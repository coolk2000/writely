<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Display the specified user's page.
	 *
	 * @param $name
	 * @return Response
	 */
	public function show($name)
	{
		$user = User::where('username', '=', $name)->first();

		if ($user == null)
		{
			abort(404);
		}

		return view('user.show', compact('user'));
	}

}
