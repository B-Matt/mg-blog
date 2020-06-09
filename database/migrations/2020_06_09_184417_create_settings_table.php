<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60);
            $table->string('short_title', 32);
            $table->string('description', 160);
            $table->string('icon_fav')->nullable();
            $table->string('icon_apple')->nullable();
            $table->string('theme_color');
            $table->timestamps();
        });

        DB::table('settings')->insert(
            array(
                'title' => 'Default Blog Name',
                'short_title' => '&bull; Blog',
                'description' => 'Lorem ipsum anet...',
                'icon_fav' => '',
                'icon_apple' => '',
                'theme_color' => '#e6f0fc'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
