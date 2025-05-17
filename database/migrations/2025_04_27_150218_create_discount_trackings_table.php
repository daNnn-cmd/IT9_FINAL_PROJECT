<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('discount_trackings', function (Blueprint $table) {
        $table->id();
        $table->decimal('discount_percentage', 5, 2);
        $table->date('valid_from');
        $table->date('valid_to');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('discount_trackings');
}

};
