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

namespace Admin\Model;
use Think\Model;

/**
 * 图片上传模型模型
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   ThinkPHP3.2
 * @author    wangyaxian <1822581649@qq.com>
 * @link      https://github.com/duiying/gt-project
 */
class UploadImageModel extends Model
{
    /**
     * @var string|\Think\Upload 实例对象
     */
	private $_uploadObj = '';

    /**
     * 上传路径
     */
	const UPLOAD = 'upload';

	public function __construct()
    {
		$this->_uploadObj = new \Think\Upload();
		$this->_uploadObj->rootPath = './' . self::UPLOAD . '/';
		$this->_uploadObj->subName = date(Y) . '/' . date(m) . '/' . date(d);
	}

    /**
     * 上传图片
     *
     * @return array|bool
     */
	public function uploadImage()
    {
		$res = $this->_uploadObj->upload();

		if ($res) {
			$res['code'] = '200';
			$res['msg'] = self::UPLOAD . '/' . $res['file']['savepath'] . $res['file']['savename'];
		} else {
			$res['code'] = '201';
			$res['msg'] = $this->_uploadObj->getError();
		}

		return $res;
	}

    public function uploadKindeditor() {
        $res = $this->_uploadObj->upload();

        if($res) {
            return self::UPLOAD.'/'.$res['imgFile']['savepath'].$res['imgFile']['savename'];
        } else {
            return false;
        }
    }
}
