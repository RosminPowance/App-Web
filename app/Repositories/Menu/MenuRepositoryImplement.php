<?php

namespace App\Repositories\Menu;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MMenuAplikasi;
use Closure;

class MenuRepositoryImplement extends Eloquent implements MenuRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(MMenuAplikasi $model)
    {
        $this->model = $model;
    }

    
    public function find($id) { }

    public function findOrFail($id) { }

    public function all() {
        return $this->model->allWithClosure();
    }
    public function allWithClosure(?Closure $closure) {
        if ($closure) {
            return $closure($this->model)->get();
        }
        return $this->model->all();
    }

    public function create($data) { }

    public function update($id, array $data) { }

    public function delete($id) { }

    public function destroy(array $id) { }

    // Write something awesome :)
}
