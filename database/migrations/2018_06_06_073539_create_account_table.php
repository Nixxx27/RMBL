<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_account', function (Blueprint $table) {
            $table->increments('id');

            $table->string('acc_name')->nullable();
          
            $table->string('amount');

            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type');

            $table->date('open_date');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');

            $table->longtext('description')->nullable();
            $table->longtext('remarks')->nullable();

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
        Schema::dropIfExists('loan_account');
    }
}
