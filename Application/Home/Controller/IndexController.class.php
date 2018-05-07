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
    public function search(){
        $key = $_GET['key'];
        $article = M('article');
        $circle =M('circle');
        $result['post'] = $article->query("SELECT * FROM my_article WHERE label LIKE '%$key%' or title LIKE '%$key%'");
        $result['circle'] = $circle->query("SELECT * FROM my_circle WHERE circle_name LIKE '%$key%' or circle_intro LIKE '%$key%'");
        $this->assign("key",$key);
        $this->assign("result_post", json_encode($this->return_text($result['post'])));
        $this->assign("result_circle",json_encode($result['circle']));
        $this->display();
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