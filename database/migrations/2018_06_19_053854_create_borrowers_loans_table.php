<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowersLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowers_loans', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans_tbl');

            $table->integer('collected_by')->unsigned()->nullable();
            $table->foreign('collected_by')->references('id')->on('users');

            $table->date('due_date')->nullable();
            $table->string('due_amount')->nullable();

            $table->date('date_of_payment')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('balance')->nullable();

            $table->string('payee_name')->nullable();

            $table->longtext('remarks')->nullable();

            $table->string('status')->default('unpaid');
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
        Schema::dropIfExists('borrowers_loans');
    }
}
