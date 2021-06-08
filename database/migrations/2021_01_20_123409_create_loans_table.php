<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loanable_type')->nullable();
            $table->integer('loanable_id')->nullable();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('jurisdiction_address');
            $table->string('actual_address');
            $table->string('job');
            $table->string('job_address');
            $table->string('job_phone');
            $table->string('income');
            $table->string('additional_income');
            $table->string('liabilities');
            $table->string('family_full_name');
            $table->string('family_phone');
            $table->string('family_1_full_name');
            $table->string('family_2_phone');
            $table->string('employee_full_name');
            $table->string('employee_phone');
            $table->string('friend_full_name');
            $table->string('friend_phone');
            $table->integer('payment_day');
            $table->integer('month_total');
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
        Schema::dropIfExists('loans');
    }
}
