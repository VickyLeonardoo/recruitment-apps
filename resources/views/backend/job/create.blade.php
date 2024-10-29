<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Job') }}
            </h2>
            <a href="{{ route('job.index') }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="py-3 w-full bg-red-500 text-white">
                        <p class="ml-3">{{$error}}</p>
                    </div>
                @endforeach
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <form method="POST" action="{{ route('job.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <x-input-label for="code" :value="__('Code')" />
                        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')"  autofocus autocomplete="code" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                        
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description*')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="position_id" :value="__('Position')" />
                        <select name="position_id" id="position_id" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Choose Position</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}" {{ old('position_id') == $position->id  ? 'selected':''}}>{{ $position->name }}</option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('position_id')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Type')" />
                        <select name="type" id="type" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Choose Type</option>
                            <option value="fulltime" {{ old('type') == 'fulltime'  ? 'selected':''}}>Full Time</option>
                            <option value="parttime" {{ old('type') == 'parttime'  ? 'selected':''}}>Part Time</option>
                            <option value="internship" {{ old('type') == 'internship'  ? 'selected':''}}>Internship</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="requirements" :value="__('Requirement*')" />
                        <textarea id="requirements" name="requirements" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('requirements') }}</textarea>
                        <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="qualification" :value="__('Qualification*')" />
                        <textarea id="qualification" name="qualification" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('qualification') }}</textarea>
                        <x-input-error :messages="$errors->get('qualification')" class="mt-2" />
                    </div>

                    <div class="mt-4 flex">
                        <!-- Start Date -->
                        <div class="w-1/2 pr-2">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" autofocus autocomplete="start_date" />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>
                    
                        <!-- End Date -->
                        <div class="w-1/2 pl-2">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" autofocus autocomplete="end_date" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 flex">
                        <!-- Start Date -->
                        <div class="w-1/2 pr-2">
                            <x-input-label for="min_salary" :value="__('Min salary')" />
                            <x-text-input id="min_salary" class="block mt-1 w-full" type="number" name="min_salary" :value="old('min_salary')" autofocus autocomplete="min_salary" />
                            <x-input-error :messages="$errors->get('min_salary')" class="mt-2" />
                        </div>
                    
                        <!-- End Date -->
                        <div class="w-1/2 pl-2">
                            <x-input-label for="max_salary" :value="__('Max Salary')" />
                            <x-text-input id="max_salary" class="block mt-1 w-full" type="number" name="max_salary" :value="old('max_salary')" autofocus autocomplete="max_salary" />
                            <x-input-error :messages="$errors->get('max_salary')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
