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
use Think\Exception;

/**
 * 登录控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying
 */
class LoginController extends Controller
{
    /**
     * 登录(页面)
     */
	public function index()
    {
		$this->display();
	}

	/**
	 * 生成验证码
	 */
	public function verify()
    {
		$config = ['length' => 4, 'fontSize' => 50];
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}

	/**
	 * 登录验证
	 */
	public function check()
    {
		// 数据验证
		$data = dataToArray($_POST);
		foreach ($data as $k => $v) {
			if (!trim($v)) {
				$this->ajaxReturn(['msg' => '数据填写不完整!', 'code' => '201'], 'json');
			}
		}

		if (!checkVerify($data['verifyCode'])) {
			$this->ajaxReturn(['msg' => '验证码错误!', 'code' => '201'], 'json');
		}

		$where = ['admin_name' => $data['admin_name'], 'admin_pass' => encrypt($data['admin_pass'])];

		$res = null;

		try {
            $res = D('Common')->info('Admin', $where, 'admin_id, admin_name');
        } catch (Exception $e) {
            $this->ajaxReturn(['msg' => '数据库连接错误!', 'code' => '201'], 'json');
        }

		if($res) {
			session('isLogin', 1);
			session('admin_id', $res['admin_id']);
			session('admin_name', $res['admin_name']);
			$this->ajaxReturn(['msg' => '登录成功!', 'code' => '200'], 'json');
		}
		$this->ajaxReturn(['msg' => '用户名或密码错误!', 'code' => '201'], 'json');
	}

	/**
	 * 退出登录
	 */
	public function logout()
    {
		// 清除所有session
		session(null);
		$this->ajaxReturn(['msg' => '退出成功!', 'code' => '200'], 'json');
	}
}
