@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-semibold mb-4">Detalhes da Pessoa</h1>
        <div class="mb-6">
            <p><strong>Nome:</strong> {{ $person->name }}</p>
            <p><strong>Email:</strong> {{ $person->email }}</p>
        </div>
        @auth
        <div class="flex gap-2 mb-6">
            <a href="{{ route('people.edit', $person) }}"
               class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                Editar Pessoa
            </a>
            <form method="POST"
                  action="{{ route('people.destroy', $person) }}"
                  onsubmit="return confirm('Confirma exclusão?')">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Excluir Pessoa
                </button>
            </form>
        </div>
        @endauth
        <div class="mt-8">
            <div class="flex items-center gap-4 mb-4">
                <h2 class="text-xl font-semibold mb-0">Contatos</h2>
                @auth
                <a href="{{ route('people.contacts.create', $person) }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Novo Contato
                </a>
                @endauth
            </div>
            @if($person->contacts->isEmpty())
                <p class="text-gray-500">Nenhum contato cadastrado.</p>
            @else
                <div class="bg-white shadow rounded">
                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">País</th>
                                <th class="px-4 py-2 text-left">Número</th>
                                <th class="px-4 py-2 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($person->contacts as $contact)
                                <tr class="border-t">
                                    <td class="px-4 py-2">
                                        +{{ $contact->country_code }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $contact->number }}
                                    </td>
                                    <td class="px-4 py-2 flex gap-2">
                                        <a href="{{ route('contacts.show', $contact) }}"
                                           class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                            Ver
                                        </a>
                                        @auth
                                        <a href="{{ route('contacts.edit', $contact) }}"
                                           class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600">
                                            Editar
                                        </a>
                                        <form method="POST"
                                              action="{{ route('contacts.destroy', $contact) }}"
                                              onsubmit="return confirm('Excluir contato?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                Excluir
                                            </button>
                                        </form>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="mt-6">
            <a href="{{ route('people.index') }}"
               class="text-blue-600 hover:underline">
                ← Voltar para Pessoas
            </a>
        </div>

    </div>
</div>
@endsection


