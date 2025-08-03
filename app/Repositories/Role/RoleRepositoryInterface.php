<?php

namespace App\Repositories\Role;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    /**
     * Get paginated list of roles with search and filters
     */
    public function getPaginatedRoles(Request $request): LengthAwarePaginator;
    
    /**
     * Create a new role
     */
    public function createRole(array $data): Role;
    
    /**
     * Update an existing role
     */
    public function updateRole(Role $role, array $data): bool;
    
    /**
     * Delete a role
     */
    public function deleteRole(Role $role): bool;
    
    /**
     * Format roles for datatable
     */
    public function formatRolesForDatatable($roles): array;
}
