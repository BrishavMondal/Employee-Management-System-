<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('department_id')
                ->constrained('departments')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('employee_id', 20)->unique();

            $table->string('first_name', 100);
            $table->string('last_name', 100);

            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();

            $table->date('date_of_birth')->nullable();

            $table->enum('gender', [
                'Male',
                'Female',
                'Other'
            ])->nullable();

            $table->string('designation', 100);

            $table->decimal('salary', 12, 2);

            $table->date('hire_date');

            $table->enum('status', [
                'Active',
                'Inactive',
                'On Leave'
            ])->default('Active');

            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};