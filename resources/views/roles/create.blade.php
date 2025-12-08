@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-6 text-center">
            <h3 class="text-xl font-semibold text-gray-700 flex items-center justify-center gap-2">
                <i class="bi bi-shield-shaded text-gray-600"></i>
                Criar Perfil
            </h3>
        </div>

        {{-- Body --}}
        <div class="p-8">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                {{-- Nome do perfil --}}

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2"><span class="text-red-500">*</span>Nome do Perfil</label>
                    <input type="text" name="name" class="w-full rounded-lg border p-2 @error('name') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('name') }}" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Descrição --}}
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Descrição
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="w-full rounded-lg border p-2 @error('description') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botão --}}
                @can('create', App\Models\Role::class)
                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow transition-colors flex items-center gap-2"
                    >
                        <i class="bi bi-plus"></i>
                        Criar Perfil
                    </button>
                @endcan

            </form>
        </div>
    </div>
</div>
@endsection
