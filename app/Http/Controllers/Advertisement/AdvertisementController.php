<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index()
    {
        $advertisements = Advertisement::where('user_id', Auth::user()->id)->get();
        return Inertia::render('User/Dashboard', [
            'advertisements' => $advertisements,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render('User/Index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response|\Inertia\Response
     */
    public function store(Request $request)
    {
        $advertisement = new Advertisement();
        if (Auth::user()->isCompany == true) {
            $advertisement->company_id = Auth::user()->id;
        } else {
            $advertisement->personal_id = Auth::user()->id;
        }
        $advertisement->productName = $request->input('productName');
        $advertisement->description = $request->input('description');
        $advertisement->category = $request->input('category');
        //  dd($advertisement->category);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $advertisement->images = $filename;
        }

        if ($request->hasFile('image1')) {
            $file = $request->file('image1');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $advertisement->images1 = $filename;
        }

        if ($request->hasFile('image2')) {
            $file = $request->file('image2');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $advertisement->images2 = $filename;
        } else {
            return back();
        }
        $advertisement->user_id = Auth::user()->id;
        $advertisement->save();
        $advertisements = Advertisement::where('user_id', Auth::user()->id)->with('user')->get();
        return Inertia::render('User/Dashboard', [
            'advertisements' => $advertisements,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function show($id)
    {
        $advertisement = Advertisement::where('id', $id)->get();

        return Inertia::render('User/Show', [
            'advertisement' => $advertisement,
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
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Advertisement::where('id', $id)->delete();
        return back();

    }

    public function deactivate($id)
    {
        Advertisement::where('id', $id)->update([
            'isAvailable' => false
        ]);
        return redirect()->route('home.index');
    }

    public function activate($id)
    {
        Advertisement::where('id', $id)->update([
            'isAvailable' => true
        ]);
        return back();
    }
}
