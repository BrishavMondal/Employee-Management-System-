<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job Application') }}
        </h2>

    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('job-applications.update', $jobApplication) }}"
                        class="space-y-6"
                    >

                        @csrf
                        @method('PUT')

                        {{-- Employee --}}
                        <div>

                            <label
                                for="employee_id"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Employee / Applicant
                            </label>

                            <select
                                name="employee_id"
                                id="employee_id"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                                @foreach ($employees as $employee)

                                    <option
                                        value="{{ $employee->id }}"
                                        @selected(
                                            old(
                                                'employee_id',
                                                $jobApplication->employee_id
                                            ) == $employee->id
                                        )
                                    >
                                        {{ $employee->employee_id }}
                                        -
                                        {{ $employee->first_name }}
                                        {{ $employee->last_name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('employee_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Position --}}
                        <div>

                            <label
                                for="position"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Position
                            </label>

                            <input
                                type="text"
                                name="position"
                                id="position"
                                value="{{ old('position', $jobApplication->position) }}"
                                required
                                maxlength="150"
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                            @error('position')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Application Date --}}
                        <div>

                            <label
                                for="application_date"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Application Date
                            </label>

                            <input
                                type="date"
                                name="application_date"
                                id="application_date"
                                value="{{ old(
                                    'application_date',
                                    $jobApplication->application_date->format('Y-m-d')
                                ) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                            @error('application_date')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                                @foreach ([
                                    'Applied',
                                    'Shortlisted',
                                    'Interview',
                                    'Selected',
                                    'Rejected'
                                ] as $status)

                                    <option
                                        value="{{ $status }}"
                                        @selected(
                                            old(
                                                'status',
                                                $jobApplication->status
                                            ) === $status
                                        )
                                    >
                                        {{ $status }}
                                    </option>

                                @endforeach

                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Notes --}}
                        <div>

                            <label
                                for="notes"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Notes
                            </label>

                            <textarea
                                name="notes"
                                id="notes"
                                rows="5"
                                maxlength="2000"
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >{{ old('notes', $jobApplication->notes) }}</textarea>

                            @error('notes')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Buttons --}}
                        <div class="flex justify-between">

                            <a
                                href="{{ route('job-applications.show', $jobApplication) }}"
                                class="text-gray-600 hover:text-gray-900"
                            >
                                ← Back
                            </a>

                            <div class="flex gap-3">

                                <a
                                    href="{{ route('job-applications.index') }}"
                                    class="px-4 py-2 border border-gray-300
                                           rounded-md text-sm text-gray-700
                                           hover:bg-gray-50"
                                >
                                    Cancel
                                </a>

                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-gray-800 text-white
                                           rounded-md text-sm font-medium
                                           hover:bg-gray-700"
                                >
                                    Update Application
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>