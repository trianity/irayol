<?php

namespace App\Http\Controllers;

use File;
use Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Madnest\Madzipper\Facades\Madzipper;

class AddonsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:addons.index', ['only' => ['index']]);
        $this->middleware('permission:addons.create', ['only' => ['create','store']]);
        $this->middleware('permission:addons.edit', ['only' => ['edit','update', 'active']]);
        $this->middleware('permission:addons.show', ['only' => ['show']]);
        $this->middleware('permission:addons.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $modules = Module::all();
        return view('addons.index', compact('modules'));
    }

    public function active(Request $request)
    {
        foreach(Module::all() as $v) {
            if($request->addons_name == $v->alias) {
                $module_name = $v->getName();
                break;
            }
        }

        $module = Module::find($module_name);
        
        if($module) {
            if($module->enabled())
                $module->disable();
            else
                $module->enable();
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [];
        return view('addons.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $addon_name = pathinfo(Madzipper::make($request->file('addon'))->listFiles('/\module.json/i')[0], PATHINFO_DIRNAME);
            $addon_info = json_decode(Madzipper::make($request->file('addon'))->getFileContent($addon_name.'/module.json'));
            Madzipper::make($request->file('addon'))->folder($addon_name)->extractTo(base_path('Modules/' . $addon_name));

            return redirect()->route('addons.index')->with('success', __('global.successfully_added_addons', ['module' => $addon_name]));
        } catch (\Exception $e) {
            return redirect()->route('addons.index')->with('danger', "Error: ". $e->getMessage());
        }
        
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('panel::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($addon_name)
    {
        try {
            File::deleteDirectory(base_path('Modules/' . $addon_name));
            return redirect()->route('addons.index')->with('warning', __('global.successfully_destroy_addons', ['module' => $addon_name]));
        } catch (\Exception $e) {
            return redirect()->route('addons.index')->with('danger', "Error: " . $e->getMessage());
        }
    }
}
