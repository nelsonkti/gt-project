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
 * 定时任务控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying
 */
class CronController extends Controller
{
    /**
     * 数据库备份脚本
     */
	public function dump()
	{
		// mysqldump命令所在的地址要用全路径
		$shell = "/opt/lampp/bin/mysqldump -u " . C("DB_USER") . " " . C("DB_NAME") . " > /tmp/live_" . time() . ".sql";
    	exec($shell);
	}
}




