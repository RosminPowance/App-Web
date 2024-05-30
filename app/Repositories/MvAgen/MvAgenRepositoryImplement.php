<?php

namespace App\Repositories\MvAgen;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MvAgen;

class MvAgenRepositoryImplement extends Eloquent implements MvAgenRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(MvAgen $model)
    {
        $this->model = $model;
    }

    /**
     * Fin an item by id
     * @param mixed $id
     * @return Model|null
     */
    public function find($id)
    {
    }

    /**
     * find or fail
     * @param mixed $id
     * @return mixed
     */
    public function findOrFail($id)
    {
    }

    /** 
     * Return all items
     * @return Collection|null
     */
    public function all()
    {
        $LVL = func_num_args() > 0 ? func_get_arg(0) : null;
        $builder = $this->model;
        if ($LVL === 0 || $LVL)
        {
            $builder = $builder->where('LVL', '=', $LVL);
        }

        return $builder->get();
    }

    /**
     * Create an item
     * @param array|mixed $data
     * @return Model|null
     */
    public function create($data)
    {
    }

    /**
     * Update a model
     * @param int|mixed $id
     * @param array|mixed $data
     * @return bool|mixed
     */
    public function update($id, array $data)
    {
    }

    /**
     * Delete a model
     * @param int|Model $id
     */
    public function delete($id)
    {
    }

    /**
     * multiple delete
     * @param array $id
     * @return mixed
     */
    public function destroy(array $id)
    {
    }
}
