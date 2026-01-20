@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">

    <h1 class="text-2xl font-semibold mb-6">Editar Pessoa</h1>

    <div class="bg-white shadow rounded p-6">

        <form method="POST" action="{{ route('people.update', $person) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium text-sm text-gray-700">Nome</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $person->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $person->email) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                    Atualizar
                </button>

                <a href="{{ route('people.index') }}"
                   class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancelar
                </a>
            </div>

        </form>


    @auth
    <div class="mt-6">
        <a href="{{ route('people.contacts.create', $person) }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Novo Contato
        </a>
    </div>
    @endauth

</div>
@endsection
