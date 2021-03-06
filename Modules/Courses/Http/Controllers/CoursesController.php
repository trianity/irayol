<?php

namespace Modules\Courses\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Classe;
use Modules\Courses\Entities\Course;
use Modules\Courses\Entities\Section;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $courses = Course::paginate(15);
        return view('courses::courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $medias = Media::all();
        return view('courses::courses.create', compact('categories', 'medias'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $course = Course::create([
                'instructor_id' => auth()->user()->id,
                'title' => $request->title,
                'level' => $request->level,
                'slug' => Str::slug($request->title),
                'keywords' => $request->keywords,
                'description' => $request->description,
                'required' => $request->required,
                'includes' => $request->includes,
                'image' => $request->image,
                'visibility' => $request->visibility
            ]);

            $course->categories()->attach($request->category);

            return redirect()->route('courses.index')->with('success', __('courses::global.successfully_added'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', "Error: " . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        $sections = Section::where('course_id', $course->id)->get();
        return view('courses::courses.show', compact('course', 'sections'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Course $course)
    {
        $categories = Category::where('is_active', 1)->get()->pluck('name', 'id');
        $medias = Media::all();
        return view('courses::courses.edit', compact('course', 'categories', 'medias'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Course $course)
    {
        try {
            $course->update([
                'instructor_id' => $request->user()->id,
                'title' => $request->title,
                'level' => $request->level,
                'slug' => Str::slug($request->title),
                'keywords' => $request->keywords,
                'description' => $request->description,
                'required' => $request->required,
                'includes' => $request->includes,
                'image' => $request->image,
                'visibility' => $request->visibility
            ]);

            $course->categories()->sync($request->category);

            return redirect()->route('courses.index')->with('success', __('courses::global.successfully_updated'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', "Error: " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('courses.index')->with('warning', __('courses::global.successfully_destroy'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('danger', "Error: " . $e->getMessage());
        }
    }

    public function all(){
        try {
            $courses = Course::paginate();
            return view('courses::courses.all', compact('courses'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    public function course($slug){
        try {
            $course = Course::where('slug', $slug)->first();
            $sections = Section::where('course_id', $course->id)->get();
            return view('courses::courses.info', compact('course', 'sections'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
        
    }

    public function play($slug, $id){
        try {
            $course = Course::where('slug', $slug)->first();
            $sections = Section::where('course_id', $course->id)->get();
            $classe = Classe::where('id', $id)->first();
            return view('courses::courses.play', compact('course', 'sections', 'classe'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }
}
