<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

	public function index()
	{
		return redirect('/home');
	}

	public function settings()
	{
		if (Auth::user())
		{
			$auth_user = Auth::user();

			$title = $auth_user->username.'\'s settings';

			return view('user.settings', compact('auth_user', 'title'));
		}
		elseif (Auth::guest())
		{
			return redirect('/home');
		}
		else
		{
			return redirect('/home');
		}
	}

	/**
	 * Display the specified user's page.
	 *
	 * @param User $username
	 * @return Response
	 */
	public function show($username)
	{
		$user = User::where('username', '=', $username)->first();

		if ($user == null)
		{
			abort(404);
		}

		$title = $user->username;

		if (Auth::user())
		{
			$auth_user = Auth::user();
		}
		else
		{
			$auth_user = null;
		}

		return view('user.show', compact('user', 'auth_user', 'title'));
	}

}
