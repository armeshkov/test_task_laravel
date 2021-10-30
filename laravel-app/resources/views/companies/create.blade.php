@extends('companies.base')
@section('content')
    <div class="container">
        <h1>Create Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('dashboardcompanies.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name of company</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp">
                <div id="phoneHelp" class="form-text">Without +7 and spaces</div>
            </div>
            <div class="mb-3">
                <label for="website" class="form-label">Link to website of company</label>
                <input type="text" class="form-control" id="website" name="website">
            </div>

            <div class="mb-3">
                <label for="logo" class="formFile">Upload logo of company</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
