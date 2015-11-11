<?php
namespace Zuoye\Controller;
use Think\Controller;
use Zuoye\Logic\LiuxiLogic;
use Zuoye\Logic\WeijingyunLogic;
use Zuoye\Logic\LitianLogic;
use Zuoye\Logic\DenghaoyangLogic;
use Zuoye\Logic\ZhangjiahaoLogic;
use Zuoye\Logic\AnqiangLogic;
class IndexController extends Controller
{
    public function indexAction()
    {
	$array=array(49,38,65,97,76,13,27,49);
    $test = new LiuxiLogic();
    $value = $test-> quick_sort($array);
    var_dump($value);
	}
}