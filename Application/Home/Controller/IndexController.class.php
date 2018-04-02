<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->assign_data();
        $this->display();
    }
    public function assign_data(){
        $article = M('article');
        $this->assign("total",$article->count("article_id"));
    }

}