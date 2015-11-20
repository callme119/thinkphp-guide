<?php
namespace Liuxi\Controller;

use Think\Controller;

use Liuxi\Logic\LiuxiLogic;
class LiuxiController extends Controller
{
    public function indexAction()
    {
        $lists = array();
        $i = 0;

        do
        {
            $lists[] = rand(1, 1000);
        }
        while ( $i++ <= 20);

        echo "Source data is " . implode(",", $lists);
        echo "<br />";

        $QuickSortL = new LiuxiLogic();
        $lists = $QuickSortL->lxsort($lists);
        echo "Sorted data is " . implode(",", $lists);
        echo "<br />";
    }

}
