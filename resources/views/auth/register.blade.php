@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8 px-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            {{ __('Register') }}
        </h2>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-1">
                    {{ __('Name') }}
                </label>
                <input id="name" type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required autocomplete="name" autofocus
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 @error('name') border-red-500 @enderror">

                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- Roles (Select Box) --}}
            <div class="mb-6">
                <label for="role" class="block text-gray-700 font-medium mb-2">
                    {{ __('Select Role') }}
                </label>

                <select id="role" name="role_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:ring focus:ring-blue-200 focus:border-blue-500 @error('role_id') border-red-500 @enderror"
                    required>
                    <option value="">-- Selecione um perfil --</option>

                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">
                    {{ __('Email Address') }}
                </label>
                <input id="email" type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required autocomplete="email"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 @error('email') border-red-500 @enderror">

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">
                    {{ __('Password') }}
                </label>
                <input id="password" type="password"
                    name="password"
                    required autocomplete="new-password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 @error('password') border-red-500 @enderror">

                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label for="password-confirm" class="block text-gray-700 font-medium mb-1">
                    {{ __('Confirm Password') }}
                </label>
                <input id="password-confirm" type="password"
                    name="password_confirmation"
                    required autocomplete="new-password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500">
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
