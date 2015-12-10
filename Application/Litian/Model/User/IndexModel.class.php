<?php

namespace Litian\Model\User;


/**
*
*/
class IndexModel
{

    protected $pageShow = "";           //
    protected $users    = array();      //
    public function setPageShow($pageShow)
    {
        $this->pageShow = (string)$pageShow;
    }
    // public function getPageShow()
    // {
    //     $pageShow = "<a href=" . U('?p=2')>
    // }
    public function setUsers($users)
    {
        $this->users = $users;
    }
    public function getUsers()
    {
        #测试数据
        $users[] = array('id'=>1, "name"=>"zhangsan");
        $users[] = array('id'=>2, "name"=>"zhangsan");
        $users[] = array('id'=>3, "name"=>"zhangsan");
        $users[] = array('id'=>4, "name"=>"zhangsan");
        return $users;
    }
    public function getPostsByUserId($userId)
    {
        #
    }
}
