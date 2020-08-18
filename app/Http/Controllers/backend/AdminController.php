<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;
use App\Role;
use App\Permission;
use App\User;
use App\RolePermission;
use App\UserRole;
use Session;
use Auth;
class AdminController extends Controller
{
  public function addAdmin()
  {
   $role = Role::where('deleted_at',NULL)->get();
   $permission = Permission::get();
   return view('cd-admin.admin.add-new-admin',compact('role','permission'));
 }

 public function viewAdmin()
 {
   $finalResult = [];
   $user = User::where('deleted_at',Null)->where('email','!=','creatudevelopers@admin.com')->get();
   foreach($user as $users)
   {
    $role = UserRole::where('user_id',$users->id)->get()->first();
    $role['detail'] = Role::where('id',$role->role_id)->get()->first();
    $users['role'] = $role;
    $finalResult[count($finalResult)] = $users;
  }
  return view('cd-admin.admin.view-all-admin',compact('finalResult'));
}

public function insertAdmin()
{
 $request = Request()->all();
 $this->validate(Request(),[
  'username' => 'required',
  'fullname' => 'required',
  'email' => 'required|email|max:255|unique:users,email',
  'password' => 'required|min:8',
  'role' => 'required',
  'status' => 'required',
  'image_name' => '',
]);
 $user = new User;
 if(isset($request['image_name']))
 {
  $file = $request['image_name'];
  $filename = time().$file->getClientOriginalName();
  $destination = public_path('uploads/profile');
  $file->move($destination,$filename);
  $user->image_name = $filename;
}
$user->user_name = $request['username'];
$user->full_name = $request['fullname'];
$user->email = $request['email'];
$user->password = bcrypt($request['password']);
$user->active_status = $request['status'];
$user->save();
$role = new UserRole;
$role->user_id = $user->id;
$role->role_id = $request['role'];
$role->save();
Session::flash('success','insert successFully..!!!');
return redirect()->to('cd-admin/view-all-admin');
}

public function editAdmin($id)
{
 $finalResult = [];
 if($user = User::where('id',$id)->get()->first())
 {
  $role = Role::where('deleted_at',NULL)->get();
  $permission = Permission::get();
  $userRole = UserRole::where('user_id',$user->id)->get()->first();
  $rolePermission = RolePermission::where('role_id',$userRole->role_id)->get()->first();
  $finalResult['user'] = $user;
  $finalResult['role'] = $role;
  $finalResult['permission'] = $permission;
  $finalResult['userRole'] = $userRole;
  $finalResult['rolePermission'] = $rolePermission;
  return view('cd-admin.admin.edit-admin',compact('finalResult'));
}
}

public function updateAdmin($id)
{
  $request = Request()->all();
  $this->validate(Request(),[
    'username' => 'required',
    'fullname' => 'required',
    'email' => 'required|email|max:255',
    'role' => 'required',
    'status' => 'required',
    'image_name' => '',
  ]);
  $user = User::where('id',$id)->get()->first();
  if(isset($request['image_name']))
  {
    if(file_exists('public/uploads/profile/'.$user['image_name']))
    {
      unlink('public/uploads/profile/'.$user['image_name']);
    }
    $file = $request['image_name'];
    $filename = time().$file->getClientOriginalName();
    $destination = public_path('uploads/profile');
    $file->move($destination,$filename);
    $user->image_name = $filename;
  }
  $user->user_name = $request['username'];
  $user->full_name = $request['fullname'];
  $user->email = $request['email'];
  $user->active_status = $request['status'];
  if($user->save())
  {
    $role = UserRole::where('user_id',$user->id)->get()->first();
    $role->user_id = $user->id;
    $role->role_id = $request['role'];
    $role->save();
  }
  Session::flash('success','updated successFully..!!!');
  return redirect()->to('cd-admin/view-all-admin');
}

public function deleteAdmin($id)
{
 if($user = User::where('id',$id)->get()->first())
 {
  $today = \Carbon\Carbon::now('Asia/Kathmandu');
  $user->deleted_at = $today;
  $user->save();
  Session::flash('failure','Deleted successFully');
  return redirect()->to('cd-admin/view-all-admin');
}
}

public function changePasswordForm()
{
  return view('cd-admin.admin.change-password');
}

public function changePassword()
{
 $data = Request()->validate([
  'password' => 'required',
  'confirm_password' => 'required|same:password'
]);
 $password = bcrypt($data['password']);
 $user = User::find(Auth::user()->id);
 $user->password = $password;
 $user->save();
 $notification = array(
  'message' => 'Password Changed Successfully',
  'alert-type' => 'success',
);
 return redirect('cd-admin/dashboard')->with($notification);
}

public function sendPasswordLink($id)
{
  $data = User::find($id);
  $email = encrypt($data['email']);
  Mail::to($data['email'])->send(new PasswordReset($data,$email));
  $notification = array(
    'message' => 'Reset Password Link Sent Successfully',
    'alert-type' => 'success',
  );
  return redirect()->back()->with($notification);
}

public function ResetPasswordForm($email)
{
  $mail = decrypt($email);
  $data = User::where('email',$mail)->firstOrFail();
  return view('auth.reset-password',compact('data'));
} 

public function ResetPassword($id)
{
  $data = Request()->validate([
    'password' => 'required',
    'confirm_password' => 'required|same:password'
  ]);
  $password = bcrypt($data['password']);
  $user = User::find($id);
  $user->password = $password;
  $user->save();
  $notification = array(
    'message' => 'Password Reset Successfully',
    'alert-type' => 'success',
  );
  return redirect()->back()->with($notification);
}   


public function editProfileForm()
{
  $data = User::find(Auth::user()->id);
  return view('cd-admin.admin.update-profile',compact('data'));
}

public function editProfile()
{
  $user = User::find(Auth::user()->id);
  $validation = Request()->validate([
    'username' => 'required',
    'fullname' => 'required',
    'image_name' => '',
  ]);
  if(isset($validation['image_name']))
  {
    if(file_exists('public/uploads/profile/'.$user['image_name']))
    {
      unlink('public/uploads/profile/'.$user['image_name']);
    }
    $file = $validation['image_name'];
    $filename = time().$file->getClientOriginalName();
    $destination = public_path('uploads/profile');
    $file->move($destination,$filename);
    $user->image_name = $filename;
  }
  $user->user_name = $validation['username'];
  $user->full_name = $validation['fullname'];
  $user->save();
  $notification = array(
    'message' => 'Profile Updated Successfully',
    'alert-type' => 'success',
  );
  return redirect('cd-admin/dashboard')->with($notification);
}

public function updateStatus($id)
  {
    $data = User::find($id);
    if ($data['active_status'] == '1') 
    {
      $a['active_status'] = '0';
    }
    else
    {
      $a['active_status'] = '1';
    }
    $data->active_status = $a['active_status'];
    $data->save();
    $notification = array(
      'message' => 'Status Updated Successfully',
      'alert-type' => 'success',
    );
    return redirect()->back()->with($notification);
  }
}
