<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. 
     */
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title');
            $table->text('description');
            $table->foreignId('position_id')->constrained();
            $table->text('responsibilities');
            $table->text('requirements');
            $table->string('type');
            $table->date('start_date');
            $table->date('end_date'); 
            $table->float('min_salary');
            $table->float('max_salary');
            $table->enum('status', ['Active', 'Draft', 'Cancelled', 'Done'])->default('Draft');
            $table->boolean('is_archive')->default(false);
            $table->integer('max_pax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
