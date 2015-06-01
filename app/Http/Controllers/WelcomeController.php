<?php namespace App\Http\Controllers;

use App\Status;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		try {
			$queue = Status::whereKey('queue')->first();
			$cron = Status::whereKey('cron')->first();
		} catch (\PDOException $e) {
			dd($e->getMessage());
		}

		$status = 'Queue: '.($queue ? 'YES' : 'NO').'<br>';
		$status .= 'Cron: '.($cron ? 'YES' : 'NO');

		return $status;
	}

}
