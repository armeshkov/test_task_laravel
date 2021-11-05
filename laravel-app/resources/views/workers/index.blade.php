@extends('companies.base')
@section('content')
    <div class="container mt-3 mb-3">
        <h1>{{ $company->name }}</h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($workers as $worker)
                <tr>
                    <th scope="row">{{ $worker->first_name }}</th>
                    <td>{{ $worker->last_name }}</td>
                    <td>{{ $worker->email }}</td>
                    <td>{{ $worker->phone }}</td>
                    <td>{{ $worker->created_at }}</td>
                    <td>{{ $worker->updated_at }}</td>
                    <td>
                        <a class="btn btn-small btn-primary" href="{{ route('dashboardcompanies.workers.show', ['company' => $company, 'worker' => $worker]) }}">Show</a>
                        <a class="btn btn-small btn-success" href="{{ route('dashboardcompanies.workers.edit', ['company' => $company, 'worker' => $worker]) }}">Edit</a>
                        <form class="pt-2" action="{{ route('dashboardcompanies.workers.destroy', ['company' => $company, 'worker' => $worker]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $workers->links() }}
    </div>
    <div class="container text-center">
        <a href="{{ route('dashboardcompanies.workers.create', ['company' => $company]) }}" class="btn btn-primary">Add worker</a>
    </div>
@endsection
