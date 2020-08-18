<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	

	// public function buildMenu($menu, $parentid = 0) 
	// { 
	// 	$result = null;
	// 	foreach ($menu as $item) 
	// 		if ($item->parent_id == $parentid) { 
	// 			$result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
	// 			<div class='dd-handle nested-list-handle'>
	// 			<span class='glyphicon glyphicon-move'></span>
	// 			</div>
	// 			<div class='nested-list-content'>{$item->label}
	// 			<div class='pull-right'>
	// 			<a href='".url("admin/menu/edit/{$item->id}")."'>Edit</a> |
	// 			<a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
	// 			</div>
	// 			</div>".$this->buildMenu($menu, $item->id) . "</li>"; 
	// 		} 
	// 		return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
	// 	} 

	public function childs() {
		return $this->hasMany('App\Menu','parent_id','id')->where('deleted_at',NULL)->orderBy('priority_no','asc') ;
	}

	public function categories()
	{
		return $this->hasMany(Menu::class, 'parent_id', 'id')->where('deleted_at',NULL)->orderBy('priority_no', 'ASC');
	}

	public function frontcategories()
	{	
		return $this->hasMany(Menu::class, 'parent_id', 'id')->where('deleted_at',NULL)->orderBy('priority_no', 'ASC');
	}

	public function sidecategories()
	{	
		return $this->hasMany(Menu::class, 'parent_id', 'id')->where('deleted_at',NULL)->orderBy('priority_no', 'ASC');
	}
}
