<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prognoza
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Temperature po gradovima
        </p>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($cities->isEmpty())
                <div class="rounded-xl bg-white p-6 shadow text-gray-600">
                    Nema unetih gradova.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($cities as $item)
                        <div class="rounded-xl bg-white p-6 shadow text-center">
                            <div class="text-lg font-semibold text-gray-800">
                                {{ $item->city->name }}
                            </div>

                            <div class="mt-4 text-3xl font-bold text-blue-600">
                                {{ $item->temperature }}°C
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
