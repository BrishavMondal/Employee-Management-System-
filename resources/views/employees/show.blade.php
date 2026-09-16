<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee Details
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="flex items-center justify-between mb-6">

                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Employee Details
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        View complete employee information.
                    </p>
                </div>

                <div class="flex gap-3">

                    <a
                        href="{{ route('employees.edit', $employee) }}"
                        class="px-5 py-2.5 bg-indigo-600 text-white rounded-md font-semibold text-sm hover:bg-indigo-700"
                    >
                        Edit Employee
                    </a>

                    <a
                        href="{{ route('employees.index') }}"
                        class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md font-semibold text-sm hover:bg-gray-300"
                    >
                        Back
                    </a>

                </div>

            </div>


            {{-- Employee Information --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                {{-- Header --}}
                <div class="p-6 border-b border-gray-200">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="text-xl font-bold text-gray-900">
                                {{ $employee->first_name }}
                                {{ $employee->last_name }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $employee->designation }}
                            </p>

                        </div>

                        @if ($employee->status === 'Active')

                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>

                        @elseif ($employee->status === 'Inactive')

                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                Inactive
                            </span>

                        @else

                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                On Leave
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Details --}}
                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">


                        {{-- Employee ID --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Employee ID
                            </p>

                            <p class="mt-1 text-base text-gray-900 font-semibold">
                                {{ $employee->employee_id }}
                            </p>

                        </div>


                        {{-- Department --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Department
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->department->name }}
                            </p>

                        </div>


                        {{-- First Name --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                First Name
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->first_name }}
                            </p>

                        </div>


                        {{-- Last Name --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Last Name
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->last_name }}
                            </p>

                        </div>


                        {{-- Email --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Email
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->email }}
                            </p>

                        </div>


                        {{-- Phone --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Phone
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->phone ?? 'Not provided' }}
                            </p>

                        </div>


                        {{-- Date of Birth --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Date of Birth
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->date_of_birth?->format('d M Y') ?? 'Not provided' }}
                            </p>

                        </div>


                        {{-- Gender --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Gender
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->gender ?? 'Not provided' }}
                            </p>

                        </div>


                        {{-- Designation --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Designation
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->designation }}
                            </p>

                        </div>


                        {{-- Salary --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Salary
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ number_format((float) $employee->salary, 2) }}
                            </p>

                        </div>


                        {{-- Hire Date --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Hire Date
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->hire_date?->format('d M Y') ?? 'Not provided' }}
                            </p>

                        </div>


                        {{-- Created --}}
                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Created
                            </p>

                            <p class="mt-1 text-base text-gray-900">
                                {{ $employee->created_at->format('d M Y, h:i A') }}
                            </p>

                        </div>

                    </div>


                    {{-- Address --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">

                        <p class="text-sm font-medium text-gray-500">
                            Address
                        </p>

                        <p class="mt-2 text-base text-gray-900">
                            {{ $employee->address ?? 'Not provided' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>