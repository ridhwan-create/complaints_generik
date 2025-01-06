<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Complaint') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Complainer Details Container -->
                    <div class="mb-6 bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Complainer Details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Complainer Name -->
                            <div>
                                <x-input-label for="complainer" :value="__('Complainer Name')" />
                                <x-text-input id="complainer" name="complainer" type="text" class="mt-1 block w-full" :value="old('complainer')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('complainer')" />
                            </div>

                            <!-- Contact Number -->
                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full" :value="old('contact_number')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>
                    </div>

                    <!-- System -->
                    <div class="mt-4">
                        <x-input-label for="system" :value="__('System')" />
                        <x-text-input id="system" name="system" type="text" class="mt-1 block w-full" :value="old('system')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('system')" />
                    </div>

                    <!-- Details -->
                    <div class="mt-4">
                        <x-input-label for="details" :value="__('Details')" />
                        <textarea id="details" name="details" class="form-textarea mt-1 block w-full" rows="4" required>{{ old('details') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('details')" />
                    </div>

                    <!-- Image -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Upload Image (Optional)')" />
                        <input id="image" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="form-select mt-1 block w-full" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <div class="mt-6">
                        <x-primary-button>
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
