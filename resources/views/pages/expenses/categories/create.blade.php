@extends('layouts.base')
@section('content')

<div class="py-2 flex justify-between">
    <label for="title" class="font-bold my-2 text-primary text-white">
        <h1 class="text-2xl font-bold">Créer un nouveau Compte</h1>
        <h3>Créez un nouveau compte et enregistrez-le.</h3>
    </label>
    <div for="title" class="text-sm my-2 text-primary">
        <a href="{{ route('expense_categories.index') }}" class="rounded-full border ns-inset-button error hover:bg-gray-200 hover:text-gray-900 text-white  px-1 py-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-flex">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ __( 'Retour' ) }}
        </a>
    </div>
</div>
<div class="">
    <form method="POST" action="{{ route('expense_categories.store') }}" id="createForm">
        @csrf

        <div class="py-4">
            <!-- Name -->
            <x-label for="name" :value="__('Name')" />
            <div class="flex justify-between rounded-md border-2 bg-indigo-600 border-indigo-600">
                <x-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-button>
                    {{ __('Sauvegarder') }}
                </x-button>
            </div>
        </div>

        <div class="bg-green-0 w-max rounded-md py-2 px-4">
            <x-input-label :value="__('Information Générale')" />
        </div>
        <div class="bg-white rounded-md shadow-lg px-6 w-full">
            <div class="grid md:grid-cols-1 pb-8">
                <!-- Categories -->
                <div class="col-span-1 mt-4">
                    <x-input-label for="operation" :value="__('Operation')" />
                    <select name="operation" id="operation" class="mt-1 block w-full py-2 px-3 border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Selectionner le type de l'opération</option>
                        <option value="debit">Débit</option>
                        <option value="credit">Crédit</option>
                    </select>
                    <h6 class="text-xs mt-1">{{ __("All entities attached to this category will either produce a \"credit\" or \"debit\" to the cash flow history.") }}</h6>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
