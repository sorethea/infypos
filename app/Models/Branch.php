<?php

namespace App\Models;

use App\Models\Contracts\JsonResourceful;
use Illuminate\Database\Eloquent\Model;

class Branch extends BaseModel implements JsonResourceful
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


    public function getResourceType()
    {
        // TODO: Implement getResourceType() method.
    }

    public function prepareData()
    {
        // TODO: Implement prepareData() method.
    }

    public function prepareIncluded()
    {
        // TODO: Implement prepareIncluded() method.
    }

    public function prepareLinks()
    {
        // TODO: Implement prepareLinks() method.
    }

    public function prepareAttributes()
    {
        // TODO: Implement prepareAttributes() method.
    }

    public function asJsonResource()
    {
        // TODO: Implement asJsonResource() method.
    }

    public function asJsonResourceWithRelationships()
    {
        // TODO: Implement asJsonResourceWithRelationships() method.
    }
}
