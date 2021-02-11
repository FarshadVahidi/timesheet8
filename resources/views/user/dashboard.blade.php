@extends('dashboard')

@section('nav')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('Myhours') }}" :active="request()->routeIs('Myhours')">
            {{ __('All Hour') }}
        </x-jet-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('add') }}" :active="request()->routeIs('add')">
            {{ __('Add Hour') }}
        </x-jet-nav-link>
    </div>
@endsection

@if(Session::has('hasNotPermission'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('hasNotPermission')}}
    </div>
@endif

@if(Session::has('alert_deleted'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('alert_deleted')}}
    </div>
@endif

