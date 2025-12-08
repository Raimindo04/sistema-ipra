

@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
     <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg border border-gray-200 rounded-2xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center justify-center gap-2">
                    <i class="bi bi-shield-shaded text-gray-600"></i>
                    Detalhes do Perfil
                </h3>
            </div>

            {{-- Body --}}
            <div class="p-8">

                <ul class="divide-y divide-gray-200">

                    {{-- Nome --}}
                    <li class="py-4 flex items-start gap-3">
                        <i class="bi bi-shield-shaded text-green-600 text-3xl"></i>
                        <div>
                            <p class="font-semibold text-gray-700">Nome:</p>
                            <p class="text-lg font-bold">{{ $role->name }}</p>
                        </div>
                    </li>

                    {{-- Descrição --}}
                    <li class="py-4 flex items-start gap-3">
                        <i class="bi bi-justify-left text-blue-500 text-3xl"></i>
                        <div>
                            <p class="font-semibold text-gray-700">Descrição:</p>
                            <p class="text-gray-600">{{ $role->description ?? 'Sem descrição' }}</p>
                        </div>
                    </li>

                    {{-- Ativo --}}
                    <li class="py-4 flex items-start gap-3">
                        <i class="bi bi-toggle-on text-indigo-500 text-3xl"></i>
                        <div>
                            <p class="font-semibold text-gray-700">Activo:</p>
                            <p class="font-semibold {{ $role->active == 'true' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $role->active == 'true' ? 'Activo' : 'Desactivado' }}
                            </p>
                        </div>
                    </li>

                    {{-- Criado --}}
                    <li class="py-4 flex items-start gap-3">
                        <i class="bi bi-calendar text-yellow-500 text-3xl"></i>
                        <div>
                            <p class="font-semibold text-gray-700">Criado em:</p>
                            <p class="text-gray-600">
                                {{ \Carbon\Carbon::parse($role->created_at)->locale('pt-BR')->translatedFormat('d \d\e F \d\e Y \à\s H:i:s') }}
                            </p>
                        </div>
                    </li>

                    {{-- Atualizado --}}
                    <li class="py-4 flex items-start gap-3">
                        <i class="bi bi-arrow-repeat text-red-500 text-3xl"></i>
                        <div>
                            <p class="font-semibold text-gray-700">Atualizado em:</p>
                            <p class="text-gray-600">
                                {{ \Carbon\Carbon::parse($role->updated_at)->locale('pt-BR')->translatedFormat('d \d\e F \d\e Y \à\s H:i:s') }}
                            </p>
                        </div>
                    </li>

                </ul>

                {{-- Buttons --}}
                <div class="flex justify-between mt-8">

                    @can('viewAny', \App\Models\Role::class)
                    <a href="{{ route('roles.index') }}"
                       class="px-5 py-2.5 rounded-xl border border-gray-400 text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                    @endcan

                    @can('update', $role)
                    <a href="{{ route('roles.edit', $role->id) }}"
                       class="px-5 py-2.5 rounded-xl border border-yellow-500 text-yellow-600 hover:bg-yellow-50 flex items-center gap-2">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>
                    @endcan

                    @can('delete', $role)
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                          onsubmit="return confirm('Tem certeza que deseja excluir esta função?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl border border-red-500 text-red-600 hover:bg-red-50 flex items-center gap-2">
                            <i class="bi bi-trash3-fill"></i> Excluir
                        </button>
                    </form>
                    @endcan

                </div>

            </div>
        </div>
     </div>
</div>
@endsection
