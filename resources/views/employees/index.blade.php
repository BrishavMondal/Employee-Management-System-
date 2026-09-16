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
                        Manage company employees.
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


            {{-- Search and Filters --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">

                <form
                    method="GET"
                    action="{{ route('employees.index') }}"
                >

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        {{-- Search --}}
                        <div class="md:col-span-2">

                            <label
                                for="search"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Search
                            </label>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Employee ID, name, email, phone..."
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                        </div>


                        {{-- Department --}}
                        <div>

                            <label
                                for="department_id"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Department
                            </label>

                            <select
                                id="department_id"
                                name="department_id"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="">
                                    All Departments
                                </option>

                                @foreach ($departments as $department)

                                    <option
                                        value="{{ $department->id }}"
                                        {{ request('department_id') == $department->id ? 'selected' : '' }}
                                    >
                                        {{ $department->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="">
                                    All Statuses
                                </option>

                                <option
                                    value="Active"
                                    {{ request('status') === 'Active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="Inactive"
                                    {{ request('status') === 'Inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                                <option
                                    value="On Leave"
                                    {{ request('status') === 'On Leave' ? 'selected' : '' }}
                                >
                                    On Leave
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="mt-4 flex gap-3">

                        <button
                            type="submit"
                            class="px-5 py-2.5 bg-indigo-600 text-white rounded-md font-semibold text-sm hover:bg-indigo-700"
                        >
                            Search / Filter
                        </button>

                        <a
                            href="{{ route('employees.index') }}"
                            class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md font-semibold text-sm hover:bg-gray-300"
                        >
                            Clear
                        </a>

                    </div>

                </form>

            </div>


            {{-- Employee Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if ($employees->count())

                    <div class="px-6 py-4 border-b border-gray-200">

                        <p class="text-sm text-gray-600">

                            Showing
                            <strong>{{ $employees->firstItem() }}</strong>
                            to
                            <strong>{{ $employees->lastItem() }}</strong>
                            of
                            <strong>{{ $employees->total() }}</strong>
                            employees

                        </p>

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
                                        Email
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Department
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Designation
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

                    <div class="p-12 text-center">

                        <h3 class="text-lg font-semibold text-gray-900">
                            No employees found
                        </h3>

                        @if (request()->hasAny(['search', 'department_id', 'status']))

                            <p class="mt-2 text-sm text-gray-500">
                                No employees match your current search or filters.
                            </p>

                            <a
                                href="{{ route('employees.index') }}"
                                class="inline-flex mt-5 px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md font-semibold text-sm hover:bg-gray-300"
                            >
                                Clear Filters
                            </a>

                        @else

                            <p class="mt-2 text-sm text-gray-500">
                                Add your first employee to get started.
                            </p>

                            <a
                                href="{{ route('employees.create') }}"
                                class="inline-flex mt-5 px-5 py-2.5 bg-indigo-600 text-white rounded-md font-semibold text-sm hover:bg-indigo-700"
                            >
                                + Add Employee
                            </a>

                        @endif

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>