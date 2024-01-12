<?php

namespace App\Interfaces\base;

use Illuminate\Database\Eloquent\Model;

interface BaseInterface {
    public function create($data);

    public function edit(int $id, $data);

    public function delete(int $id);

    public function getAll($is_pagination, int $perPage = 8, $search = null);

    public function updateStatus(int $id, bool $newStatus, $status_column_name);

    public function getOne(int $id);

    public function getOneWithRelations(int $id);

}
