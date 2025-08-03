<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * User repository instance.
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Super-Admin')->get();
        return view('users.form', compact('roles'));
    }

    /**
     * administrator a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // if ($request->user()->cannot('create_administrators')) {
        //     abort(403);
        // }
        $data = $request->validated();
        $this->userRepository->createUser($data);

        return redirect()->route('users.index')->with('success', 'Пользователь создан');
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
        $roles = Role::where('name', '!=', 'Super-Admin')->get();

        return view('users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        // if ($request->user()->cannot('edit_administrators')) {
        //     abort(403);
        // }
        $data = $request->validated();
        $this->userRepository->updateUser($user, $data);

        return redirect()->route('users.index')->with('success', 'Пользователь успешно отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        // if ($request->user()->cannot('delete_administrators')) {
        //     abort(403);
        // }
        $this->userRepository->deleteUser($user);
        return redirect()->route('users.index')->with('success', 'Пользователь удален');
    }

    public function list(Request $request)
    {
        $users = $this->userRepository->getPaginatedUsers($request);

        $data = [
            'draw' => $request->get('draw'),
            'recordsTotal' => $users->total(),
            'recordsFiltered' => $users->total(),
            'data' => $this->userRepository->formatUsersForDatatable($users)
        ];

        return response()->json($data);
    }

    // Method removed as it's now handled by the repository
}
