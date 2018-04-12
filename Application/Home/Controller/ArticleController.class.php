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
    public $default = '/mycircle/Public/img/akari.jpg';
    public function read(){
        $article =  M('article');
        if(isset($_GET['aid'])) {
            $aid = $_GET['aid'];
            $result = $article->find($aid);
            $article->where("article_id = '$aid'")->setInc('pageview');
            $this->assign("title",$result['title']);
            $this->assign("content",$result['content']);
            $this->assign("label",$result['label']);
            $this->assign("date",$result['publish_date']);
            $this->assign("id",$aid);
            $editor = $result['editor'];
            $editor = M('user')->where("uid = '$editor'")->getField('username');
            $this->assign("editor",$editor);
            $total = M('comment')->count($aid);
            $this->assign("total",$total);
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
            $this->assign('cover',$result['cover']);
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
            if(isset($_POST['cover'])){
                $data['cover'] = $_POST['cover'];
            }
            else{
                $data['cover'] = $this->default;
            }
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
            if(isset($_POST['cover'])){
                $upd['cover'] = $_POST['cover'];
            }
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
            username ,circle,p_cid,cover
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
    public function upload(){
        $circle = new \Home\Controller\CircleController();
        $circle->upload('/upload/article/post/');
    }
    public function getTopicPostList(){
        $article = M('article');
        $article = M('article');
        $rank = $article -> field('title,pageview,comment')->select();
        $rank = $this->quick_sort($rank);
        $this->ajaxReturn($rank);
    }
    public function quick_sort($arr) {
        //先判断是否需要继续进行
        $length = count($arr);
        if($length <= 1) {
            return $arr;
        }
        //如果没有返回，说明数组内的元素个数 多余1个，需要排序
        //选择一个标尺
        //选择第一个元素
        $base_num = $arr[0];
        $base = $arr[0]['pageview'] + $arr[0]['comment']*2;
        //遍历 除了标尺外的所有元素，按照大小关系放入两个数组内
        //初始化两个数组
        $left_array = array();//比
        $right_array = array();//大于标尺的
        for($i=1; $i<$length; $i++) {
            $current = $arr[$i]['pageview'] + $arr[$i]['comment']*2;
            if($base < $current) {
                //放入左边数组
                $left_array[] = $arr[$i];
            } else {
                //放入右边
                $right_array[] = $arr[$i];
            }
        }
        //递归
        $left_array = $this->quick_sort($left_array);
        $right_array = $this->quick_sort($right_array);
        //合并
        return array_merge($left_array, array($base_num), $right_array);
    }
    public function shootComment(){
        $comment = M('comment');
        $data['reviewer'] = session('uid');
        $data['content'] = $_POST['content'];
        $data['post_id'] = $_POST['id'];
        $data['date'] = date("Y-m-d H:i:s");
        $comment->add($data);
    }
    public function getComment(){
        $comment = M('comment');
        $id = $_POST['id'];
        $page = $_POST['page'];
        $current = ($_POST['current']-1)*$page;
        //$result = $comment->query("SELECT reviewer,date,content,username,d_avatar FROM my_comment JOIN my_user ON my_user.uid = my_comment.reviewer JOIN my_data ON my_data.d_uid = my_comment.reviewer where post_id = '$id' ORDER BY comment_id DESC LIMIT $current,$page");
        $result = $comment->query("SELECT reviewer,date,content,username,d_avatar FROM my_comment JOIN my_user ON my_user.uid = my_comment.reviewer JOIN my_data ON my_data.d_uid = my_comment.reviewer where post_id = '$id' ORDER BY comment_id DESC");
        $this->ajaxReturn($result);
    }
}