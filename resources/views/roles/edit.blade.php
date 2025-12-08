@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    {{-- Main form --}}
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg border border-gray-200 rounded-2xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center justify-center gap-2">
                    <i class="bi bi-shield-shaded text-gray-600"></i>
                    Editar Perfil "{{ $role->name }}"
                </h3>
            </div>

            {{-- Body --}}
            <div class="p-8">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nome do perfil --}}

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2"><span class="text-red-500">*</span>Nome do Perfil</label>
                        <input type="text" name="name" class="w-full rounded-lg border p-2 @error('name') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('name', $role->name) }}" />
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
                        >{{ old('description', $role->description) }}</textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Switch Activo --}}
                    <div class="flex items-center mb-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox"
                                   name="active"
                                   id="activeSwitch"
                                   class="sr-only peer"
                                   {{ $role->active == 'true' ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-300 peer-focus:ring-2 peer-focus:ring-blue-500 rounded-full peer
                                        peer-checked:bg-blue-600 transition-all"></div>
                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-all peer-checked:translate-x-5"></div>
                        </label>

                        <span id="switchLabel" class="ml-3 text-sm font-medium text-gray-700">
                            {{ $role->active == 'true' ? 'Activo' : 'Desativado' }}
                        </span>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-between mt-8">

                        @can('view', $role)
                        <a href="{{ route('roles.show', $role->id) }}"
                           class="px-5 py-2.5 rounded-xl border border-gray-400 text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                        @endcan

                        @can('sync', $role)
                        <a href="{{ route('roles.sync', $role->id) }}"
                           class="px-5 py-2.5 rounded-xl border border-yellow-500 text-yellow-600 hover:bg-yellow-50 flex items-center gap-2">
                            <i class="bi bi-ui-checks"></i> Permissões
                        </a>
                        @endcan

                        @can('update', $role)
                        <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 flex items-center gap-2">
                            <i class="bi bi-floppy"></i> Salvar
                        </button>
                        @endcan

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const checkbox = document.getElementById("activeSwitch");
        const label = document.getElementById("switchLabel");

        checkbox.addEventListener("change", () => {
            label.textContent = checkbox.checked ? "Activo" : "Desativado";
        });
    });
</script>
