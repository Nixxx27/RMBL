<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_tbl', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('borrower_id')->unsigned();
            $table->foreign('borrower_id')->references('id')->on('borrowers_tbl');

            $table->date('start_date');
            $table->string('amount');
            $table->string('terms');
            $table->string('rate');
            $table->string('sched');

            $table->integer('collector_id')->unsigned();
            $table->foreign('collector_id')->references('id')->on('users');

            $table->longtext('remarks')->nullable();

            $table->string('status')->default('open');

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
        Schema::dropIfExists('loans_tbl');
    }
}
