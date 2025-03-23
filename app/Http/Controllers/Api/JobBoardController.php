<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JobBoardService;

class JobBoardController extends Controller
{

    public function __construct(
        private readonly JobBoardService $jobBoardService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobs = $this->jobBoardService->getJobs($request);

        return response()->json($jobs);
    }
}
