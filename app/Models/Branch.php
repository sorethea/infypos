<?php

namespace App\Models;

use App\Models\Contracts\JsonResourceful;
use App\Traits\HasJsonResourcefulData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Branch extends BaseModel implements JsonResourceful
{

    use HasFactory, HasJsonResourcefulData;

    public $table = 'branches';

    const JSON_API_TYPE = 'branches';


    public $fillable = [
        'brand_id',
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
        'brand_id' => 'required|exists:brands,id',
        'name' => 'required',
        'address' => 'required',
        'location' => 'required',
        'description' => 'nullable',
    ];


    public function prepareAttributes(): array
    {
        $fields = [
            'name' => $this->name,
            'address' => $this->address,
            'location' => $this->location,
        ];

        return $fields;
    }

    public function prepareBranches(): array
    {
        $fields = [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'location' => $this->location,
            'brand_name' => $this->brand->name,
        ];

        return $fields;
    }

    public function prepareLinks()
    {
        return [
            'self' => route('branches.show', $this->id),
        ];
    }

    public function brand(): BelongsTo{
        return $this->belongsTo(Brand::class);
    }
}
