<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRefNumMaturityToLoanTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans_tbl', function (Blueprint $table) {
            $table->string('ref_num')->after('id')->nullable();
            $table->date('maturity')->after('start_date')->nullable();
            $table->string('total_loan')->after('amount')->nullable();
            $table->string('balance')->after('total_loan')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans_tbl', function (Blueprint $table) {
            //
        });
    }
}
