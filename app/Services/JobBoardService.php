<?php

namespace App\Services;

use App\Repositories\JobBoardRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class JobBoardService
{
    public function __construct(
        private readonly JobBoardRepository $jobBoardRepository,
    ) {
    }

    public function getJobs(): LengthAwarePaginator
    {
        return $this->jobBoardRepository->getJobs();
    }

}
