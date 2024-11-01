<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Schedule') }}
            </h2>
            @role('superadmin')
                <a href="{{ route('schedule.index') }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                    Back
                </a>
            @endrole
        </div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @elseif (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('error') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-red-600 hover:bg-red-300 hover:text-red-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $schedule->job->position->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $schedule->job->code }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-slate-500 text-sm">Date</p>
                        <h3 class="text-indigo-950 text-xl font-bold">@formatDate($schedule->date)</h3>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-slate-500 text-sm">Time</p>

                        {{-- <h3 class="text-indigo-950 text-xl font-bold">{{ $schedule->position->count() }}</h3> --}}
                        <h3 class="text-indigo-950 text-xl font-bold">@formatTime($schedule->start_time) - @formatTime($schedule->end_time)</h3>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('schedule.edit', $schedule->id) }}"
                            class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-full">
                            Edit schedule
                        </a>
                        <form action="{{ route('schedule.destroy', $schedule) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="font-bold py-2 px-4 bg-red-700 hover:bg-red-400 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">

                <div class="flex flex-row justify-between items-center">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">Applicant</h3>
                        <p class="text-slate-500 text-sm">{{ $schedule->line->count() }} Total Applicant</p>
                    </div>
                    <!-- Trigger Button -->
                    <button class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-full"
                        onclick="toggleModal(true)">
                        Generate
                    </button>
                </div>
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th
                                class="bg-sky-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-sky-600 font-bold tracking-wider uppercase text-xs">
                                Job Code</th>
                            <th
                                class="bg-sky-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-sky-600 font-bold tracking-wider uppercase text-xs">
                                Position</th>
                            <th
                                class="bg-sky-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-sky-600 font-bold tracking-wider uppercase text-xs">
                                Mark</th>
                            <th
                                class="bg-sky-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-sky-600 font-bold tracking-wider uppercase text-xs">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        @forelse ($schedule->line as $line)
                            <tr class="hover:bg-sky-100">
                                <td class="border-b border-gray-200 px-6 py-4">{{ $line->application->user->name }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $line->application->reg_no }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">
                                    <input type="checkbox" {{ $line->is_mark ? 'checked' : '' }} style="transform: scale(1.3);" onclick="return false">
                                </td>
                                <td class="border-b border-gray-200 px-6 py-4">
                                    <div class="flex flex-row items-center gap-x-3">
                                        <form action="{{ route('schedule.line.destroy',$line) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-700 border border-red-700 rounded-full hover:bg-red-100 delete-button"
                                                >
                                                <!-- SVG Trash Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>

                                        <a href="{{ route('application.show', $line->application->id) }}"
                                            class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-lg">Detail
                                            Applicant</a>
                                    </div>
                                </td>
                            <tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center border-b border-gray-200 px-6 py-4">No data found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Modal Background -->
    <div id="generateModal"
        class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
            <h2 class="text-xl font-bold text-indigo-950 mb-4">Select Applicants for Generation</h2>

            <!-- Applicants Table -->
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-2"><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                            Select
                            All</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Registration No</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applicants as $applicant)
                        <tr>
                            <td class="p-2 border">
                                <input type="checkbox" class="applicant-checkbox" value="{{ $applicant->id }}">
                            </td>
                            <td class="p-2 border">{{ $applicant->user->name }}</td>
                            <td class="p-2 border">{{ $applicant->reg_no }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No applicants found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Modal Buttons -->
            <div class="flex justify-end mt-4">
                <button onclick="toggleModal(false)"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 mr-2">
                    Cancel
                </button>
                <button onclick="generateSelected()"
                    class="px-4 py-2 bg-indigo-700 text-white rounded-md hover:bg-indigo-500">
                    Generate Selected
                </button>
            </div>
        </div>
    </div>
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('generateModal');
            modal.classList.toggle('hidden', !show);
        }

        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('.applicant-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = source.checked);
        }

        function generateSelected() {
            const selectedIds = Array.from(document.querySelectorAll('.applicant-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                alert("Please select at least one applicant.");
                return;
            }

            // Send the selected IDs to the controller using fetch
            fetch(`/schedules/{{ $schedule->id }}/generate-applicants`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        applicant_ids: selectedIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.success);
                        toggleModal(false); // Close the modal after success
                        window.location.reload(); // Refresh the page to update data
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>
