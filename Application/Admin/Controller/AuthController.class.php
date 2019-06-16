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

namespace Admin\Controller;
use Think\Controller;

/**
 * 权限控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying
 */
class AuthController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Auth';

    /**
     * 连接字符串
     */
    CONST CONNECTION_STRING = '|--------';

	/**
	 * 列表
	 */
	public function index()
    {
	    // 排序
		$sort  = 'auth_sort, auth_id';
        // 一级权限
		$listA = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['auth_level' => 0], '*', $sort);
        // 二级权限
		$listB = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['auth_level' => 1], '*', $sort);
        // 三级权限
		$listC = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['auth_level' => 2], '*', $sort);
		
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
		$this->display();
	}

	/**
	 * 添加(页面)
	 */
	public function add()
    {
        // 一级权限
		$listA = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['auth_level' => 0], '*', 'auth_sort, auth_id');
        // 二级权限
		$listB = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['auth_level' => 1], '*', 'auth_sort, auth_id');

		$this->assign('listA', $listA);
		$this->assign('listB', $listB);
		$this->display();
	}

	/**
	 * 添加(数据)
	 */
	public function addData()
    {
		$data = $_POST;

		if ($data['auth_pid'] == 0) {
			$data['auth_level'] = 0;
		} else {
			$info = D(self::COMMON_MODEL)->getField(self::MODEL_NAME, ['auth_id' => $data['auth_pid']], 'auth_level');
			if ($info == 0) {
				$data['auth_level'] = 1;
			} else {
				$data['auth_level'] = 2;
			}
		}

		$res = D(self::COMMON_MODEL)->add(self::MODEL_NAME, $data);
		if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 删除
	 */
	public function del()
    {
		$auth_id = intval($_POST['data']);

		// 如果不是三权限, 并且下面有子级权限, 则提示请先删除子级权限
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['auth_id' => $auth_id], 'auth_level');
		if ($info['auth_level'] != 2) {
			$res = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['auth_pid' => $auth_id], 'auth_id');
			if ($res) {
                $this->ajaxReturn(msg('请先删除子级权限!', self::CODE_FAIL), self::JSON_TYPE);
			}
		}

		$where = ['auth_id' => $auth_id];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

		if ($res) {
			// 同时删除所有角色下的该权限
			$infos = D(self::COMMON_MODEL)->infos('Role', [], 'role_id, role_auth_ids');
			foreach ($infos as $key => $value) {
				if ($auth_id == $value['role_auth_ids']) {
					$res = D(self::COMMON_MODEL)->edit('Role', ['role_id' => $value['role_id']], ['role_auth_ids'=>'']);
				} else {
					$role_auth_ids = explode(',', $value['role_auth_ids']);
					if($findkey = array_search($auth_id, $role_auth_ids)) {
						unset($role_auth_ids[$findkey]);
						$role_auth_ids = implode(',', $role_auth_ids);
						$res = D('Common')->edit('Role', ['role_id' => $value['role_id']], ['role_auth_ids' => $role_auth_ids]);
					}
				}
			}

            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 编辑(页面)
	 */
	public function edit()
    {
		$auth_id = intval($_GET['auth_id']);
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['auth_id' => $auth_id]);
        //  一级权限
		$listA = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['auth_level' => 0], '*', 'auth_sort, auth_id');
        // 二级权限
		$listB = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['auth_level' => 1], '*', 'auth_sort, auth_id');

		$this->assign('listA', $listA);
		$this->assign('listB', $listB);
		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑-数据
	 */
	public function editData()
    {
		$data = $_POST;
		$where = ['auth_id' => $data['auth_id']];
		unset($data['auth_id']);
		
		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 更改状态
	 */
	public function status()
    {
		$where = ['auth_id' => $_POST['data']];
		
		// 三级权限不允许显示
		$level = D(self::COMMON_MODEL)->getField(self::MODEL_NAME, $where, 'auth_level');
		if ($level == 2) {
            $this->ajaxReturn(msg('三级权限不允许显示!', self::CODE_FAIL), self::JSON_TYPE);
		}
		
		$status = D(self::COMMON_MODEL)->getField(self::MODEL_NAME, $where, 'auth_status');
		if($status == 0) {
			$data = ['auth_status' => 1];
		} else {
			$data = ['auth_status' => 0];
		}

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 排序
	 */
	public function sort()
    {
		$where = ['auth_id' => $_POST['auth_id']];
		$data = ['auth_sort' => $_POST['auth_sort']];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}
}
