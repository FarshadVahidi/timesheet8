@extends('super.dashboard')

@section('describe1')

    <section style="padding-top:60px">
        <div class="container">
            <div class="card-head">
                @if(Session::has('user_added'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('user_added')}}
                    </div>
                @endif
            </div>

        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/addNewPerson" method="POST" class="pb-5">

                        <div class="py-3">
                            <legend>You can add new person</legend>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="name">
                            {{ $errors->first('name') }}
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="email">
                            {{ $errors->first('email') }}
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            {{ $errors->first('password') }}
                        </div>

                        <div class="mb-3">
                            <select class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="role_id">
                                <option class="disabled">Select Role</option>
                                <option value="user">User</option>
                                <option value="administrator">Administrator</option>
                                <option value="superadministrator">Super Administrator</option>

                            </select>
                            {{ $errors->first('role_id') }}
                        </div>

                        @csrf

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection
