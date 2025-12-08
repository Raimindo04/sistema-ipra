@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">
        Histórico de Alterações — Formulário #{{ $ipraForm->id }}
    </h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Data</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Utilizador</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Campo</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Antes</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Depois</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($logs as $log)
                    @foreach ($log->getChangesAttribute() as $campo => $valores)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ $log->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ $log->user->name ?? 'Sistema' }}
                            </td>

                            <td class="px-4 py-2 text-sm text-gray-800 font-medium">
                                {{ $campo }}
                            </td>

                            <td class="px-4 py-2 text-sm text-red-600">
                                {{ $valores['old'] ?? '' }}
                            </td>

                            <td class="px-4 py-2 text-sm text-green-600">
                                {{ $valores['new'] ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Nenhuma alteração encontrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
