<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users.index', ['only' => ['index']]);
        $this->middleware('permission:users.create', ['only' => ['create','store']]);
        $this->middleware('permission:users.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users.show', ['only' => ['show']]);
        $this->middleware('permission:users.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if (!empty($request->number)) {
            $number = $request->number;
        } else {
            $number = 10;
        }

        if (!empty($search)) {
            $usersObjects = User::where('name', 'LIKE', '%' . $search . '%')->paginate($number);
        } else {
            $usersObjects = User::paginate($number);
        }

        return view('users.index', compact('usersObjects'));
    }

    /**
     * Show the form for creating a new users.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a new users in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(StoreUsersRequest $request)
    {
        try {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);

            return redirect()->route('users.index')->with('success_message', 'Users was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified users.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $users = User::findOrFail($id);

        return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified users.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $roles = Role::get()->pluck('name', 'id');
        $users = User::findOrFail($id);
        return view('users.edit', compact('users', 'roles'));
    }

    /**
     * Update the specified users in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UpdateUsersRequest $request)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());

            $roles = $request->roles ? $request->roles : [];
            $user->syncRoles($roles);

            return redirect()->route('users.index')->with('success_message', 'User was successfully updated.');
        } catch (Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified users from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $users = User::findOrFail($id);
            $users->delete();
            return redirect()->route('users.index')->with('success', 'User was successfully deleted.');
        } catch (Exception $exception) {
            return back()->withInput()->with(['danger' => "Error: " . $exception->getMessage()]);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'email' => 'required|string|min:1|max:255',
            'name' => 'required|string|min:1|max:255',
            'roles' => 'required',
        ];

        $data = $request->validate($rules);
        return $data;
    }

    public function profile(){
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function profileEdit(){
        $user = Auth::user();
        $roles = Role::get()->pluck('name', 'id');
        return view('profile.edit', compact('user', 'roles'));
    }

    public function profileUpdate($id, UpdateUsersRequest $request){
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->update();

            $roles = $request->roles ? $request->roles : [];
            $user->syncRoles($roles);

            return redirect()->route('profile.index')->with('success_message', 'User was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
