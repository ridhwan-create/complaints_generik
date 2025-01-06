<x-public-layout>
    <x-slot name="title">Create Complaint</x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Create a New Complaint</h2>
        <form action="{{ route('public_complaints.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Hidden Admin Emails -->
            @foreach ($adminEmails as $email)
            <input type="hidden" name="admin_email[]" value="{{ $email }}">
            @endforeach
           <!-- Complainer Details Container -->
            <div class="mb-4">
                <div class="flex space-x-4">
                    <!-- Complainer Name -->
                    <div class="w-1/3">
                        <x-input-label for="complainer" :value="__('Complainer Name')" />
                        <x-text-input id="complainer" name="complainer" type="text" class="mt-1 block w-full" :value="old('complainer')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('complainer')" />
                    </div>

                    <!-- Contact Number -->
                    <div class="w-1/3">
                        <x-input-label for="contact_number" :value="__('Contact Number')" />
                        <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full" :value="old('contact_number')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                    </div>

                    <!-- Email -->
                    <div class="w-1/3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <x-input-label for="system" :value="__('System')" />
                <select id="system" name="system" class="mt-1 block w-auto border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="" disabled selected>Select a system</option>
                    @foreach ($systemNames as $system)
                        <option value="{{ $system->id }}" {{ old('system') == $system->id ? 'selected' : '' }}>
                            {{ $system->systems }} <!-- Gunakan 'systems' di sini -->
                        </option>
                    @endforeach
                </select>                
                <x-input-error class="mt-2" :messages="$errors->get('system')" />
            </div>            
            
            <div class="mb-4">
                <x-input-label for="details" :value="__('Complaint section (write your complaint here)')" />
                <textarea id="details" name="details" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('details') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('details')" />
            </div>
            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Upload Image (Optional)')" />
                <input id="image" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>
            <!-- Status -->
            <input type="hidden" id="status" name="status" value="pending">

            <div class="mt-6 flex items-center space-x-4">
                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Submit') }}
                </button>
            
                <!-- Back Button -->
                <button type="button" onclick="window.history.back()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back') }}
                </button>
            </div>
            
        </form>
    </div>
</x-public-layout>
