<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Media;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:page.index', ['only' => ['index']]);
        $this->middleware('permission:page.create', ['only' => ['create','store']]);
        $this->middleware('permission:page.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page.show', ['only' => ['show']]);
        $this->middleware('permission:page.delete', ['only' => ['destroy']]);
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
            $allpage = Page::where('title', 'LIKE', '%' . $search . '%')->paginate($number);            
        } else {
            $allpage = Page::paginate($number);
        }
        return view('page.index', compact('allpage', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = Media::all();
        return view('page.create', compact('media'));
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
            'title' => 'required|unique:pages',
        ]);
        if ($validator->passes()) {
            $page = new Page();
            $page->title = $request->title;
            $page->content = $request->content;
            $page->user_id = Auth::id();
            $page->slug = Str::slug($request->title);
            $page->titleseo = $request->titleseo;
            $page->descseo = $request->descriptionseo;
            $page->keywordseo = $request->keywordseo;
            $save = $page->save();
            if ($save) {
                return redirect()->action('HomeController@page')->with('success', __('global.successfully_added'));
            }
        } else {
            return redirect()->route('page.create')->withErrors($validator)->withInput();
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
        $page = Page::find($id);
        $users = User::all()->pluck('name', 'id');
        $media = Media::all();
        if (!$page) {
            abort(404);
        }
        return view('page.edit',compact('page', 'media', 'users'));
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
        $page = Page::find($id);
        $validator = Validator::make(request()->all(), [
            'title' => ['required', Rule::unique('pages')->ignore($page->id)],
            'slug' => ['required', Rule::unique('pages')->ignore($page->id)],
        ]);
        if ($validator->passes()) {
            $page->title = $request->title;
            $page->content = $request->content;
            $page->user_id = $request->user_id;
            $page->slug = Str::slug($request->slug);
            $page->titleseo = $request->titleseo;
            $page->descseo = $request->descriptionseo;
            $page->keywordseo = $request->keywordseo;
            $save = $page->save();
            if ($save) {
                return redirect()->route('page.index')->with('success', __('global.successfully_updated'));
            }
        } else {
            return redirect()->route('route.edit', $id)->withErrors($validator)->withInput();
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
        $page = Page::find($id);
        $delete = $page->delete();
        if ($delete) {
            return redirect()->action('HomeController@page')->with('warning', __('global.successfully_destroy'));
        }
    }

    public function active(Request $request){
        try {
            if ($request->main_page == setting('main_page')) {
                setting(['main_page' => ''])->save();
            } else {
                setting(['main_page' => $request->main_page])->save();
            }
            return redirect()->back()->with('success', __('global.successfully_updated'));
        } catch (\Exception $e) {
            return redirect()->route('addons.index')->with('danger', "Error: ". $e->getMessage());
        }
    }
}
