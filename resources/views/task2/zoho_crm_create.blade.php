<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zoho CRM Data Insert') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-4 grid-cols-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-3">
                    <div class="p-6 bg-white space-y-2">
                        <a href="{{ route('google.sheets.create') }}" class="border-l-4 border-gray-900 block p-2.5 bg-gray-50 hover:bg-gray-100">Google Sheets</a>
                        <a href="{{ route('zoho.crm.create') }}" class="border-l-4 border-gray-900 block p-2.5 bg-gray-50 hover:bg-gray-100">Zoho CRM</a>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-9">
                    <div class="p-6 bg-white">
                        <form action="{{ route('zoho.crm.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                            </div>
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                            </div>
                            <button class="py-2 px-6 bg-gray-900 text-white rounded-md">save data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
