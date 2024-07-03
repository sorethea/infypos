<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Repositories\BaseRepository;

class BranchRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'address',
        'location',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Branch::class;
    }
}
