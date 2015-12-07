<?php
namespace Yunzhi\Model;

use Think\Model;

class YunzhiModel extends Model
{
    protected $p            = 1;                    //当前页
    protected $pageSize     = 20;                   //每页多少条记录
    protected $totalCount   = 0;                    //总条数
    protected $errors       = array();              //错误信息
    protected $orders       = array("desc");        //排序方式
    protected $bys          = array("id");          //排序字段
    protected $maps         = array();              //查询条件
    protected $keywords     = "";                   //查询关键字
    protected $field        = "title";              //查询字段

    public function __construct()
    {
        $this->p        = (int)I('get.p');
        $this->pageSize =   (I("get.pagesize") !== "") ? I("get.pagesize") : 
                            (C("YUNZHI_PAGE_SIZE") ? C("YUNZHI_PAGE_SIZE") : 20);

        $this->keywords = trim(I('get.keywords'));
        $this->field    = (I('get.field') === "" || (int)I('get.field')) ? $this->field : I('get.field');

        if (trim(I('get.filed')) !== "")
        {
            $filed = trim(I('get.field'));
        }
        $this->maps[$this->field] = array("like", "%" . $this->keywords . "%");

        if (I("get.by") !== "")
        {
            $this->setBy(I("get.by"));
            $this->setOrder(I("get.order"));
        }
        
        parent::__construct();
    }

    public function setP($p)
    {
        $this->p = (int)$p;
        return $this;
    }

    public function getP()
    {
        return $this->p;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = (int)$pageSize;
        return $this;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setTotalCount($totalCount)
    {
        $this->totalCount = (int)$totalCount;
        return $this;
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function setOrder($order)
    {
        $order = ($order == "desc") ? "desc" : "asc";
        $this->orders[] = $order;
        return $this;
    }

    public function setBy($by)
    {
        $this->bys[] = $by;
        return $this;
    }

    public function subBy($by)
    {
        foreach($this->bys as $key => $value)
        {
            if ($value = $by)
            {
                unset($this->bys[$key]);
                unset($this->orders[$key]);
            }
        }
        return $this;
    }

    public function setError($error)
    {
        $this->error = $error;
        $this->errors[] = $error;
        return;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getErrors()
    {
        return $this->errors();
    }

    /**
     * 如果未传入第二个参数，则第一个参数必须为数组，进行合并。
     * @param [type] $map   [description]
     * @param [type] $value [description]
     */
    public function addMaps($map, $value = null)
    {
        if($value === null)
        {
            if(!is_array($map))
            {
               $this->setError("YunzhiModel:addMaps 您传入的变量类型需要为带有键值的数组");
               return $this;
            }
            $this->maps = array_merge($this->maps , $map);
        }
        else
        {
            $this->maps["$map"] = $value;  
        }
        
        return $this;
    }

    public function subMaps($key)
    {
        unset($this->maps["$key"]);
        return $this;
    }

    public function setMaps($maps)
    {
        if(!is_array($maps))
        {
            $this->setError("YunzhiModel:setMaps 传入的变量类型非数组");
            return $this;
        }
        $this->maps = $maps;
        return $this;
    }

    public function getMaps()
    {
        return $this->maps;
    }

    public function getListbyId($id, $pk = "id")
    {
        if ((int)$id === 0)
        {
            $this->setError("YunzhiModel:getListbyId id类型不是INT或是传入的ID值为空");
            return $this;
        }

        try
        {
            $list = $this->where("$pk = $id")->find();
            return $list;
        }
        catch(\Think\Exception $e)
        {
            $this->setError($e->getMessage());
            return $this;
        }
    }

    public function getLists($fields = array(), $maps = array())
    {
        $page = $this->p . "," . $this->pageSize;
        $lists =    $this->
                    _getLists($fields, $maps)->         
                    page("$page")->
                    select();
        return $lists;
    }

    public function getAllLists($fields = array(), $maps = array())
    {
        $lists =    $this->
                    _getLists($fields, $maps)->
                    select();
        return $lists;
    }

    private function _getLists($fields = array(), $maps = array())
    {
        if (!is_array($fields) || !is_array($maps))
        {
            $this->setError("YunzhiModel:_getList 传入的参数类型有误");
            return $this;
        }

        if (empty($maps))
        {
            $maps = $this->maps;
        }

        $orderBys = array();
        foreach ($this->bys as $k => $by)
        {
            $order = ($this->orders[$k] == "asc") ? "asc" : "desc";
            $orderBys[$by] = $order;
        }

        $this->_getCounts($maps);
        
        return  $this->
                field($fields)->
                where($maps)->
                order($orderBys);
    }


    //重新计算当前页码及总数
    private function _getCounts()
    {
        $this->totalCount = $this->where($this->maps)->count();
        $this->p = (int)ceil($this->totalCount / $this->pageSize) > $this->p ?
                    (int)ceil($this->totalCount / $this->pageSize) :
                    $this->p;

        //利用C函数，向PAGE标签传值
        C("YUNZHI_TOTAL_COUNT", $this->totalCount);
        C("YUNZHI_PAGE_SIZE", $this->pageSize);
        C("YUNZHI_P", $this->p);
    }
}