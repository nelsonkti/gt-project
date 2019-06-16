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
 * 公共控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class CommonController extends Controller
{
    CONST MSG_SUCCESS = '操作成功';
    CONST MSG_FAIL = '操作失败';
    CONST CODE_SUCCESS = '200';
    CONST CODE_FAIL = '201';
    CONST JSON_TYPE = 'json';
    CONST COMMON_MODEL = 'Common';

	public function __construct() {
		parent::__construct();
		$this->init();
		
		$res = D(self::COMMON_MODEL)->auth();
		if (!$res) {
			if (IS_AJAX) {
                $this->ajaxReturn(msg('没有操作权限!', self::CODE_FAIL), self::JSON_TYPE);
			} else {
				$this->error('没有操作权限! <br><span style="color:gray;">正在跳转...</span>');
			}
		}
	}

	/**
	 * 如果没有登录返回登录界面
	 */
	public function init() {
		$isLogin = $this->isLogin();
		if (!$isLogin) {
			$this->error('请先登录! <br><span style="color:gray;">正在跳转...</span>' . '---'.$isLogin . '---', U('Login/index'));
		}
	}

	/**
	 * 判断是否登录
	 */
	public function isLogin() {
		return session('isLogin');
	}
}
