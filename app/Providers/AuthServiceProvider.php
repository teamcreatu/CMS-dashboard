<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\UserRole;
use App\RolePermission;
use App\Permission;
use Auth;
use App\Members;
use App\Posts;;
use App\Events;
use App\Resource;
use App\Role;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permission = Permission::where('deleted_at',NULL)->where('name','!=','all')->get();
        Gate::define('all',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                foreach($decode as $d)
                {
                    if($d['name'] == $ability)
                    {
                        if(in_array('all',$d['mode']) || in_array('edit',$d['mode']) || in_array('create',$d['mode']) || in_array('delete',$d['mode']))
                        {   
                            return true;
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });
        foreach($permission as $p)
        { 
            Gate::define($p['name'],function($user,$ability)
            {   
                $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
                $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
                if($role['role_id'] != 1)
                {
                    $firstdecode = json_decode($role['mode']);
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
                    foreach($decode as $d)
                    {
                        if($d['name'] == $ability)
                        {   
                            if(in_array('all',$d['mode']) || in_array('edit',$d['mode']) || in_array('create',$d['mode']) || in_array('delete',$d['mode']))
                            {
                                return true;    
                            }
                        }

                    }

                    return false;
                }
                else
                {
                    return true;
                }
            });

            Gate::define('delete-'.$p['name'],function($user,$ability)
            {
                $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
                $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
                if($role['role_id'] != 1)
                {
                    $firstdecode = json_decode($role['mode']);
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
                    foreach($decode as $d)
                    {
                        if($d['name'] == 'all')
                        {   
                            if(in_array('all',$d['mode']) || in_array('delete',$d['mode']))
                            {  
                                return true;    
                            }
                        }
                        if($d['name'] == $ability)
                        {
                            if(in_array('all',$d['mode']) || in_array('delete',$d['mode']))
                            {  
                                return true;    
                            }
                        }
                    }
                    return false;
                }
                else
                {
                    return true;
                }
            });
            Gate::define('add-'.$p['name'],function($user,$ability)
            {
                $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
                $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
                if($role['role_id'] != 1)
                {
                    $firstdecode = json_decode($role['mode']);
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
                    foreach($decode as $d)
                    {
                        if($d['name'] == 'all')
                        {
                            if(in_array('all',$d['mode']) || in_array('create',$d['mode']))
                            {  
                                return true;    
                            }
                        }
                        if($d['name'] == $ability)
                        {
                            if(in_array('all',$d['mode']) || in_array('create',$d['mode']))
                            {  
                                return true;    
                            }
                        }
                    }
                    return false;
                }
                else
                {
                    return true;
                }
            });

            Gate::define('edit-'.$p['name'],function($user,$ability)
            {
                $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
                $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
                if($role['role_id'] != 1)
                {
                    $firstdecode = json_decode($role['mode']);
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
                    foreach($decode as $d)
                    {

                        if($d['name'] == 'all')
                        {
                            if(in_array('all',$d['mode']) || in_array('edit',$d['mode']))
                            {  
                                return true;    
                            }
                        }
                        if($d['name'] == $ability)
                        {
                            if(in_array('all',$d['mode']) || in_array('edit',$d['mode']))
                            {  
                                return true;    
                            }
                        }
                    }
                    return false;
                }
                else
                {
                    return true;
                }
            });
        }

        Gate::define('view-category-staffs',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $member = Members::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'staffs' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']))
                        {
                            $category = array_intersect(json_decode($member['category_id']), $d->category);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });

        Gate::define('edit-category-staffs',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $member = Members::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'staffs' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']) || in_array('edit',$d['mode']))
                        {
                            $category = array_intersect(json_decode($member['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });


        Gate::define('delete-category-staffs',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $member = Members::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'staffs' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']) || in_array('delete',$d['mode']))
                        {
                            $category = array_intersect(json_decode($member['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });

        Gate::define('view-category-post',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $posts = Posts::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'post' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']))
                        {
                            $category = array_intersect(json_decode($posts['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });


        Gate::define('edit-category-post',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $posts = Posts::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'post' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']) || in_array('edit',$d['mode']))
                        {
                            $category = array_intersect(json_decode($posts['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });


        Gate::define('delete-category-post',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $posts = Posts::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'post' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']) || in_array('delete',$d['mode']))
                        {
                            $category = array_intersect(json_decode($posts['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });

        Gate::define('view-category-documents',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $documents = Resource::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'documents' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']))
                        {
                            $category = array_intersect(json_decode($documents['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });


        Gate::define('edit-category-documents',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $documents = Resource::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'documents' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']) || in_array('edit',$d['mode']))
                        {
                            $category = array_intersect(json_decode($documents['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });


        Gate::define('delete-category-documents',function($user,$ability)
        {   
            $data = UserRole::where('deleted_at',NULL)->where('user_id',$user->id)->get()->first();
            $role = RolePermission::where('deleted_at',NULL)->where('role_id',$data['role_id'])->get()->first();
            if($role['role_id'] != 1)
            {
                $firstdecode = json_decode($role['mode']);
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
                $documents = Resource::find($ability);
                foreach($decode as $d)
                {
                    if($d['name'] == 'documents' && isset($d['category']))
                    {   
                        if(in_array('all',$d['mode']) || in_array('delete',$d['mode']))
                        {
                            $category = array_intersect(json_decode($documents['category_id']), $d['category']);
                            if(count($category) >= 1)
                            {
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
        });

    }
}
