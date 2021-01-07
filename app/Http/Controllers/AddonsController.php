<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Module;
use File;
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
            $request->session()->flash('success', "Successfully added $addon_name addon");
        } catch (\Exception $e) {
            return redirect()->route('addons.index')->with('danger', "Error: ". $e->getMessage());
        }
        return redirect()->route('addons.index');
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
    public function edit($id, FormBuilder $formBuilder)
    {
        $page = PageTranslation::findOrFail($id);
        $form = $formBuilder->create('Modules\Panel\Forms\PageForm', [
            'method' => 'PUT',
            'url' => route('panel.pages.update', $id),
            'model' => $page
        ]);
        return view('panel::pages.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $page = PageTranslation::findOrFail($id);
        $page->fill($request->all());
        $page->save();

        alert()->success('Successfully saved');
        return redirect()->route('panel.pages.index', ['locale' => $page->locale]);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($addon_name)
    {
        try {
            File::deleteDirectory(base_path('Modules/' . $addon_name));
            return redirect()->route('addons.index')->with('warning', "Successfully delete $addon_name addons");
        } catch (\Exception $e) {
            return redirect()->route('addons.index')->with('danger', "Error: " . $e->getMessage());
        }
    }
}
