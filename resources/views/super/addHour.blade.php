
@extends('super.dashboard')

@section('describe1')
    <section>
        <div class="container">
            <section style="padding-top:60px">

                <div class="card-head px-3">
                    @if(Session::has('date_added'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('date_added')}}
                        </div>
                    @endif

                    @if(Session::has('date_duplicate'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('date_duplicate')}}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <h4>{{$errors->first()}}</h4>
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

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                            <label class="form-check-label" for="flexCheckIndeterminate" name="ferie">
                                Ferie
                            </label>
                        </div>

                        <div class="form-check">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>

            </section>

        </div>
    </section>
@endsection

