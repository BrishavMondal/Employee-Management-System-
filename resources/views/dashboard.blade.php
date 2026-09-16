<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Employee Management System
                </p>
            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">


                {{-- Total Employees --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <p class="text-sm font-medium text-gray-500">
                            Total Employees
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900">
                            {{ $totalEmployees }}
                        </p>

                        <a
                            href="{{ route('employees.index') }}"
                            class="inline-block mt-3 text-sm text-indigo-600 hover:text-indigo-800"
                        >
                            View employees →
                        </a>

                    </div>

                </div>


                {{-- Active Employees --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <p class="text-sm font-medium text-gray-500">
                            Active Employees
                        </p>

                        <p class="mt-2 text-3xl font-bold text-green-600">
                            {{ $activeEmployees }}
                        </p>

                        <p class="mt-3 text-sm text-gray-500">
                            Currently active
                        </p>

                    </div>

                </div>


                {{-- Inactive Employees --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <p class="text-sm font-medium text-gray-500">
                            Inactive Employees
                        </p>

                        <p class="mt-2 text-3xl font-bold text-red-600">
                            {{ $inactiveEmployees }}
                        </p>

                        <p class="mt-3 text-sm text-gray-500">
                            Currently inactive
                        </p>

                    </div>

                </div>


                {{-- On Leave --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <p class="text-sm font-medium text-gray-500">
                            On Leave
                        </p>

                        <p class="mt-2 text-3xl font-bold text-yellow-600">
                            {{ $onLeaveEmployees }}
                        </p>

                        <p class="mt-3 text-sm text-gray-500">
                            Currently on leave
                        </p>

                    </div>

                </div>


                {{-- Departments --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <p class="text-sm font-medium text-gray-500">
                            Departments
                        </p>

                        <p class="mt-2 text-3xl font-bold text-indigo-600">
                            {{ $totalDepartments }}
                        </p>

                        <a
                            href="{{ route('departments.index') }}"
                            class="inline-block mt-3 text-sm text-indigo-600 hover:text-indigo-800"
                        >
                            View departments →
                        </a>

                    </div>

                </div>

            </div>


            {{-- Main Content --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


                {{-- Recent Employees --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <div class="flex items-center justify-between mb-5">

                            <div>

                                <h3 class="text-lg font-semibold text-gray-900">
                                    Recent Employees
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Latest employees added to the system.
                                </p>

                            </div>

                            <a
                                href="{{ route('employees.index') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-800"
                            >
                                View all
                            </a>

                        </div>


                        @if ($recentEmployees->count())

                            <div class="overflow-x-auto">

                                <table class="min-w-full">

                                    <thead>

                                        <tr class="border-b border-gray-200">

                                            <th class="py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Employee
                                            </th>

                                            <th class="py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Department
                                            </th>

                                            <th class="py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                                Status
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @foreach ($recentEmployees as $employee)

                                            <tr class="border-b border-gray-100">

                                                <td class="py-4">

                                                    <a
                                                        href="{{ route('employees.show', $employee) }}"
                                                        class="font-medium text-gray-900 hover:text-indigo-600"
                                                    >
                                                        {{ $employee->first_name }}
                                                        {{ $employee->last_name }}
                                                    </a>

                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ $employee->employee_id }}
                                                    </p>

                                                </td>


                                                <td class="py-4 text-sm text-gray-600">

                                                    {{ $employee->department->name }}

                                                </td>


                                                <td class="py-4 text-right">

                                                    @if ($employee->status === 'Active')

                                                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                            Active
                                                        </span>

                                                    @elseif ($employee->status === 'Inactive')

                                                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                            Inactive
                                                        </span>

                                                    @else

                                                        <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            On Leave
                                                        </span>

                                                    @endif

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        @else

                            <div class="py-10 text-center">

                                <p class="text-gray-500">
                                    No employees found.
                                </p>

                                <a
                                    href="{{ route('employees.create') }}"
                                    class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700"
                                >
                                    Add Employee
                                </a>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- Department Statistics --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <div class="flex items-center justify-between mb-5">

                            <div>

                                <h3 class="text-lg font-semibold text-gray-900">
                                    Employees by Department
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Employee distribution across departments.
                                </p>

                            </div>

                            <a
                                href="{{ route('departments.index') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-800"
                            >
                                Manage
                            </a>

                        </div>


                        @if ($departmentStats->count())

                            <div class="space-y-5">

                                @foreach ($departmentStats as $department)

                                    <div>

                                        <div class="flex items-center justify-between mb-2">

                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $department->name }}
                                            </span>

                                            <span class="text-sm font-semibold text-gray-900">
                                                {{ $department->employees_count }}
                                            </span>

                                        </div>


                                        @php

                                            $percentage = $totalEmployees > 0
                                                ? ($department->employees_count / $totalEmployees) * 100
                                                : 0;

                                        @endphp


                                        <div class="w-full bg-gray-200 rounded-full h-2">

                                            <div
                                                class="bg-indigo-600 h-2 rounded-full"
                                                style="width: {{ $percentage }}%"
                                            ></div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="py-10 text-center">

                                <p class="text-gray-500">
                                    No departments found.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Quick Actions --}}
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Quick Actions
                    </h3>

                    <div class="mt-4 flex flex-wrap gap-3">

                        <a
                            href="{{ route('employees.create') }}"
                            class="px-5 py-2.5 bg-indigo-600 text-white rounded-md font-semibold text-sm hover:bg-indigo-700"
                        >
                            + Add Employee
                        </a>

                        <a
                            href="{{ route('departments.create') }}"
                            class="px-5 py-2.5 bg-gray-800 text-white rounded-md font-semibold text-sm hover:bg-gray-900"
                        >
                            + Add Department
                        </a>

                        <a
                            href="{{ route('employees.index') }}"
                            class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md font-semibold text-sm hover:bg-gray-300"
                        >
                            Manage Employees
                        </a>

                        <a
                            href="{{ route('departments.index') }}"
                            class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md font-semibold text-sm hover:bg-gray-300"
                        >
                            Manage Departments
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>