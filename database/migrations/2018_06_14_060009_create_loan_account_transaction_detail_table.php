<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanAccountTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_account_transaction_details', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('loan_account_id')->unsigned();
            $table->foreign('loan_account_id')->references('id')->on('loan_account');

            $table->string('is_income'); // 1 = Yes, 0 = No
            $table->string('details')->nullable();
            
            $table->integer('transacted_by')->unsigned();
            $table->foreign('transacted_by')->references('id')->on('users');

            $table->longtext('remarks')->nullable();

            $table->string('amount')->nullable();

            
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
        Schema::dropIfExists('loan_account_transaction_details');
    }
}
