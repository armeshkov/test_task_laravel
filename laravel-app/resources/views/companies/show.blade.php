@extends('companies.base')
@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">phone</th>
                <th scope="col">website</th>
                <th scope="col">logo</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Workers</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $company->name }}</th>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->phone }}</td>
                    <td>{{ $company->website }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="" width="100" height="100">
                    </td>
                    <td>{{ $company->created_at }}</td>
                    <td>{{ $company->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
