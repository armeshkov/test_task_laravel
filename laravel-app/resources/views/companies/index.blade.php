<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
                <td>{{ $company->logo }}</td>
                <td>{{ $company->created_at }}</td>
                <td>{{ $company->updated_at }}</td>
                <td>
                    <a class="btn btn-small btn-primary" href="{{ url('companies/' . $company->id) }}">Show</a>
                    <a class="btn btn-small btn-success" href="">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection
</body>
</html>
