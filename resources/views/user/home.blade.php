@extends('dashboard')

@section('nav')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Add Hour') }}
        </x-jet-nav-link>
    </div>
@endsection
