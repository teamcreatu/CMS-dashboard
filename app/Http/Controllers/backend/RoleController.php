<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\userRole;
use App\RolePermission;
use Auth;
use \Carbon\Carbon;
use App\MembersCategory;
use App\EventsCategory;
use App\PostsCategory;
use App\ResourceCategory;

class RoleController extends Controller
{
  public function addRole()
  {
    $memcat = MembersCategory::where('deleted_at',NULL)->get();
    $evecat = EventsCategory::where('deleted_at',NULL)->get();
    $newcat = PostsCategory::where('deleted_at',NULL)->get();
    $rescat = ResourceCategory::where('deleted_at',NULL)->get();
    $permission = Permission::where('deleted_at',Null)->get();
    $permission1 = Permission::where('deleted_at',NULL)->get();
    return view('cd-admin.role.add-role',compact('permission','memcat','evecat','newcat','rescat'));
  }

  public function viewRole()
  {
   $role = Role::where('deleted_at',Null)->where('id','!=',1)->get();
   return view('cd-admin.role.view-role',compact('role'));
 }

 public function editRole($id)
 {
  $memcat = MembersCategory::where('deleted_at',NULL)->get();
  $newcat = PostsCategory::where('deleted_at',NULL)->get();
  $rescat = ResourceCategory::where('deleted_at',NULL)->get();
  $permission = Permission::where('deleted_at',Null)->get();
  $permissions = RolePermission::where('deleted_at',NULL)->where('role_id',$id)->get()->first();
  $firstdecode = json_decode($permissions['mode']);
  $decode = [];
  foreach($firstdecode as $key=>$d)
  {
    $decode[$key]['name'] = $d->name;
    $decode[$key]['mode'] = json_decode($d->mode);
    if(isset($d->category))
    {
      if($d->category != NULL)
      {
        $decode[$key]['category'] = json_decode($d->category);
      }
    }
  }
  $role = Role::where('id',$id)->where('deleted_at',Null)->get()->first();
  return view('cd-admin.role.edit-role',compact('decode','role','memcat','newcat','rescat','permission'));
}

public function insertRole()
{
  $this->validate(Request(),[
    'name' => 'required',
  ]);
  $request = Request()->all();
  $permission = Permission::where('deleted_at',NULL)->get();
  $a = [];
  foreach($permission as $key => $p)
  {
    $a[$key]['name'] = $p['name'];
    if(isset($request[$p['name']]))
    {
      $a[$key]['mode'] = json_encode($request[$p['name']]);
    }
    elseif(isset($request[$p['name'].'_radio']))
    {
      $a[$key]['mode'] = json_encode(array($request[$p['name'].'_radio']));
    } 
    else
    {
      $a[$key]['mode'] = NULL;
    }
    if($p['name'] == 'post' || $p['name'] =='staffs' || $p['name'] == 'documents')
    {
      if(isset($request['mode'.$p['name']]))
      {
        $a[$key]['category'] = json_encode($request['mode'.$p['name']]);
      }
      else
      {
        $a[$key]['category'] = NULL;
      }
    }
  }
  $encode = json_encode($a);
  $role = new Role;
  $code = time().mt_rand();
  $role->name = $request['name'];
  $role->code = $code;
  if($role->save())
  {
    $rolePermission = new RolePermission;
    $rolePermission->role_id = $role->id;
    $rolePermission->mode = $encode;
    $rolePermission->created_by = Auth::user()->id;
    $rolePermission->updated_by = Auth::user()->id;
    $rolePermission->save();
  }
  $notification = array(
   'message' => 'Role Added Successfully',
   'alert-type' => 'success',
 );
  return redirect()->to('cd-admin/view-all-role')->with($notification);

}

public function deleteRole($id)
{
 if($role = Role::where('id',$id)->get()->first())
 {
   $today = Carbon::now('Asia/Kathmandu');;
   $role->deleted_at = $today;
   $role->save();
   $notification = array(
     'message' => 'Role Deleted Successfully',
     'alert-type' => 'success',
   );
   return redirect()->to('cd-admin/view-all-role')->with($notification);

 }
}

public function updateRole($id)
{
  $request = Request()->all();
  if($role = Role::where('id',$id)->get()->first())
  {
    $this->validate(Request(),[
      'name' => 'required',
    ]);
    $modes = $request['mode'];
    $permission = Permission::where('deleted_at',NULL)->get();
    $a = [];
    foreach($permission as $key => $p)
    {
      $a[$key]['name'] = $p['name'];
      if(isset($request[$p['name']]))
      {
        $a[$key]['mode'] = json_encode($request[$p['name']]);
      }
      elseif(isset($request[$p['name'].'_radio']))
      {
        $a[$key]['mode'] = json_encode(array($request[$p['name'].'_radio']));
      } 
      else
      {
        $a[$key]['mode'] = NULL;
      }
      if($p['name'] == 'post' || $p['name'] =='staffs' || $p['name'] == 'documents')
      {
        if(isset($request['mode'.$p['name']]))
        {
          $a[$key]['category'] = json_encode($request['mode'.$p['name']]);
        }
        else
        {
          $a[$key]['category'] = NULL;
        }
      }
    }
    $encode = json_encode($a);
    $code = time().mt_rand();
    $role->name = $request['name'];
    $role->code = $code;
    if($role->save())
    {
     $rolePermission = RolePermission::where('role_id',$id)->get()->first();
     $rolePermission->role_id = $id;
     $rolePermission->mode = $encode;
     $rolePermission->updated_by = Auth::user()->id;
     $rolePermission->save();
   }
   $notification = array(
    'message' => 'Role Updated Successfully',
    'alert-type' => 'success',
  );
   return redirect()->to('cd-admin/view-all-role')->with($notification);

 }

}
}
