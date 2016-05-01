<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class HomeController extends Controller
{
	public function index()
	{
		$tags = DB::table('tags')->get();
		$projects = DB::table('project')->get();
		$users = DB::table('users')->get();
    	return view('pages.home',['tags'=>$tags,'projects'=>$projects,'users'=>$users]);
	}

	public function search(Request $request){
		$tags = DB::table('tags')->get();
		$qstr = $request->input('q');
		$projects = DB::select( DB::raw("select * from project,users where users.userid = project.addedby and project_id in (select pid from (select project.project_id as pid, (to_tsvector(project.project_name)||to_tsvector(description) || to_tsvector(tagname)) as document from project natural join tagmap) p_search where p_search.document @@ to_tsquery(:query) )"), array(
   			'query' => $qstr	,
 		));
		return view('pages.search',['tags'=>$tags,'projects'=>$projects]);

	}
}
