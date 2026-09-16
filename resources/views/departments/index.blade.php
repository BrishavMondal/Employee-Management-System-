<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Departments
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="flex items-center justify-between mb-6">

                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Departments
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage company departments and their employees.
                    </p>
                </div>

                <a
                    href="{{ route('departments.create') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                >
                    + Add Department
                </a>

            </div>


            {{-- Success Message --}}
            @if (session('success'))

                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif


            {{-- Error Message --}}
            @if (session('error'))

                <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>

            @endif


            {{-- Department Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if ($departments->count())

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>

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

                                @foreach ($departments as $department)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $department->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $department->name }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="text-sm text-gray-600">
                                                {{ $department->description ?? 'No description' }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $department->employees_count }}
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

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    <div class="p-6 border-t border-gray-200">

                        {{ $departments->links() }}

                    </div>

                @else

                    {{-- Empty State --}}
                    <div class="p-12 text-center">

                        <h3 class="text-lg font-semibold text-gray-900">
                            No departments found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Create your first department to get started.
                        </p>

                        <a
                            href="{{ route('departments.create') }}"
                            class="inline-flex mt-5 items-center px-5 py-2.5 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-700"
                        >
                            + Add Department
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>