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
            $this->assign("title",$result['title']);
            $this->assign("content",$result['content']);
        }
        $this->display();
    }
    public function write(){
        $circle = M('circle');
        if(isset($_GET['circle'])) {
            $result = $circle->find($_GET['circle']);
            $this->assign("circle_name",$result['circle_name']);
        }
        if(isset($_GET['article_id'])) {
            $article = M('article');
            $result = $article->find($_GET['article_id']);
            $this->assign('title',$result['title']);
            $this->assign('content',$result['content']);
            $this->assign('label',$result['label']);
        }
        $this->assign("uid",session("uid"));
        $this->display();
    }
    public function article_submit(){
        $article = M('article');
        if($_POST['action']=='sub'){
            $data['content'] = $_POST['content'];
            $data['title'] = $_POST['title'];
            $data['circle'] = $_POST['circle_name'];
            $data['label'] = $_POST['label'];
            $data['editor'] = session("uid");
            $data['publish_date'] = date("Y-m-d");
            $aid = $article-> add($data);
            $data['w_aid'] = $aid;
            $data['w_uid'] = session("uid");
            M('write')->add($data);
            $data['p_aid'] = $aid;
            $data['p_cid'] = $_POST["id"];
            M('post')->add($data);
            $cid = $_POST["id"];
            $circle = M('circle');
            $circle->where("circle_id='$cid'")->setInc('circle_article_num');
            $url = __ROOT__."/Article/read/".$aid;
            $this->ajaxReturn($url);
        }
        if($_POST['action']=='edit'){
            $aid = $_POST['id'];
            $upd['title'] = $_POST['title'];
            $upd['content'] = $_POST['content'];
            $upd['label'] = $_POST['label'];
            $article->where("'$aid'=article_id")->save($upd);
            $url = __ROOT__."/Article/read/".$aid;
            $this->ajaxReturn($url);
        }
    }
    public function article_list(){
        $article = M('article');
        if(isset($_POST['circle_id'])){
            $cid = $_POST['circle_id'];
            $result = $article->query("SELECT * FROM my_article JOIN my_post ON my_post.p_aid = my_article.article_id JOIN my_circle ON my_circle.circle_id = my_post.p_cid WHERE circle_id = '$cid' ORDER BY publish_date DESC");
        }else{
            $need = $_POST['need_page'];
            $current = ($_GET['page']-1)*$need;
            $result = $article->query("SELECT article_id, 
            pageview, comment, publish_date,content,title,
            username ,circle,p_cid
            FROM my_article JOIN my_post ON my_post.p_aid = my_article.article_id
            JOIN my_user ON my_user.uid = my_article.editor  ORDER BY publish_date DESC LIMIT $current,$need");
        }
        $return = $this->return_text($result);
        $this->ajaxReturn($return);
    }
    //格式化文本
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
    //消除文本头部中的空格
    public function trimall($str){
        $reg = array("\t","\n","\r","&nbsp;","&emsp;");
        return str_replace($reg, '', $str);
    }

}