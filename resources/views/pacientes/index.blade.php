@extends('layouts.app')

@section('content')
<header class="flex items-center justify-between p-1">
    <h1 class="text-4xl font-bold text-gray-800">Pacientes</h1>
    <a 
        href="{{ route('pacientes.create') }}" 
        title="Cadastrar" 
        class="h-fit px-2 py-1 border rounded shadow  
            text-stone-50 font-semibold 
            bg-gray-800 border-gray-800 
            hover:bg-gray-700 hover:border-gray-700 
            active:bg-gray-900 active:border-gray-900 
            ease-in-out duration-200"
    ><i class="bi bi-plus text-2xl"></i></a>
</header>
<main class="container max-w-360 mx-auto p-1">
    <div class="w-full border border-stone-50 rounded shadow">
        <table class="w-full">
            <thead class="bg-gray-800 text-stone-50 shadow-xs">
                <tr class="*:not-first:not-last:border-x 
                    *:not-first:not-last:border-stone-200 *:py-1 *:px-3 
                    *:text-start *:text-xs *:cursor-default"
                >
                    <th>#</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Data de nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="*:border-t *:border-stone-200 *:hover:bg-gray-100 
                **:py-1 **:px-3 *:hover:text-gray-800 text-gray-700 cursor-default"
            >
                @forelse ($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->id }}</td>
                    <td>{{ $paciente->nome }}</td>
                    <td>{{ $paciente->cpf }}</td>
                    <td>{{ $paciente->telefone }}</td>
                    <td>{{ $paciente->email }}</td>
                    <td>{{ $paciente->data_nascimento }}</td>
                    <td>aqui vão as ações</td>
                </tr>
                @empty
                <tr>
                    <td 
                        colspan="7" 
                        class="text-center text-xs"
                    >Nenhuma informação</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-1 pt-4 border-t border-stone-200">{{ $pacientes->links() }}</div>
    </div>
</main>
@endsection