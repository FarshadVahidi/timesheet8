@extends('user.dashboard')

@section('describe1')
    <section>
        <div class="container">
            <div class="card-head">
                @if(Session::has('hour_update'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('hour_update')}}
                    </div>
                @endif

                @if(Session::has('hour_duplicate'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('date_added')}}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form method="POST" action="/createNewHour">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Date</label>
                        <input type="date" name="Date" class="form-control" id="exampleInputEmail1">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Hour</label>
                        <input type="number" name="Hour" class="form-control" id="exampleInputPassword1" placeholder="Must Be In Minute">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </section>
@endsection
