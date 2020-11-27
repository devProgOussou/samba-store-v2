<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Company;
use App\Models\Personal;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all()->where('isAdmin', 0);
        $advertisements = Advertisement::all()->where('user_id', Auth::user()->id);
        if(Auth::user()->isAdmin == 0 && Auth::user()->isActive == 1)
        {
            if(Auth::user()->isCompany == false)
            {
                if(Auth::user()->isRegister == 1)
                {
                    return Inertia::render('User/Dashboard',[
                        'advertisements' => $advertisements
                    ]);
                }
                else{
                    $personal = new Personal();
                    $personal->lastName = Auth::user()->name;
                    $personal->firstName = Auth::user()->username;
                    $personal->address = Auth::user()->address;
                    $personal->phone = Auth::user()->phone;
                    $personal->user_id = Auth::user()->id;
                    $personal->save();
                    DB::update("UPDATE users SET isRegister = 1 WHERE id = ".Auth::user()->id);
                    return Inertia::render('User/Dashboard',[
                        'advertisements' => $advertisements
                    ]);
                }
            }
            else
            {
                if(Auth::user()->isRegister == 1)
                {
                    return Inertia::render('User/Dashboard',[
                        'advertisements' => $advertisements
                    ]);
                }
                else{
                    $company = new Company();
                    $company->companyName = Auth::user()->name;
                    $company->address = Auth::user()->address;
                    $company->phone = Auth::user()->phone;
                    $company->user_id = Auth::user()->id;
                    $company->save();
                    DB::update("UPDATE users SET isRegister = 1 WHERE id = ".Auth::user()->id);
                    return Inertia::render('User/Dashboard',[
                        'advertisements' => $advertisements
                    ]);
                }
            }
        }
        elseif(Auth::user()->isAdmin == 0 && Auth::user()->isActive == 0)
        {
            return Inertia::render('User/Deactivate');
        }
        else{
            return Inertia::render('Admin/Index', [
                'users' => $users
            ]);
        }

    }
}
