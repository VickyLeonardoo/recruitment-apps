<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Question') }}
            </h2>
            <a href="{{ route('question.index') }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <form method="POST" action="{{ route('question.update',$question) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description*')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ $question->description }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <p class="text-red-500 text-xs">This is optional field, leave it blank if you don't want to upload an image</p>
                        <x-text-input id="image" class="block mt-1 w-full border-2 border-gray-100 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="file" name="image"  autofocus autocomplete="image" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        @if ($question->image)
                            <img src="{{ Storage::url($question->image) }}" alt="" class="rounded-2xl mt-4 object-cover w-[200px] h-[150px]">
                        @endif
                    </div>

                    <div class="mt-4">
                        <x-input-label for="difficult*" :value="__('Difficult')" />
                        <select name="difficult" id="difficult" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Choose Difficult</option>
                            <option value="Easy" {{ $question->difficult == 'Easy'  ? 'selected':'' }}>Easy</option>
                            <option value="Medium" {{ $question->difficult == 'Medium'  ? 'selected':'' }}>Medium</option>
                            <option value="Hard" {{ $question->difficult == 'Hard'  ? 'selected':'' }}>Hard</option>
                        </select>
                        <x-input-error :messages="$errors->get('difficult')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
            
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Question
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
