@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-4">Detalhes do Contato</h1>
    <div class="bg-white shadow rounded p-6 mb-6">
        <p><strong>Pessoa:</strong>
            <a href="{{ route('people.show', $contact->person) }}" class="text-blue-600 hover:underline">
                {{ $contact->person->name }}
            </a>
        </p>
        <p><strong>Código do País:</strong> {{ $contact->country_code }}</p>
        <p><strong>Número:</strong> {{ $contact->number }}</p>
    </div>

    @auth
    <div class="flex gap-2 mb-6">
        <a href="{{ route('contacts.edit', $contact) }}" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Editar</a>
        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Confirma exclusão?')">
            @csrf
            @method('DELETE')
            <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Excluir</button>
        </form>
    </div>
    @endauth

    <a href="{{ route('people.show', $contact->person) }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Voltar</a>
</div>
@endsection
