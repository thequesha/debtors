<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserFilter extends QueryFilter
{
    /**
     * Filter by search term across multiple columns
     */
    public function search($value)
    {
        // Handle DataTables search format which can be array with 'value' key
        if (is_array($value) && isset($value['value'])) {
            $searchTerm = $value['value'];
        } else {
            $searchTerm = $value;
        }

        if ($searchTerm === null || is_array($searchTerm)) {
            $searchTerm = '';
        }

        // Only apply filter if search term is not empty
        if (!empty($searchTerm)) {
            $this->builder->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('surname', 'like', '%' . $searchTerm . '%')
                    ->orWhere('username', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }
    }

    /**
     * Filter by name
     */
    public function name($value)
    {
        $this->builder->where('name', 'like', '%' . $value . '%');
    }

    /**
     * Filter by surname
     */
    public function surname($value)
    {
        $this->builder->where('surname', 'like', '%' . $value . '%');
    }

    /**
     * Filter by middle name
     */
    public function middleName($value)
    {
        $this->builder->where('middle_name', 'like', '%' . $value . '%');
    }

    /**
     * Apply DataTables specific parameters
     */
    public function applyDatatableParams()
    {
        $start = $this->request->get('start', 0);
        $length = $this->request->get('length', 10);
        $page = $start / $length + 1;

        // Handle search parameter from DataTables
        // We pass the entire search array to let the search method handle it
        if ($this->request->has('search')) {
            $this->setParam('search', $this->request->get('search'));
        }

        return [
            'page' => $page,
            'per_page' => $length
        ];
    }
}
