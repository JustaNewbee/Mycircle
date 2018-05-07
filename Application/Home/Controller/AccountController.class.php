<?php
/**
 * Created by PhpStorm.
 * User: Micosoft
 * Date: 2017/12/18 0018
 * Time: 20:25
 */

namespace Home\Controller;
use Think\Controller;
class AccountController extends Controller{
    public $default = '/mycircle/Public/img/akari.jpg';
    public function user_login(){
        $login = M('user');
        $username = $_POST['username'];
        $password = MD5($_POST['password']);
        $result = $login->where("username='$username' and password='$password'")->find();
        if($result){
            session("uid",$result['uid']);
            session("username",$result['username']);
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    public function login() {
        if(!is_null(session('uid'))){
            $this->redirect('Index/index');
        }
        else $this->display();
    }
    public function check_login(){
        if(session("uid")){
            $uid = session('uid');
            $data['head'] = true;
            $data['name'] = session("username");
            $data['src'] = M('data')->where("d_uid = '$uid'")->getField('d_avatar');
            if(M('user')->where("uid = $uid")->getField('permission')==1){
                $data['role'] = 'admin';
            }
        }else{
            $data['head'] = false;
        }
        $this->ajaxReturn($data);
    }
    public function user_sign(){
        $register = M('user');
        $username = $_POST['username'];
        $password = MD5($_POST['password']) ;
        $mail = $_POST['mail'];
        $insert_data['username'] =  $username;
        $insert_data['password'] =  $password;
        $insert_data['mail'] =  $mail;
        $register->data($insert_data)->add();
        $login = M('user');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $login->where("username='$username' and password='$password'")->find();
        $data['d_avatar'] = $this->default;
        $data['d_uid'] = $result['uid'];
        M('data')->add($data);
        session("uid",$result['uid']);
        session("username",$result['username']);
    }
    public function verify(){
        $user = M('user');
        $verify = $_POST['verify'];
        $result = $user->where("username = '$verify'")->find();
        if(is_null($result)){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    public function logout(){
        session('uid',null);
        session('username',null);
        redirect(U('Home/Index'));
    }
    public function mydata(){
        $uid = session('uid');
        $data = M('data');
        $result = $data->where("d_uid = '$uid'")->find();
        $this->assign('uid',session('uid'));
        $this->assign('uname',session('username'));
        $this->assign('intro',$result['d_intro']);
        $this->assign('sex',$result['d_sex']);
        $this->assign('date',$result['d_birthday']);
        if(!is_null($result['d_avatar'])){
            $this->assign('avatar',$result['d_avatar']);
        }else{
            $this->assign('avatar',$this->default);
        }
        $this->display();
    }
    public function change_data(){
        $uid = session('uid');
        $data['d_sex'] = $_POST['sex'];
        $data['d_intro'] = $_POST['intro'];
        $data['d_birthday'] =$_POST['date'];
        $data['d_uid'] = $uid;
        $data['d_avatar'] = $_POST['src'];
        $dt = M('data');
        if($dt->where("d_uid = '$uid'")->find()){
            $dt->where("d_uid = '$uid'")->save($data);
        }else{
            $dt->where("d_uid = '$uid'")->add($data);
        }
        $this->ajaxReturn('true');
    }
    public function upload(){
        $circle = new \Home\Controller\CircleController();
        $circle->upload('/upload/user/');
    }
    public function post(){
        $article = M('article');
        $uid = session('uid');
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $result['code'] = '0';
        $result['msg'] = "";
        $result['count'] = $article->where("editor='$uid'")->count();
        $at = new \Home\Controller\ArticleController();
        $result['data'] = $at->return_text($article->where("editor='$uid'")
            ->field('article_id,title,content,pageview,comment,publish_date,circle,label')
            ->page($page,$limit)->select());
        $this->ajaxReturn($result);
    }
    public function del(){
        $article = M('article');
        $post = M('post');
        $write = M('write');
        $comment = M('comment');
        $aid = $_POST['id'];
        $cid = $post->where("p_aid='$aid'")->find()['p_cid'];
        $write->where("w_aid='$aid'")->delete();
        $post->where("p_aid='$aid'")->delete();
        $article->where("article_id='$aid'")->delete();

        M('circle')->where("'$cid'=circle_id")->setDec('circle_article_num');
        $this->ajaxReturn(true);
    }
    public function mycircle(){
        $id = session('uid');
        $this->assign('total',M('relation')->where("r_uid = $id")->count());
        $this->assign('total_create',M('circle')->where("circle_creator = $id")->count());
        $this->display();
    }
    public function getMyCircle(){
        $relation = M('relation');
        $uid = session('uid');
        $page = $_POST['page'];
        $current = ($_POST['current']-1)*$page;
        $result = $relation->query("SELECT circle_id,circle_name,circle_intro,circle_avatar FROM my_relation
        JOIN my_circle ON my_circle.circle_id=r_cid WHERE r_uid = $uid LIMIT $current,$page");
        $this->ajaxReturn($result);
    }
    public function getMyCreateCircle() {
        $circle = M('circle');
        $uid = session('uid');
        $page = $_POST['page'];
        $current = ($_POST['current']-1)*$page;
        $result = $circle->query("SELECT circle_id,circle_name,circle_intro,circle_avatar,checked FROM my_circle
        WHERE circle_creator = $uid LIMIT $current,$page");
        $this->ajaxReturn($result);
    }
    public function changePassword(){
        $pw = md5($_POST['password']);
        $old_pw = md5($_POST['old_password']);
        $id = session('uid');
        if(M('user')->where("uid = $id and password = '$old_pw'")->find()){
            M('user')->where("uid = $id")->setField('password',$pw);
            $msg['head'] = true;
        }else {
            $msg['head'] = false;
            $msg['content'] = '密码错误';
        }
        $this->ajaxReturn($msg);
    }
}