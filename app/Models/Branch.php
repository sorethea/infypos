<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends BaseModel
{
    public $table = 'branches';

    public $fillable = [
        'name',
        'address',
        'location',
        'description'
    ];

    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'location' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'name' => 'required',
        'address' => 'required',
        'location' => 'required',
        'description' => 'nullable'
    ];


}
