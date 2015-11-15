<?php
namespace User\Logic;
use User\Model\UserModel;
class UserLogic extends UserModel
{
	protected $totalCount = 0;
	protected $pagesize = 0;
	protected $pageShow = 0;
	protected  $errors = array();
	public function getErrors()
	{
		return $this->errors;
	}

	public function getListByName($name)
	{
		//判断是否是字符串
		if (is_string($name)!==true) {
			$this->errors[] = "传入变量类型非string";
			return false;
		}

		//去空格
		$nameed=trim((string)$name, " ");

		
		$map['name'] = $nameed;
		$status=$this->create($map,4);

		//判断状态
		if (!$status)
		{
			$this->errors[]=$this->getError();
			return false;
		}

		$data = $this->where($map)->find();
		return $data;
	}

	public function getListById($id)
	{
		$map['id'] = $id;
		$data = $this->where($map)->find();
		return $data;
	}

	public function getLists()
	{
		try{
			if($status===0 || $status===1)
			{
				$map[status] = $status;
			}    
		
		//计算总条数
			$this->totalCount = $this->where($map)->count();
			// dump($this->totalCount);
			// exit();

			//读取配置项
		    $pagesize = C('PAGE_SIZE');

		    // 实例化分页类 传入总记录数和每页显示的记录数
		    $Page = new \Think\Page($this->totalCount,$pagesize);
		    $Page->setConfig('prev','上一页');
        	$Page->setConfig('next','下一页');
        	$Page->setConfig('theme', '%HEADER% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE%');
		    $this->pageShow = $Page->show();
		    $lists = $this->page($_GET['p'],$pagesize)->select();
		
		//echo $this->getLastSql();
		  return $lists;
		}
		catch(\Think\Exception $e)
		{
			$this->errors[]=$e->getMessage();
			return false;
		}

	}
	public function getSearchLists()
	{
		//去空格
		$keywords=trim(I('get.keywords'));

		//判断是否为空
		if ($keywords!=="")
		{
			$map['name'] = array('like','%'.$keywords.'%');
			
			$searchLists=$this->where($map)->select();

			return $searchLists;
		}
		else
			echo "请输入查询关键字";
	}
	public function getPageShow(){
		return $this->pageShow;
	}
	 public function deleteInfo($id)
    {
        $map['id'] = $id;
        $datas=$this->where($map)->delete();
        return $datas;
    }
    public function addList($list)
    {
    	try{
    		if($this->create($list))
    		{
    			$id=$this->add();
    			return $id;
    		}
    		else
    		{
    			$this->errors[]=$this->getError();
    			return false;
    		}
    	}
    	catch(\Think\Exception $e)
    	{
    		$this->errors[]=$e->getMessage();
    		return false;
    	}
    }
    public function saveList($list){
    	try{
    		if($this->create($list))
    		{
    			$id=$this->save();
    			return $id;
    		}
    		else
    		{
    			$this->errors[]=$this->getError();
    			return false;
    		}
    	}
    	catch(\Think\Exception $e)
    	{
    		$this->errors[]=$e->getMessage();
    		return false;
    	}
    }
}