<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function admin()
    {
        return $this->hasMany(Admin_Role::class);
    }

    public function permission()
    {
        return $this->hasMany(Role_Permission::class);
    }

}
