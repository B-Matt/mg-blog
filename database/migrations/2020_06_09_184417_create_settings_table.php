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
            $table->string('google_tag')->nullable();
            $table->string('theme_color');
            $table->string('profile_facebook')->nullable();
            $table->string('og_img')->nullable();
            $table->string('profile_twitter')->nullable();
            $table->string('twitter_img')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert(
            array(
                'title' => 'Default Blog Name',
                'short_title' => 'Blog',
                'description' => 'Lorem ipsum anet&hellip;',
                'icon_fav' => '',
                'icon_apple' => '',
                'theme_color' => '#e6f0fc',
                'profile_facebook' => '',
                'profile_twitter' => ''
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
