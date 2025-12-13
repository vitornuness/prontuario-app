@extends('layouts.app')

@section('content')
<header class="flex items-center p-1">
    <a
        href="{{ route('pacientes.index') }}" 
        title="Voltar" 
        class="h-fit py-2 ps-2 pe-3 me-2 border rounded shadow flex items-center
        text-gray-800 font-semibold 
        bg-gray-100 border-gray-100 
        hover:bg-gray-50 hover:border-gray-50 
        active:bg-gray-200 active:border-gray-200 
        ease-in-out duration-200"
    >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
    </a>
    <h1 class="text-4xl font-bold text-gray-800">Cadastro de paciente</h1>
</header>
<main class="container max-w-360 mx-auto p-1">
    <div class="px-4 py-2 shadow rounded mt-20 mx-auto max-w-2xl">
        <form 
            method="post" 
            action={{ route('pacientes.store') }} 
            onsubmit="document.querySelectorAll(
                    'button[type=\'submit\'], input[type=\'submit\']'
                ).forEach(el => {
                    el.disabled = true;
                })"
        >
            @csrf
            <div class="flex flex-col gap-4">
                {{-- NOME --}}
                 <div class="flex flex-col">
                    <label
                        for="nome"
                        class="text-xs font-semibold text-gray-800"
                    >Nome</label>
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="border rounded p-1 border-gray-800 
                            @error('nome') border-2 border-red-500 @enderror" 
                        value="{{ old('nome') }}" 
                    />
                    @error('nome')
                    <div class="my-1 text-red-500 text-xs">
                        {{ $message }}
                    </div>
                    @enderror
                 </div>
                <div class="flex gap-2">
                    {{-- DATA DE NASCIMENTO --}}
                     <div class="flex-1 basis-0 flex flex-col">
                        <label
                            for="data_nascimento"
                            class="text-xs font-semibold text-gray-800"
                        >Data de nascimento</label>
                        <input
                            type="date"
                            id="data_nascimento"
                            name="data_nascimento"
                            class="border rounded p-1 border-gray-800 
                                @error('data_nascimento') border-2 border-red-500 @enderror" 
                            value="{{ old('data_nascimento') ?? today()->format('Y-01-01') }}"
                        />
                        @error('data_nascimento')
                        <div class="my-1 text-red-500 text-xs">
                            {{ $message }}
                        </div>
                        @enderror
                     </div>
                    {{-- CPF --}}
                     <div class="flex-1 basis-0 flex flex-col">
                        <label
                            for="cpf"
                            class="text-xs font-semibold text-gray-800"
                        >CPF</label>
                        <input
                            type="number"
                            id="cpf"
                            name="cpf"
                            class="border rounded p-1 border-gray-800
                                @error('cpf') border-2 border-red-500 @enderror" 
                            value="{{ old('cpf') }}"
                        />
                        @error('cpf')
                        <div class="my-1 text-red-500 text-xs">
                            {{ $message }}
                        </div>
                        @enderror
                     </div>
                </div>
                <div class="flex gap-2">
                    {{-- TELEFONE --}}
                     <div class="flex-1 basis-0 flex flex-col">
                        <label
                            for="telefone"
                            class="text-xs font-semibold text-gray-800"
                        >Telefone</label>
                        <input
                            type="number"
                            id="telefone"
                            name="telefone"
                            class="border rounded p-1 border-gray-800
                                @error('telefone') border-2 border-red-500 @enderror" 
                            value="{{ old('telefone') }}"
                        />
                        @error('telefone')
                        <div class="my-1 text-red-500 text-xs">
                            {{ $message }}
                        </div>
                        @enderror
                     </div>
                    {{-- E-MAIL --}}
                     <div class="flex-1 basis-0 flex flex-col">
                        <label
                            for="email"
                            class="text-xs font-semibold text-gray-800"
                        >E-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="border rounded p-1 border-gray-800
                                @error('email') border-2 border-red-500 @enderror" 
                            value="{{ old('email') }}"
                        />
                        @error('email')
                        <div class="my-1 text-red-500 text-xs">
                            {{ $message }}
                        </div>
                        @enderror
                     </div>
                </div>
            </div>
            <div class="mt-4 flex flex-row-reverse">
                <button 
                    type="submit"
                    class="cursor-pointer h-fit px-4 py-1 border rounded shadow  
                        text-stone-50 font-semibold 
                        bg-gray-800 border-gray-800 
                        hover:bg-gray-700 hover:border-gray-700 
                        active:bg-gray-900 active:border-gray-900 
                        disabled:bg-gray-500 disabled:border-gray-500 
                        disabled:cursor-wait
                        ease-in-out duration-200" 
                >Salvar</button>
            </div>
        </form>
    </div>
</main>
@endsection