<?php

namespace Litian\Model\User;

use Yunzhi\Model\YunzhiModel;
/**
*
*/
class IndexModel extends YunzhiModel
{
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
