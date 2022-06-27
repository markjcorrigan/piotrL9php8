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
//        Schema::table('comments', function (Blueprint $table) {
//            Schema::table('blog_posts', function (Blueprint $table) {
//                $table->unsignedBigInteger('user_id')->foreign();
//                $table->foreign('user_id')->references('id')->on('users');
//            });
//        });
        Schema::table('comments', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');


            $table->foreign('user_id')
                ->references('id')->on('users');
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
