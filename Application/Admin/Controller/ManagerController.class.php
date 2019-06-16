<?php
/**
 * gt-project
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */

namespace Admin\Controller;
use Think\Controller;

/**
 * 管理员控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class ManagerController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Admin';

	/**
	 * 列表
	 */
	public function index()
    {
		$list = D(self::COMMON_MODEL)->infos(self::MODEL_NAME, [], 'admin_id, admin_name, admin_role_id');
		foreach ($list as $key => $value) {
			$list[$key]['role_name'] = D(self::COMMON_MODEL)->getField('Role', ['role_id' => $value['admin_role_id']], 'role_name');
		}

		$this->assign('list', $list);
		$this->display();
	}

	/**
	 * 添加(页面)
	 */
	public function add()
    {
		$role_list = D(self::COMMON_MODEL)->infos('Role', [], 'role_id, role_name');

		$this->assign('role_list', $role_list);
		$this->display();
	}

	/**
	 * 添加(数据)
	 */
	public function addData()
    {
		$data = $_POST;
		unset($data['admin_repass']);
		$data['admin_pass'] = encrypt($data['admin_pass']);

		$res = D(self::COMMON_MODEL)->add(self::MODEL_NAME, $data);
        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 删除
	 */
	public function del() {
		$admin_id 	= intval($_POST['data']);

		// 超级管理员admin不允许删除
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['admin_id' => $admin_id], 'admin_name');
		if ($info['admin_name'] == 'admin') {
            $this->ajaxReturn(msg('删除失败! 超级管理员admin不允许删除', self::CODE_FAIL), self::JSON_TYPE);
		}

		$where = ['admin_id' => $admin_id];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 编辑(页面)
	 */
	public function edit()
    {
		$admin_id = intval($_GET['admin_id']);
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['admin_id' => $admin_id], 'admin_id, admin_name, admin_role_id');
		if ($info['admin_name'] == 'admin') {
			$this->error('超级管理员admin不允许编辑');
		}
		$role_list = D(self::COMMON_MODEL)->infos('Role',array(),'role_id, role_name');

		$this->assign('role_list', $role_list);
		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;

		// 超级管理员admin不允许编辑
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['admin_id' => $data['admin_id']], 'admin_name');
		if ($info['admin_name'] == 'admin') {
            $this->ajaxReturn(msg('删除失败! 超级管理员admin不允许编辑', self::CODE_FAIL), self::JSON_TYPE);
		}

		$where = ['admin_id' => $data['admin_id']];
		unset($data['admin_id']);
		
		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}
}
