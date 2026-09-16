<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Departments') }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage company departments and employee assignments.
                </p>
            </div>

            <a
                href="{{ route('departments.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent
                       rounded-md font-semibold text-xs text-white uppercase tracking-widest
                       hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900
                       focus:outline-none focus:ring-2 focus:ring-indigo-500
                       focus:ring-offset-2 transition ease-in-out duration-150"
            >
                + Add Department
            </a>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Department
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Employees
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @forelse ($departments as $department)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="font-semibold text-gray-900">
                                                {{ $department->name }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="text-sm text-gray-600 max-w-md">
                                                {{ $department->description ?: 'No description' }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full
                                                         text-xs font-medium bg-blue-100 text-blue-800">

                                                {{ $department->employees_count }}

                                                {{ $department->employees_count === 1 ? 'Employee' : 'Employees' }}

                                            </span>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">

                                            <a
                                                href="{{ route('departments.show', $department) }}"
                                                class="text-blue-600 hover:text-blue-900 mr-4"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('departments.edit', $department) }}"
                                                class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('departments.destroy', $department) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this department?');"
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

                                @empty

                                    <tr>

                                        <td
                                            colspan="4"
                                            class="px-6 py-12 text-center"
                                        >

                                            <div class="text-gray-500">

                                                <div class="text-lg font-medium">
                                                    No departments found
                                                </div>

                                                <p class="mt-1 text-sm">
                                                    Create your first department to get started.
                                                </p>

                                                <a
                                                    href="{{ route('departments.create') }}"
                                                    class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium"
                                                >
                                                    + Add Department
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    @if ($departments->hasPages())

                        <div class="mt-6">
                            {{ $departments->links() }}
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>