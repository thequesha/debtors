<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Role repository instance.
     */
    protected $roleRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        if ($request->user()->cannot('create_roles')) {
            abort(403);
        }
        $data = $request->validated();
        $this->roleRepository->createRole($data);

        return redirect()->route('roles.index')->with('success', 'Rol üstünlikli döredildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        if ($request->user()->cannot('edit_roles')) {
            abort(403);
        }
        $data = $request->validated();
        $this->roleRepository->updateRole($role, $data);

        return redirect()->route('roles.index')->with('success', 'Rol üstünlikli üýtgeildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Role $role)
    {
        if ($request->user()->cannot('delete_roles')) {
            abort(403);
        }
        $this->roleRepository->deleteRole($role);
        return redirect()->back()->with('success', 'Rol üstünlikli pozuldy');
    }


    public function list(Request $request)
    {
        $roles = $this->roleRepository->getPaginatedRoles($request);

        $data = [
            'draw' => $request->get('draw'),
            'recordsTotal' => $roles->total(),
            'recordsFiltered' => $roles->total(),
            'data' => $this->roleRepository->formatRolesForDatatable($roles)
        ];

        return response()->json($data);
    }



    // Method removed as it's now handled by the repository
}
