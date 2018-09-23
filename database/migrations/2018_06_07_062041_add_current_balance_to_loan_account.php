<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrentBalanceToLoanAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_account', function (Blueprint $table) {
            
            $table->integer('assigned_to')->unsigned()->after('open_date')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users');

           $table->string('current_balance')->after('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_account', function (Blueprint $table) {
            //
        });
    }
}
