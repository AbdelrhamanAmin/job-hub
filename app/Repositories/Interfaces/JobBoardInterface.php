<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface JobBoardInterface
{
    public function getJobs(Request $request): LengthAwarePaginator;
}
