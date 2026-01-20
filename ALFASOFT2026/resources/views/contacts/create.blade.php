@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-4">Novo Contato</h1>
    <div class="bg-white shadow rounded p-6">
        <p class="mb-4">
            <strong>Pessoa:</strong> {{ $person->name }}
        </p>
        @auth
        <form method="POST" action="{{ route('people.contacts.store', $person) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Código do País</label>
                <select name="country_code" required class="border rounded px-3 py-2 w-full">
                    @foreach($countries as $country)
                        @foreach($country['codes'] as $code)
                            <option value="{{ $code }}">
                                {{ $country['name'] }} ({{ $code }})
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('country_code')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="block font-medium">Número</label>
                <input type="text" name="number" value="{{ old('number') }}"
                       class="border rounded px-3 py-2 w-full">
                @error('number')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex gap-4">
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Salvar
                </button>
                <a href="{{ route('people.show', $person) }}"
                   class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Voltar
                </a>
            </div>
        </form>
        @endauth
    </div>
</div>
@endsection
