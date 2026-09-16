<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('position', 150);
            $table->date('application_date');
            $table->string('status', 50)->default('Applied');
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('position');
            $table->index('status');
            $table->index('application_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};