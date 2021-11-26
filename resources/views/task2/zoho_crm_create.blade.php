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
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="mb-3">
                                        <label for="First_Name">First Name</label>
                                        <input type="text" name="First_Name" id="First_Name" class="@error('First_Name') border-red-500 @enderror block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                        @error('First_Name')
                                        <p class="text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="Last_Name">Last Name</label>
                                        <input type="text" name="Last_Name" id="Last_Name" class="@error('Last_Name') border-red-500 @enderror block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                        @error('Last_Name')
                                        <p class="text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email">Email</label>
                                        <input type="email" name="Email" id="Email" class="@error('Email') border-red-500 @enderror block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                        @error('Email')
                                        <p class="text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <label for="Company">Company</label>
                                        <input type="text" name="Company" id="Company" class="@error('Company') border-red-500 @enderror block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                        @error('Company')
                                        <p class="text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="State">State</label>
                                        <input type="text" name="State" id="State" class="@error('State') border-red-500 @enderror block border-gray-300 rounded-md w-full focus:ring-gray-400 focus:border-gray-400">
                                        @error('State')
                                        <p class="text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="py-2 px-6 bg-gray-900 text-white rounded-md">save data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
