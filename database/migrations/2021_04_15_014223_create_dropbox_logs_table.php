<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropboxLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropbox_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dropbox_id')->index();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('activity')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('final_weight')->nullable();
            $table->timestamp('deployed_at')->nullable();
            $table->timestamp('replaced_at')->nullable();
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
        Schema::dropIfExists('dropbox_logs');
    }
}
