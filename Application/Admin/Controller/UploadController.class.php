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
 * 上传文件控制器
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class UploadController extends Controller
{
    /**
     * 缩略图上传
     */
    public function uploadImage()
    {
        $upload = D('UploadImage');
        $res = $upload->uploadImage();
        if ($res['code'] == '201') {
            $this->ajaxReturn(['msg' => '上传失败!' . $res['msg'], 'code' => '201'], 'json');
        }
        $this->ajaxReturn(['msg' => '上传成功!', 'code' => '200', 'file' => $res['msg']], 'json');
    }
}