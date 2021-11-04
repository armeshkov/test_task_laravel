<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Company $company)
    {
        $this->authorize('viewAny', $company);
        return view('workers.index', ['company' => $company]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Company $company)
    {
        return view('workers.create', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request, Company $company)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            //'phone' => ['required', 'regex:/^((\+?7|8)(?!95[4-79]|99[08]|907|94[^0]|336)([348]\d|9[0-6789]|7[0247])\d{8}|\+?(99[^4568]\d{7,11}|994\d{9}|9955\d{8}|996[57]\d{8}|9989\d{8}|380[34569]\d{8}|375[234]\d{8}|372\d{7,8}|37[0-4]\d{8}))$/'],
            'phone' => 'required|min:10',
        );
        $validator = Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            return redirect(route('dashboardcompanies.workers.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $worker = Worker::create([
           'first_name' => $request->first_name,
           'last_name' => $request->last_name,
           'company_id' => $company->id,
           'email' => $request->email,
           'phone' => $request->phone,
        ]);
        Session::flash('message', 'Successfully added worker!');
        return Redirect::to(route('dashboardcompanies.workers.index', ['company' => $company]));
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Company $company, Worker $worker)
    {
        $this->authorize('view', [$worker, $company]);
        return view('workers.show', ['company' => $company, 'worker' => $worker]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Company $company, Worker $worker)
    {
        $this->authorize('update', [$company, $worker]);
        return view('workers.edit', ['company' => $company,'worker' => $worker]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, Company $company, Worker $worker)
    {
        $this->authorize('update', [$company, $worker]);
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            //'phone' => ['required', 'regex:/^((\+?7|8)(?!95[4-79]|99[08]|907|94[^0]|336)([348]\d|9[0-6789]|7[0247])\d{8}|\+?(99[^4568]\d{7,11}|994\d{9}|9955\d{8}|996[57]\d{8}|9989\d{8}|380[34569]\d{8}|375[234]\d{8}|372\d{7,8}|37[0-4]\d{8}))$/'],
            'phone' => 'required|min:10',
            'email' => 'required|email'
        );
        $validator = Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            return redirect(route('dashboardcompanies.workers.edit', ['company' => $company, 'worker' => $worker]))
                ->withErrors($validator)
                ->withInput();
        }
        Worker::where('id', $worker->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_id' => $worker->company_id,
            'email' => $request->email,
            'phone' => $request->phone,

        ]);
        return Redirect::to(route('dashboardcompanies.workers.show', ['company' => $company, 'worker' => $worker]))->with('message', 'Success!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
