<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cities & Temperatures
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.cities.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Add City
                </a>
            </div>

            <div class="bg-white shadow rounded">
                <table class="w-full table-auto border-collapse">
                    <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 border">City</th>
                        <th class="px-4 py-2 border">Temperature (°C)</th>
                        <th class="px-4 py-2 border text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cities as $city)
                        <tr>
                            <td class="px-4 py-2 border">{{ $city->city }}</td>
                            <td class="px-4 py-2 border">{{ $city->temperature }}</td>
                            <td class="px-4 py-2 border text-center space-x-2">
                                <a href="{{ route('admin.cities.edit', $city) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('admin.cities.destroy', $city) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure?')"
                                            class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                                No cities found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

