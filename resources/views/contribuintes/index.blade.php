@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Imoveis</h1>

    @livewire('contribuintes-table')
</div>
@endsection
