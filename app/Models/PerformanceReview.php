<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'reviewer_id',
        'status',
        'feedback'
    ];

    /*
     * Get reviewer that owns the performance review
     *
     */
    public function reviewer(){
        return $this->belongsTo(User::class);
    }


    /*
     * get users that assigned as performance reviews
     */
    public function reviewees(){
        return $this->belongsToMany(User::class,'performance_review_reviewee','performance_review_id','user_id');
    }
}
