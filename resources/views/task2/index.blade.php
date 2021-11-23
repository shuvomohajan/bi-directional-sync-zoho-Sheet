<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Task 2') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white">
            <form action="{{ route('google.sheets.store') }}" method="POST">
            @csrf
            <div class="mb-10">
                <label for="google_sheet_id">Google Sheet Id</label>
                <input type="text" value="1aUp_GEJTzskJTkYHKb6h9azkR_QuUM8i-dZH9_hLgAk" readonly name="google_sheet_id" id="google_sheet_id" class="block rounded-md w-full focus:ring-blue-400">
              </div>
              <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="block rounded-md w-full focus:ring-blue-400">
              </div>
              <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="block rounded-md w-full focus:ring-blue-400">
              </div>
              <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="block rounded-md w-full focus:ring-blue-400">
              </div>
              <button class="py-2 px-6 bg-gray-900 text-white rounded-md">save data</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
