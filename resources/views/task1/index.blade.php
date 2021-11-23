<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Task 1') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="grid gap-4 grid-cols-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-3">
          <div class="p-6 bg-white border-b border-gray-200 space-y-2">
            <a href="{{ route('oauth.google.sheets') }}" class="border-l-4 border-blue-500 block p-2.5 bg-gray-50 hover:bg-gray-100">Google Sheets</a>
            <a href="{{ route('oauth.zoho.crm') }}" class="border-l-4 border-blue-500 block p-2.5 bg-gray-50 hover:bg-gray-100">Zoho CRM</a>
          </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-9">
          <div class="p-6 bg-white break-words">
            @if (session()->has('g_auth'))
              <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-2.5">
                @foreach (session()->get('g_auth') as $key => $value)
                  <p><b>{{ $key }}</b>: {{ $value }}</p>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
