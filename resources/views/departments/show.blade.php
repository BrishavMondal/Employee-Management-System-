<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $department->name }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Department details and assigned employees.
                </p>

            </div>

            <div class="flex gap-3">

                <a
                    href="{{ route('departments.edit', $department) }}"
                    class="inline-flex items-center px-4 py-2
                           bg-gray-800 border border-transparent
                           rounded-md font-semibold text-xs text-white
                           uppercase tracking-widest hover:bg-gray-700"
                >
                    Edit Department
                </a>

                <a
                    href="{{ route('departments.index') }}"
                    class="inline-flex items-center px-4 py-2
                           bg-white border border-gray-300
                           rounded-md font-semibold text-xs text-gray-700
                           uppercase tracking-widest hover:bg-gray-50"
                >
                    Back
                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Department Information --}}
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Department Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <div class="text-sm text-gray-500">
                                Department Name
                            </div>

                            <div class="mt-1 text-base font-medium text-gray-900">
                                {{ $department->name }}
                            </div>

                        </div>

                        <div>

                            <div class="text-sm text-gray-500">
                                Total Employees
                            </div>

                            <div class="mt-1 text-base font-medium text-gray-900">
                                {{ $department->employees->count() }}
                            </div>

                        </div>

                        <div class="md:col-span-2">

                            <div class="text-sm text-gray-500">
                                Description
                            </div>

                            <div class="mt-1 text-base text-gray-900">
                                {{ $department->description ?: 'No description provided.' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Employees --}}
            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="flex items-center justify-between mb-5">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Employees
                        </h3>

                        <a
                            href="{{ route('employees.create') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-900"
                        >
                            + Add Employee
                        </a>

                    </div>

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Employee ID
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Name
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Designation
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Action
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forelse ($department->employees as $employee)

                                    <tr>

                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $employee->employee_id }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $employee->first_name }}
                                            {{ $employee->last_name }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $employee->designation }}
                                        </td>

                                        <td class="px-6 py-4">

                                            <span class="text-sm">
                                                {{ $employee->status }}
                                            </span>

                                        </td>

                                        <td class="px-6 py-4 text-right">

                                            <a
                                                href="{{ route('employees.show', $employee) }}"
                                                class="text-indigo-600 hover:text-indigo-900 text-sm"
                                            >
                                                View
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="px-6 py-10 text-center text-gray-500"
                                        >
                                            No employees assigned to this department.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>