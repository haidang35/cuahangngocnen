<?php

namespace Modules\Debit\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Modules\Debit\Enums\DebitStatus;
use Modules\Debit\Http\Requests\StoreDebitRequest;
use Modules\Debit\Http\Requests\UpdateDebitRequest;
use Modules\Debit\Services\DebitService;

class DebitController extends Controller
{
    protected $debitService;

    public function __construct(DebitService $debitService)
    {
        $this->debitService = $debitService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string',
            'created_at' => 'nullable|string'
        ]);
        $debits = $this->debitService->findAll($request);
        return view('debit::index', [
            'debits' => $debits
        ]);
    }

    /**
     * Display a listing of the trashed resource.
     * @return Renderable
     */
    public function trashed(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string',
            'created_at' => 'nullable|string'
        ]);
        $debits = $this->debitService->findAllTrashed($request);
        return view('debit::trashed', [
            'debits' => $debits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('debit::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreDebitRequest $request)
    {
        $newDebit = $this->debitService->save($request);
        return redirect()->back()->with([
            'message' => 'Tạo mới ghi nợ thành công'
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('debit::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $debit = $this->debitService->findById($id);
        return view('debit::edit', [
            'debit' => $debit
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateDebitRequest $request, $id)
    {
        $result = $this->debitService->update($id, $request);
        return redirect()->route('debit.index')->with([
            'message' => 'Cập nhật ghi nợ thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $result = $this->debitService->delete($id);
        return redirect()->back()->with([
            'message' => 'Xóa ghi nợ thành công'
        ]);
    }

    /**
     * updateStatus
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => ['required', new Enum(DebitStatus::class)]
        ]);
        $result = $this->debitService->updateStatus($id, $request->status);
        return redirect()->back()->with([
            'message' => 'Cập nhật trạng thái ghi nợ thành công'
        ]);
    }

    public function restore($id)
    {
        $result = $this->debitService->restore($id);
        return redirect()->route('debit.index')->with([
            'message' => 'Khôi phục ghi nợ thành công'
        ]);
    }
}
