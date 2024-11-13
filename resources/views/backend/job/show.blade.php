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
            <div class="flex flex-row mb-4">
                
                @if ($job->status == 'Draft')
                    <a href="{{ route('job.edit',$job) }}" class="mr-4 font-bold py-1 px-4 bg-amber-700 hover:bg-amber-400 text-white rounded-full">
                        Edit
                    </a>
                    <a href="{{ route('job.set.active',$job) }}" class="mr-4 font-bold py-1 px-4 bg-sky-700 hover:bg-sky-400 text-white rounded-full">
                        Active
                    </a>
                    <form action="{{ route('job.destroy',$job) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mr-4 font-bold py-2 px-4 bg-red-700 text-white rounded-full">
                            Delete
                        </button>
                    </form>
                @elseif($job->status == 'Active')
                    <a href="{{ route('job.set.done',$job) }}" class="mr-4  font-bold py-1 px-4 bg-green-700 hover:bg-green-400 text-white rounded-full">
                        Done
                    </a>
                    <a href="{{ route('job.set.cancel',$job) }}" class="mr-4  font-bold py-1 px-4 bg-red-700 hover:bg-red-400 text-white rounded-full">
                        Cancel
                    </a>
                @elseif($job->status == 'Cancelled')
                    <a href="{{ route('job.set.draft',$job) }}" class="mr-4  font-bold py-1 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-full">
                        Draft
                    </a>
                @endif
            </div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="py-3 w-full bg-red-500 text-white">
                        <p class="ml-3">{{$error}}</p>
                    </div>
                @endforeach
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="mt-4">
                    <x-input-label for="code" :value="__('Code')" />
                    <x-text-input id="code" class="border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400 block mt-1 w-full " type="text" name="code" :value="$job->code" readonly />
                </div>
                    
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" type="text" name="title" :value="$job->title" readonly />
                </div>
            
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description*')" />
                    <textarea id="description" name="description" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" rows="4" readonly>{{ $job->description }}</textarea>
                </div>
            
                <div class="mt-4">
                    <x-input-label for="position_id" :value="__('Position')" />
                    <select name="position_id" id="position_id" class="rounded-lg pl-3 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" disabled>
                        <option value="{{ $job->position_id }}">{{ $job->position->name }}</option>
                    </select>
                </div>
            
                <div class="mt-4">
                    <x-input-label for="type" :value="__('Type')" />
                    <select name="type" id="type" class="rounded-lg pl-3 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" disabled>
                        <option value="{{ $job->type }}">{{ ucfirst($job->type) }}</option>
                    </select>
                </div>
            
                <div class="mt-4">
                    <x-input-label for="requirements" :value="__('Requirement*')" />
                    <textarea id="requirements" name="requirements" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" rows="4" readonly>{{ $job->requirements }}</textarea>
                </div>
            
                <div class="mt-4">
                    <x-input-label for="responsibilities" :value="__('Responsibilities*')" />
                    <textarea id="responsibilities" name="responsibilities" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" rows="4" readonly>{{ $job->responsibilities }}</textarea>
                </div>
            
                <div class="mt-4 flex">
                    <div class="w-1/2 pr-2">
                        <x-input-label for="start_date" :value="__('Start Date')" />
                        <x-text-input id="start_date" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" type="date" name="start_date" :value="$job->start_date" readonly />
                    </div>
                    
                    <div class="w-1/2 pl-2">
                        <x-input-label for="end_date" :value="__('End Date')" />
                        <x-text-input id="end_date" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" type="date" name="end_date" :value="$job->end_date" readonly />
                    </div>
                </div>
            
                <div class="mt-4 flex">
                    <div class="w-1/2 pr-2">
                        <x-input-label for="min_salary" :value="__('Min salary')" />
                        <x-text-input id="min_salary" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" type="number" name="min_salary" :value="$job->min_salary" readonly />
                    </div>
                    
                    <div class="w-1/2 pl-2">
                        <x-input-label for="max_salary" :value="__('Max Salary')" />
                        <x-text-input id="max_salary" class="block mt-1 w-full border-b-4 border-t-0 border-l-0 border-r-0 border-gray-400" type="number" name="max_salary" :value="$job->max_salary" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
