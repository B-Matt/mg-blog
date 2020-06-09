<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'perm_read', "perm_write", "perm_delete", "perm_update", "perm_users", "perm_su"
    ];
}
