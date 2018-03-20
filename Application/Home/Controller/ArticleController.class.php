<?php
/**
 * Created by PhpStorm.
 * User: Micosoft
 * Date: 2017/12/27 0027
 * Time: 17:47
 */
namespace Home\Controller;
use Think\Controller;
class ArticleController extends Controller{
    public function read(){
        $article =  M('article');
        if(isset($_GET['aid'])) {
            $result = $article->find($_GET['aid']);
        }
        $this->assign("title",$result['title']);
        $this->assign("content",$result['content']);
        $this->display();
    }
    public function write(){
        $circle = M('circle');
        if(isset($_GET['circle_id'])) {
            $result = $circle->find($_GET['circle_id']);
        }
        $this->assign("circle_name",$result['circle_name']);
        $this->assign("username",session("username"));
        $this->display();
    }
    public function article_submit(){
        $article = M('article');
        $data['content'] = $_POST['content'];
        $data['title'] = $_POST['title'];
        $data['circle'] = $_POST['circle_name'];
        $data['label'] = $_POST['label'];
        $data['editor'] = session("username");
        $data['publish_date'] = date("Y-m-d");
        $aid = $article-> add($data);
        $data['w_aid'] = $aid;
        $data['w_uid'] = session("uid");
        M('write')->add($data);
        $data['p_aid'] = $aid;
        $data['p_cid'] = $_POST["circle_id"];
        M('post')->add($data);
        $url = __ROOT__."/Article/read/".$aid;
        $this->ajaxReturn($url);
    }
    public function article_list(){
        $article = M('article');
        if(isset($_POST['circle_id'])){
            $cid = $_POST['circle_id'];
            $result = $article->query("SELECT * FROM my_article JOIN my_post ON my_post.p_aid = my_article.article_id JOIN my_circle ON my_circle.circle_id = my_post.p_cid WHERE circle_id = '$cid' ORDER BY publish_date DESC");
        }else{
            $result = $article->query("SELECT * FROM my_article JOIN my_post ON my_post.p_aid = my_article.article_id ORDER BY publish_date DESC");
        }
        $return = $this->return_text($result);
        $this->ajaxReturn($return);
    }
    //格式化文本，处理文章的第一段文本
    public function return_text($result){
        for($i=0;$i<count($result);$i++) {
            $content = $result[$i]['content'] ;
            $point = strpos($content, "</p>")+4;
            $result[$i]['content']= substr($content,0,$point);
            if(strchr($result[$i]['content'],"<img")) {
                $result[$i]['content']= substr($content,$point,strpos($content, "</p>")+4);
            }
            $result[$i]['content'] = strip_tags($result[$i]['content']);
            $result[$i]['content'] = $this->trimall($result[$i]['content']);
        }
        return $result;
    }
    //消除文本中的空格
    function trimall($str){
        $reg = array(" ","　","\t","\n","\r");
        return str_replace($reg, '', $str);
    }
}