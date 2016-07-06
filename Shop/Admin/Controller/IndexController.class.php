<?php
/**
 * 后台首页控制器
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-03 0003
 * Time: 13:14
 * Http: www.hongyuvip.com
 */

namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function __construct(){
        parent::__construct();
        if(!session('username')){
            //跳转至登录界面
            $this -> redirect('Login/login');
        }else{
            $this->assign('username',$_SESSION['username']);
        }
    }

    public function index(){
        $this->display();
    }

    public function main(){
        $this->display();
    }

}