@extends('dashboard')

@section('nav')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
            {{ __('Add New Person') }}
        </x-jet-nav-link>
    </div>
@endsection
