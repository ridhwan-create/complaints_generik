<!-- resources/views/public_complaints/status_check_form.blade.php -->
<x-public-layout>
    <x-slot name="title">Complaint List</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <form method="POST" action="{{ route('public_complaints.checkStatus') }}">
                    @csrf
                    <x-input-label for="email" :value="__('Complainer Email is Required')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-1/2" :value="old('email')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-public-layout>