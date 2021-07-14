<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('dokter_id')->constrained('users');
            $table->text('medical_number_record');
            $table->text('ktp');
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->text('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->date('date_in');
            $table->date('date_out');
            $table->text('symptoms');
            $table->text('disease');
            $table->text('stadium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
