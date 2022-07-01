<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration    //NB in Piotr 200 class AddPolymorphToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);
            $table->dropColumn('blog_post_id');
            $table->morphs('commentable');
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
            $table->dropMorphs('commentable');
            $table->foreign('blog_post_id')->nullable()->constrained();
        });
    }
};
