<?php

namespace App\Http\Controllers;

use App\Services\DebtorService;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    public function __construct(private DebtorService $debtors) {}

    /**
     * Display a paginated listing of debtors.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $debtors = $this->debtors->paginate($perPage);

        return view('debtors.index', compact('debtors'));
    }

    /**
     * Generate 1000 random debtors (500 allowed / 500 prohibited).
     */
    public function generate()
    {
        $this->debtors->generateBatch(1000);

        return redirect()->route('debtors.index')
            ->with('success', '1000 должников успешно создано.');
        }

    /**
     * Delete all debtors.
     */
    public function clear()
    {
        $this->debtors->deleteAll();

        return redirect()->route('debtors.index')
            ->with('success', 'Все должники удалены.');
    }
}
