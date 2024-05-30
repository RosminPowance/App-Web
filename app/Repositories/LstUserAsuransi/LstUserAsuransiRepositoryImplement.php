<?php

namespace App\Repositories\LstUserAsuransi;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\LstUserAsuransi;

class LstUserAsuransiRepositoryImplement extends Eloquent implements LstUserAsuransiRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(LstUserAsuransi $model)
    {
        $this->model = $model;
    }

    public function findByNikAndPassId($nik, $passId) {
        return ($this->model->where('nik', $nik)->where('pass_id', $passId)->first());
     }

    public function find($id) { }

    public function findOrFail($id) { }

    public function all() { }

    public function create($data) { }

    public function update($id, array $data) { }

    public function delete($id) { }

    public function destroy(array $id) { }

    
}
