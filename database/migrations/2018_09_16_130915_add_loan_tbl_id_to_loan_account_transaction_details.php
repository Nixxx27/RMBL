<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoanTblIdToLoanAccountTransactionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_account_transaction_details', function (Blueprint $table) {
            $table->integer('loan_id')->unsigned()->after('transacted_by')->nullable();
            $table->foreign('loan_id')->references('id')->on('loans_tbl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_account_transaction_details', function (Blueprint $table) {
            //
        });
    }
}
