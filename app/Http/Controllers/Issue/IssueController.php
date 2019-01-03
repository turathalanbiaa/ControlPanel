<?php

namespace App\Http\Controllers\Issue;

use App\model\Issue\issue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IssueController extends Controller
{
    public function issue()
    {
        $issues =$users = DB::table('issue')
            ->orderBy('id', 'desc')
            ->get();
        return view('issue.issue' )->with(["issues" => $issues ]);;
    }

}
