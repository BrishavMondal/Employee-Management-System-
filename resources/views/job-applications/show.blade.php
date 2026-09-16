<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Job Application Details
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $jobApplication->position }}
                </p>

            </div>

            <div class="flex gap-3">

                <a
                    href="{{ route('job-applications.edit', $jobApplication) }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md
                           text-sm font-medium hover:bg-gray-700"
                >
                    Edit
                </a>

                <a
                    href="{{ route('job-applications.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md
                           text-sm text-gray-700 hover:bg-gray-50"
                >
                    Back
                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900 mb-6">
                        Application Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <p class="text-sm text-gray-500">
                                Employee ID
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $jobApplication->employee->employee_id }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Applicant
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $jobApplication->employee->first_name }}
                                {{ $jobApplication->employee->last_name }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Email
                            </p>

                            <p class="mt-1">
                                {{ $jobApplication->employee->email }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Department
                            </p>

                            <p class="mt-1">
                                {{ $jobApplication->employee->department->name ?? 'N/A' }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Position
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $jobApplication->position }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Application Date
                            </p>

                            <p class="mt-1">
                                {{ $jobApplication->application_date->format('d M Y') }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <p class="mt-1 font-medium">
                                {{ $jobApplication->status }}
                            </p>

                        </div>

                        <div class="md:col-span-2">

                            <p class="text-sm text-gray-500">
                                Notes
                            </p>

                            <p class="mt-1 whitespace-pre-line">
                                {{ $jobApplication->notes ?: 'No notes available.' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>