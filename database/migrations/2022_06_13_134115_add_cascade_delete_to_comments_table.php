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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);  //NB on mysql this foreign key is called a strange name but putting in [ ] we can get to it through simple name
            $table->foreign('blog_post_id')
                ->references('id')
                ->on('blog_posts')
                ->onDelete('cascade');  //i.e. deleted on the database level through cascading
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);  //NB on mysql this foreign key is called a strange name but putting in [ ] we can get to it through simple name
            $table->foreign('blog_post_id')
                ->references('id')
                ->on('blog_posts');
            });

    }
};
