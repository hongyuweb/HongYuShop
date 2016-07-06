<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-03 0003
 * Time: 13:24
 * Http: www.hongyuvip.com
 */

namespace Admin\Controller;
use Admin\Controller\IndexController;
class ManagerController extends IndexController {

    //增加管理员
    public function addAdmin(){
        if(IS_POST){
            $admin = D('Admin');
            if($admin->create()){
                if($admin->add()){
                    $this->success('添加成功',U('Manager/listAdmin'));
                    exit;
                }else{
                    $this->error('添加失败，请重试！');
                }
            }else{
                $this->error($admin->getError());
            }
        }
        $this->display();
    }

    //编辑管理
    public function saveAdmin($id){
        $admin = D('Admin');
        if($_POST){
            if($admin->create()){
                if($admin->save() !== FALSE){
                    $this->success('修改成功',U('Manager/listAdmin'));
                    exit;
                }else{
                    $this->error('修改失败，请重试！');
                }
            }else{
                $this->error($admin->getError());
            }
        }
        $info = $admin->find($id);
        $this->assign('info',$info);
        $this->display();
    }

    //显示管理员
    public function listAdmin(){
        $model = D('Admin');
        $data = $model->search();
        $this->assign(array(
            'list' => $data['data'],
            'page' => $data['page'],
        ));
//        if($_POST){
//            //获取带翻页的数据
//            $data = $model->search();
//            show_bug($data);
//        }else{
//            $count = $model->where('1=1')->count();// 查询满足要求的总记录数
//            $per = 15; //每页显示条数
//            $Page = new \Component\Page($count,$per);
//            $list = $model->where('1=1')->order('id')->limit($Page->limit)->select();
//            $Page = $Page -> fpage();
//        }
//        $this->assign('list',$list);// 赋值数据集
//        $this->assign('page',$Page);// 赋值分页输出
        $this->display();
    }


    //删除管理员
    public function delAdmin($id){
        if($id > 1){
            $model = M('Admin');
            $model->delete($id);
        }
        $this->success('删除成功',U('Manager/listAdmin'));
    }

    //批量删除管理员
    public function delLotAdmin(){
        $dellotid = I('post.dellot');
        if($dellotid){
            $key = array_search(1,$dellotid);
            if($key !== false){
                unset($dellotid[$key]);
            }
            if($dellotid){
                $dellotid = implode(',',$dellotid);
                $model = M('Admin');
                $model -> delete($dellotid);
            }
            $this->success('删除成功',U('Manager/listAdmin'));
        }else{
            $this->error('请选择删除的管理员',U('Manager/listAdmin'));
        }
    }

    public function system(){
        $info = array(
            '系统名称'=>'鸿宇多用户商城',
            '开发团队'=>'鸿宇科技 & Shadow',
            '企业官网'=>'<a href="http://www.hongyuvip.com" target="_blank">http://www.hongyuvip.com</a>',
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            'ThinkPHP版本'=>THINK_VERSION,
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
        );
        $this->assign('info',$info);
        $this->display();
    }

    public function show(){
        $model = D("Admin");
    }
}