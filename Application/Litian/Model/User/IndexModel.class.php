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
        return $this->users;
    }
    public function getPostsByUserId($userId)
    {
        #
    }
}
