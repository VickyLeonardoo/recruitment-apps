<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Question') }}
            </h2>
            @role('superadmin')
                <a href="{{ route('question.show',$question) }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                    Back
                </a>
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $question->description }}</h3>
                            <p class="text-slate-500 text-sm">{{ $question->difficult }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        {{-- <p class="text-slate-500 text-sm">Image</p> --}}
                        @if ($question->image)
                            <img src="{{ Storage::url($question->image) }}" alt="" class="rounded-2xl object-cover w-[200px] h-[150px]">
                        @endif
                    </div>
                    
                </div>

            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full bg-red-500 text-white">
                            <p class="ml-3">{{$error}}</p>
                        </div>
                    @endforeach
                @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <form method="POST" action="{{ route('question.store.choice',$question) }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mt-4">
                        <x-input-label for="label" :value="__('Label')" />
                        <x-text-input id="label" class="block mt-1 w-full" type="text" name="label" :value="old('label')" required autofocus autocomplete="label" />
                        <x-input-error :messages="$errors->get('label')" class="mt-2" />
                    </div>
                    
                    <div class="mt-4">
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">Please select only one answer type (text or image). If you choose one, leave the other blank.</span>
                        </div>
                        <x-input-label for="answerText" :value="__('Answer Text')" />
                        <textarea id="answerText" name="answerText" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('answerText') }}</textarea>
                        <x-input-error :messages="$errors->get('answerText')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="answerImage" :value="__('Answer Image')" />
                        <x-text-input id="answerImage" class="block mt-1 w-full border-2 border-gray-100 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="file" name="answerImage" autofocus autocomplete="answerImage" />
                        <x-input-error :messages="$errors->get('answerImage')" class="mt-2" />
                    </div>
                
                    <!-- Checkbox for Is Correct -->
                    <div class="mt-4 flex items-center">
                        <input 
                            id="is_correct" 
                            type="checkbox" 
                            name="is_correct" 
                            class="mr-2" 
                            style="width: 24px; height: 24px;" 
                        />
                        <x-input-label for="is_correct" :value="__('Is Correct')" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add Choice
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>
