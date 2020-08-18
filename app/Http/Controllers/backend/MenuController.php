<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Respository\MainMenuRespository;
use App\Http\Requests\MenuPost;
use App\Photos;
use App\Menu;
use App\User;
use App\Page;
use App\PageCategory;
use App\PostsCategory;
use App\ResourceCategory;
class MenuController extends Controller
{
  public function addMainMenu()
  {
   $finalResult = [];
   $photo = Photos::where('deleted_at',NULL)->get();
   $page = Page::all();
   $main_menu = Menu::where('menu_type','main_menu')->where('deleted_at',NULL)->get();
   $side_menu = Menu::where('menu_type','side_menu')->where('deleted_at',NULL)->where('is_parent','yes')->get();
   $post_category = PostsCategory::where('deleted_at',NULL)->where('status','active')->get();
   $resource_category = ResourceCategory::where('deleted_at',NULL)->where('status','active')->get();
   return view('cd-admin.menu.add-main-menu',compact('photo','side_menu','post_category','resource_category','page','main_menu'));
 }

 public function viewMainMenu()
 {
   $menu = Menu::where('deleted_at',Null)->get();
   return view('cd-admin.menu.view-main-menu',compact('menu'));
 }

 public function insertMainMenu(MainMenuRespository $menu,MenuPost $post)
 {

   $getData = $menu->insertMainMenu();
   if(json_decode($getData->getcontent())->status == 200){
    $notification = array(
     'message' => 'Menu added successfully!',
     'alert-type' => 'success'
   );
    return redirect()->to('/cd-admin/view-all-mainMenu')->with($notification);}
  }

  public function editMainMenu($key)
  {
   $finalResult = [];
   $menu = Menu::where('id',$key)->get()->first();
   $photo = Photos::where('deleted_at',NULL)->get();
   $page = Page::all();
   $main_menu = Menu::where('menu_type','main_menu')->where('deleted_at',NULL)->where('id','!=',$key)->get();
   $side_menu = Menu::where('menu_type','side_menu')->where('deleted_at',NULL)->where('is_parent','yes')->where('id','!=',$key)->get();
   $post_category = PostsCategory::where('deleted_at',NULL)->where('status','active')->get();
   $resource_category = ResourceCategory::where('deleted_at',NULL)->where('status','active')->get();
   return view('cd-admin.menu.edit-main-menu',compact('menu','photo','page','side_menu','post_category','resource_category','main_menu'));
 }

 public function updateMainMenu(MainMenuRespository $menu,MenuPost $post,$key)
 {
   $getData = $menu->updateMainMenu($key);
   if(json_decode($getData->getcontent())->status == 200){
    $notification = array(
     'message' => 'Menu Updated successfully!',
     'alert-type' => 'success'
   );
    return redirect()->to('/cd-admin/view-all-mainMenu')->with($notification);}
  }

  public function updateStatus(MainMenuRespository $menu,$key)
  {
   $getData = $menu->updateStatus($key);
   if(json_decode($getData->getcontent())->status == 200){
    $notification = array(
     'message' => 'Menu Updated successfully!',
     'alert-type' => 'success'
   );
    return redirect()->to('/cd-admin/view-all-mainMenu')->with($notification);}
  }

  public function viewOneMenu($key)
  {
   $menu = Menu::where('id',$key)->get()->first();
   $user = User::where('id',$menu['created_by'])->get()->first();
   $user_updated = User::where('id',$menu['updated_by'])->get()->first();
   return view('cd-admin.menu.view-one-menu',compact('menu' ,'user','user_updated'));
 }

