<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
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
        $companies = Company::query()->where('user_id', '=', Auth::user()->id)->paginate(15);
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
    public function store(StoreCompanyRequest $request)
    {

        $request->validated();

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
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);
        $request->validated();

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
