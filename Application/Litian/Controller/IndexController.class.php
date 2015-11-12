<?php
namespace Litian\Controller;
use Think\Controller;
use Litian\Logic\LitianLogic;

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

        $QuickSortL = new LitianLogic();
        $lists = $QuickSortL->QuickSort($lists);

        echo "Sorted data is " . implode(",", $lists);
        echo "<br />";

    }
}
