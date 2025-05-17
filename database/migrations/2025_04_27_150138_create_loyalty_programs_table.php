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
    Schema::create('loyalty_programs', function (Blueprint $table) {
        $table->id();
        $table->string('program_name');
        $table->integer('points_required');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('loyalty_programs');
}

};
