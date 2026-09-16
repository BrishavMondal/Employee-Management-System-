<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Department') }}
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Update department information.
            </p>
        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('departments.update', $department) }}"
                        class="space-y-6"
                    >

                        @csrf
                        @method('PUT')

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
                                value="{{ old('name', $department->name) }}"
                                required
                                maxlength="100"
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
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >{{ old('description', $department->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-between">

                            <a
                                href="{{ route('departments.show', $department) }}"
                                class="text-gray-600 hover:text-gray-900"
                            >
                                ← Back
                            </a>

                            <div class="flex gap-3">

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
                                    Update Department
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>