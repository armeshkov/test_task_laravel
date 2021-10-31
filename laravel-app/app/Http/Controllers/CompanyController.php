<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $companies = Auth::user()->companies;
        return view('companies.index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            //'phone' => ['required', 'regex:/^((\+?7|8)(?!95[4-79]|99[08]|907|94[^0]|336)([348]\d|9[0-6789]|7[0247])\d{8}|\+?(99[^4568]\d{7,11}|994\d{9}|9955\d{8}|996[57]\d{8}|9989\d{8}|380[34569]\d{8}|375[234]\d{8}|372\d{7,8}|37[0-4]\d{8}))$/'],
            'phone' => 'required|min:10',
            'website' => 'url',
            'logo' => 'image|dimensions:min_width=100,min_height=100'
        );
        $validator = Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            return redirect(route('dashboardcompanies.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $folder = Auth::user()->id;
        $logo = $request->file('logo')->store("companies/$folder");

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'logo' => $logo,
            'user_id' => Auth::user()->id,
        ]);
        Session::flash('message', 'Successfully created company!');
        return Redirect::to(route('dashboardcompanies.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $this->authorize('view', $company);
        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            //'phone' => ['required', 'regex:/^((\+?7|8)(?!95[4-79]|99[08]|907|94[^0]|336)([348]\d|9[0-6789]|7[0247])\d{8}|\+?(99[^4568]\d{7,11}|994\d{9}|9955\d{8}|996[57]\d{8}|9989\d{8}|380[34569]\d{8}|375[234]\d{8}|372\d{7,8}|37[0-4]\d{8}))$/'],
            'phone' => 'required|min:10',
            'website' => 'url',
            'logo' => 'image|dimensions:min_width=100,min_height=100'
        );
        $validator = Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            return redirect(route('dashboardcompanies.edit', ['company' => $company]))
                ->withErrors($validator)
                ->withInput();
        }
        $folder = Auth::user()->id;
        $logo = $request->file('logo')->store("companies/$folder");
        Company::where('id', $company->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'logo' => $logo,
            'user_id' => Auth::user()->id,
        ]);
        return Redirect::to(route('dashboardcompanies.show', $company))->with('message', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Company $company)
    {
        $this->authorize('view', $company);
        $company->delete();
        Session::flash('message', 'Successfully deleted the company!');
        return Redirect::to(route('dashboardcompanies.index'));
    }
}
