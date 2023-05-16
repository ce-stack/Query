<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\CrudOperationService;
use App\Repositories\QueryService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $queryService;


    public function __construct(QueryService $queryService)
    {
        return $this->queryService = $queryService;
    }

    public function index()
    {

        $allRecords = $this->queryService->allData();
        return response()->json(['data' => $allRecords]);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->queryService->storeMethod($data);

        if($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function getTasks()
    {
        $tasks =  $this->queryService->singleData();

        return response()->json(['data' => $tasks]);
    }


}
