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
 * 前台页面静态化控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/TP3-CMS
 */
class HomeController extends CommonController
{
    /**
     * 前台首页
     *
     * @param string $type
     */
	public function index($type = '')
    {
		// 公共部分
		$res = D(self::COMMON_MODEL)->common();
		foreach ($res as $key=>$value) {
			$this->assign($key, $value);
		}

		// 轮播
		$banner = D(self::COMMON_MODEL)->infosOrder('Banner', ['banner_status' => 0], 'banner_img, banner_href', 'banner_sort, banner_id');
		$this->assign('banner', $banner);

		// 客户案例
		$case = D(self::COMMON_MODEL)->infosOrderLimit('Case', [], 'case_title, case_img', 'case_sort, case_id', 8);
		$this->assign('case', $case);

		// 新闻动态
		$article = D(self::COMMON_MODEL)->infosOrderLimit('Article', [], 'art_id, art_title, art_time', 'art_sort, art_id', 5);
		$this->assign('article', $article);

		if ($type == 'buildHtml') {
			$this->buildHtml('index', C('HTML_PATH'), 'Home/index');
		} else {
			$this->display(); 
		}
    }

    /**
     * 客户案例
     *
     * @param string $type
     */
    public function client($type = '')
    {
    	// 公共部分
		$res = D(self::COMMON_MODEL)->common();
		foreach ($res as $key => $value) {
			$this->assign($key, $value);
		}

    	$case = D(self::COMMON_MODEL)->infosOrder('Case', [], 'case_title, case_img', 'case_sort, case_id');
    	$this->assign('case', $case);

    	if ($type == 'buildHtml') {
    		$this->buildHtml('client', C('HTML_PATH'), 'Home/client');
    	} else {
    		$this->display();
    	}
    }

    /**
     * 新闻详情
     *
     * @param string $type
     * @param int $art_id
     */
    public function detail($type = '', $art_id = 0)
    {
    	// 公共部分
		$res = D(self::COMMON_MODEL)->common();
		foreach($res as $key => $value) {
			$this->assign($key, $value);
		}

		if (!$art_id) {
			$art_id = intval($_REQUEST['id']);
		}
    	
    	$info = D(self::COMMON_MODEL)->info('Article', ['art_id' => $art_id], '*');

    	$this->assign('info', $info);

    	if ($type == 'buildHtml') {
    		$this->buildHtml('art-' . $art_id, C('HTML_PATH') . '/news/', 'Home/detail');
    	} else {
    		$this->display();
    	}
    }

    /**
     * 在线留言
     *
     * @param string $type
     */
    public function msg($type = '')
    {
    	// 公共部分
		$res = D(self::COMMON_MODEL)->common();
		foreach ($res as $key=>$value) {
			$this->assign($key, $value);
		}
		if ($type == 'buildHtml') {
			$this->buildHtml('msg', C('HTML_PATH'), 'Home/msg');
		} else {
			$this->display();
		}
    }

    /**
     * 公司简介
     *
     * @param string $type
     */
    public function us($type = '')
    {
    	// 公共部分
		$res = D(self::COMMON_MODEL)->common();
		foreach ($res as $key => $value) {
			$this->assign($key, $value);
		}

		if ($type == 'buildHtml') {
			$this->buildHtml('us', C('HTML_PATH'), 'Home/us');
		} else {
			$this->display();
		}
    }

    /**
     * 联系我们
     *
     * @param string $type
     */
    public function contact($type = '')
    {
    	// 公共部分
		$res = D(self::COMMON_MODEL)->common();
		foreach ($res as $key => $value) {
			$this->assign($key, $value);
		}
		
		if ($type == 'buildHtml') {
			$this->buildHtml('contact', C('HTML_PATH'), 'Home/contact');
		} else {
			$this->display();
		}
    }

    /**
     * 人才招聘
     *
     * @param string $type
     */
    public function job($type = '') {
    	// 公共部分
		$res = D(self::COMMON_MODEL)->common();
		foreach ($res as $key => $value) {
			$this->assign($key, $value);
		}
		
		// 职位
		$list = D(self::COMMON_MODEL)->infosOrder('Job', ['job_status' => 0], '*', 'job_sort, job_id');
		$this->assign('list', $list);

		// 邮箱
		$mail = D(self::COMMON_MODEL)->getField('Config', [], 'config_firm_mail');
		$mail = str_replace('@', '#', $mail);

		$this->assign('mail', $mail);

		if ($type == 'buildHtml') {
			$this->buildHtml('job', C('HTML_PATH'), 'Home/job');
		} else {
			$this->display();
		}
    }

    /**
     * 首页生成静态HTML
     */
    public function indexHtml()
    {
    	$this->index('buildHtml');
    }

    /**
     * 在线留言生成静态HTML
     */
    public function msgHtml()
    {
    	$this->msg('buildHtml');
    }

    /**
     * 公司简介生成静态HTML
     */
    public function usHtml()
    {
    	$this->us('buildHtml');
    }

    /**
     * 联系我们生成静态HTML
     */
    public function contactHtml()
    {
    	$this->contact('buildHtml');
    }

    /**
     * 人才招聘生成静态HTML
     */
    public function jobHtml()
    {
    	$this->job('buildHtml');
    }

    /**
     * 客户案例生成静态HTML
     */
    public function clientHtml()
    {
    	$this->client('buildHtml');
    }

    /**
     * 新闻详情生成静态HTML
     *
     * @param $art_id
     */
    public function detailHtml($art_id)
    {
    	$this->detail('buildHtml', $art_id);
    }
}
