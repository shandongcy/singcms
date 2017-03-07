<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;

use Think\Model;

class AdminModel extends Model {

    private $_db = '';

    public function __construct() {
        $this->_db = M('admin');
    }

    public function getAdminByUsername($username) {
        $ret = $this->_db->where('username="' . $username . '"')->find();
        return $ret;
    }

    public function addAdmin($username, $password) {
        $password = getMd5Password($password);
        $data = array(
            'username' => $username,
            'password' => $password,
        );
        $rs = $this->_db->add($data);
        return $rs;
    }

}
