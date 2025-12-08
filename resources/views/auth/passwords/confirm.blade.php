@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8 px-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">
            {{ __('Confirm Password') }}
        </h2>

        <p class="text-gray-600 mb-6 text-center">
            {{ __('Please confirm your password before continuing.') }}
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="block text-gray-700 font-medium mb-1">
                    {{ __('Password') }}
                </label>

                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 @error('password') border-red-500 @enderror">

                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                    {{ __('Confirm Password') }}
                </button>
            </div>

            {{-- Forgot password --}}
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}"
                       class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif

        </form>
    </div>
</div>
@endsection
