<?php
namespace Liuxi\Controller;

use Think\Controller;
use Liuxi\Logic\QuickSortLogic;	//快速排序

class IndexController extends Controller
{
	public function indexAction()
	{
		$lists = array();
		$errors = array();
		$i = 0;

		$QuickSortL = new QuickSortLogic();
		do {
			$lists[] = rand(1, 1000);
		} while ( $i ++ <= 100);
		
		echo "sourse data <br />" . implode("," , $lists) . "<br />";
		try {
			$result = $QuickSortL->liuXix($lists);
			echo "liuxi's result <br />" . implode("," , $result) . "<br />";
		} catch (xception $e) {
			$errors[] = $e->getMessage();
		}
		try {
			$result = $QuickSortL->zhangJiaHao($lists);
			echo "liuxi's result <br />" . implode("," , $result) . "<br />";
		} catch (\Think\Exception $e) {
			exit();
			$errors[] = $e->getMessage();
		}

		// echo "<br /><br />errors: <br />";
		// $error = implode("<br />" , $errors);
		// echo $error;
	}
}