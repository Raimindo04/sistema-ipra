<div>
<div class="p-6 bg-white rounded-2xl shadow-lg border border-gray-100">
    <!-- Cabeçalho: Filtros e Controles -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
        <div class="flex items-center gap-3 w-full sm:w-1/3">
            <input
                type="text"
                wire:model.live="search"
                placeholder="🔍 Pesquisar por nome, NUIT, contacto..."
                class="flex-1 border-gray-300 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
            />
        </div>

        <div class="flex items-center gap-3">

            <!-- Botão Novo Contribuinte -->
            @can('create', IpraForm::class)
                <a href="{{ route('contribuintes.create') }}"
                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-xl shadow-md transition-all duration-200 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4v16m8-8H4"/>
                    </svg>
                    Novo Imovel
                </a>
            @endcan
            <!-- Botão Exportar Excel -->
            @can('excelExport', IpraForm::class)
            <a href="{{ route('ipraforms.export') }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                ⬇️ Baixar Excel
            </a>
            @endcan
            <!-- Selecionar quantidade por página -->
            <select wire:model="perPage" class="border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-green-500">
                <option value="5">5 por página</option>
                <option value="10">10 por página</option>
                <option value="25">25 por página</option>
            </select>
        </div>
    </div>

    <!-- Tabela -->
    <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-sm">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gradient-to-r from-green-100 to-green-200 text-green-900 font-semibold">
                <tr>
                    @php
                        $headers = [
                            'ps_nome' => 'Nome',
                            'ps_apelido' => 'Apelido',
                            'pj_nome_empresa' => 'Empresa',
                            'pj_representante' => 'Representante',
                            'nuit' => 'NUIT',
                            'telefone' => 'Telefone',
                        ];
                    @endphp

                    @foreach($headers as $field => $label)
                        <th class="px-4 py-3 cursor-pointer whitespace-nowrap" wire:click="sortBy('{{ $field }}')">
                            <div class="flex items-center gap-1">
                                <span>{{ $label }}</span>
                                @if($sortField === $field)
                                    <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                                @endif
                            </div>
                        </th>
                    @endforeach

                    <th class="px-4 py-3 whitespace-nowrap">Pluscode</th>
                    <th class="px-4 py-3 cursor-pointer whitespace-nowrap" wire:click="sortBy('created_at')">
                        <div class="flex items-center gap-1">
                            <span>Criado Em</span>
                            @if($sortField === 'created_at')
                                <span class="text-xs">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                            @endif
                        </div>
                    </th>
                    <th class="px-4 py-3 text-center whitespace-nowrap">Ações</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($contribuintes as $contribuinte)
                    <tr class="hover:bg-green-50 transition-colors">
                        <td class="px-4 py-2 font-medium">{{ $contribuinte->ps_nome }}</td>
                        <td class="px-4 py-2">{{ $contribuinte->ps_apelido }}</td>
                        <td class="px-4 py-2">{{ $contribuinte->pj_nome_empresa }}</td>
                        <td class="px-4 py-2">{{ $contribuinte->pj_representante }}</td>
                        <td class="px-4 py-2">{{ $contribuinte->nuit }}</td>
                        <td class="px-4 py-2">{{ $contribuinte->telefone }}</td>
                        <td class="px-4 py-2">{{ $contribuinte->pluscode }}</td>
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($contribuinte->created_at)->locale('pt-BR')->translatedFormat('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-2 text-center flex items-center justify-center gap-3">
                            @can('view', $contribuinte)
                                <a href="{{ route('contribuintes.show', $contribuinte->id) }}"
                                class="text-blue-600 hover:text-blue-800" title="Ver">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            @endcan

                            @can('history', $contribuinte)
                                <a href="{{ route('contribuintes.history', $contribuinte->id) }}"
                                class="text-blue-600 hover:text-blue-800" title="Histórico">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </a>
                            @endcan

                            @can('update', $contribuinte)
                            <a href="{{ route('contribuintes.edit', $contribuinte->id) }}"
                            class="text-blue-600 hover:text-blue-800" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5l3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                            </a>
                            @endcan

                            @can('print', $contribuinte)
                            <a href="{{ route('contribuintes.resumoPDF', $contribuinte->id) }}"
                                class="text-blue-600 hover:text-blue-800" title="PDF" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2m-1 4h-8m8 4h-8M5 7h14v14H5z" />
                                </svg>
                            </a>
                            @endcan

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="p-6 text-center text-gray-500 italic">
                            Nenhum Imovel encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="mt-4">
        {{ $contribuintes->links() }}
    </div>
</div>
</div>
