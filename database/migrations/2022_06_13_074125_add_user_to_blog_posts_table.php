<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
//            $table->unsignedBigInteger('user_id');  //must be the same type as the id column on the user table!!!!!!!!!!!!!
//            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('user_id')->foreign();
//            $table->foreignId('user_id')->constrained();  //I think this is the field to fix
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');


        });
    }
};
