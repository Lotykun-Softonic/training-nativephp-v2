@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots dark:bg-gray-900 selection:bg-indigo-500 selection:text-white">
        <div>
            @if(isset($user->name))
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">User {{ $user->name }}</h2>
            @else
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Create New User</h2>
            @endif
            <br>
            <livewire:user-form :user="$user" />
            <br>
            <div class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                <a href="{{ route('home') }}">Back to Home</a>
            </div>
        </div>
    </div>
@endsection
