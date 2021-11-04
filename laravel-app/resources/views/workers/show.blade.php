@extends('companies.base')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Company</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{ $worker->first_name }}</th>
                <td>{{ $worker->last_name }}</td>
                <td>{{ $worker->email }}</td>
                <td>{{ $worker->phone }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $worker->created_at }}</td>
                <td>{{ $worker->updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
