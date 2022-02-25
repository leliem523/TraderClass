<?php

namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Modules\Dashboard\Models\Blog_Model;
use App\Modules\Dashboard\Models\BlogCategory_Model;
use App\Modules\Dashboard\Rules\Permission;
use Illuminate\Support\Facades\Auth;
//use App\Modules\Dashboard\Helpers\Helper;
use Illuminate\Support\Facades\Cookie;

class BlogCategory extends Controller {

    public function __construct() {
        /*
        $this->middleware(function ($request, $next) {
            $permission = Permission::access(Auth::getUser()->id);
            foreach ($permission as $key => $value) {
                if ($value->class == "Blog" && $value->status == 0) {
                    return redirect("admin/403");
                }
            }
            return $next($request);
        });*/
    }

    public function index() {
        
        dd("Chưa có template");
    }

}
