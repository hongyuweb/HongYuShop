<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-03 0003
 * Time: 13:24
 * Http: www.hongyuvip.com
 */

namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        if($_POST){
            $model = D('Admin');
            if($model->create($_POST, 4)){
                $ret = $model->login();
                if($ret === TRUE){
                    $model->data(array('id'=>session('id'),'last_login'=>array('exp','now()')))->save();
                    $this -> redirect('Index/index');
                    exit;
                }else{
                    $ret == 1 ? $this->error('用户名不存在！') : $this->error('密码不正确！');
                }
            }else{
                $this->error($model->getError());
            }
        }
        $this->display();
    }

    public function logout(){
        session(null);
        $this->redirect('Login/login');
    }
}