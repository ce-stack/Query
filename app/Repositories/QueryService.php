<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class QueryService
{
    //store method
    public function storeMethod(Request $request)
    {
      DB::beginTransaction();

      try {
        DB::table('accounts')->insert([
            'name' => $request->name,
        ]);

        DB::table('projects')->inster([
            'name'=> $request->name,
            'account_id' => $request->account_id
        ]);
        DB::table('jobs')->insert([
            'name' => $request->name,
            'amount' => $request->amount,
            'project_id' => $request->project_id
        ]);
        DB::table('tasks')->insert([
            'name' => $request->name,
            'project_id' => $request->project_id
        ]);
      } catch (\Throwable $th) {
        DB::rollback();
        return false;
      }
    }


    //get all data
    public function allData()
    {



        $tables = DB::select('SELECT * FROM querytaskpantervalue.tables WHERE table_schema = :database', ['database' => env('DB_DATABASE')]);
        $allRecords = [];

        foreach ($tables as $table) {
            $tableName = $table->TABLE_NAME;
            $records = DB::table($tableName)->get();
            $allRecords[$tableName] = $records;
        }

        return $allRecords;
    }


    //single data
    public function singleData()
    {
        DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.price', '<', 100)
            ->select('tasks.*')
            ->get();
    }
}
