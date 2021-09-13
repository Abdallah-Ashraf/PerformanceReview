<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name',500);
            $table->text('description');
            $table->text('feedback')->nullable();
            $table->enum('status',['Open','Closed'])->default('Open');
            $table->unsignedBigInteger('reviewer_id');
            $table->foreign('reviewer_id')->references('id')->on('users');
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
        Schema::table('performance_reviews', function(Blueprint $table)
        {
            $table->dropForeign('performance_reviews_reviewer_id_foreign');
        });
        Schema::dropIfExists('performance_reviews');

    }
}
