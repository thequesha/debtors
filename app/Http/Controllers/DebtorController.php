<?php

namespace App\Http\Controllers;

use App\Services\DebtorService;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    public function __construct(private DebtorService $debtors)
    {
    }

    /**
     * Display a paginated listing of debtors.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $debtors = $this->debtors->paginate($perPage);

        return view('debtors.index', compact('debtors'));
    }
}
