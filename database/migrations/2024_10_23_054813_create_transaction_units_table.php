<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transaction_units', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code');
            $table->foreign('transaction_code')->references('transaction_code')->on('transactions')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->date('date_borrowed');
            $table->date('date_returned')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('fine', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_units');
    }
};
