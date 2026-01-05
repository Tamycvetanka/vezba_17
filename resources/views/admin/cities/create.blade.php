<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add City
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded bg-white p-6 shadow">

                @if ($errors->any())
                    <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.cities.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text"
                               name="city"
                               value="{{ old('city') }}"
                               class="mt-1 w-full rounded border-gray-300"
                               placeholder="e.g. Beograd">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Temperature (°C)</label>
                        <input type="number"
                               name="temperature"
                               value="{{ old('temperature') }}"
                               class="mt-1 w-full rounded border-gray-300"
                               placeholder="e.g. 22">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                            Save
                        </button>

                        <a href="{{ route('admin.cities.index') }}"
                           class="rounded bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

