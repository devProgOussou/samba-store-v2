<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Company;
use App\Models\Message;
use App\Models\Personal;
use App\Models\contactForm;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->get();
        $advertisements = Advertisement::where('user_id', $id)->get();
        return Inertia::render('Admin/User', [
            'user' => $user,
            'advertisements' => $advertisements
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        Personal::where('user_id', $id)->delete();
        Company::where('user_id', $id)->delete();
        Advertisement::where('user_id', $id)->delete();
        Message::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back();
    }

    /**
     * Display the list user's Company.
     *
     * @return Response|\Inertia\Response
     */
    public function showCompanies()
    {
        $companies = Company::with('user')->get();

        return Inertia::render('Admin/CompanyShow', [
            'companies' => $companies
        ]);
    }

    /**
     * Display the list user's Personal.
     *
     * @return Response|\Inertia\Response
     */
    public function showPersonals()
    {
        $personals = Personal::with('user')->get();

        return Inertia::render('Admin/PersonalShow', [
            'personals' => $personals
        ]);
    }


     /**
     * Deactivate the specific user.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function deactivate($id)
    {
        User::where('id', $id)->update([
            'isActive' => false
        ]);
        return back();
    }

    /**
     * Activate the specific user.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function activate($id)
    {
        User::where('id', $id)->update([
            'isActive' => true
        ]);
        return back();
    }


    /**
     * Display the specific user's Company.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function showCompany($id)
    {
        $company = Company::where('id', $id)->get();
        $advertisements = Advertisement::where('user_id', $id)->get();

        return Inertia::render('Admin/showCompany', [
            'company' => $company,
            'advertisements' => $advertisements
        ]);
    }

    public function showPersonal($id)
    {
        $personal = User::where('id', $id)->get();
        $advertisements = Advertisement::where('personal_id', $id)->get();

        return Inertia::render('Admin/showPersonal', [
            'personal' => $personal,
            'advertisements' => $advertisements
        ]);
    }

    public function DeletePersonalPost($id)
    {
        Advertisement::where('id', $id)->delete();
        return back();
    }

    public function personalDelete($id)
    {
        Advertisement::where('personal_id', $id)->delete();
        Personal::where('user_id', $id)->delete();
        User::where('id', $id)->delete();

        return back();
    }

    public function companyDelete($id)
    {
        Advertisement::where('company_id', $id)->delete();
        Company::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back();
    }

    public function contactAdmin(Request $request)
    {
        $contactAdmin = new contactForm();
        $contactAdmin->messages = $request->input('messages');
        $contactAdmin->user_id = Auth::user()->id;
        $contactAdmin->save();
        return redirect()->route('Admin.messageSave');
    }

    public function messageSave()
    {
        return Inertia::render('User/Deactivate');
    }

    public function sendMessageToUserDeactivated()
    {

    }
}
