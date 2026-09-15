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

            $table->string('applicant_name', 150);
            $table->string('email', 150);
            $table->string('phone', 20)->nullable();

            $table->string('position', 150);

            $table->date('application_date');

            $table->enum('status', [
                'Pending',
                'Shortlisted',
                'Interview',
                'Selected',
                'Rejected'
            ])->default('Pending');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};