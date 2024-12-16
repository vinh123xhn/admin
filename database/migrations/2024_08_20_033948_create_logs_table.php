<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('server_id')->index();
            $table->string('role_name')->nullable();
            $table->integer('role_power')->default(0)->index();
            $table->integer('role_level')->default(0)->index();
            $table->integer('role_id')->default(0)->index();
            $table->integer('role_vip')->default(0);
            $table->integer('role_professional')->default(0);
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
        Schema::dropIfExists('logs');
    }
}
