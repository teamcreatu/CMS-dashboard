<?php

namespace App\Respository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Menu;
use Auth;
use \Carbon\Carbon;


class MainMenuRespository extends Controller
{
    public $successStatus = 200;

    public function insertMainMenu()
    {
        $request = Request()->all();
        $menu = new Menu;
        $menu->menu_name = $request['name'];
        $menu->menu_name_ne = $request['name_ne'];
        if(isset($request['priority_no']))
        {
            $menu->priority_no = $request['priority_no'];
        }
        else
        {
            $menu->priority_no = 0;
        }
        $menu->menu_type = $request['menu_type'];
        $menu->active_status = $request['status'];
        $menu->url_type = $request['url_type'];
        if($request['menu_type'] == 'side_menu')
        {
            if(!isset($request['side_menu_category']))
            {
                Request()->validate([
                    'side_menu_category' =>'required',
                ]);
            }
        }
        if($request['menu_type'] == 'main_menu')
        {
            if(!isset($request['main_menu_category']))
            {
                Request()->validate([
                    'main_menu_category' =>'required',
                ]);
            }
        }
        if($request['menu_type'] == 'side_menu' && $request['side_menu_category'] == 'parent')
        {
            $menu->is_parent = 'yes';
            $menu->parent_id = 0;
            if($request['add'] == "post_category")
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';      
            }

        }
        elseif($request['menu_type'] == 'side_menu' && $request['side_menu_category'] != 'parent')
        {
            $menu->parent_id = $request['side_menu_category'];
            if($request['add'] == "post_category")
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';      
            }
        }
        elseif($request['menu_type'] == 'main_menu' && $request['main_menu_category'] == 'parent')
        {
            $menu->is_parent = 'yes';
            $menu->parent_id = 0;
            if($request['add'] == "post_category")
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';      
            }

        }
        elseif($request['menu_type'] == 'main_menu' && $request['main_menu_category'] != 'parent')
        {
            $menu->parent_id = $request['main_menu_category'];
            if($request['add'] == "post_category")
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';      
            }
        }
        else
        {
         if($request['add'] == "post_category")
         {
            $menu->page_url = $request['post_category'].'/en';
            $menu->page_url_ne = $request['post_category'].'/ne';
        }
        elseif($request['add'] == 'document_category')
        {
            $menu->page_url = $request['document_category'].'/en';
            $menu->page_url_ne = $request['document_category'].'/ne';
        }
        else
        {
            $menu->page_url = $request['page_url'];
            $new = substr(urldecode($request['page_url']),0,-3);
            $menu->page_url_ne = $new.'/ne';      
        }
    }
    $menu->slug = str_slug($request['name']);
    $menu->created_by = Auth::user()->id;
    $menu->updated_by = Auth::user()->id;
    $menu->save();
    return response()->json(['success'=>$menu,  'status' => $this->successStatus]); 
}

public function updateMainMenu($key)
{
    if($menu = Menu::where('id',$key)->get()->first())
    { 
        $request = Request()->all();
        $menu->menu_name = $request['name'];
        $menu->menu_name_ne = $request['name_ne'];
        if(isset($request['priority_no']))
        {
            $menu->priority_no = $request['priority_no'];
        }
        else
        {
            $menu->priority_no = 0;
        }      
        $menu->menu_type = $request['menu_type'];
        $menu->active_status = $request['status'];
        $menu->url_type = $request['url_type'];
        if($request['menu_type'] == 'side_menu' && $request['side_menu_category'] == 'parent')
        {
            $menu->is_parent = 'yes';
            $menu->parent_id = 0;
            if($request['add'] == "post_category" || $request['add'] == 'document_category')
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';
            }
        }
        elseif($request['menu_type'] == 'side_menu' && $request['side_menu_category'] != 'parent')
        {
            $menu->parent_id = $request['side_menu_category'];
            if($request['add'] == "post_category")
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';      
            }
        }
        elseif($request['menu_type'] == 'main_menu' && $request['main_menu_category'] == 'parent')
        {
            $menu->is_parent = 'yes';
            $menu->parent_id = 0;
            if($request['add'] == "post_category")
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';
            }
        }
        elseif($request['menu_type'] == 'main_menu' && $request['main_menu_category'] != 'parent')
        {
            $menu->parent_id = $request['main_menu_category'];
            if($request['add'] == "post_category")
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';      
            }
        }
        else
        {
            $menu->is_parent = NULL;
            $menu->parent_id = NULL;
            if($request['add'] == "post_category" || $request['add'] == 'document_category')
            {
                $menu->page_url = $request['post_category'].'/en';
                $menu->page_url_ne = $request['post_category'].'/ne';
            }
            elseif($request['add'] == 'document_category')
            {
                $menu->page_url = $request['document_category'].'/en';
                $menu->page_url_ne = $request['document_category'].'/ne';
            }
            else
            {
                $menu->page_url = $request['page_url'];
                $new = substr(urldecode($request['page_url']),0,-3);
                $menu->page_url_ne = $new.'/ne';                    }
            }
            $menu->slug = str_slug($request['name']);
            $menu->created_by = Auth::user()->id;
            $menu->updated_by = Auth::user()->id;
            $menu->save();
            return response()->json(['success'=>$menu,  'status' => $this->successStatus]);
        }
        else
        {
           return response()->json(['error'=>'Unauthorised'], 401);
       }
   }

   public function updateStatus($key)
   {
    if($menu = Menu::where('id',$key)->get()->first())
    {
        if ($menu->active_status == 'active') {
            $menu['active_status'] = 'inactive';
            $menu->save();
        }else{
            $menu['active_status'] = 'active';
            $menu->save();
        }return response()->json(['success'=>$menu,  'status' => $this->successStatus]);
    }else{
        return response()->json(['error'=>'Unauthorised'], 401);
    }
}

public function deleteMainMenu($key)
{
    if($menu = Menu::where('id',$key)->get()->first())
    {
        $today = Carbon::now('Asia/Kathmandu');;
        $menu->deleted_at = $today;
        $menu->menu_name = 'deleted__'.$menu['menu_name'];
        $menu->menu_name_ne = 'deleted__'.$menu['menu_name_ne'];
        $menu->save();
        return response()->json(['success'=>$menu,  'status' => $this->successStatus]);
    }else{
        return response()->json(['error'=>'Unauthorised'], 401);
    }
}
}