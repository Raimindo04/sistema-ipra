@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10">

    <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 flex items-center justify-center gap-2">
                <i class="bi bi-shield-shaded text-blue-700"></i>
                Gestão de Perfis (Roles)
            </h3>
        </div>

        <!-- Content -->
        <div class="p-8 space-y-6">

            <!-- Filtros -->
            <div class="grid md:grid-cols-3 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Perfil</label>
                    <input type="text" id="searchName"
                           class="w-full px-4 py-2.5 rounded-xl border-gray-300 shadow-sm
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Pesquisar por nome">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Descrição</label>
                    <input type="text" id="searchDescription"
                           class="w-full px-4 py-2.5 rounded-xl border-gray-300 shadow-sm
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Pesquisar por descrição">
                </div>

                <div class="flex items-end space-x-3">

                    <button id="applyFilters"
                            class="px-4 py-2.5 bg-blue-600 text-white text-sm rounded-xl shadow
                                   hover:bg-blue-700 transition flex items-center gap-1">
                        <i class="bi bi-search"></i> Aplicar
                    </button>

                    <button id="clearFilters"
                            class="px-4 py-2.5 bg-gray-500 text-white text-sm rounded-xl shadow
                                   hover:bg-gray-600 transition flex items-center gap-1">
                        <i class="bi bi-x-circle"></i> Limpar
                    </button>

                    @can('create', App\Models\Role::class)
                        <a href="{{ route('roles.create') }}"
                           class="px-4 py-2.5 bg-green-600 text-white text-sm rounded-xl shadow
                                  hover:bg-green-700 transition flex items-center gap-1">
                            <i class="bi bi-plus-circle"></i> Novo Perfil
                        </a>
                    @endcan

                </div>
            </div>

            <!-- Tabela -->
            <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">

                <table id="rolesTable" class="min-w-full bg-white">

                    <thead class="bg-gray-50 border-b">
                        <tr class="text-gray-700 uppercase text-xs">
                            <th class="px-4 py-3 font-semibold">ID</th>
                            <th class="px-4 py-3 font-semibold">Nome</th>
                            <th class="px-4 py-3 font-semibold">Descrição</th>
                            <th class="px-4 py-3 font-semibold text-center">Status</th>
                            <th class="px-4 py-3 font-semibold text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 text-sm">
                        @foreach ($roles as $role)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="px-4 py-3 font-medium text-gray-800">{{ $loop->iteration }}</td>

                            <td class="px-4 py-3 font-semibold text-gray-700">
                                {{ $role->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $role->description }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if ($role->active == 'true')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        Activo
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                        Desativado
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">

                                    @can('update', $role)
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="px-3 py-2 bg-green-600 text-white rounded-lg text-xs shadow
                                                  hover:bg-green-700 transition flex items-center gap-1">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                    @endcan

                                    @can('sync', $role)
                                        <a href="{{ route('roles.sync', $role->id) }}"
                                           class="px-3 py-2 bg-blue-600 text-white rounded-lg text-xs shadow
                                                  hover:bg-blue-700 transition flex items-center gap-1">
                                            <i class="bi bi-arrow-repeat"></i> Sync
                                        </a>
                                    @endcan

                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="bg-gray-50 border-t text-xs text-gray-700">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nome</th>
                            <th class="px-4 py-3">Descrição</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Ações</th>
                        </tr>
                    </tfoot>

                </table>

            </div>

        </div>
    </div>

</div>
@endsection
