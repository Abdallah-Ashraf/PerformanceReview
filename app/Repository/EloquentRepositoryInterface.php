<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;


    /**
     * @param array $attributes
     * @param int $id
     * @return Boolean
     */
    public function update(int $id,array $attributes): int;

    /**
     * @param $id
     * @param $with
     * @return Model
     */
    public function find($id,$with=[]): ?Model;



    /*
     * @param $id
     * @return Bool
     */
    public function delete($id);


    /**
     * @param $id
     * @param $with
     * @param $where
     */
    public function paginate($count,$where,$with);

    /*
     * @param $with
     * @return Collection
     */
    public function all($with): Collection;
}
