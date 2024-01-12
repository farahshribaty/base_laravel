<?php

namespace App\Interfaces;

use App\Interfaces\base\BaseInterface;

interface CategoryInterface extends BaseInterface {

    // public function getAllCategoryForDashboard(int $perPage = 8, $search = null);
    public function getAllCategoryForDashboard(int $perPage = 8, $search = null);
    public function getAllCategory(int $perPage ) ;
}