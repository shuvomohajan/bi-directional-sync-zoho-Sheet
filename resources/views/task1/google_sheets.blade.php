<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Google Sheets') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="grid gap-4 grid-cols-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-3">
          <div class="p-6 bg-white space-y-2">
            <a href="{{ route('oauth.google.sheets') }}" class="border-l-4 border-blue-500 block p-2.5 bg-gray-50 hover:bg-gray-100">Google Sheets</a>
            <a href="{{ route('oauth.zoho.crm') }}" class="border-l-4 border-blue-500 block p-2.5 bg-gray-50 hover:bg-gray-100">Zoho CRM</a>
          </div>
        </div>
        <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg col-span-9">
          <form action="{{ route('oauth.google.sheets.authorize') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="client_id">Client Id</label>
              <input type="text" name="client_id" id="client_id" class="block rounded-md w-full focus:ring-blue-400">
            </div>
            <div class="mb-3">
              <label for="client_secret">Client Secret</label>
              <input type="text" name="client_secret" id="client_secret" class="block rounded-md w-full focus:ring-blue-400">
            </div>
            <button class="py-2 px-6 bg-gray-900 text-white rounded-md">Authorize</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
