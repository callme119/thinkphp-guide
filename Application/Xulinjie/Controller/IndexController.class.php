<?php
namespace Xulinjie\Controller;

use Think\Controller;
use Xulinjie\Logic\XulinjieLogic;

class IndexController extends Controller
{
    public function indexAction()
    {
        $lists = array();
        $relists = array();
        $i = 0;

        do {
            $lists[] = rand(1, 1000);
        } while ( $i++ <= 20);

        echo "Source data is " . implode(",", $lists);
        echo "<br />";

        $QuickSortL = new XulinjieLogic();
        $lists = $QuickSortL->quickSort($lists);
        $lists2 = $QuickSortL->quick_sort($lists);
        echo "Sorted data is " . implode(",", $lists);
        echo "<br />";
        echo "Sorted data is " . implode(",", $lists2);
        echo "<br />";

    }
}