<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Staff') }}
            </h2>
            <a href="{{ route('staff.index') }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <form method="POST" action="{{ route('staff.update',$staff) }}" enctype="multipart/form-data">
                    @csrf
                    
                    
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $staff->user->name }}"  autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $staff->user->email }}" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Role')" />
                        <select name="role" id="role" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Choose Role</option>
                            <option value="admin" {{ $role == 'admin' ? 'selected':'' }}>Admin</option>
                            <option value="hr" {{ $role == 'hr' ? 'selected':'' }}>HR</option>
                            <option value="manager" {{ $role == 'manager' ? 'selected':'' }}>Manager</option>
                        </select>

                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="department_id" :value="__('Department')" />
                        <select name="department_id" id="department_id" class="rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Choose Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $staff->department_id == $department->id ? 'selected':'' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Staff
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
