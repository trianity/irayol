<?php

namespace App\Http\Controllers;

use Igaster\LaravelTheme\Facades\Theme;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Madnest\Madzipper\Facades\Madzipper;

class ThemeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:theme.index', ['only' => ['index']]);
        $this->middleware('permission:theme.create', ['only' => ['create','store']]);
        $this->middleware('permission:theme.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:theme.show', ['only' => ['show']]);
        $this->middleware('permission:theme.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = \App::make('igaster.themes');
        $data['themes'] = json_decode(json_encode($themes->scanJsonFiles()));
        if (!count($data['themes'])) {
            alert()->danger('You have no themes installed.');
        }
        return view('themes.index', $data);
    }

    public function active(Request $request)
    {
        try {
            if(Theme::exists($request->theme_name)){
                Theme::set($request->theme_name);
                setting(['theme_active' => $request->theme_name])->save();
                return redirect()->back()->with('success_message', 'Theme was successfully change.');
            }
        } catch (Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $zip = Madzipper::make($request->file('theme'));
            $files = collect($zip->listFiles());
            $theme_json = $files->flatten()->filter(function ($file) {
                return Str::endsWith($file, 'theme.json');
            })->first();
            $theme_info = json_decode($zip->getFileContent($theme_json));
            $theme_name = $theme_info->name;

            //check if theme exists
            $themes = \App::make('igaster.themes');
            $themes = collect(json_decode(json_encode($themes->scanJsonFiles())));
            $zip->folder('asset/' . $theme_name)->extractTo(public_path('themes/' . $theme_name));
            $zip->folder('theme/' . $theme_name)->extractTo(resource_path('themes/' . $theme_name));
            return redirect()->route('themes.index')->with('success', "Successfully added $theme_name theme");
        } catch (\Exception $e) {
            return redirect()->route('themes.index')->with('danger', "Error: " . $e->getMessage());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($theme_name)
    {
        try {
            File::deleteDirectory(public_path('themes/' . $theme_name));
            File::deleteDirectory(resource_path('themes/' . $theme_name));
            return redirect()->route('themes.index')->with('warning', "Successfully delete $theme_name theme");
        } catch (\Exception $e) {
            return redirect()->route('themes.index')->with('danger', "Error: " . $e->getMessage());
        }
    }
}
