<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Google Sheets Data Append') }}
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
                <div class="overflow-hidden shadow-sm sm:rounded-lg col-span-9 space-y-4">
                    <div class="p-6 bg-white">
                        <form action="{{ route('user.google.sheets.id.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="google_sheet_id">Google Sheet Id</label>
                                <div class="flex space-x-4">
                                    <input type="text" value="{{ Auth::user()->google_sheet_id }}" name="google_sheet_id" id="google_sheet_id"
                                           class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                    <button type="submit" class="py-2 px-6 bg-gray-900 text-white rounded-md">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="p-6 bg-white">
                        <form action="{{ route('google.sheets.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                </div>
                                <div class="mb-3">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                            </div>
                            <div class="mb-3">
                                <label for="company">Company</label>
                                <input type="text" name="company" id="company" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                            </div>
                            <div class="mb-3">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                            </div>
                            <button class="py-2 px-6 bg-gray-900 text-white rounded-md">save data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
