@extends('super.dashboard')

@section('describe1')



    <section>

        <div class="container">
            <section style="padding-top:60px">

                <div class="card-head px-3">

                    <div class="card-head">
                        @if(Session::has('hour_update'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('hour_update')}}
                            </div>
                        @endif

                        @if(Session::has('alert'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('alert')}}
                            </div>
                        @endif
                            <h1>You are editing your staff hour</h1>
                            <hr>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">

                            <form method="post" action="{{route('day.update')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$date->id}}"/>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Data</label>
                                    <h2>{{$date->date}}</h2>
                                    <label for="exampleInputEmail1" class="form-label">Hour</label>
                                    <h2>{{$date->hour}}</h2>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">New hour</label>
                                    <input type="number" name="Hour" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Hour</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection

