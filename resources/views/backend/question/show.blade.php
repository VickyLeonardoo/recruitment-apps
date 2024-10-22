<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Question') }}
            </h2>
            @role('superadmin')
                <a href="{{ route('question.index') }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
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
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('question.edit', $question) }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                            Edit 
                        </a>
                        <form action="{{ route('question.destroy', $question) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-2 px-4 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div> 

                <hr class="my-5">

                <div class="flex flex-row justify-between items-center">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">Choice</h3>
                        <p class="text-slate-500 text-sm">{{ $question->choice->count() }} Total Choice</p>
                    </div>
                    <a href="{{ route('question.create.choice',$question) }}" class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-full">
                        Add New Choice
                    </a>
                </div>

                @foreach($question->choice as $choice)
                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        @if ($choice->answerImage)
                        <img src="{{ Storage::url($question->image) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        @endif

                        <div class="flex flex-col">
                            @if($choice->answerText)
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $choice->answerText }}</h3>
                            @endif
                            <p class="text-slate-500 text-sm">{{ $choice->label }}</p>
                        </div>
                    </div>

                    
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('position.edit',$choice) }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('position.destroy',$choice) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-2 px-4 bg-red-700 text-white rounded-full">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.20967 5.64 2.24967 6.05C2.28967 6.46 2.64967 6.76 3.06967 6.72L5.10967 6.52C10.3497 6 15.6297 6.2 20.9297 6.73C20.9597 6.73 20.9797 6.73 21.0097 6.73C21.3897 6.73 21.7197 6.44 21.7597 6.05C21.7897 5.64 21.4897 5.27 21.0697 5.23Z" fill="white"/>
                                    <path d="M19.2297 8.14C18.9897 7.89 18.6597 7.75 18.3197 7.75H5.67975C5.33975 7.75 4.99975 7.89 4.76975 8.14C4.53975 8.39 4.40975 8.73 4.42975 9.08L5.04975 19.34C5.15975 20.86 5.29975 22.76 8.78975 22.76H15.2097C18.6997 22.76 18.8397 20.87 18.9497 19.34L19.5697 9.09C19.5897 8.73 19.4597 8.39 19.2297 8.14ZM13.6597 17.75H10.3297C9.91975 17.75 9.57975 17.41 9.57975 17C9.57975 16.59 9.91975 16.25 10.3297 16.25H13.6597C14.0697 16.25 14.4097 16.59 14.4097 17C14.4097 17.41 14.0697 17.75 13.6597 17.75ZM14.4997 13.75H9.49975C9.08975 13.75 8.74975 13.41 8.74975 13C8.74975 12.59 9.08975 12.25 9.49975 12.25H14.4997C14.9097 12.25 15.2497 12.59 15.2497 13C15.2497 13.41 14.9097 13.75 14.4997 13.75Z" fill="white"/>
                                    </svg>
                            </button>
                        </form>
                    </div>
                    
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</x-app-layout>
