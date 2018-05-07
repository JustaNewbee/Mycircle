<?php
/**
 * Created by PhpStorm.
 * User: Micosoft
 * Date: 2018/4/13 0013
 * Time: 23:59
 */
namespace Home\Controller;
use Think\Controller;
class MyAdminController extends Controller {
    public function index() {
        $user = M('user');
        $id = session('uid');
        if(is_null($id)){
            $this->redirect('Account/login', null, 3, '<a class="wrap-tip" href="'.__ROOT__.'/Account/login" 
            style="display:inline-block; position: absolute; top: 50%; left: 0; right: 0; margin: 0 auto; border: 1px solid #dadada; 
            padding: 50px 70px; width: 800px; text-align: center;transform: translateY(-50%);">页面跳转中...点击直接跳转</a>');
           return ;
        }
        if($user->where("uid = $id and permission = 1")->find()){
            $this->display();
        }
        else $this->error('没有权限访问','Index/index',3);
    }
    public function check_circle(){
        $circle = M('circle');
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $list['code'] = '0';
        $list['msg']="";
        $list['data'] = $circle->query("SELECT circle_id, circle_name, circle_intro, username, class_name FROM my_circle JOIN my_user ON my_user.uid = my_circle.circle_creator JOIN my_class on my_class.class_id = my_circle.circle_class where checked = 'unpass' LIMIT $page,$limit");
        $list['count']= $circle->where("checked = 'unpass'")->count();
        $this->ajaxReturn($list);
    }
    public function class_admin(){
        $class = M('class');
        if($_POST['request']=="parent_class"){
            $result = $class->where("parent_id = 0")->select();
        }
        if($_POST['request']=="child_class"){
            $select = $_POST['select_class'];
            $result = $class->where("parent_id = $select")->select();
        }
        $this->ajaxReturn($result);
    }
    public function request(){
        $circle = M('circle');
        if($_POST['request']=='accept'){
            $accept_id = $_POST['id'];
            $circle->where("circle_id = $accept_id")->setField('checked','pass');
            $this->ajaxReturn('accept_success');
            return ;
        }
        if($_POST['request']=='reject'){
            $reject_id = $_POST['id'];
            $circle->where("circle_id = $reject_id")->delete();
            $this->ajaxReturn('reject_success');
            return ;
        }
        $this->ajaxReturn('error');
    }
    public function addClass(){
        $class = M('class');
        $data['class_name'] = $_GET['addClass'];
        $data['parent_id'] = $_GET['fromClass'];
        $data['class_id'] = $class->count() + 1;
        if($class->add($data)){
            $this->ajaxReturn('success');
        }
    }
    public function removeClass(){
        $class = M('class');
        if(isset($_GET['removeClass'])){
            $class_id = $_GET['removeClass'];
            $class->where("class_id = $class_id")->delete();
            $this->ajaxReturn('success');
        }
    }
    public function mycircle(){
        $id = session('uid');
        $cid = $_GET['circle'];
        $circle = M('circle');
        $result = $circle->where("circle_creator = $id and circle_id =$cid")->find();
        if($result){
            $this->assign("id",$result['circle_id']);
            $this->assign("name",$result['circle_name']);
            $this->assign("intro",$result['circle_intro']);
            $this->assign("notice",$result['notice']);
            $this->assign("avatar",$result['circle_avatar']);
            $this->display();
        }else {
            $this->error('没有权限访问','Index/index',3);
        }
    }
    public function upload(){
        $circle = new \Home\Controller\CircleController();
        $circle->upload('/upload/circle/');
    }
    public function change_circle(){
        $circle = M('circle');
        $id = $_POST['id'];
        $data['circle_avatar'] = $_POST['src'];
        $data['circle_intro'] = $_POST['intro'];
        $data['notice'] = $_POST['notice'];
        if($circle->where("circle_id = '$id'")->find()){
            $circle->where("circle_id = '$id'")->save($data);
        }
        $this->ajaxReturn('true');
    }
    public function post(){
        $article = M('article');
        $cid = $_GET['id'];
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $result['code'] = '0';
        $result['msg'] = "";
        $result['count'] = M('post')->where("p_cid ='$cid'")->count();
        $at = new \Home\Controller\ArticleController();
        $result['data'] = $at->return_text($article->join("my_post on my_post.p_aid = my_article.article_id")->where("p_cid ='$cid'")
            ->field('article_id,title,content,pageview,comment,publish_date,circle,label')
            ->page($page,$limit)->select());
        $this->ajaxReturn($result);
    }
    public function admin_del(){
        $article = M('article');
        $post = M('post');
        $write = M('write');
        $comment = M('comment');
        $aid = $_POST['id'];
        $cid = $post->where("p_aid='$aid'")->find()['p_cid'];
        $write->where("w_aid='$aid'")->delete();
        $post->where("p_aid='$aid'")->delete();
        $article->where("article_id='$aid'")->delete();
        $comment->where("post_id='$aid'")->delete();
        M('circle')->where("'$cid'=circle_id")->setDec('circle_article_num');
        $this->ajaxReturn(true);
    }
}