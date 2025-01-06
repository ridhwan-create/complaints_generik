<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Complaint') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('complaints.update', $complaint) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="bg-gray-100 p-4 rounded mb-6">
                        <h3 class="text-lg font-semibold">Complainer Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <x-input-label for="complainer" :value="__('Complainer Name')" />
                                <x-text-input id="complainer" name="complainer" type="text" class="mt-1 block w-full"
                                              :value="$complaint->complainer" required />
                                <x-input-error class="mt-2" :messages="$errors->get('complainer')" />
                            </div>

                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full"
                                              :value="$complaint->contact_number" required />
                                <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                              :value="$complaint->email" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="system" :value="__('System')" />
                        <x-text-input id="system" name="system" type="text" class="mt-1 block w-full"
                                      :value="$complaint->system" required />
                        <x-input-error class="mt-2" :messages="$errors->get('system')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="details" :value="__('Details')" />
                        <textarea id="details" name="details" class="form-textarea mt-1 block w-full" rows="4"
                                  required>{{ $complaint->details }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('details')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <x-text-input id="status" name="status" type="text" class="mt-1 block w-full"
                                      :value="$complaint->status" required />
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="image" :value="__('Complaint Image (Optional)')" />
                        @if ($complaint->image)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500">Current Image:</p>
                                <img src="{{ route('storage.uploads', ['filename' => $complaint->image]) }}" alt="Complaint Image" class="max-w-full h-auto rounded border">
                            </div>
                        @endif
                        <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    <div class="mt-6">
                        <x-primary-button>
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
