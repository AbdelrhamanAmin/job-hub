<?php

namespace App\Repositories;

use App\Models\JobBoard;
use App\Services\FilterService;
use Illuminate\Pagination\LengthAwarePaginator;

class JobBoardRepository
{
    public function __construct(
        private readonly FilterService $filterService,
        private readonly JobBoard $jobBoard
    ) {}

    public function getJobs(): LengthAwarePaginator
    {
        $query = $this->jobBoard->with(['languages', 'locations', 'categories', 'attributeValues']);

        return $this->filterService->apply($query)->paginate(10);
    }
}
