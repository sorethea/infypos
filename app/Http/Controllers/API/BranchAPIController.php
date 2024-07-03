<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBranchAPIRequest;
use App\Http\Requests\API\UpdateBranchAPIRequest;
use App\Http\Resources\BranchCollection;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Repositories\BranchRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class BranchAPIController
 */
class BranchAPIController extends AppBaseController
{
    private BranchRepository $branchRepository;

    public function __construct(BranchRepository $branchRepo)
    {
        $this->branchRepository = $branchRepo;
    }

    /**
     * Display a listing of the Branches.
     * GET|HEAD /branches
     */
    public function index(Request $request): BranchCollection
    {

        $perPage = getPageSize($request);

        $branches = $this->branchRepository->paginate($perPage);

        BranchResource::usingWithCollection();

        return new BranchCollection($branches);
    }

    /**
     * Store a newly created Branch in storage.
     * POST /branches
     */
    public function store(CreateBranchAPIRequest $request): BranchResource
    {
        $input = $request->all();

        $branch = $this->branchRepository->storeBranch($input);
        BranchResource::usingWithCollection();

        return new BranchResource($branch);
    }

    /**
     * Display the specified Branch.
     * GET|HEAD /branches/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Branch $branch */
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            return $this->sendError('Branch not found');
        }

        return $this->sendResponse($branch->toArray(), 'Branch retrieved successfully');
    }

    /**
     * Update the specified Branch in storage.
     * PUT/PATCH /branches/{id}
     */
    public function update($id, UpdateBranchAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Branch $branch */
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            return $this->sendError('Branch not found');
        }

        $branch = $this->branchRepository->update($input, $id);

        return $this->sendResponse($branch->toArray(), 'Branch updated successfully');
    }

    /**
     * Remove the specified Branch from storage.
     * DELETE /branches/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Branch $branch */
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            return $this->sendError('Branch not found');
        }

        $branch->delete();

        return $this->sendSuccess('Branch deleted successfully');
    }
}
