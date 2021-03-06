<?php

namespace Modules\Courses\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Classe;
use Illuminate\Contracts\Support\Renderable;
use Modules\Courses\Http\Requests\CreateClassRequest;

class ClassesController extends Controller
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
    public function store(CreateClassRequest $request)
    {
        try {            
            $class = Classe::updateOrCreate(
                ['id' => $request->class_id],
                [
                    'title' => $request->title_class,
                    'section_id' => $request->section_class_id,
                    'is_active' => $request->is_active,
                    'media_type' => $request->media_type,
                    'url' => $request->url,
                    'duration' => $request->duration,
                    'access' => $request->access,
                    'note' => $request->note,
                ]
            );
            return response()->json(['status' => 'success', 'message' =>  $class]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
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
        $section  = Classe::where('id', $id)->first();
        return response()->json(['status' => 'success', 'message' =>  $section]);
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
    public function destroy($id)
    {
        try {
            Classe::where('id', $id)->delete();
            return response()->json(['status' => 'warning', 'message' =>  __('courses::global.successfully_destroy')]);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }

    public function order(Request $request)
    {
        try {
            foreach($request->get('order') as $id => $order) {
                Classe::find($id)->update(['order' => $order]);
            }
            return response()->json(['status' => 'success', 'message' => __('courses::global.successfully_updated')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }

    }
}
