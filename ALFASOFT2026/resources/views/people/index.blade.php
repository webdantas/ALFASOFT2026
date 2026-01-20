@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Pessoas</h1>

        @auth
        <a href="{{ route('people.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Nova Pessoa
        </a>
        @endauth
    </div>

    @if($people->isEmpty())
        <p class="text-gray-500">Nenhuma pessoa cadastrada.</p>
        <p class="text-gray-500">Necessário estar autenticado para criar pessoas.</p>
            @guest
        <p class="text-gray-500">Clique em "Entrar" para se autenticar.</p> <br>
            @endguest

            @auth
        <p class="text-gray-500">Clique em "Nova Pessoa" para cadastrar uma nova pessoa.</p>
            @endauth    
    @else
        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nome</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $person->name }}</td>
                            <td class="px-4 py-2">{{ $person->email }}</td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">

                                    <a href="{{ route('people.show', $person) }}"
                                       class="inline-flex items-center px-3 py-1.5
                                              bg-blue-600 text-white text-sm
                                              rounded hover:bg-blue-700">
                                        Ver
                                    </a>

                                    @auth
                                    <a href="{{ route('people.edit', $person) }}"
                                       class="inline-flex items-center px-3 py-1.5
                                              bg-yellow-500 text-white text-sm
                                              rounded hover:bg-yellow-600">
                                        Editar
                                    </a>

                                    <form action="{{ route('people.destroy', $person) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Confirma exclusão?')"
                                                class="inline-flex items-center px-3 py-1.5
                                                       bg-red-600 text-white text-sm
                                                       rounded hover:bg-red-700">
                                            Excluir
                                        </button>
                                    </form>
                                    @endauth

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
