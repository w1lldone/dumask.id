<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->index();
            $table->foreignId('reporter_id')->index();
            $table->string('user_latitude')->nullable();
            $table->string('user_longitude')->nullable();
            $table->string('condition')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolver_id')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
