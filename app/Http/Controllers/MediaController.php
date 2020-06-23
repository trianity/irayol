<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class MediaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:media.index', ['only' => ['index']]);
        $this->middleware('permission:media.create', ['only' => ['create','store']]);
        $this->middleware('permission:media.edit', ['only' => ['edit','update', 'active']]);
        $this->middleware('permission:media.show', ['only' => ['show']]);
        $this->middleware('permission:media.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if (!empty($request->number)) {
            $page = $request->number;
        } else {
            $page = 12;
        }

        if (!empty($search)) {
            $media = Media::where('image_name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $media = Media::paginate($page);
        }
        return view('media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('media')) {
            //check if isset media
            $destinationPath = storage_path() . '/app/public/uploads/'; //chmod 0777
            $files = $request->file('media');

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $reName = uniqid(rand(15, 20)) . '.' . $extension;

                //check if exists
                if (File::exists($destinationPath . "/" . $reName)) {
                    $request->session()->flash('warning', 'Your file is already uploaded!');
                } else {
                    $medias = $reName;
                    $images[] = $medias;
                    $author[] = $request->author;
                    $exten[] = $extension;

                    $media = new Media();
                    for ($i = 0; $i < count($images); $i++) {
                        $media->user_id = Auth::id();
                        $media->file = $images[$i];
                        $media->path = url('/') . "/storage/uploads/" . $images[$i];
                        $media->extension = $exten[$i];
                        $media->save();
                    }
                    $file->move($destinationPath, $medias); //save to path
                }
            }
            return response()->json(['uploaded' => storage_path() . '/app/public/uploads/' . $reName]);
        } else {
            return response()->json(['code' => '401', 'message' => 'Error!']);
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
    public function destroy($id)
    {
        try{
            $media = Media::find($id);
            $name = $media->file;
            $destinationPath = storage_path() . '/app/public/uploads/';

            if (file_exists($destinationPath . $name)) {
                File::delete($destinationPath . $name);
            }

            $delete = $media->delete();

            if ($delete) {
                return redirect()->back()->with('success', 'Successfully deleted!');
            }
        } catch (\Exception $e){
            return redirect()->back('media.index')->with('danger', "Error: ". $e->getMessage());
        }
    }
}
