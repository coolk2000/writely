<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PageRequest;
use App\Page;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller {

	/**
	 * Create a new pages controller instance.
	 */
	public function __construct()
	{
		$this->middleware('auth', ['only' => 'create', 'edit']);
	}

	public function index()
	{
		$pages = Page::latest('published_at')->get();

		if (Auth::user())
		{
			$auth_user = Auth::user();
		}
		else
		{
			$auth_user = null;
		}

		return view('pages.index', compact('pages', 'auth_user'));
	}

	/**
	 * Show a single page.
	 *
	 * @param Page $id
	 * @return \Illuminate\View\View
	 */
	public function show($id)
	{
		$page = Page::where('id', '=', $id)->first();

		if ($page == null)
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

		return view('pages.show', compact('page', 'auth_user'));
	}

	/**
	 * Show the page to create a new page.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$tags = Tag::lists('name', 'id');

		if (Auth::user())
		{
			$auth_user = Auth::user();
		}
		else
		{
			$auth_user = null;
		}

		return view('pages.create', compact('tags', 'auth_user'));
	}

	/**
	 * Store the page in the database.
	 *
	 * @param PageRequest $request
	 * @return Response
	 */
	public function store(PageRequest $request)
	{
		$this->createPage($request);

		$page = Auth::user()->pages()->latest('created_at')->first();
		$redirect = '/pages/'. $page->id;

		return redirect($redirect);
	}

	/**
	 * Return the page edit page.
	 *
	 * @param Page $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$tags = Tag::lists('name', 'id');

		$page = Page::where('id', '=', $id)->first();

		if ($page == null)
		{
			abort(404);
		}

		if (Auth::user())
		{
			$auth_user = Auth::user();

			if (Auth::user()->id != $page->user_id)
			{
				return redirect('/pages/'. $page->id);
			}
		}
		else
		{
			$auth_user = null;
		}

		return view('pages.edit', compact('page', 'tags', 'auth_user'));
	}

	/**
	 * Update the page.
	 *
	 * @param Page $page
	 * @param PageRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Page $page, PageRequest $request)
	{
		$page->update($request->except('_method', '_token'));

		$this->syncTags($page, $request->input('tag_list'));

		return redirect('pages');
	}

	/**
	 * Sync up the tags with the page.
	 *
	 * @param Page $page
	 * @param array $tags
	 * @return bool
	 */
	private function syncTags(Page $page, $tags)
	{
		if ($tags == null)
		{
			return false;
		}
		else
		{
			$page->tags()->sync($tags);
		}
	}

	/**
	 * Create a new page.
	 *
	 * @param PageRequest $request
	 */
	private function createPage(PageRequest $request)
	{
		$body = nl2br(preg_replace('/(<script(\s|\S)*?<\/script>)|(<style(\s|\S)*?<\/style>)|(<!--(\s|\S)*?-->)|(<\/?(\s|\S)*?>)/', '', $request->body));
		$title = $request->title;
		$published_at = $request->published_at;
		$tags = $request->tags;

		$page = Auth::user()->pages()->create(compact('body', 'title', 'published_at', 'tags'));

		$this->syncTags($page, $request->input('tag_list'));

		return $page;
	}

}
