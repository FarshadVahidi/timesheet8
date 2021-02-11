@extends('super.dashboard')

@section('describe1')
    <div class="container">
        <div class="card-head">
            @if(Session::has('hour_deleted'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('hour_deleted')}}
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
                    <th scope="col">Edit</th>
                    <th scop="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $d)
                    <tr>
                        <td>{{$d->date}}</td>
                        <td>{{$d->hour}}</td>
                        <td>{{$d->created_at}}</td>
                        <td>{{$d->updated_at}}</td>
                        <td><a href="/hours-update/{{$d->id}}" class="btn btn-success">Edit</a></td>
                        <td><a href="/hours-delete/{{$d->id}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


    </div>
@endsection
