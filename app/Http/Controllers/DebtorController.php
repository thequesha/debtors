<?php

namespace App\Http\Controllers;

use App\Services\DebtorService;
use App\Models\Debtor;
use App\Services\GoogleSheetUrlService;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    public function __construct(
        private DebtorService $debtors,
        private GoogleSheetUrlService $sheets,
    ) {}


    /**
     * Display a paginated listing of debtors.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $debtors = $this->debtors->paginate($perPage);
        $sheetUrl = $this->sheets->get();

        return view('debtors.index', compact('debtors', 'sheetUrl'));
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
    public function saveSheetUrl(Request $request)
    {
        $validated = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $this->sheets->save($validated['url']);

        return back()->with('success', 'URL сохранён.');
    }

    /**
     * Remove the specified debtor.
     */
    public function destroy(Debtor $debtor)
    {
        $debtor->delete();
        return back()->with('success', 'Должник удалён.');
    }

    public function clear()
    {
        $this->debtors->deleteAll();

        return redirect()->route('debtors.index')
            ->with('success', 'Все должники удалены.');
    }
}