 public function deleteMainMenu(MainMenuRespository $menu,$key)
 {
   $getData = $menu->deleteMainMenu($key);
   if(json_decode($getData->getcontent())->status == 200){
    $notification = array(
     'message' => 'Menu Deleted successfully!',
     'alert-type' => 'success'
   );
    return redirect()->to('/cd-admin/view-all-mainMenu')->with($notification);
  }
}

public function sortMainMenu()
{ 
  $mainMenu = [];
  $menu = Menu::where('deleted_at',NULL)->where('menu_type','main_menu')->where('active_status','active')->where('parent_id',0)->orderBy('priority_no','asc')->get();
    // foreach ($menu as $key => $m) 
    // {
    //   $firstSubMenu = $this->AddSub($m['id']);
    // }
  return view('cd-admin.menu.sort-mainmenu',compact('menu'));
}


public function updateSort()
{

  $request = Request()->all();
  $sort = json_decode($request['sort']);
  foreach ($sort as $key => $s) 
  {
    $menu = Menu::find($s->id);
    $menu->parent_id = 0;
    $menu->priority_no = $key + 1;
    $menu->save();
    if(isset($s->children))
    {
      $data = $this->checkchildren($s->children,$s->id);
    }
  }

  $notification = array(
    'message' => 'Menu Sorted Successfully!',
   'alert-type' => 'success'
 );
  return redirect()->to('/cd-admin/sort-mainMenu')->with($notification);
}

public function checkchildren($data,$parent_id)
{
 
  foreach ($data as $key => $s) 
  {
    $menu = Menu::find($s->id);
    $menu->parent_id = $parent_id;
    $menu->priority_no = $key + 1;
    $menu->save();
    if(isset($s->children))
    {
      $data = $this->checkchildren($s->children,$s->id);
    }
  }
  return $data;
}

public function sortSideMenu()
{
  $side_menu = Menu::where('menu_type','side_menu')->where('deleted_at',NULL)->where('active_status','active')->where('is_parent','yes')->orderBy('priority_no','asc')->get(); 
  foreach($side_menu as $key=>$s)
  {
    $finalSideMenu[$key]['parent_menu'] = $s; 
    $finalSideMenu[$key]['sub_menu'] = Menu::where('menu_type','side_menu')->where('deleted_at',NULL)->where('active_status','active')->where('is_parent',NULL)->where('parent_id',$s['id'])->orderBy('priority_no','asc')->get();
  }
  return view('cd-admin.menu.sort-side-menu',compact('finalSideMenu'));
}

public function updateSideMenuSort()
{
  $request = Request()->all();
  $sort = json_decode($request['sort']);
  foreach($sort as $first=>$s)
  {
    $menu = Menu::find($s->id);
    if(isset($s->children))
    {
      $new_menu = Menu::find($s->id);
      $new_menu->parent_id = $s->id;
      $new_menu->is_parent = 'yes';
      $new_menu->priority_no = $first + 1;
      $new_menu->save();
      foreach($s->children as $key=>$sm)
      {
        $sub_menu = Menu::find($sm->id);
        $sub_menu->is_parent = NULL;
        $sub_menu->parent_id = $menu['id'];
        $sub_menu->priority_no = $key + 1;
        $sub_menu->save();
        if(isset($sm->children))
        {
          break;
        }
      }
    }
    else
    {
      $data = Menu::find($s->id);
      $data->parent_id = $s->id;
      $data->is_parent = 'yes';
      $data->priority_no = $first + 1;
      $data->save();
    }
  }
  $notification = array(
   'message' => 'Side Menu Sorted successfully!',
   'alert-type' => 'success'
 );
  return redirect()->back()->with($notification);
}


  // $json = $request->nested_category_array;
  // $decoded_json = json_decode($json, TRUE);

  // $simplified_list = [];
  // $this->recur1($decoded_json, $simplified_list);

public function recur1($nested_array=[], &$simplified_list=[]){

  foreach($nested_array as $k => $v){

    $sort_order = $k+1;
    $simplified_list[] = [
      "category_id" => $v['id'], 
      "parent_id" => 0, 
      "sort_order" => $sort_order
    ];

    if(!empty($v["children"])){
      $this->recur2($v['children'], $simplified_list, $v['id']);
    }

  }
}

public function recur2($sub_nested_array=[], &$simplified_list=[], $parent_id = NULL){
  foreach($sub_nested_array as $k => $v){

    $sort_order = $k+1;
    $simplified_list[] = [
      "category_id" => $v['id'], 
      "parent_id" => $parent_id, 
      "sort_order" => $sort_order
    ];

    if(!empty($v["children"])){
      return $this->recur2($v['children'], $simplified_list, $v['id']);
    }
  }
}

}
