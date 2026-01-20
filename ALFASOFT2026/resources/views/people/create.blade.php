@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-4">Nova Pessoa</h1>
    <div class="bg-white shadow rounded p-6">
        <form method="POST" action="{{ route('people.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nome</label>
                <input type="text" name="name"
                       class="border rounded px-3 py-2 w-full"
                       value="{{ old('name') }}">
                @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block font-medium">Email</label>
                <input type="email" name="email"
                       class="border rounded px-3 py-2 w-full"
                       value="{{ old('email') }}">
                @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="flex gap-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Salvar
                </button>
                <a href="{{ route('people.index') }}"
                   class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
