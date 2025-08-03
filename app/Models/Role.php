<?php

namespace App\Models;

use App\Filters\HasFilter;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFilter;
}
