<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->nullable();
            $table->integer('doctor_id')
                ->unsigned()
                ->nullable();
            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors')
                ->onUpdate('NO ACTION')
                ->nullable();
            $table->string('name')->nullable();
            $table->text('reason')->nullable();
            $table->mediumInteger('age')->nullable();
            $table->enum('gender',["F","M"])->comment('F-Female, M-Male')->nullable();
            $table->timestamp('appointment_time')->nullable();
            $table->enum('status',["REQUEST","ACCEPTED","CANCELLED"])->nullable();
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
        Schema::dropIfExists('patient_appointments');
    }
}
