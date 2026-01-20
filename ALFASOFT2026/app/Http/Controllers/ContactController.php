<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    public function create(Person $person)
    {
        $countries = $this->getCountries();

        return view('contacts.create', compact('person', 'countries'));
    }

    public function store(StoreContactRequest $request, Person $person)
    {
        $person->contacts()->create($request->validated());

        return redirect()
            ->route('people.show', $person)
            ->with('success', 'Contato criado com sucesso');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $countries = $this->getCountries();

        return view('contacts.edit', compact('contact', 'countries'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return redirect()
            ->route('contacts.show', $contact)
            ->with('success', 'Contato atualizado com sucesso');
    }

    public function destroy(Contact $contact)
    {
        $person = $contact->person;

        $contact->delete();

        return redirect()
            ->route('people.show', $person)
            ->with('success', 'Contato removido com sucesso');
    }

    private function getCountries(string $search = null): array
    {
        $url = 'https://restcountries.com/v3.1/all?fields=name,idd';

        if ($search) {
            $url = 'https://restcountries.com/v3.1/name/' . $search . '?fields=name,idd';
        }

        $response = Http::get($url);

        if (! $response->successful()) {
            return [];
        }

        return collect($response->json())
            ->filter(fn ($country) =>
                isset($country['idd']['root'], $country['idd']['suffixes'])
            )
            ->map(function ($country) {
                $codes = collect($country['idd']['suffixes'])
                    ->map(fn ($s) => $country['idd']['root'] . $s);

                return [
                    'name' => $country['name']['common'],
                    'codes' => $codes,
                ];
            })
            ->values()
            ->toArray();
    }
}
