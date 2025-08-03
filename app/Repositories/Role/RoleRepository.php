<?php

namespace App\Repositories\Role;

use App\Filters\RoleFilter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Get paginated list of roles with search and filters
     */
    public function getPaginatedRoles(Request $request): LengthAwarePaginator
    {
        $filter = new RoleFilter($request);
        $paginationParams = $filter->applyDatatableParams();
        
        return Role::filter($filter)
            ->where('name', '!=', 'Super-Admin')
            ->latest()
            ->paginate(
                $paginationParams['per_page'],
                ['*'],
                'page',
                $paginationParams['page']
            );
    }
    
    /**
     * Create a new role
     */
    public function createRole(array $data): Role
    {
        $role = Role::create($data);
        
        if (isset($data['permissions'])) {
            $permissions = Permission::whereIn('id', $data['permissions'])->get();
            $role->syncPermissions($permissions);
        }
        
        return $role;
    }
    
    /**
     * Update an existing role
     */
    public function updateRole(Role $role, array $data): bool
    {
        $role->update($data);
        
        if (isset($data['permissions'])) {
            $permissions = Permission::whereIn('id', $data['permissions'])->get();
            $role->syncPermissions($permissions);
        }
        
        return true;
    }
    
    /**
     * Delete a role
     */
    public function deleteRole(Role $role): bool
    {
        return (bool) $role->delete();
    }
    
    /**
     * Format roles for datatable
     */
    public function formatRolesForDatatable($roles): array
    {
        $data = [];
        foreach ($roles as $role) {
            $data[] = [
                view('roles.components.name-column', compact('role'))->render(),
                view('roles.components.permissions-column', compact('role'))->render(),
                view('roles.components.more-button', compact('role'))->render()
            ];
        }

        return $data;
    }
}
