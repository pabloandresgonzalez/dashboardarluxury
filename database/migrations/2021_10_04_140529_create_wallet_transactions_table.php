<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('user');
            $table->double('value');            
            $table->double('fee');
            $table->string('type');
            $table->string('hash');
            $table->char('currency', 36)->nullable();
            $table->char('approvedBy', 36);
            $table->boolean('inOut');
            $table->string('status');
            $table->string('detail');
            
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
        Schema::dropIfExists('wallet_transactions');
    }
}
