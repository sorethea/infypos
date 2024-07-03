<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Models\Brand;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class BranchRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'address',
        'location',
        'created_at',
    ];

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'name',
        'address',
        'location',
        'description',
    ];


    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Branch::class;
    }

    public function storeBranch($input)
    {
        try {
            DB::beginTransaction();
            $branch = $this->create($input);
            if (isset($input['image']) && $input['image']) {
                $media = $branch->addMedia($input['image'])->toMediaCollection(Branch::PATH,
                    config('app.media_disc'));
            }
            DB::commit();

            return $branch;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updateBranch($input, $id)
    {
        try {
            DB::beginTransaction();
            $branch = $this->update($input, $id);
            if (isset($input['image']) && $input['image']) {
                $branch->clearMediaCollection(Branch::PATH);
                $branch['image_url'] = $branch->addMedia($input['image'])->toMediaCollection(Branch::PATH,
                    config('app.media_disc'));
            }
            DB::commit();

            return $branch;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

}
