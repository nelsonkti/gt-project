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
 * 导航栏控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying
 */
class NavController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Nav';

	/**
	 * 列表
	 */
	public function index() 
    {
        // 一级导航
		$listA = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['nav_pid' => 0], '*', 'nav_sort, nav_id');
        // 二级导航
		$listB = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, ['nav_pid' => ['neq', 0]], '*', 'nav_sort, nav_id');

		$this->assign('listA', $listA);
		$this->assign('listB', $listB);
		$this->display();
	}

	/**
	 * 添加(页面)
	 */
	public function add()
    {
		$list = D(self::COMMON_MODEL)->infos(self::MODEL_NAME, ['nav_pid' => 0], 'nav_id, nav_name');

		$this->assign('list', $list);
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
	 * 删除
	 */
	public function del()
    {
		$nav_id = intval($_POST['data']);

		// 如果是一级导航, 并且下面有二级导航, 则删除失败
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['nav_id' => $nav_id], 'nav_pid');
		if ($info['nav_pid'] == 0) {
			$res = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['nav_pid' => $nav_id], 'nav_id');
			if ($res) {
                $this->ajaxReturn(msg('请先删除二级导航!', self::CODE_FAIL), self::JSON_TYPE);
			}
		}

		$where = ['nav_id' => $nav_id];
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
		$nav_id = intval($_GET['nav_id']);
		$list = D(self::COMMON_MODEL)->infos(self::MODEL_NAME, ['nav_pid' => 0], 'nav_id, nav_name');
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['nav_id' => $nav_id]);

		$this->assign('list', $list);
		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;
		$where = ['nav_id' => $data['nav_id']];
		unset($data['nav_id']);
		
		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 排序
	 */
	public function sort()
    {
		$where = ['nav_id' => $_POST['nav_id']];
		$data = ['nav_sort' => $_POST['nav_sort']];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}
}
