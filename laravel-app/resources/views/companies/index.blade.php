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
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
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
                <td>
                    <a class="btn btn-small btn-primary" href="{{ route('dashboardcompanies.show', ['company' => $company]) }}">Show</a>
                    <a class="btn btn-small btn-success" href="{{ route('dashboardcompanies.edit', ['company' => $company]) }}">Edit</a>
                    <form class="pt-2" action="{{ route('dashboardcompanies.destroy', ['company' => $company]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $companies->links() }}
    </div>
@endsection
