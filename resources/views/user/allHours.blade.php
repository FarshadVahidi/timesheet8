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
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Hours</th>
                        <th scope="col">Added</th>
                        <th scope="col">Last Update</th>
                        <th scope="col" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allMyHours as $hour)
                        <tr>
                            <td>{{$hour->date}}</td>
                            <td>{{$hour->hour}}</td>
                            <td>{{$hour->created_at}}</td>
                            <td>{{$hour->updated_at}}</td>
                            <td><a href="/hour-update/{{$hour->date}}" class="btn btn-info">update</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
