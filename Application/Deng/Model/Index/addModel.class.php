<?php
namespace Deng\Model\Index;

class addModel
{
	protected $menu = array();
	protected $menus = array();
	protected $titles = array();

	public function setMenu($menu){
		$this->menu = $menu;
	}

	public function getMenu(){
		return $this->menu;
	}

	public function setMenus($menus){
		$this->menus = $menus;
	}

	public function getMenus(){
		return $this->menus;
	}

	public function setTitles($titles){
		$this->titles = $titles;
	}

	public function getTitles(){
		return $this->titles;
	}


}