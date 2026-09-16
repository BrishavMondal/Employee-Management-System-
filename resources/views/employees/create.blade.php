<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Employee
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">

                    <h1 class="text-2xl font-bold text-gray-900">
                        Create Employee
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Enter the employee's information below.
                    </p>

                </div>


                {{-- Validation Summary --}}
                @if ($errors->any())

                    <div class="mb-6 p-4 bg-red-100 border border-red-200 rounded-lg">

                        <h3 class="font-semibold text-red-800">
                            Please correct the following errors:
                        </h3>

                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('employees.store') }}"
                    method="POST"
                >

                    @csrf


                    {{-- Department --}}
                    <div class="mb-6">

                        <label
                            for="department_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Department
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="department_id"
                            name="department_id"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="">
                                Select Department
                            </option>

                            @foreach ($departments as $department)

                                <option
                                    value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}
                                >
                                    {{ $department->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('department_id')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Employee ID --}}
                    <div class="mb-6">

                        <label
                            for="employee_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Employee ID
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="employee_id"
                            name="employee_id"
                            type="text"
                            value="{{ old('employee_id') }}"
                            required
                            maxlength="20"
                            placeholder="EMP-001"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('employee_id')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Name --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div>

                            <label
                                for="first_name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                First Name
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="first_name"
                                name="first_name"
                                type="text"
                                value="{{ old('first_name') }}"
                                required
                                maxlength="100"
                                placeholder="John"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('first_name')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <div>

                            <label
                                for="last_name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Last Name
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                value="{{ old('last_name') }}"
                                required
                                maxlength="100"
                                placeholder="Doe"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('last_name')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Email + Phone --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div>

                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Email
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                maxlength="150"
                                placeholder="john@example.com"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('email')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <div>

                            <label
                                for="phone"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Phone
                            </label>

                            <input
                                id="phone"
                                name="phone"
                                type="text"
                                value="{{ old('phone') }}"
                                maxlength="20"
                                placeholder="017XXXXXXXX"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('phone')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Date of Birth + Gender --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div>

                            <label
                                for="date_of_birth"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Date of Birth
                            </label>

                            <input
                                id="date_of_birth"
                                name="date_of_birth"
                                type="date"
                                value="{{ old('date_of_birth') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('date_of_birth')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <div>

                            <label
                                for="gender"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Gender
                            </label>

                            <select
                                id="gender"
                                name="gender"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="">
                                    Select Gender
                                </option>

                                <option
                                    value="Male"
                                    {{ old('gender') === 'Male' ? 'selected' : '' }}
                                >
                                    Male
                                </option>

                                <option
                                    value="Female"
                                    {{ old('gender') === 'Female' ? 'selected' : '' }}
                                >
                                    Female
                                </option>

                                <option
                                    value="Other"
                                    {{ old('gender') === 'Other' ? 'selected' : '' }}
                                >
                                    Other
                                </option>

                            </select>

                            @error('gender')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Designation --}}
                    <div class="mb-6">

                        <label
                            for="designation"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Designation
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="designation"
                            name="designation"
                            type="text"
                            value="{{ old('designation') }}"
                            required
                            maxlength="100"
                            placeholder="Software Engineer"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('designation')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Salary + Hire Date --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div>

                            <label
                                for="salary"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Salary
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="salary"
                                name="salary"
                                type="number"
                                step="0.01"
                                min="0"
                                value="{{ old('salary') }}"
                                required
                                placeholder="50000.00"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('salary')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <div>

                            <label
                                for="hire_date"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Hire Date
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="hire_date"
                                name="hire_date"
                                type="date"
                                value="{{ old('hire_date') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('hire_date')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="mb-6">

                        <label
                            for="status"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Status
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option
                                value="Active"
                                {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="Inactive"
                                {{ old('status') === 'Inactive' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                            <option
                                value="On Leave"
                                {{ old('status') === 'On Leave' ? 'selected' : '' }}
                            >
                                On Leave
                            </option>

                        </select>

                        @error('status')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Address --}}
                    <div class="mb-6">

                        <label
                            for="address"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="4"
                            maxlength="2000"
                            placeholder="Employee address..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('address') }}</textarea>

                        @error('address')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Buttons --}}
                    <div class="flex items-center gap-3">

                        <button
                            type="submit"
                            class="px-6 py-2.5 bg-indigo-600 text-white rounded-md font-semibold text-sm hover:bg-indigo-700"
                        >
                            Create Employee
                        </button>

                        <a
                            href="{{ route('employees.index') }}"
                            class="px-6 py-2.5 bg-gray-200 text-gray-800 rounded-md font-semibold text-sm hover:bg-gray-300"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>