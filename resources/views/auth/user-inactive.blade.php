@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
     <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg border border-gray-200 rounded-2xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-red-100 to-red-200 p-6 text-center">
                <h3 class="text-xl font-semibold text-red-700 flex items-center justify-center gap-2">
                    <i class="bi bi-exclamation-octagon-fill text-red-600"></i>
                    Conta Inativa
                </h3>
            </div>

            {{-- Body --}}
            <div class="p-8">

                <div class="text-center space-y-6">

                    {{-- Ícone grande --}}
                    <div class="flex justify-center">
                        <i class="bi bi-person-x-fill text-red-500 text-7xl"></i>
                    </div>

                    {{-- Mensagem principal --}}
                    <h2 class="text-2xl font-bold text-gray-800">
                        A sua conta está desativada
                    </h2>

                    {{-- Texto --}}
                    <p class="text-gray-600 text-lg max-w-lg mx-auto">
                        Para continuar a usar o sistema, por favor
                        <span class="font-semibold text-red-600">contacte o administrador</span>
                        para reativar o seu acesso.
                    </p>

                    {{-- Botão para login --}}
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition shadow-md">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Voltar ao Login
                    </a>
                </div>

            </div>
        </div>
     </div>
</div>
@endsection
