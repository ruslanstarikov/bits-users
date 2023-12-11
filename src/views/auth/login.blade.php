@extends('layouts.base')
@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    @include('vendor.user-registration.components.basic.form-head', ['header' => 'Sign in to your account'])
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" hx-post="{{ route('login') }}" hx-target="body">
            @csrf
            @include('vendor.user-registration.components.basic.email', ['name' => 'email', 'value' => old('email'),  'label' => 'Email address'])
            @include('vendor.user-registration.components.basic.password', ['name' => 'password', 'label' => 'Password', 'autocomplete' => 'current-password', 'forgot' => true])
            <div>
                <button type="submit" hx-indicator="dots" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Sign in</button>
            </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-400">
            Not a member?
            <a href="{{ route('register') }}" class="font-semibold leading-6 text-indigo-400 hover:text-indigo-300">Register now</a>
        </p>
    </div>
</div>
@endsection
