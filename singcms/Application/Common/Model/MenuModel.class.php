<?php

namespace Common\Model;

use Think\Model;

/**
 * Description of MenuModel
 *
 * @author cy
 */
class MenuModel extends Model {

    private $_db = '';

    public function __construct() {
        $this->_db = M('menu');
    }

    public function insert($data = array()) {
        if (!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    public function getMenus($data = array(), $page, $pageSize = 2) {
        //仅读取 状态不等于 -1 的
        $data['status'] = array('neq', -1);
        //分页开始位置
        $offSet = ($page - 1) * $pageSize;
        //条件查询
        $res = $this->_db->where($data)->order("listorder desc,menu_id desc")->limit($offSet, $pageSize)->select();
        return $res;
    }

    public function getMenusCount($data = array()) {
        //仅读取 状态不等于 -1 的
        $data['status'] = array('neq', -1);
        return $this->_db->where($data)->count();
    }

    public function find($id) {
        if (!isset($id) || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('menu_id=' . $id)->find();
    }

    public function updateMenuById($id, $data) {
        if (!$id || !is_numeric($id)) {
            throw_exception("表单ID不合法");
        }
        if (!$data || !is_array($data)) {
            throw_exception("更新数据不合法");
        }
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    public function updateStatusById($id, $status) {
        if (!$id || !is_numeric($id)) {
            throw_exception("表单ID不合法");
        }
        if (!$status || !is_numeric($status)) {
            throw_exception("更新状态不合法");
        }

        $data['status'] = $status;
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    public function updateListorderById($id,$listorder) {
        if(!$id || !is_numeric($id)){
            throw_exception("ID不合法");
        }
        $data = array(
            'listorder' => intval($listorder),
        );
        return $this->_db->where('menu_id='.$id)->save($data);
    }

}
