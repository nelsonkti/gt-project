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
 * 客户案例控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class CaseController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Case';

	/**
	 * 列表
	 */
	public function index()
    {
		$res = D(self::COMMON_MODEL)->datalist(self::MODEL_NAME, array(), '*', 'case_sort, case_id');

		$this->assign('list', $res['list']);
		$this->assign('page', $res['page']);
		$this->assign('count', $res['count']);
		$this->display();
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
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 编辑(页面)
	 */
	public function edit()
    {
		$case_id = intval($_GET['case_id']);
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['case_id' => $case_id]);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;
		$where = ['case_id' => $data['case_id']];
		unset($data['case_id']);
		
		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if ($res) {
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 排序
	 */
	public function sort()
    {
		$where = ['case_id' => $_POST['case_id']];
		$data = ['case_sort' => $_POST['case_sort']];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if ($res) {
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
		$this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 删除
	 */
	public function del()
    {
		$case_id = intval($_POST['data']);

		$where = ['case_id' => $case_id];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

		if ($res) {
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 批量删除
	 */
	public function dels()
    {
		$case_ids = $_POST['data'];
		$where = ['case_id' => ['in', $case_ids]];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

		if ($res) {
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 生成静态HTML文件
	 */
	public function html() {
		$html = new \Admin\Controller\HomeController();
		$html->indexHtml();
		$html->clientHtml();
	}
}
