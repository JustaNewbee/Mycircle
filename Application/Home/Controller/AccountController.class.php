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
}