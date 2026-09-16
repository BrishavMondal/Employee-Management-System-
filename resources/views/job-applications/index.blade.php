<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Job Applications') }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage recruitment applications and candidate status.
                </p>
            </div>

            <a
                href="{{ route('job-applications.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800
                       border border-transparent rounded-md font-semibold
                       text-xs text-white uppercase tracking-widest
                       hover:bg-gray-700"
            >
                + Add Application
            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))

                <div class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif

            {{-- Search & Filter --}}
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">

                <div class="p-6">

                    <form
                        method="GET"
                        action="{{ route('job-applications.index') }}"
                        class="grid grid-cols-1 md:grid-cols-4 gap-4"
                    >

                        <div class="md:col-span-2">

                            <label
                                for="search"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Search
                            </label>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Position, employee ID, name or email"
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                        </div>

                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="mt-1 block w-full rounded-md border-gray-300
                                       shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                                <option value="">All Statuses</option>

                                @foreach ([
                                    'Applied',
                                    'Shortlisted',
                                    'Interview',
                                    'Selected',
                                    'Rejected'
                                ] as $status)

                                    <option
                                        value="{{ $status }}"
                                        @selected(request('status') === $status)
                                    >
                                        {{ $status }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="flex items-end gap-2">

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white
                                       rounded-md text-sm font-medium
                                       hover:bg-gray-700"
                            >
                                Search
                            </button>

                            <a
                                href="{{ route('job-applications.index') }}"
                                class="px-4 py-2 border border-gray-300
                                       rounded-md text-sm font-medium
                                       text-gray-700 hover:bg-gray-50"
                            >
                                Clear
                            </a>

                        </div>

                    </form>

                </div>

            </div>

            {{-- Applications Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs
                                               font-medium text-gray-500
                                               uppercase tracking-wider">
                                        Employee
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs
                                               font-medium text-gray-500
                                               uppercase tracking-wider">
                                        Position
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs
                                               font-medium text-gray-500
                                               uppercase tracking-wider">
                                        Application Date
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs
                                               font-medium text-gray-500
                                               uppercase tracking-wider">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs
                                               font-medium text-gray-500
                                               uppercase tracking-wider">
                                        Actions
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @forelse ($applications as $application)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4">

                                            <div class="font-medium text-gray-900">
                                                {{ $application->employee->first_name }}
                                                {{ $application->employee->last_name }}
                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $application->employee->employee_id }}
                                            </div>

                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $application->position }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $application->application_date->format('d M Y') }}
                                        </td>

                                        <td class="px-6 py-4">

                                            @php
                                                $statusClasses = [
                                                    'Applied' => 'bg-gray-100 text-gray-800',
                                                    'Shortlisted' => 'bg-blue-100 text-blue-800',
                                                    'Interview' => 'bg-yellow-100 text-yellow-800',
                                                    'Selected' => 'bg-green-100 text-green-800',
                                                    'Rejected' => 'bg-red-100 text-red-800',
                                                ];
                                            @endphp

                                            <span
                                                class="inline-flex px-2.5 py-0.5
                                                       rounded-full text-xs font-medium
                                                       {{ $statusClasses[$application->status] ?? 'bg-gray-100 text-gray-800' }}"
                                            >
                                                {{ $application->status }}
                                            </span>

                                        </td>

                                        <td class="px-6 py-4 text-right text-sm">

                                            <a
                                                href="{{ route('job-applications.show', $application) }}"
                                                class="text-blue-600 hover:text-blue-900 mr-4"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('job-applications.edit', $application) }}"
                                                class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('job-applications.destroy', $application) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this application?');"
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
                                            colspan="5"
                                            class="px-6 py-12 text-center text-gray-500"
                                        >

                                            <div class="text-lg font-medium">
                                                No job applications found
                                            </div>

                                            <p class="mt-1 text-sm">
                                                Add your first recruitment application.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    @if ($applications->hasPages())

                        <div class="mt-6">
                            {{ $applications->links() }}
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>