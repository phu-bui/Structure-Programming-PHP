<?php
namespace Modules\User\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class AdminBaseController extends BaseController
{
    protected $adminUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->adminUser = Auth::guard('admin')->user();
            if(!empty($this->adminUser)){
                View::share('adminUser', $this->adminUser);
            }
            return $next($request);
        });
    }
}
