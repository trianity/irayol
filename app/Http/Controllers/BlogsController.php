<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Media;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blog.index', ['only' => ['index']]);
        $this->middleware('permission:blog.create', ['only' => ['create','store']]);
        $this->middleware('permission:blog.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blog.show', ['only' => ['show']]);
        $this->middleware('permission:blog.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $users = User::all()->pluck('name', 'id');

        if (!empty($request->number)) {
            $number = $request->number;
        } else {
            $number = 10;
        }

        if (!empty($search)) {
            $allblog = Blog::where('title', 'LIKE', '%' . $search . '%')->paginate($number);
        } else {
            $allblog = Blog::paginate($number);
        }

        return view('blog.index', compact('allblog', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = Media::all();
        $categories = Category::where('is_active', 1)->get();
        return view('blog.create', compact('media', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|unique:blogs',
        ]);

        if ($validator->passes()) {
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->user_id = Auth::id();
            $blog->slug = Str::slug($request->title);
            $blog->titleseo = $request->titleseo;
            $blog->descseo = $request->descriptionseo;
            $blog->keywordseo = $request->keywordseo;
            $blog->visibility = $request->visibility;
            $blog->main_image = $request->main_image;
            $blog->published_at = Carbon::parse($request->published_at);
            $save = $blog->save();

            $blog->categories()->attach($request->category);

            if ($save) {
                $request->session()->flash('success', 'Successfully saved!');
                return redirect()->action('HomeController@blog');
            }
        } else {
            return redirect()->route('blog.create')
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::all(); //add medai upload
        $categories = Category::where('is_active', 1)->get()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        $blog = Blog::find($id);
        if (!$blog) {
            abort(404);
        }
        return view('blog.edit', compact('blog','media', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        $validator = Validator::make(request()->all(), [
            'title' => ['required', Rule::unique('blogs')->ignore($blog->id)],
            'slug' => ['required', Rule::unique('blogs')->ignore($blog->id)],
        ]);

        if ($validator->passes()) {
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->user_id = $request->user_id;
            $blog->slug = Str::slug($request->slug);
            $blog->titleseo = $request->titleseo;
            $blog->descseo = $request->descriptionseo;
            $blog->keywordseo = $request->keywordseo;
            $blog->visibility = $request->visibility;
            $blog->main_image = $request->main_image;
            $blog->published_at = Carbon::parse($request->published_at);
            $save = $blog->save();

            $blog->categories()->sync($request->category);

            if ($save) {
                $request->session()->flash('success', 'Successfully saved!');
                return redirect()->route('blog.index');
            }
        } else {
            return redirect()->route('blog.edit', $id)->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $delete = $blog->delete();
        if ($delete) {
            return redirect()->route('blog.index')->with('success', 'Successfully deleted the blog!');
        }
    }
}
