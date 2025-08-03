<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Filters\UserFilter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get paginated list of users with search and filters
     */
    public function getPaginatedUsers(Request $request): LengthAwarePaginator
    {
        $filter = new UserFilter($request);
        $paginationParams = $filter->applyDatatableParams();

        // Handle middle_name parameter (convert to camelCase for filter)
        if ($request->has('middle_name')) {
            $filter->setParam('middleName', $request->get('middle_name'));
        }

        return User::filter($filter)
            ->withTrashed()
            ->latest()
            ->paginate(
                $paginationParams['per_page'],
                ['*'],
                'page',
                $paginationParams['page']
            );
    }

    /**
     * Create a new user
     */
    public function createUser(array $data): User
    {
        $user = User::create($data);

        if (isset($data['password'])) {
            $user->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        if (isset($data['roles'])) {
            $roles = Role::whereIn('id', $data['roles'])->get();
            $user->syncRoles($roles->pluck('name')->toArray());
        }

        if (isset($data['image'])) {
            $user->addImage($data['image']);
        }

        if (isset($data['status']) && $data['status'] == 'fired') {
            $user->delete();
        }

        return $user;
    }

    /**
     * Update an existing user
     */
    public function updateUser(User $user, array $data): bool
    {
        $user->update($data);

        if (isset($data['password']) && $data['password']) {
            $user->update([
                'password' => Hash::make($data['password'])
            ]);
        }

        if (isset($data['roles'])) {
            $roles = Role::whereIn('id', $data['roles'])->get();
            $user->syncRoles($roles->pluck('name')->toArray());
        }

        // Handle image separately
        if (isset($data['image'])) {
            // Only process if it's a new image (base64)
            if (str_starts_with($data['image'], 'data:image')) {
                $user->addImage($data['image']);
            }
        }

        if (isset($data['status'])) {
            if ($data['status'] == 'fired' && !$user->trashed()) {
                $user->delete();
            }

            if ($data['status'] != 'fired' && $user->trashed()) {
                $user->restore();
            }
        }

        return true;
    }

    /**
     * Delete a user
     */
    public function deleteUser(User $user): bool
    {
        return (bool) $user->forceDelete();
    }

    /**
     * Restore a deleted user
     */
    public function restoreUser(User $user): bool
    {
        return (bool) $user->restore();
    }

    /**
     * Format users for datatable
     */
    public function formatUsersForDatatable($users): array
    {
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                view('users.components.name-column', compact('user'))->render(),
                $user->phone,
                view('users.components.role-column', compact('user'))->render(),
                view('users.components.status-column', compact('user'))->render(),
                $user->created_at->format('d.m.Y'),
                view('users.components.more-button', compact('user'))->render()
            ];
        }

        return $data;
    }
}
