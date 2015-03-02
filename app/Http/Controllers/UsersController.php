<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

	public function index()
	{
		return redirect('/user/home');
	}

	public function home()
	{
		if (Auth::user())
		{
			return redirect('user/'. Auth::user()->username);
		}
		elseif (Auth::guest())
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

	public function editTagline(User $user, TaglineRequest $request)
	{
		$user->update($request->except('_method', '_token'));

		$this->syncTags($page, $request->input('tag_list'));

		return redirect('user/'.$user->username);
	}

}
