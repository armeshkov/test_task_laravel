<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
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
        $workers = Worker::query()->where('company_id', '=', $company->id)->paginate(15);
        return view('workers.index', ['company' => $company, 'workers' => $workers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Company $company)
    {
        $this->authorize('create', [Worker::class, $company]);
        return view('workers.create', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreWorkerRequest $request, Company $company)
    {
        $this->authorize('create', [Worker::class, $company]);
        $request->validated();
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
    public function update(UpdateWorkerRequest $request, Company $company, Worker $worker)
    {
        $this->authorize('update', [$company, $worker]);

        $request->validated();

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
     */
    public function destroy(Company $company, Worker $worker)
    {
        $this->authorize('update', [$company, $worker]);
        $worker->delete();
        Session::flash('message', 'Successfully deleted the company!');
        return Redirect::to(route('dashboardcompanies.workers.index', $company));
    }
}
