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
 * 首页控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class IndexController extends Controller 
{
	/**
	 * 首页
	 */
	public function index()
    {
		// 直接传入模板文件名
		$this->display('index.html');
	}


    /**
     * 新闻列表
     */
    public function news()
    {
    	// 公共部分
		$res = D('Common')->common();
		foreach ($res as $key=>$value) {
			$this->assign($key, $value);
		}

		$list = D('Common')->datalist('Article', [], '*', 'art_sort, art_id');

		$this->assign('list', $list['list']);
		$this->assign('page', $list['page']);
		$this->assign('count', $list['count']);

		$this->display();
    }
}