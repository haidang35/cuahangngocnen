@extends('dashboard::layouts.master')

@section('content')

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Thống kê</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Thống kê</li>
            </ol>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-12">
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible"> <i class="ti-user"></i>
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span
                    aria-hidden="true"></span> </button>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-20">Tất cả khách hàng</h5>
                <form method="GET" action="{{ route('customer.index') }}" class="row">
                    <div class="col-md-3">
                        <input class="form-control" name="keyword" value="{{ request()->get('keyword') }}"
                            placeholder="Tìm kiếm theo tên, số điện thoại, email, địa chỉ" />
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        <a href="{{ route('report.index') }}" class="btn btn-success">Hủy bỏ tìm kiếm</a>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example23" class="table table-bordered m-t-30 table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <td>Tổng tiền đã nợ</td>
                                <td>Tổng tiền nợ đã trả</td>
                                <td>Tổng tiền nợ còn thiếu</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>
                                    <a href="{{ route('customer.show', ['id' => $customer->id]) }}">{{ $customer->name
                                        }}</a>
                                </td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->total_debit_amount }}</td>
                                <td>{{ $customer->total_paid_debit_amount }}</td>
                                <td>{{ $customer->total_processing_debit_amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

@endsection