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

namespace Home\Controller;
use Think\Controller;

/**
 * 留言控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class MsgController extends Controller 
{
	/**
	 * 添加
	 */
	public function addData()
    {
		$data = $_POST;
		$data['msg_time'] = time();

		$res = D('Common')->add('Msg', $data);
		if ($res) {
			$this->ajaxReturn(['msg' => '添加成功!', 'code' => '200'], 'json');
		}
		$this->ajaxReturn(['msg' => '添加失败!', 'code' => '201'], 'json');
	}
}
