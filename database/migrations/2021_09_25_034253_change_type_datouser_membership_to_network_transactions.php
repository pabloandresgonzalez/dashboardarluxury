<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeDatouserMembershipToNetworkTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('network_transactions', function (Blueprint $table) {
            DB::statement("ALTER TABLE network_transactions MODIFY userMembership bigint(20)");
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
            DB::statement("ALTER TABLE network_transactions MODIFY userMembership varchar(255)");
        });
    }
}
