<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorNotedBooksTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_noted_books', function (Blueprint $table) {
            $table->id();  // auto-incrementing ID
            $table->date('date');  // date for the note
            $table->unsignedBigInteger('doctor_id');  // foreign key to doctors table
            $table->unsignedBigInteger('patient_id');  // foreign key to patients table
            $table->text('description');  // description of the note
            $table->timestamps();  // created_at and updated_at timestamps

            // Foreign key relationships
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctor_noted_books');
    }
}
