<?php
/**
 * Created by PhpStorm.
 * User: Micosoft
 * Date: 2017/12/30 0030
 * Time: 17:22
 */
namespace Home\Controller;
use Think\Controller;
class CircleController extends Controller{
    public function circle_index(){
        $this->display();
    }
    public function circle_display(){
        $category = $_GET['category'];
        $circle = M('circle');
        if(isset($category)){
            $result = $circle -> query("SELECT circle_id,circle_name,circle_people_num,circle_article_num,circle_intro,class_name FROM my_circle INNER JOIN my_class ON my_circle.circle_class = my_class.class_id WHERE circle_class='$category'");
        }else{
            $result = $circle -> query("SELECT circle_id,circle_name,circle_people_num,circle_article_num,circle_intro,class_name FROM my_circle INNER JOIN my_class ON my_circle.circle_class = my_class.class_id");
        }
       // $result = $circle -> getField("circle_id,circle_name,circle_intro",true);
        $this->ajaxReturn($result);
    }
    public function  get_circle_class(){
        $select = $_POST['select'];
        $circle = M('class');
        if($select){
            $result = $circle->where("parent_id='$select'")->getfield("class_id,class_name",true);
            $this->ajaxReturn($result);
        }else{
            $result = $circle->where("parent_id=0")->getfield("class_id,class_name",true);
            $this->ajaxReturn($result);
        }
    }
    public function circle_create(){
        $this->display();
    }
    public function create_circle(){
        $circle = M('circle');
        $circle_name = $_POST['circle_name'];
        $circle_intro = $_POST['circle_intro'];
        $circle_class = $_POST['circle_class'];
        $insert_data['circle_name'] = $circle_name;
        $insert_data['circle_intro'] = $circle_intro;
        $insert_data['circle_class'] = $circle_class;
        $circle->data($insert_data)->add();
    }
    public function my_circle(){
        $circle = M('circle');
        if(isset($_GET['id'])) {
            $data = $circle->find($_GET['id']);
            $class = M('class')->find($data['circle_class']);
            $this->assign("name",$data['circle_name']);
            $this->assign("intro",$data["circle_intro"]);
            $this->assign("people",$data["circle_people_num"]);
            $this->assign("article",$data["circle_article_num"]);
            $this->assign("id",$_GET['id']);
            $this->assign("class",$class['class_name']);
            $this->assign("category",$class['class_id']);
        }
        $this->display();
    }
//    加入兴趣圈操作
    public function join(){
        $join = M('relation');
        $uid = session("uid");
        $data['r_cid'] = $_GET['circle_id'];
        $data['r_uid'] = $uid;
        $join->add($data);
    }
    public function user_list(){
        $user = M('user');
        $uid = session("uid");
        if(isset($uid)){
            $join = $user -> query("SELECT circle_id,circle_name FROM my_user 
            JOIN my_relation on my_relation.r_uid=my_user.uid 
            JOIN my_circle on my_relation.r_cid=my_circle.circle_id
            where uid = '$uid'");
//            M('circle')->update()
            $article = $user -> query("SELECT title ,article_id FROM my_user 
                              JOIN my_write ON my_user.uid = my_write.w_uid 
                              JOIN my_article ON my_article.article_id = my_write.w_aid
                              WHERE uid = '$uid'");
            $result = array($join,$article);
            $this->ajaxReturn($result);
        }
    }
}