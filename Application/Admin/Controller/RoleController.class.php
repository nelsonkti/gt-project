<?php
/**
 * TP3-CMS
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/TP3-CMS
 */

namespace Admin\Controller;
use Think\Controller;

/**
 * 角色控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/TP3-CMS
 */
class RoleController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Role';

    /**
     * 连接字符串
     */
    CONST CONNECTION_STRING = '|--------';

	/**
	 * 列表
	 */
	public function index()
    {
		$res = D(self::COMMON_MODEL)->datalist(self::MODEL_NAME, [], 'role_id, role_name', 'role_id desc');

		$this->assign('list', $res['list']);
		$this->assign('page', $res['page']);
		$this->assign('count', $res['count']);
		$this->display();
	}

	/**
	 * 删除
	 */
	public function del()
    {
		$role_id = intval($_POST['data']);
		$where = ['role_id' => $role_id];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

		if($res) {
			// 删除角色之后删除相关用户的角色
			$infos = D(self::COMMON_MODEL)->infos('Admin', ['admin_role_id' => $role_id], 'admin_id');
			foreach($infos as $key => $value) {
				$res =D(self::COMMON_MODEL)->edit('Admin', ['admin_id' => $value['admin_id']], ['admin_role_id' => 0]);
			}
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 批量删除
	 */
	public function dels()
    {
		$role_ids = $_POST['data'];
		$where = ['role_id' => ['in', $role_ids]];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 添加(页面)
	 */
	public function add()
    {
		$this->display();
	}

	/**
	 * 添加(数据)
	 */
	public function addData()
    {
		$data = $_POST;

		$res = D(self::COMMON_MODEL)->add(self::MODEL_NAME, $data);

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
		$role_id = intval($_GET['role_id']);
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['role_id' => $role_id], 'role_id, role_name');

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;

		$where = ['role_id' => $data['role_id']];
		unset($data['role_id']);

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 分配权限
	 */
	public function info()
    {
		$role_id = intval($_GET['role_id']);
		$role_info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['role_id' => $role_id], '*');
		$role_auth_ids = explode(',', $role_info['role_auth_ids']);
		$field = 'auth_id, auth_name, auth_pid, auth_level';
		$sort = 'auth_sort, auth_id';

        // 一级权限
		$listA = D(self::COMMON_MODEL)->infosOrder('Auth', ['auth_level' => 0], $field, $sort);
        // 二级权限
		$listB = D(self::COMMON_MODEL)->infosOrder('Auth', ['auth_level' => 1], $field, $sort);
        // 三级权限
		$listC = D(self::COMMON_MODEL)->infosOrder('Auth', ['auth_level' =>2 ], $field, $sort);

		$list = [];
		foreach ($listA as $k1 => $v1) {
			$list[] = $v1;
			foreach ($listB as $k2 => $v2) {
				if ($v2['auth_pid'] == $v1['auth_id']) {
					$v2['auth_name'] = self::CONNECTION_STRING . $v2['auth_name'];
					$list[] = $v2;
					foreach ($listC as $k3 => $v3) {
						if ($v3['auth_pid'] == $v2['auth_id']) {
							$v3['auth_name'] = str_repeat(self::CONNECTION_STRING, 2) . $v3['auth_name'];
							$list[] = $v3;
						}
					}
				}
			}
		}

		$this->assign('list', $list);
		$this->assign('role_auth_ids', $role_auth_ids);
		$this->assign('role_info', $role_info);

		$this->display();
	}

	/**
	 * 修改角色权限ids
	 */
	public function authEdit()
    {
		$role_id = $_POST['role_id'];
		$role_auth_ids = $_POST['role_auth_ids'];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, ['role_id' => $role_id], ['role_auth_ids' => $role_auth_ids]);
        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}
}
