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
        $data['editor'] = session("username");
        $data['publish_date'] = date("Y-m-d");
        $aid = $article-> add($data);
        $data['w_aid'] = $aid;
        $data['w_uid'] = session("uid");
        M('write')->add($data);
    }
    public function article_list(){
        $article = M('article');
        $result = $article->query("SELECT * FROM my_article JOIN my_post ON my_post.p_aid = my_article.article_id ORDER BY publish_date DESC");
        for($i=0;$i<count($result);$i++) {
            $content = $result[$i]['content'] ;
            $result[$i]['content']= substr($content,0,strpos($content, "</p>")+4);
        }
        $this->ajaxReturn($result);
    }
}