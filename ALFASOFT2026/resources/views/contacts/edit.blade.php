@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-4">Editar Contato</h1>
    <div class="bg-white shadow rounded p-6">
        <form method="POST"
              action="{{ route('contacts.update', $contact) }}"
              class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-medium">Código do País</label>
                <input type="text"
                       name="country_code"
                       value="{{ old('country_code', $contact->country_code) }}"
                       class="border rounded px-3 py-2 w-full">
            </div>
            <div>
                <label class="block font-medium">Número</label>
                <input type="text"
                       name="number"
                       value="{{ old('number', $contact->number) }}"
                       class="border rounded px-3 py-2 w-full">
            </div>
            <div class="flex gap-4">
                <button class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                    Atualizar
                </button>
                <a href="{{ route('people.show', $contact->person) }}"
                   class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
