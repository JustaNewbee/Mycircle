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
        $uid = session('uid');
        $this->assign("username",session("username"));
        $this->assign("total",$article->count("article_id"));
        $this->assign('avatar',M('data')->where("d_uid='$uid'")->getField('d_avatar'));
    }
}