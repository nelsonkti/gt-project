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
 * 幻灯控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class BannerController extends CommonController 
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Banner';

	/**
	 * 列表
	 */
	public function index()
    {
		$list = D(self::COMMON_MODEL)->infosOrder(self::MODEL_NAME, [], '*', 'banner_sort, banner_id');

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
	 * 编辑(页面)
	 */
	public function edit()
    {
		$banner_id = intval($_GET['banner_id']);
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['banner_id' => $banner_id]);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;
		$where = ['banner_id' => $data['banner_id']];
		unset($data['banner_id']);
		
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
		$banner_id = intval($_POST['data']);

		$where = ['banner_id' => $banner_id];
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
		$banner_ids = $_POST['data'];
		$where = ['banner_id' => ['in', $banner_ids]];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

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
		$where 	= ['banner_id' => $_POST['banner_id']];
		$data 	= ['banner_sort' => $_POST['banner_sort']];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if ($res) {
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 更改状态
	 */
	public function status()
    {
		$where = ['banner_id' => $_POST['data']];
		$status = D(self::COMMON_MODEL)->getField(self::MODEL_NAME, $where, 'banner_status');

		$data = $status == 0 ? ['banner_status' => 1] : ['banner_status' => 0];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if ($res) {
			$this->html();
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 生成静态HTML文件
	 */
	public function html()
    {
		$html = new \Admin\Controller\HomeController();
		$html->indexHtml();
	}
}
