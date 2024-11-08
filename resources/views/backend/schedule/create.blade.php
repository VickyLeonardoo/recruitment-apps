<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Schedule') }}
            </h2>
            <a href="{{ route('schedule.index') }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="py-3 mb-4 w-full bg-red-500 text-white">
                        <p class="ml-3">{{$error}}</p> 
                    </div>
                @endforeach
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <form method="POST" action="{{ route('schedule.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mt-4">
                        <x-input-label for="job_vacancy_id" :value="__('Job')" />
                        <select name="job_vacancy_id" id="job_vacancy_id" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>-- Choose Job --</option>
                            @forelse ($jobs as $job)
                                <option value="{{ $job->id }}" {{ old('job_vacancy_id') == $job->id  ? 'selected':''}}>{{ $job->code }}</option>
                            @empty
                                <option value="" disabled>No Data Found</option>                                
                            @endforelse
                        </select>

                        <x-input-error :messages="$errors->get('job_vacancy_id')" class="mt-2" />
                    </div>
                    
                    <div class="mt-4">
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autofocus autocomplete="date" />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="start_time" :value="__('Start Time')" />
                        <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" :value="old('start_time')" required autofocus autocomplete="start_time" />
                        <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="end_time" :value="__('End Time')" />
                        <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" :value="old('end_time')" required autofocus autocomplete="end_time" />
                        <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
            
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New Schedule
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Opsi",
                allowClear: true
            });
        });
    </script>
</x-app-layout>
