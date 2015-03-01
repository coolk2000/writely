<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

		if (Auth::user())
		{
			$auth_user = Auth::user();
		}
		else
		{
			$auth_user = null;
		}

		return view('user.show', compact('user', 'auth_user'));
	}

}
