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
 * 配置控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/TP3-CMS
 */
class ConfigController extends CommonController
{
    /**
     * 模型
     */
    CONST MODEL_NAME = 'Config';

	/**
	 * 网站信息
	 */
	public function index()
    {
		$field = 'config_web_name, config_web_stat, config_web_copyright, config_web_record';
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, [], $field);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * SEO设置
	 */
	public function seo()
    {
		$field = 'config_seo_title, config_seo_keywords, config_seo_desc';
		$info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, [], $field);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 企业信息
	 */
	public function firm()
    {
		$field = 'config_firm_name, config_firm_location, config_firm_phone, config_firm_fax, config_firm_mail';
        $info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, [], $field);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 客服设置
	 */
	public function service()
    {
		$field = 'config_service_phone, config_service_qq';
        $info = D(self::COMMON_MODEL)->info(self::MODEL_NAME, [], $field);

		$this->assign('info', $info);
		$this->display();
	}

	/**
	 * 编辑(数据)
	 */
	public function editData()
    {
		$data = $_POST;
		$res = D(self::COMMON_MODEL)->edit(self::MODEL_NAME, [], $data);
		if($res) {
            $this->ajaxReturn(msg(self::MSG_SUCCESS, self::CODE_SUCCESS), self::JSON_TYPE);
		}
        $this->ajaxReturn(msg(self::MSG_FAIL, self::CODE_FAIL), self::JSON_TYPE);
	}
}
