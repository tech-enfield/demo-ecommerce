<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if($request->filled('name')) {
            $query->where('name', 'like', '%'. $request->query('name') . '%');
        }

        $data = $query->paginate(10);
        // $data = User::paginate(10);
        return view('admin.users.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::default()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('admin');

        event(new Registered($user));

        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = User::paginate(10);
        return view('admin.users.edit', ['data' => $data, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::default()],
        ]);

        $user->update(['name' => $request->name, 'password' => Hash::make($request->password)]);

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'));
    }

    public function assignRole(User $user)
    {
        $data = User::paginate(10);
        $roles = Role::all();
        return view('admin.users.assign-role', ['data' => $data, 'roles' => $roles, 'user' => $user]);
    }

    public function assignRoleStore(Request $request, User $user)
    {
        $request->validate([
            'roles' => ['required', 'array'],
            'roles.*' => ['exists:roles,name']
        ]);

        $user->syncRoles($request->roles);

        return redirect(route('admin.users.index'));
    }
}
