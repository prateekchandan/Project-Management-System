<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use App\User;
use App\Project;
use Session;
class HomeController extends Controller
{
	public function __construct()
    {
        if(Session::has('user'))
        	Auth::login(Session::get('user'));
    }
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
 		$message = 'Showing '.sizeof($projects).' projects for query '.htmlentities($qstr);
		return view('pages.search',['tags'=>$tags,'projects'=>$projects,'message'=>$message]);

	}

	public function tags($tagname){
		$tags = DB::table('tags')->get();
		$projects = DB::select(DB::raw("select * from project,users where users.userid = project.addedby and project_id in (select project_id from tagmap where tagname = :tagname)"),array('tagname'=>$tagname));
 		$message = 'Showing '.sizeof($projects).' projects for tag '.htmlentities($tagname);
		return view('pages.search',['tags'=>$tags,'projects'=>$projects,'message'=>$message]);

	}

	public function projectsAll(){
		$tags = DB::table('tags')->get();
		$projects = DB::select(DB::raw("select * from project,users where users.userid = project.addedby"),array());
 		$message = 'Showing '.sizeof($projects).' projects ';
		return view('pages.search',['tags'=>$tags,'projects'=>$projects,'message'=>$message]);

	}

	public function projectView($id){
		$tags = DB::table('tags')->get();
		$project = DB::select(DB::raw("select * from project,users where users.userid = project.addedby and project_id=:id"),array('id'=>$id));
		if(sizeof($project)==0)
			return view('pages.error');
		$project = $project[0];

		$users = DB::select(DB::raw("select *,start_time::date as date,end_time::date as end_date  from working_on natural join users where  project_id = :id"),array('id'=>$id));
		$admin = (!Auth::guest() && Auth::user()->userid == $project->userid);

		$toapply = 0;
		if($admin==0 && !Auth::guest()){
			$working_on = DB::table('working_on')->where('project_id','=',$project->project_id)->where('userid','=',Auth::user()->userid)->first();
			$toapply = is_null($working_on);
		}

		$tagmap = DB::table('tagmap')->where('project_id','=',$project->project_id)->get();
		return view('pages.project',['tags'=>$tags,'project'=>$project,'users'=>$users,'admin'=>$admin,'tagmap'=>$tagmap,'toapply'=>$toapply]);

	}


	public function login_view(){
		return view('pages.login');
	}

	public function login(Request $request){
		$user = User::where('password','=',$request->input('password'))->where('userid','=',$request->input('uid'))->first();
		if(is_null($user))
			return view('pages.login',['message'=>"Invalid username or password"]);

		Session::put('user',$user);
		return redirect()->to('/');
	}

	public function user($userid){
		$user = User::where('userid','=',$userid)->first();
		if(is_null($user))
			return view('pages.error');
		$skills = DB::select(DB::raw("select * from skills where userid=:userid"),array('userid'=>$userid));
		$ownprojects = DB::select(DB::raw("select * from project where addedby = :userid"),array('userid'=>$userid));
		$otherprojects = DB::select(DB::raw("select *,start_time::date as date,end_time::date as end_date  from working_on,project where working_on.project_id=project.project_id and userid = :userid"),array('userid'=>$userid));
		return view('pages.user',['user'=>$user,'skills'=>$skills,'ownprojects'=>$ownprojects,'otherprojects'=>$otherprojects]);
	}

	public function logout(){
		Session::remove('user');
		return redirect()->to('/');
	}

	public function add_project_view(){
		if(Auth::guest())
			return redirect()->to('login');
		$tags = DB::table('tags')->get();

		return view('pages.add_project',array('tags'=>$tags));
	}

	public function add_project(Request $request)
	{
		if(Auth::guest())
			return redirect()->to('login');

		$tags = $request->input('tags');
		$project = new Project;
		$project->project_name = $request->input('name');
		$project->description = $request->input('desc');
		$project->addedby = Auth::user()->userid;
		$project->status = 'in progress';
		$project->save();


		
		$insert = [];
		foreach($tags as $tag) {
			array_push($insert,['tagname'=>$tag,'project_id'=>$project->project_id]);
		}
		DB::table('tagmap')->insert($insert);
		return redirect()->to('projects');
	}

	public function add_tag_view(){
		if(Auth::guest())
			return redirect()->to('login');
		$tags = DB::table('tags')->get();

		return view('pages.add_tag',array('tags'=>$tags));
	}

	public function add_tag(Request $request)
	{
		if(Auth::guest())
			return redirect()->to('login');

		$tagname = $request->input('tagname');
		$tag=DB::table('tags')->where('tagname','=',$tagname)->first();
		if(is_null($tag))
			DB::table('tags')->insert([
				['tagname'=>$tagname]
				]);
		return redirect()->back();

	}

	public function apply_project($id)
	{
		if(Auth::guest())
			return redirect()->to('login');
		$project = Project::find($id);
		if(is_null($project))
			return view('pages.error');

		$working_on = DB::table('working_on')->where('project_id','=',$project->project_id)->where('userid','=',Auth::user()->userid)->first();
		if(is_null($working_on))
		{
		
			DB::table('working_on')->insert([[
				'userid'=>Auth::user()->userid,
				'project_id'=>$project->project_id,
				'status'=>'applied',
				'start_time'=>date('Y-m-d G:i:s')
				]]);
		}

		return redirect()->to('project/'.$project->project_id);

	}


	public function signup_view(){
		if(!Auth::guest())
			return redirect()->to('/');

		return view('pages.signup');
	}

	public function signup(Request $request)
	{
		if(!Auth::guest())
			return redirect()->to('/');


		$user = new User;
		$user->name = $request->input('name');
		$user->userid = $request->input('uid');
		$user->email = $request->input('email');
		$user->password = $request->input('password');
		$user->type = $request->input('utype');
		$user->phone = $request->input('phone');
		$user->institute = $request->input('institute');
		$user->roll_number = $request->input('roll');
		$user->save();
		Session::put('user',$user);
		return redirect()->to('/');
	}

}
