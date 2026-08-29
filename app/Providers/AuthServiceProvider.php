<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-post', function (User $user, $post) {
            return $post == "Admin";
        });
        
        Gate::define('add-company', function (User $user, $post) {
            return Auth::user()->type == 'Admin';
        });

        Gate::define('add-cate', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                if ($result[0]=='admin')return true;
                return $result[0] == 'add';
            }
            return true;
        });

        Gate::define('view-cate', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                if ($result[0]=='admin')return true;
                return $result[0] == 've';
            }
            return true;
        });

        Gate::define('add-pro', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 'add';
            }
            return true;
        });

        Gate::define('view-pro', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 've';
            }
            return true;
        });

        Gate::define('view-count', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 've';
            }
            return true;
        });

        Gate::define('view-bulkprice', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 've';
            }
            return true;
        });

        Gate::define('add-sale', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 'add';
            }
            return true;
        }); 

        Gate::define('add-purchase', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 'add';
            }
            return true;
        });

        Gate::define('add-cashin', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 'add';
            }
            return true;
        });

        Gate::define('add-cashout', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 'add';
            }
            return true;
        });    

        Gate::define('view-cashin', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 've';
            }
            return true;
        });

        Gate::define('view-cashout', function (User $user, $post) {
            $result = Permission::where(['pages'=>$post,'user_id'=>Auth::id()])->pluck('permission');
            if (count($result)>0) {
                return $result[0] == 've';
            }
            return true;
        }); 

        Gate::define('view-userrights', function (User $user, $post) {
            return Auth::user()->type == 'Admin';
        });      
    }
}
