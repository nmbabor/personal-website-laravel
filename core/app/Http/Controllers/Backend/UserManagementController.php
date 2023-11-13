<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\ValidImageType;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageHandlerController;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->latest()->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn(
                    'thumb',
                    '<img class="img-fluid" src="{{ $pro_pic }}" width="50" alt="{{ $name }}">'
                )
                ->addColumn('created', function ($data) {
                    return date('d M, Y', strtotime($data->created_at));
                })
                ->addColumn(
                    'action',
                    '<div class="action-wrapper">
                    <a class="btn btn-sm bg-gradient-primary"
                        href="{{ route(\'backend.admin.user.edit\', $id) }}">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <a class="btn btn-sm bg-gradient-danger"
                        href="{{ route(\'backend.admin.user.delete\', $id) }}"
                        onclick="return confirm(\'Are you sure ?\')">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                    </a>
                    @if ($is_suspended)
                        <a class="btn btn-sm bg-gradient-success"
                            href="{{ route(\'backend.admin.user.suspend\', [\'id\' => $id, \'status\' => 0]) }}">
                            <i class="fas fa-check-square"></i>
                            Activate
                        </a>
                    @else
                        <a class="btn btn-sm bg-gradient-warning"
                            href="{{ route(\'backend.admin.user.suspend\', [\'id\' => $id, \'status\' => 1]) }}"
                            onclick="return confirm(\'Are you sure ?\')">
                            <i class="far fa-times-circle"></i>
                            Suspend
                        </a>
                    @endif
                    
                </div>'
                )
                ->addColumn('suspend', function ($data) {
                    if ($data->is_suspended == 0) {
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-pill badge-danger">Suspended</span>';
                    }
                })
                ->addColumn('roles', function ($data) {
                    foreach ($data->roles as $key => $role) {
                        return $role->name;
                        if (!$key + 1 != count($data->roles)) {
                            return "<br>";
                        }
                    }
                })
                ->rawColumns(['thumb', 'created', 'action', 'suspend', 'roles'])
                ->toJson();
        }

        return view('backend.users.index');
    }

    public function fetchPageData(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('type', 'User')->latest()->paginate(10);

            return view('backend.users.user-table-data', compact('users'))->render();
        }
    }

    public function suspend($id, $status)
    {
        $user = User::findOrFail($id);

        if ($user->is_suspended == $status) {
            return back()->with('error', 'User already suspended');
        } else {
            $user->is_suspended = $status;
            $user->save();

            return back()->with('success', 'User suspended successfully');
        }
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'type' => 'required',
                'password' => 'required',
                'profile_image' => ['file', new ValidImageType]
            ]);

            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->password = bcrypt($request->password);
            $newUser->type = $request->type;
            $newUser->username = uniqid();

            if ($request->hasFile("profile_image")) {
                $newUser->profile_image = uploadImageAndGetPath($request->file("profile_image"), "/assets/images/users");
            }
            $newUser->save();

           /*  $role = Role::find($request->role);
            $newUser->syncRoles($role); */

            return to_route('backend.admin.users')->with('success', 'User created successfully');
        } else {
           /*  $roles = Role::all(); */
            return view('backend.users.create');
        }
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'type' => 'required',
                'profile_image' => ['file', new ValidImageType]
            ]);

            if ($request->name !== $user->name) {
                $user->name = $request->name;
            }

            if ($request->email !== $user->email) {
                $user->email = $request->email;
                $user->google_id = null;
                $user->is_google_registered = false;
            }

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            if ($request->hasFile("profile_image")) {
                secureUnlink($user->profile_image);

                $user->profile_image = uploadImageAndGetPath($request->file("profile_image"), "/assets/images/users");
            }
            $user->save();

           /*  $role = Role::find($request->role);
            $user->syncRoles($role); */
            
            return to_route('backend.admin.users')->with('success', 'User updated successfully');
        } else {
            if ($id == auth()->id()) {
                return to_route('user.profile');
            }

            $roles = Role::all();
            return view('backend.users.edit', compact('user', 'roles'));
        }
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Can not delete your self');
        }
        if ($id == 1) {
            return back()->with('error', 'Can not delete master account');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted');
    }
}
