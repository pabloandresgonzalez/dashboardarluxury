<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworkTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('user');
            $table->double('value');
            $table->double('fee');
            $table->string('type');
            $table->string('userMembership');
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
        Schema::dropIfExists('network_transactions');
    }
}
