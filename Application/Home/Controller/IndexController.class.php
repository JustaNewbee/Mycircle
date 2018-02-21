<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->assign_data();
        $this->display();
    }
    public function assign_data(){
        $this->assign("username",session("username"));
    }
}