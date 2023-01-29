<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Entities\Customer;
use Modules\Customer\Http\Requests\StoreCustomerRequest;
use Modules\Customer\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string',
        ]);
        $customers = $this->customerService->findAll($request);
        return view('customer::index', [
            'customers' => $customers
        ]);
    }
    
    /**
     * trashed
     *
     * @param  mixed $request
     * @return void
     */
    public function trashed(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string',
        ]);
        $customers = $this->customerService->findAllTrashed($request);
        return view('customer::trashed', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerService->save($request);
        return redirect()->route('customer.index')->with([
            'message' => "Tạo mới khách hàng {$customer->name} thành công !!"
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $customer = $this->customerService->findById($id);
        return view('customer::show', [
            'customer' => $customer,
            'debits' => $customer->debits()->latest()->paginate(15)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('customer::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreCustomerRequest $request, $id)
    {
        $customer = $this->customerService->update($request, $id);
        return redirect()->route('customer.index')->with([
            'message' => 'Cập nhật thông tin khách hàng thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $customer = $this->customerService->delete($id);
        return redirect()->route('customer.index')->with([
            'message' => 'Xóa khách hàng thành công'
        ]);
    }
    
    /**
     * restore
     *
     * @param  int $id
     * @return Renderable
     */
    public function restore($id)
    {
        $result = $this->customerService->restore($id);
        return redirect()->route('customer.index')->with([
            'message' => 'Khôi phục khách hàng thành công'
        ]);
    }
}
