@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8 px-4">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">
            {{ __('Verifique seu Endereço de Email') }}
        </h2>

        {{-- Success message --}}
        @if (session('resent'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 text-sm border border-green-300">
                {{ __('Um novo link de verificação foi enviado para o seu endereço de email.') }}
            </div>
        @endif

        <p class="text-gray-700 mb-4 leading-relaxed">
            {{ __('Antes de continuar, verifique seu email para um link de verificação.') }}
        </p>

        <p class="text-gray-700 mb-6 leading-relaxed">
            {{ __('Se você não recebeu o email') }},
        </p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                {{ __('Clique aqui para solicitar outro') }}
            </button>
        </form>

    </div>
</div>
@endsection
