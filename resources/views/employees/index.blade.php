<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employees
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="flex items-center justify-between mb-6">

                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Employees
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage company employees and their departments.
                    </p>
                </div>

                <a
                    href="{{ route('employees.create') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700"
                >
                    + Add Employee
                </a>

            </div>


            {{-- Success Message --}}
            @if (session('success'))

                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif


            {{-- Employee Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if ($employees->count())

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
                                        Email
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Department
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Designation
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Salary
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($employees as $employee)

                                    <tr class="hover:bg-gray-50">

                                        {{-- Employee ID --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-semibold text-gray-900">
                                                {{ $employee->employee_id }}
                                            </span>
                                        </td>


                                        {{-- Name --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $employee->first_name }}
                                                {{ $employee->last_name }}
                                            </div>

                                        </td>


                                        {{-- Email --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="text-sm text-gray-600">
                                                {{ $employee->email }}
                                            </div>

                                        </td>


                                        {{-- Department --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                {{ $employee->department->name }}
                                            </span>

                                        </td>


                                        {{-- Designation --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $employee->designation }}
                                        </td>


                                        {{-- Salary --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ number_format($employee->salary, 2) }}
                                        </td>


                                        {{-- Status --}}
                                        <td class="px-6 py-4 whitespace-nowrap">

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


                                        {{-- Actions --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">

                                            <a
                                                href="{{ route('employees.show', $employee) }}"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('employees.edit', $employee) }}"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('employees.destroy', $employee) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-red-600 hover:text-red-900"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    <div class="p-6 border-t border-gray-200">

                        {{ $employees->links() }}

                    </div>

                @else

                    {{-- Empty State --}}
                    <div class="p-12 text-center">

                        <h3 class="text-lg font-semibold text-gray-900">
                            No employees found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Add your first employee to get started.
                        </p>

                        <a
                            href="{{ route('employees.create') }}"
                            class="inline-flex mt-5 items-center px-5 py-2.5 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700"
                        >
                            + Add Employee
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>