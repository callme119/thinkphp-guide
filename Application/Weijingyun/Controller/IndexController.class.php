<?php
namespace Weijingyun\Controller;

use Think\Controller;
use Weijingyun\Logic\WeijingyunLogic;

class IndexController extends Controller
{
    public function indexAction()
    {
        $lists = array();
        $i = 0;

        do {
            $lists[] = rand(1, 1000);
        } while ( $i++ <= 20);

        echo "Source data is " . implode(",", $lists);
        echo "<br />";

        $QuickSortL = new WeijingyunLogic();
        $lists = $QuickSortL->wjysort($lists);
        
        echo "Sorted data is " . implode(",", $lists);
        echo "<br />";

    }
}