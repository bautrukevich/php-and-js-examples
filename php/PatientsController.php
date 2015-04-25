<?php namespace App\Http\Controllers;

use App\Patient;
use App\User;

use Carbon\Carbon;
use \Auth;

use \Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientsController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return Auth::user()->patients()->orderBy('updated_at', 'desc')->get();

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$patient = Auth::user()->articles()->create($request->all());
		return $patient;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function search()
	{

		// Get query
		$query = Input::get('q');
		
		// Search patient %like% name
		$searchPatient = Auth::user()->patients()->where('name', 'like', '%'.$query.'%')->get();

		if (!$searchPatient->isEmpty()) {
			$result = "Выберите из списка:";
		} else {
			$result = "Ничего не найдено";
		}

		// Return response with results of search
		return response()->view('patients.search-list', compact('query', 'searchPatient', 'result'));

	}

}
