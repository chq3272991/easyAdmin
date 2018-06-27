<?php
namespace Common\Controller;
use Think\Controller;

/**
 * 银河官网接口文件
 * @package Home\Controller
 * @author Rick
 * @time 20160620
 */

class CommonController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajaxJSON($data){
        if($data){
            $this->ajaxReturn($data,'json');
        }
    }
}
?>