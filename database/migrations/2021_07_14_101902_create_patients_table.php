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
            $table->foreignId('dokter_id')->constrained('users');
            $table->text('name');
            $table->text('medical_number_record');
            $table->text('ktp');
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->text('birth_place');
            $table->date('birth_date');
            $table->text('address');

            $table->text('length_of_stay'); // lama inap
            $table->enum('stadium_type', ['Dini', 'Lanjut']); // jenis stadium
            $table->integer('tumor_size'); // ukuran tumor
            $table->enum('treatment_type', ['KEMOTERAPI', 'RADIOTERAPI']); // jenis pengobatan
            $table->enum('status', ['HIDUP', 'MENINGGAL']);

            $table->boolean('icu_indikator')->nullable()->default(false); // masuk ruang icu atau tidak
            $table->integer('icu_los')->nullable(); //  berapa lama masuk ruang icu
            $table->integer('vent_hour')->nullable();

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
