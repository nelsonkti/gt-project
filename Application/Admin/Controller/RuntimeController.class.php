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
 * 更新缓存控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class RuntimeController extends CommonController
{
    /**
     * 更新缓存(页面)
     */
	public function index() {
		$this->display();
	}

    /**
     * 更新缓存(数据)
     */
	public function update() {
		$html = new \Admin\Controller\HomeController();
		$html->indexHtml();
		$html->msgHtml();
		$html->usHtml();
		$html->contactHtml();
		$html->jobHtml();
		$html->clientHtml();
		$art_ids = D('Common')->infos('Article', [], 'art_id');
		foreach ($art_ids as $key => $value) {
			$html->detailHtml($value['art_id']);
		}
        $this->ajaxReturn(msg('缓存更新成功!', self::CODE_SUCCESS), self::JSON_TYPE);
	}
}
