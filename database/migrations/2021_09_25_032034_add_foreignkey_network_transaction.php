<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyNetworkTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('network_transactions', function (Blueprint $table) {
            
            $table->foreign("user")->references("id")->on("users");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('network_transactions', function (Blueprint $table) {

            $table->dropForeign('network_transactions_user_foreign');
            
        });
    }
}
