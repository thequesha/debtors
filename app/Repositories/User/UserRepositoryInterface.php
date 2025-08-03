<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Get paginated list of users with search and filters
     */
    public function getPaginatedUsers(Request $request): LengthAwarePaginator;
    
    /**
     * Create a new user
     */
    public function createUser(array $data): User;
    
    /**
     * Update an existing user
     */
    public function updateUser(User $user, array $data): bool;
    
    /**
     * Delete a user
     */
    public function deleteUser(User $user): bool;
    
    /**
     * Restore a deleted user
     */
    public function restoreUser(User $user): bool;
    
    /**
     * Format users for datatable
     */
    public function formatUsersForDatatable($users): array;
}
