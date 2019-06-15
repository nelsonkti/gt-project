<?php
/**
 * TP3-CMS
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/TP3-CMS
 */

namespace Admin\Controller;
use Think\Controller;

/**
 * 留言控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/TP3-CMS
 */
class MsgController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Msg';

	/**
	 * 列表
	 */
	public function index()
    {
		// 搜索条件 ThinkPHP搜索分页必须用get方式
		$where = [];

		// 日期
		if ($_REQUEST['start'] && $_REQUEST['end']) {
			$where['msg_time'] = [
			    'between',
                strval(strtotime($_REQUEST['start'])) . ',' . strval(strtotime($_REQUEST['end']) + 86399)
            ];
			$this->assign('start', $_REQUEST['start']);
			$this->assign('end', $_REQUEST['end']);
		} elseif ($_REQUEST['start']) {
			$where['msg_time'] = ['gt', strtotime($_REQUEST['start'])];
			$this->assign('start', $_REQUEST['start']);
		} elseif ($_REQUEST['end']) {
			$where['msg_time'] = ['lt', strtotime($_REQUEST['end']) + 86399];
			$this->assign('end', $_REQUEST['end']);
		}
		
		// 状态
		if (isset($_REQUEST['msg_status']) && $_REQUEST['msg_status'] === '0') {
			$where['msg_status'] = 0;
			$this->assign('msg_status', 0);	
		}
		if (isset($_REQUEST['msg_status']) && $_REQUEST['msg_status'] === '1') {
			$where['msg_status'] = 1;
			$this->assign('msg_status', 1);	
		}
		
		$res = D(self::COMMON_MODEL)->datalist(self::MODEL_NAME, $where, '*', 'msg_id desc');

		$this->assign('list', $res['list']);
		$this->assign('page', $res['page']);
		$this->assign('count', $res['count']);
		$this->display();
	}

	/**
	 * 删除
	 */
	public function del()
    {
		$msg_id = intval($_POST['data']);

		$where = ['msg_id' => $msg_id];
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}

	/**
	 * 批量删除
	 */
	public function dels()
    {
		$msg_ids = $_POST['data'];
		$where = array('msg_id'=>array('in', $msg_ids));
		$res = D(self::COMMON_MODEL)->del(self::MODEL_NAME, $where);

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
		$where = ['msg_id' => $_POST['data']];
		$status = D(self::COMMON_MODEL)->getField(self::MODEL_NAME, $where, 'msg_status');
		
		$data = $status == 0 ? ['msg_status' => 1] : ['msg_status' => 0];

		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, $where, $data);
        if ($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
        }
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}
}
