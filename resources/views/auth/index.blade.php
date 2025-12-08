@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10">
 <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
    <!-- Header -->

    <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 flex items-center justify-center gap-2">
                <i class="bi bi-shield-shaded text-blue-700"></i>
                 Gestão de Usuários
            </h3>
    </div>

    <!-- Content -->
    <div class="p-8 space-y-6">
        <!-- Filtros -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="flex items-end space-x-3">
                @can('manageUsers', App\Models\User::class)
                    <a href="{{ route('users.create') }}"
                        class="px-4 py-2.5 bg-green-600 text-white text-sm rounded-xl shadow
                                hover:bg-green-700 transition flex items-center gap-1">
                        <i class="bi bi-plus-circle"></i> Novo Usuario
                    </a>
                @endcan

            </div>
        </div>
        <!-- Table Container -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">

            <table class="min-w-full border-collapse bg-white">

                <!-- Cabeçalho -->
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="uppercase text-xs text-gray-600 tracking-wider">
                        <th class="px-6 py-4 text-left">ID</th>
                        <th class="px-6 py-4 text-left">Usuário</th>
                        <th class="px-6 py-4 text-left">Perfil</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Ações</th>
                    </tr>
                </thead>

                <!-- Corpo -->
                <tbody class="text-gray-700 text-sm">

                    @foreach ($users as $user)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- ID -->
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $loop->iteration }}
                        </td>

                        <!-- Nome + Email -->
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900">{{ $user->name }}</span>
                                <span class="text-xs text-gray-500">{{ $user->email }}</span>
                            </div>
                        </td>

                        <!-- Role -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-semibold">
                                {{ $user->role->name }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">
                            @if ($user->active == 1)
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-semibold">
                                    Ativo
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full font-semibold">
                                    Inativo
                                </span>
                            @endif
                        </td>

                        <!-- Ações -->
                        <td class="px-6 py-4 text-center">

                            <div class="flex justify-center gap-3">

                                @can('manageUsers', $user)
                                    <a href="{{ route('users.edit', $user->id) }}"
                                    class="px-4 py-2 bg-blue-600 text-white text-xs rounded-lg shadow hover:bg-blue-700 transition flex items-center gap-1">
                                        <i class="bi bi-pencil"></i>
                                        Editar
                                    </a>
                                @endcan

                                @can('delete', $user)
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja eliminar este usuário?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white text-xs rounded-lg shadow hover:bg-red-700 transition flex items-center gap-1">
                                            <i class="bi bi-trash"></i>
                                            Apagar
                                        </button>
                                    </form>
                                @endcan

                            </div>

                        </td>

                    </tr>
                    @endforeach

                </tbody>

                <!-- Rodapé -->
                <tfoot class="bg-gray-50 border-t border-gray-200 text-xs text-gray-600 uppercase">
                    <tr>
                        <td class="px-6 py-3">ID</td>
                        <td class="px-6 py-3">Usuário</td>
                        <td class="px-6 py-3">Perfil</td>
                        <td class="px-6 py-3">Status</td>
                        <td class="px-6 py-3 text-center">Ações</td>
                    </tr>
                </tfoot>

            </table>

        </div>
    </div>
 </div>
</div>
@endsection
