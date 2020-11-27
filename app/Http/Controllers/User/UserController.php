<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Company;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|\Inertia\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $companyID = DB::select("SELECT user_id FROM companies WHERE user_id = $id");
        if ($companyID == null)
        {
            $personals = Personal::where('user_id', $id)->get();

            return Inertia::render('User/updateUserProfile',[
                'personals-prop' => $personals
            ]);
        }
        else {
            $companies = Company::where('user_id', $id)->get();

            return Inertia::render('User/updateCompanyProfile',[
                'companies-prop' => $companies
            ]);
        }


        return Inertia::render('User/updateUserProfile',[]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function updateUser(Request $request, $id)
    {
        Personal::where('user_id', $id)->update([
            'lastName' => $request->input('lastName'),
            'firstName' => $request->input('firstName'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);

        $user = new User();
        if (Auth::user()->id == $id && $request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['avatar' => $filename]);
            $file->move('uploads/avatar/', $filename);

        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function UpdateCompany(Request $request, $id)
    {
        Company::where('user_id', $id)->update([
            'companyName' => $request->input('companyName'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);

        $user = new User();
        if (Auth::user()->id == $id && $request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'avatar' => $filename,

                        ]);
            $file->move('uploads/avatar/', $filename);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function showDash()
    {
        return Inertia::render('User/Deactivate');
    }
}
