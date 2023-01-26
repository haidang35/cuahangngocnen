@extends('dashboard::layouts.master')

@section('content')

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Quản lý ghi nợ</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Quản lý ghi nợ</li>
            </ol>
            <a href="{{ route('debit.create') }}" type="button"
                class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Tạo khách
                hàng mới</a>
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
                <h5 class="card-title m-b-20">Quản lý ghi nợ</h5>
                <form method="GET" action="{{ route('debit.index') }}" class="row">
                    <div class="col-md-3">
                        <input class="form-control" name="keyword" value="{{ request()->get('keyword') }}" placeholder="Tìm kiếm theo tên, số điện thoại, số tiền"/>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control" name="created_at" value="{{ request()->get('created_at') }}" placeholder="Tìm kiếm theo ngày ghi nợ"/>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        <a href="{{ route('debit.index') }}" class="btn btn-success">Hủy bỏ tìm kiếm</a>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example23" class="table table-bordered m-t-30 table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Số tiền ghi nợ</th>
                                <th>Trạng thái </th>
                                <td>Ngày ghi nợ</td>
                                <th>Ngày hẹn trả</th>
                                <th>Đã thanh toán vào lúc</th>
                                <td>Thao tác</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($debits as $debit)
                            <tr>
                                <td>{{ $debit->id }}</td>
                                <td>
                                    @if($debit->customer)
                                    <a href="{{ route('customer.show', ['id' => $debit->customer?->id]) }}">
                                        {{ $debit->customer->name }}
                                    </a>
                                    @endif
                                </td>
                                <td>{{ $debit->customer?->phone }}</td>
                                <td>{{ $debit->formattedAmount }}</td>
                                <td>{!! $debit->formatStatus !!}</td>
                                <td>{{ $debit->created_at }}</td>
                                <td>{{ $debit->deadline }}</td>
                                <td>{{ $debit->payment_date }}</td>
                                <td>
                                    <a href="{{ route('debit.edit', ['id' => $debit->id]) }}" data-bs-toggle="modal"
                                        data-bs-target="#model-status-{{$debit->id}}" class="btn btn-sm btn-success"><i
                                            class="fa-sharp fa-solid fa-circle-check"></i></a>
                                    <a href="{{ route('debit.edit', ['id' => $debit->id]) }}"
                                        class="btn btn-sm btn-info"><i class="fa-sharp fa-solid fa-pen"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#model{{$debit->id}}"
                                        class="btn btn-sm btn-danger"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                    <div id="model-status-{{$debit->id}}" class="modal" tabindex="-1" role="dialog"
                                        aria-labelledby="model{{$debit->id}}Label" aria-hidden="true">
                                        <form method="POST"
                                            action="{{ route('debit.update.status', ['id' => $debit->id]) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="1" />
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="model-status-{{$debit->id}}Label">
                                                            Đánh dấu khách hàng đã thanh toán khoản nợ
                                                        </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>Bạn đã chắc chắn gạch ghi nợ <b>{{ $debit->formatted_amount
                                                                }}</b>
                                                            cho khách hàng <b>{{ $debit->customer?->name }}</b></h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-info waves-effect text-white"
                                                            data-bs-dismiss="modal">Hủy bỏ</button>
                                                        <button 
                                                            type="submit"
                                                            class="btn btn-danger waves-effect text-white">Có,
                                                            Chắc chắn</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </form>

                                    </div>
                                    <div id="model{{$debit->id}}" class="modal" tabindex="-1" role="dialog"
                                        aria-labelledby="model{{$debit->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="model{{$debit->id}}Label">Xác nhận xóa
                                                        đơn ghi nợ</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Bạn đã chắc chắn xóa đơn ghi nợ <b>{{ $debit->formatted_amount
                                                            }}</b>
                                                        của khách hàng <b>{{ $debit->customer?->name }}</b></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info waves-effect text-white"
                                                        data-bs-dismiss="modal">Hủy bỏ</button>
                                                    <a href="{{ route('debit.delete', ['id' => $debit->id]) }}"
                                                        type="button" class="btn btn-danger waves-effect text-white">Có,
                                                        Chắc chắn xóa</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" style="text-align: center">
                                    <b >Không tìm thấy bản ghi nợ nào</b>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $debits->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[name=created_at]').flatpickr();
        })
    </script>
@endpush