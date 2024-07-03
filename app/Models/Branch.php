<?php

namespace App\Models;

use App\Models\Contracts\JsonResourceful;
use App\Traits\HasJsonResourcefulData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Branch extends BaseModel implements HasMedia, JsonResourceful
{

    use HasFactory, InteractsWithMedia, HasJsonResourcefulData;

    public $table = 'branches';

    const JSON_API_TYPE = 'branches';

    public const PATH = 'branch_image';

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


    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(Branch::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }


    public function prepareAttributes(): array
    {
        $fields = [
            'name' => $this->name,
        ];

        return $fields;
    }

    public function prepareBranches(): array
    {
        $fields = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        return $fields;
    }

    public function prepareLinks()
    {
        return [
            'self' => route('branches.show', $this->id),
        ];
    }
}
