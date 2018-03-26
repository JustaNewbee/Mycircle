<?php
/**
 * Created by PhpStorm.
 * User: Micosoft
 * Date: 2017/12/18 0018
 * Time: 20:25
 */

namespace Home\Controller;
use Think\Controller;
class AccountController extends Controller
{
    public function user_login(){
        $login = M('user');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $login->where("username='$username' and password='$password'")->find();
        if($result){
            session("uid",$result['uid']);
            session("username",$result['username']);
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    public function check_login(){
        if(session("uid")){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    public function user_sign(){
        $register = M('user');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $mail = $_POST['mail'];
        $insert_data['username'] =  $username;
        $insert_data['password'] =  $password;
        $insert_data['mail'] =  $mail;
        $register->data($insert_data)->add();
        $login = M('user');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $login->where("username='$username' and password='$password'")->find();
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
        $result = $data->find($uid);
        $this->assign('uid',session('uid'));
        $this->assign('uname',session('username'));
        $this->assign('intro',$result['d_intro']);
        $this->assign('sex',$result['d_sex']);
        $this->assign('date',$result['d_birthday']);
        $this->assign('avatar',$result['d_avatar']);
        $this->display();
    }
    public function change_data(){
        $default = '/mycircle/Public/img/akari.jpg';
        $uid = session('uid');
        $data['d_sex'] = $_POST['sex'];
        $data['d_intro'] = $_POST['intro'];
        $data['d_birthday'] =$_POST['date'];
        $data['d_uid'] = $uid;
        $data['d_avatar'] = $default;
        if(!is_null($_POST['src'])){
            $data['d_avatar'] = $_POST['src'];
        }
        $dt = M('data');
        if($dt->find($uid)){
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
        $result['msg']="";
        $result['count']="1000";
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
        $aid = $_POST['id'];
        $cid = $post->where("p_aid='$aid'")->find()['p_cid'];
        $write->where("w_aid='$aid'")->delete();
        $post->where("p_aid='$aid'")->delete();
        $article->where("article_id='$aid'")->delete();
        M('circle')->where("'$cid'=circle_id")->setDec('circle_article_num');
        $this->ajaxReturn(true);
    }
}