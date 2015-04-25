<?php namespace App\Http\Controllers;

use App\Visit;
use App\Patient;

use Carbon\Carbon;
use \Auth;
use \Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\VisitRequest;

use Illuminate\Http\Request;

class VisitsController extends Controller {

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
		//dd(Auth::user()->visits()->get());
		return Auth::user()->visits()->orderBy('created_at', 'desc')->get();
		//return view('visits.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$visitsCount = Auth::user()->visits()->count();
		$visitsCount++;
		$date = Carbon::now();
		return view('visits.create', compact('date', 'visitsCount'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(VisitRequest $request)
	{

		// Create a new Patient
		$patient = new Patient;
		$patient->name = $request->name;
		$patient->age = $request->age;
		$patient->size = $request->size;

		// Find user in table
		$searchPatient = Auth::user()->patients()->where('name', '=', $patient->name)->first();

		// If Patient exists
		if (!$searchPatient == '') {
			// Update him
			$searchPatient->age = $request->age;
			$searchPatient->size = $request->size;
			$updatedPatient = Auth::user()->patients()->where('patient_id', '=', $searchPatient->id)->save($searchPatient);
			// Check Patient
			$patientId = $searchPatient->id;
		} else {
			// Else add to base
			$newPatient = Auth::user()->patients()->save($patient);
			// Check Patient
			$patientId = $newPatient->id;
		}

		// Create a new Visit
		$visit = new Visit;
		$visit->count = $request->count;
		$visit->patient_id = $patientId;

		$newVisit = Auth::user()->visits()->save($visit);
			
		// Save to session
		Session::put('visit', $newVisit);

		// Redirect to system
		return redirect('system');

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

}
