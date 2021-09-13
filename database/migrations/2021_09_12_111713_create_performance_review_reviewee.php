<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceReviewReviewee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_review_reviewee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('performance_review_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('performance_review_id')->references('id')->on('performance_reviews');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_review_reviewee', function(Blueprint $table)
        {
            $table->dropForeign('performance_review_reviewee_user_id_foreign');
            $table->dropForeign('performance_review_reviewee_performance_review_id_foreign');
        });
        Schema::dropIfExists('performance_review_reviewee');
    }
}
