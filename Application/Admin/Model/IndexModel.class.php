<?php
/**
 * gt-project
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying
 */

namespace Admin\Model;
use Think\Model;

/**
 * 首页模型
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying
 */
class IndexModel extends CommonModel
{
	private $_db1 = '';
	private $_db2 = '';
	private $_db3 = '';

	public function __construct()
    {
        // 用户
		$this->_db1 = M('Admin');
        // 角色
		$this->_db2 = M('Role');
        // 权限
		$this->_db3 = M('Auth');
	}

	/**
	 * 首页显示对应权限
	 */
	public function auth()
    {
		$admin_id = session('admin_id');
		$admin_name = session('admin_name');

		// 角色ID
		$admin_role_id = $this->_db1->where(['admin_id' => $admin_id])->getField('admin_role_id');
		// 权限
		$sort = 'auth_sort, auth_id';
		if ($admin_name == 'admin') {
			// 超级管理员admin拥有全部权限
            // 一级权限
			$authA = $this->_db3->where(['auth_level' => 0, 'auth_status' => 1])->order($sort)->select();
            // 二级权限
			$authB = $this->_db3->where(['auth_level' => 1, 'auth_status' => 1])->order($sort)->select();
		} else {
			// 权限ids
			$role_auth_ids = $this->_db2->where(['role_id' => $admin_role_id])->getField('role_auth_ids');
            // 一级权限
			$authA = $this->_db3->where(['auth_level' => 0, 'auth_id' => ['in', $role_auth_ids], 'auth_status' => 1])->order($sort)->select();
            // 二级权限
			$authB = $this->_db3->where(['auth_level' => 1, 'auth_id' => ['in', $role_auth_ids], 'auth_status' => 1])->order($sort)->select();
		}
		
		$auth = ['authA' => $authA, 'authB' => $authB];
		return $auth;
	}
}
