<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Application List') }}
            </h2>
            @role('superadmin')
                {{-- <a href="" class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-full">
                    Back 
                </a> --}}
            @endrole
        </div>

    </x-slot> 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative" role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button" class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="flex justify-end space-x-4 mb-3">
                <!-- Sort By Dropdown -->
                <select id="sortSelect"
                    class="rounded-lg border-gray-300 text-gray-700 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Sort By</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>
        
                <!-- Show Dropdown -->
                <select id="filterSelect"
                    class="rounded-lg border-gray-300 text-gray-700 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Show</option>
                    <option value="today">Today</option>
                    <option value="this_week">This Week</option>
                    <option value="this_month">This Month</option>
                </select>
            </div>
        
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <!-- Left side buttons -->
                    <div class="flex space-x-2 mb-4 md:mb-0">
                        @if ($job->status != 'Done')
                            
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-300 transition duration-300" onclick="markSelected()">Mark</button>
                        <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-300" onclick="unmarkSelected()">Unmark</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-300 transition duration-300" onclick="interviewSelected()">Interview</button>
                        @endif
                        <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-300 transition duration-300" onclick="rejectSelected()">Reject</button>
                    </div>
            
                    <!-- Right side search form -->
                    <form method="GET" action="{{ route('application.index',$job) }}" class="flex w-full md:w-auto">
                        <input type="text" autocomplete="off" name="search" placeholder="Search application"
                            class="rounded-l-full w-full md:w-64 border-gray-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="bg-sky-400 text-white px-4 py-2 rounded-r-full hover:bg-sky-300 transition duration-300 ml-auto">
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
                                <input type="checkbox" style="transform: scale(1.3);" onclick="toggleCheckboxes(this)"></th>
                            <th
                                class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Name</th>
                            <th
                                class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Reg Date</th>
                            <th
                                class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Reg No</th>
                            <th
                                class="bg-red-50 sticky top-0 border-b text-center border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Status</th>
                            <th
                                class="bg-red-50 sticky text-center top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Recomendation</th>
                            <th
                                class="bg-red-50 sticky text-center top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Mark</th>
                            <th
                                class="bg-red-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-red-600 font-bold tracking-wider uppercase text-xs">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        @forelse ($applications as $application)
                                <tr>
                                    <td class="border-b border-gray-200 px-6 py-4"><input type="checkbox" class="application-checkbox" value="{{ $application->id }}" style="transform: scale(1.3);"></td>
                                    <td class="border-b border-gray-200 px-6 py-4">{{ $application->user->name }}</td>
                                    <td class="border-b border-gray-200 px-6 py-4">{{ $application->reg_no }}</td>
                                    <td class="border-b border-gray-200 px-6 py-4 text-center">@formatDate($application->created_at)</td>
                                    <td class="border-b border-gray-200 px-6 py-4">{{ $application->status }}</td>
                                    <td class="border-b text-center border-gray-200 px-6 py-4">
                                        <input type="checkbox" {{ $application->is_recomended ? 'checked' : '' }} style="transform: scale(1.3);" onclick="return false">
                                    </td>
                                    <td class="border-b text-center border-gray-200 px-6 py-4">
                                        <input type="checkbox" {{ $application->is_mark ? 'checked' : '' }} style="transform: scale(1.3);" onclick="return false">
                                    </td>
                                    <td class="border-b border-gray-200 px-6 py-4">
                                        <a href="{{ route('application.show', $application) }}" class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-lg">Detail Applicant</a>
                                        
                                    </td>
                                <tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center border-b border-gray-200 px-6 py-4">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>

    // Select/Deselect all checkboxes
    function toggleCheckboxes(source) {
        checkboxes = document.querySelectorAll('input[type="checkbox"].application-checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function showNoSelectionAlert() {
        Swal.fire({
            title: 'No Application Selected',
            text: 'Choose at least one application to perform this action.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    }
    // Collect IDs of selected applications
    // Collect IDs of selected applications
    function markSelected() {
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value);
        });

        if (selected.length > 0) {
            var url = "{{ route('application.mark', ['ids' => ':ids']) }}";
            url = url.replace(':ids', selected.join(','));
            window.location.href = url;
        } else {
            showNoSelectionAlert(); // Call the reusable function
        }
    }

    function unmarkSelected() {
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value);
        });

        if (selected.length > 0) {
            var url = "{{ route('application.unmark', ':ids') }}";
            url = url.replace(':ids', selected.join(','));
            window.location.href = url;
        } else {
            showNoSelectionAlert(); // Call the reusable function
        }
    }

    function interviewSelected(){
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value);
        });
        
        if (selected.length > 0) {
            var url = "{{ route('application.interview', ':ids') }}";
            url = url.replace(':ids', selected.join(','));
            window.location.href = url;
        } else {
            showNoSelectionAlert(); // Call the reusable function
        }
    }

    function rejectSelected() {
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value);
        });

        if (selected.length > 0) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('application.interview', ':ids') }}";
                    url = url.replace(':ids', selected.join(','));
                    window.location.href = url;
                }
            });
        } else {
            showNoSelectionAlert(); // Call the reusable function
        }
    }



</script>