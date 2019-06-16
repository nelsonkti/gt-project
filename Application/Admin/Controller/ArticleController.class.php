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
 * 文章控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying
 */
class ArticleController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Article';

    /**
     * 列表
     */
	public function index()
    {
		// 搜索条件(ThinkPHP搜索分页必须用get方式)
		$where = [];
		if ($_REQUEST['start'] && !$_REQUEST['end']) {
            $where['art_time'] = ['EGT', strtotime($_REQUEST['start'])];
			$this->assign('start', $_REQUEST['start']);
		}
		if (!$_REQUEST['start'] && $_REQUEST['end']) {
			$where['art_time'] = ['ELT', strtotime($_REQUEST['end']) + 86399];
			$this->assign('end', $_REQUEST['end']);
		}
        if ($_REQUEST['start'] && $_REQUEST['end']) {
            $where['art_time'] = [['EGT', strtotime($_REQUEST['start'])], ['ELT', strtotime($_REQUEST['end']) + 86399]];
            $this->assign('start', $_REQUEST['start']);
            $this->assign('end', $_REQUEST['end']);
        }
		if ($_REQUEST['keywords']) {
			$where['art_title'] = ['like', '%' . $_REQUEST['keywords'] . '%'];
			$this->assign('keywords', $_REQUEST['keywords']);
		}

		// 字段
		$field = 'art_id, art_title, art_editor, art_time, art_sort';
		// 排序
        $sort = 'art_sort, art_id desc';
		$res = D(self::COMMON_MODEL)->datalist(self::MODEL_NAME, $where, $field, $sort);

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

		$data['art_time'] = time();

		$res = D(self::COMMON_MODEL)->add(self::MODEL_NAME, $data);
		if ($res) {
			$this->html($res);
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
		$this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 删除
	 */
	public function del()
    {
		$art_id = intval($_POST['data']);
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, ['art_id'=>$art_id]);

		if ($res) {
			$this->delHtml($art_id);
			$this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
		$this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

    /**
     * 批量删除
     */
	public function dels()
    {
		$art_ids = $_POST['data'];
		$where = ['art_id' => ['in', $art_ids]];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

		if($res) {
			$this->delHtml($art_ids);
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 编辑(页面)
	 */
	public function edit()
    {
		$art_id = intval($_GET['art_id']);
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, ['art_id' => $art_id]);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;
		$where = ['art_id' => $data['art_id']];
		$art_id = $data['art_id'];
		unset($data['art_id']);

		$res = D('Common')->edit(self::MODEL_NAME, $where, $data);
		if ($res) {
			$this->html($art_id);
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 排序
	 */
	public function sort()
    {
		$where = ['art_id' => $_POST['art_id']];
		$data = ['art_sort' => $_POST['art_sort']];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
		if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

    /**
     * 生成文章详情的静态HTML文件
     *
     * @param $art_id integer 文章ID
     */
	public function html($art_id)
    {
		$html = new \Admin\Controller\HomeController();
		$html->detailHtml($art_id);
	}

    /**
     * 删除文章的时候同时删除静态HTML文件
     *
     * @param $art_id integer 文章ID
     */
	public function delHtml($art_id)
    {
		if (is_numeric($art_id)) {
			$file = C('HTML_PATH') . 'news/art-' . $art_id . '.html';
			unlink($file);
		} else {
			$art_id_arr = explode(',', $art_id);
			foreach ($art_id_arr as $key => $value) {
				$file = C('HTML_PATH') . 'news/art-' . $value . '.html';
				unlink($file);
			}
		}
	}
}
