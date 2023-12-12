@extends('vendor.user-registration.layouts.base')
@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        @include('vendor.user-registration.components.basic.form-head', ['header' => 'Reset Password'])
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                @include('vendor.user-registration.components.basic.email', ['name' => 'email', 'value' => old('email', $request->email), 'label' => 'Email address', 'autocomplete' => 'email'])
                @include('vendor.user-registration.components.basic.password', ['name' => 'password', 'label' => 'Password', 'autocomplete' => ''])
                @include('vendor.user-registration.components.basic.password', ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'autocomplete' => ''])
                <div>
                    <button type="submit" hx-indicator="dots" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection
