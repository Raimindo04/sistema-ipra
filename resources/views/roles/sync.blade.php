@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <div class="bg-white shadow-xl border border-gray-200 rounded-2xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-6 text-center border-b">
            <h3 class="text-2xl font-bold text-gray-800 flex items-center justify-center gap-2">
                <i class="bi bi-shield-lock text-blue-600"></i>
                Permissões do Perfil — {{ $role->name }}
            </h3>
            <p class="text-gray-500 text-sm mt-1">Gerencie as permissões atribuídas a este perfil</p>
        </div>

        <!-- Filtros -->
        <div class="p-6">
            <form id="formPermission"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('roles.save.sync', $role->id) }}">
                @csrf

                <div class="grid md:grid-cols-3 gap-4 mb-6">

                    <!-- Search Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" id="searchName"
                               placeholder="Pesquisar por nome"
                               class="mt-1 w-full px-3 py-2 border rounded-lg shadow-sm
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Search Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <input type="text" id="searchDescription"
                               placeholder="Pesquisar por descrição"
                               class="mt-1 w-full px-3 py-2 border rounded-lg shadow-sm
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-end gap-2">

                        <button type="button" id="applyFilters"
                                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg shadow
                                       hover:bg-blue-700 transition">
                            <i class="bi bi-search"></i> Aplicar
                        </button>

                        <button type="button" id="clearFilters"
                                class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-lg shadow
                                       hover:bg-gray-600 transition">
                            <i class="bi bi-x-circle"></i> Limpar
                        </button>

                        @can('sync', $role)
                        <button type="submit"
                                class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg shadow
                                       hover:bg-green-700 transition">
                            <i class="bi bi-arrow-repeat"></i> Sincronizar
                        </button>
                        @endcan
                    </div>

                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-xl border">
                    <table id="permissionsTable" class="min-w-full text-left border-collapse">

                        <thead class="bg-gray-100 border-b">
                            <tr class="text-sm font-semibold text-gray-700 uppercase">
                                <th class="px-4 py-3 w-20">#</th>
                                <th class="px-4 py-3 w-16 text-center">
                                    <input type="checkbox" id="selectAll"
                                        class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                </th>
                                <th class="px-4 py-3 w-1/4">Nome</th>
                                <th class="px-4 py-3 w-2/4">Descrição</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @foreach ($permissions as $permission)
                                @php
                                    $checked = in_array($permission->id, $role->permissions->pluck('id')->toArray());
                                @endphp

                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-semibold text-gray-700">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <input type="checkbox"
                                               name="permission_id[]"
                                               value="{{ $permission->id }}"
                                               {{ $checked ? 'checked' : '' }}
                                               class="h-5 w-5 text-blue-600 border-gray-300 rounded
                                                      focus:ring-blue-500 transition">
                                    </td>

                                    <td class="px-4 py-3 font-medium text-gray-700">
                                        {{ $permission->name }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $permission->description }}
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot class="bg-gray-100 border-t">
                            <tr class="text-sm font-semibold text-gray-600">
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3"></th>
                                <th class="px-4 py-3">Nome</th>
                                <th class="px-4 py-3">Descrição</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>

            </form>

        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="permission_id[]"]');

        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
        });
    });
</script>
@endsection

