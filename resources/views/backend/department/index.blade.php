<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Department List') }}
            </h2>
            @role('superadmin')
                <a href="{{ route('department.create') }}" class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-full">
                    Add New
                </a>
            @endrole
        </div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="flex flex-col md:flex-row justify-end items-center mb-6">
                    <!-- Ganti justify-between menjadi justify-end -->
                    <form method="GET" action="{{ route('department.index') }}" class="flex w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari Department"
                            class="rounded-l-full w-full md:w-64 border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded-r-full hover:bg-red-700 transition duration-300 ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th
                                class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Code</th>
                            <th
                                class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Name</th>
                            <th
                                class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        @forelse ($departments as $dept)
                            <tr>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $dept->code }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $dept->name }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">
                                    <a href="{{ route('department.show', $dept) }}" class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-lg">View</a>
                                </td>
                            <tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center border-b border-gray-200 px-6 py-4">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>