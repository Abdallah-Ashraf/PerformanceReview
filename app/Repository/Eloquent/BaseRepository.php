<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }


    /**
     * @param array $attributes
     * @param int $id
     *
     * @return Model
     */
    public function update(int $id,array $attributes): int
    {
        $model = $this->model->find($id);
        return $model->update($attributes);
    }

    /**
     * @param $id
     * @param $with
     * @return Model
     */
    public function find($id,$with=[]): ?Model
    {
        if(count($with) > 0){
            $query = $this->model->with($with)->find($id);
        }else{
            $query = $this->model->find($id);
        }
        return $query;
    }


    /**
     * @param array $with
     * @return Collection
     */
    public function all($with=[]): Collection
    {
        $query = $this->model->latest();
        if(count($with) > 0){
            $query->with($with);
        }
        return $query->get();
    }

    /*
     * @param $count
     */
    public function paginate($count,$where=[],$with=[])
    {
        $query=$this->model->latest();
        if(count($where)>0){
            $query->where($where);
        }
        if(count($with) > 0){
            $query->with($with);
        }
        return $query->paginate($count);
    }

    /*
     * @param int
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
