<?php

namespace Modules\Courses\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Section;
use Illuminate\Contracts\Support\Renderable;
use Modules\Courses\Entities\Classe;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('courses::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('courses::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {            
            Section::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);
            return redirect()->back()->with('success', __('courses::global.successfully_added'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('courses::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('courses::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();
            return redirect()->back()->with('warning', __('courses::global.successfully_destroy'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', "Error: " . $e->getMessage());
        }
    }

    public function classe($id)
    {
        $section = Section::findOrFail($id);
        $classes = Classe::where('section_id', $section->id)->get();
        return view('courses::classes.index', compact('section', 'classes'));
    }
}
