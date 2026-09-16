<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Department Details
            </h2>

            <a
                href="{{ route('departments.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
            >
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h3 class="text-2xl font-bold text-gray-900">
                    {{ $department->name }}
                </h3>

                <p class="mt-3 text-gray-600">
                    {{ $department->description ?? 'No description available.' }}
                </p>

                <div class="mt-6 border-t pt-6">

                    <h4 class="text-lg font-semibold">
                        Employees
                    </h4>

                    @if ($department->employees->count())

                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left">
                                            Employee ID
                                        </th>

                                        <th class="px-4 py-3 text-left">
                                            Name
                                        </th>

                                        <th class="px-4 py-3 text-left">
                                            Designation
                                        </th>

                                        <th class="px-4 py-3 text-left">
                                            Status
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">

                                    @foreach ($department->employees as $employee)
                                        <tr>

                                            <td class="px-4 py-3">
                                                {{ $employee->employee_id }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $employee->first_name }}
                                                {{ $employee->last_name }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $employee->designation }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $employee->status }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    @else

                        <p class="mt-4 text-gray-500">
                            No employees assigned to this department yet.
                        </p>

                    @endif

                </div>

            </div>

        </div>
    </div>
</x-app-layout>