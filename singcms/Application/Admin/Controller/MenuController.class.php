<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Controller;

use Think\Controller;

/**
 * Description of MenuController
 *
 * @author cy
 */
class MenuController extends CommonController {

    public function index() {
        //限制条件
        $data = array();
        if (isset($_REQUEST['type']) && in_array($_REQUEST['type'], array(0, 1))) {
            $data['type'] = intval($_REQUEST['type']);
            $this->assign("type", $data['type']);
        } else {
            $this->assign("type", -99);
        }
        //显示分页号
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        //每页条数
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 5;

        //读取数据库信息
        $menus = D('Menu')->getMenus($data, $page, $pageSize);
        $menusCount = D('Menu')->getMenusCount($data);
        //分页
        $res = new \Think\Page($menusCount, $pageSize);
        $pageRes = $res->show();
        $this->assign("menus", $menus);
        $this->assign("pageRes", $pageRes);
        $this->display();
    }

    public function add() {
        if ($_POST) {
            //基本验证
            if (!$_POST['name']) {
                return show(0, '菜单名不能为空');
            }
            if (!$_POST['m']) {
                return show(0, '模块名不能为空');
            }
            if (!$_POST['c']) {
                return show(0, '控制器不能为空');
            }
            if (!$_POST['f']) {
                return show(0, '方法不能为空');
            }
            if ($_POST['menu_id']) {
                return $this->save($_POST);
            }
            $MenuId = D('Menu')->insert($_POST);
            if ($MenuId) {
                return show(1, "数据提交成功", $MenuId);
            }
            return show(0, "数据提交失败");
        } else {
            $this->display();
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $res = D('Menu')->find($id);
        $this->assign('res', $res);
        $this->display();
    }

    public function save($data) {
        $id = $data['menu_id'];
        unset($data['menu_id']);
        try {
            $res = D('Menu')->updateMenuById($id, $data);
            if ($res === false) {
                return show(0, '数据更新失败');
            }
            return show(1, '数据更新成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function setStatus() {
        if ($_POST) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            //执行数据更新操作
            try {
                $res = D('Menu')->updateStatusById($id, $status);
                if ($res) {
                    return show(1, "数据删除成功");
                } else {
                    return show(0, "数据删除失败");
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        }
        return show(0, '没有数据提交');
    }

    public function listorder() {
        
        $jumpUrl = $_SERVER['HTTP_REFERER'];
    
        $errors = array();
        if($_POST['listorder']){
            $data = $_POST['listorder'];
            try{
                foreach ($data as $menuId=>$v){
                //遍历得到id和listorder值，传递到model中处理
                    $id = D('Menu')->updateListorderById($menuId,$v);
                    if($id === FALSE){
                        $errors[] = $menuId;
                    }
                }
            } catch (Exception $e) {
                return show(0,'排序失败'.$e->getMessage(),array('jump_url'=>$jumpUrl));                      
            }
            if($errors) {
                return show(0,'排序失败-失败ID为'.implode(',', $errors),array('jump_url'=>$jumpUrl));
            }                         
            return show(1,'排序成功',array('jump_url'=>$jumpUrl));
        }    
        return show(0,'数据提交失败', array('jump_url'=>$jumpUrl));
    }
}
