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
 * 招聘控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class JobController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Job';

	/**
	 * 列表
	 */
	public function index()
    {
		$field = 'job_id, job_name, job_where, job_num, job_sort, job_status';
		$list  = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, [], $field, 'job_sort, job_id');

		$this->assign('list', $list);
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
	 * 删除
	 */
	public function del()
    {
		$job_id = intval($_POST['data']);
		$where = ['job_id' => $job_id];

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
		$job_ids = $_POST['data'];
		$where = ['job_id' => ['in', $job_ids]];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

		if($res) {
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
		$job_id = intval($_GET['job_id']);
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['job_id' => $job_id]);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;
		$where = ['job_id' => $data['job_id']];
		unset($data['job_id']);
		
		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if($res) {
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
		$where 	= ['job_id' => $_POST['job_id']];
		$data 	= ['job_sort' => $_POST['job_sort']];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 更改状态
	 */
	public function status()
    {
		$where = ['job_id' => $_POST['data']];
		$status = D(self::COMMON_MODEL)->getField(self::MODEL_NAME, $where, 'job_status');

		$data = $status == 0 ? ['job_status' => 1] : ['job_status' => 0];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if($res) {
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 生成静态HTML
	 */
	public function html()
    {
		$html = new \Admin\Controller\HomeController();
		$html->jobHtml();
	}
}
