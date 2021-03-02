<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments__comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');

            $table->string('commenter_id')->nullable();
            $table->string('commenter_type')->nullable();
            $table->index(["commenter_id", "commenter_type"]);

            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();

            $table->string("commentable_type");
            $table->string("commentable_id");
            $table->index(["commentable_type", "commentable_id"]);

            $table->text('comment');
            $table->text('options')->nullable();

            $table->boolean('approved')->default(true);

            $table->unsignedBigInteger('child_id')->nullable();
            $table->foreign('child_id')->references('id')->on('comments__comments')->onDelete('cascade');
            $table->integer('user_id')->nullable();
            // Your fields
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
        Schema::dropIfExists('comments__comments');
    }
}
