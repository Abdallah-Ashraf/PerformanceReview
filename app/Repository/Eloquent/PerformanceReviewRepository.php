<?php

namespace App\Repository\Eloquent;

use App\Models\PerformanceReview;
use App\Repository\PerformanceReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PerformanceReviewRepository extends BaseRepository implements PerformanceReviewRepositoryInterface
{
    /**
     * PerformanceReviewRepository constructor.
     *
     * @param PerformanceReview $model
     */
    public function __construct(PerformanceReview $model)
    {
        parent::__construct($model);
    }


    public function create(array $attributes): Model
    {
        $review = $this->model->create($attributes);
        $review->reviewees()->sync($attributes['reviewee']);
        return $review;
    }

    public function update(int $id, array $attributes): int
    {
        $model = $this->model->find($id);
        if(!isset($attributes['status'])){
            $model->reviewees()->sync($attributes['reviewee']);
        }
        return $model->update($attributes);
    }

    /*
     * @param int
     * @return bool
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->reviewees()->sync([]);
        return $this->model->destroy($id);
    }
}
