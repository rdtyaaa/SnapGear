<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('transaction_units', function (Blueprint $table) {
        $table->date('return_agreement')->nullable()->after('date_borrowed');
    });
}

public function down()
{
    Schema::table('transaction_units', function (Blueprint $table) {
        $table->dropColumn('return_agreement');
    });
}

};
