<?php

// In the migration file
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('control_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('control_settings');
    }
}
