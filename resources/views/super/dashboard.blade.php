@extends('dashboard')

@section('nav')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
            {{ __('Add New Person') }}
        </x-jet-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('Myhours') }}" :active="request()->routeIs('Myhours')">
            {{ __('All My Hour') }}
        </x-jet-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('add') }}" :active="request()->routeIs('add')">
            {{ __('Add Hour') }}
        </x-jet-nav-link>
    </div>

@endsection
