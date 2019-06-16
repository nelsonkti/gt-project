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
 * 后台首页控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class IndexController extends CommonController
{
    /**
     * 后台首页
     */
	public function index()
    {
        // 根据不同用户显示不同菜单
		$auth = D('Index')->auth();	
		$admin_name = session('admin_name');

        // 管理员名称
		$this->assign('admin_name', $admin_name);
        // 一级权限
		$this->assign('authA', $auth['authA']);
        // 二级权限
		$this->assign('authB', $auth['authB']);

		$this->display();
	}

    /**
     * 基本信息
     */
    public function info()
    {
        $basicInfo = basicInfo();
        $this->assign('basicInfo', $basicInfo);
        $this->display();
    }

	/**
	 * 修改密码(页面)
	 */
	public function pass()
    {
		$this->display();
	}

	/**
	 * 修改密码(数据)
	 */
	public function edit()
    {
		// 数据验证
		$data = $_POST;
		if($data['admin_new_pass'] != $data['admin_new_repass']) {
            $this->ajaxReturn(msg('两次密码输入不一致!', self::CODE_FAIL), self::JSON_TYPE);
		}

		// 检查密码
		$admin_id = session('admin_id');
		$admin_pass = D(self::COMMON_MODEL)->getField('Admin', ['admin_id' => $admin_id], 'admin_pass');
		if ($admin_pass != encrypt($data['admin_pass'])) {
            $this->ajaxReturn(msg('原密码输入错误!', self::CODE_FAIL), self::JSON_TYPE);
		}

		// 数据更新
		$admin_new_pass = encrypt($data['admin_new_pass']);
		$res = D(self::COMMON_MODEL)->edit('Admin', ['admin_id' => $admin_id], ['admin_pass' => $admin_new_pass]);
		if (!$res) {
            $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
	}
}
