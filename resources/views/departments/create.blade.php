<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Department') }}
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Create a new company department.
            </p>
        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('departments.store') }}"
                        class="space-y-6"
                    >

                        @csrf

                        {{-- Department Name --}}
                        <div>

                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Department Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                required
                                maxlength="100"
                                placeholder="e.g. Information Technology"
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Description --}}
                        <div>

                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Description
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                maxlength="1000"
                                placeholder="Describe the department..."
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end gap-3">

                            <a
                                href="{{ route('departments.index') }}"
                                class="inline-flex items-center px-4 py-2
                                       bg-white border border-gray-300
                                       rounded-md font-semibold text-xs
                                       text-gray-700 uppercase tracking-widest
                                       hover:bg-gray-50"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2
                                       bg-gray-800 border border-transparent
                                       rounded-md font-semibold text-xs
                                       text-white uppercase tracking-widest
                                       hover:bg-gray-700"
                            >
                                Create Department
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>