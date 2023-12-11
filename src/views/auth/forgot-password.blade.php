@extends('layouts.base')
@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        @include('components.simple.form_head', ['header' => 'Reset password'])
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" hx-post="{{ route('password.email') }}" hx-target="body">

                @csrf
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                @include('components.basic.email', ['name' => 'email', 'label' => 'Email address', 'autocomplete' => 'email'])
                @if (session('status'))
                    <div class="mb-4 text-green-400">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <button type="submit" hx-indicator="dots" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Email Password Reset Link</button>
                </div>
            </form>
        </div>
    </div>
@endsection
