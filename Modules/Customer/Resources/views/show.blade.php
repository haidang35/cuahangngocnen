@extends('dashboard::layouts.master')

@section('content')

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Profile</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                    class="fa fa-plus-circle"></i> Create New</button>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible"> <i class="ti-user"></i>
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span
                aria-hidden="true"></span> </button>
    </div>
    @endif
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    {{-- <img src="../assets/images/users/5.jpg" class="img-circle" width="150" /> --}}
                    <h4 class="card-title m-t-10">{{ $customer->name }}</h4>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link">
                                <font class="font-medium">254</font>
                            </a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link">
                                <font class="font-medium">54</font>
                            </a></div>
                    </div>
                </center>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body"> <small class="text-muted">Địa chỉ email </small>
                <h6>{{ $customer->email }}</h6> <small class="text-muted p-t-30 db">Số điện thoại</small>
                <h6>{{ $customer->phone }}</h6> <small class="text-muted p-t-30 db">Địa chỉ</small>
                <h6>{{ $customer->address }}</h6>
                <small class="text-muted p-t-30 db">Social Profile</small>
                <br />
                <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#debit" role="tab">Thông tin
                        ghi
                        nợ</a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#createDebit" role="tab">Tạo mới
                        ghi nợ</a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">Sửa thông tin
                        khách hàng</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="debit" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Họ và tên</strong>
                                <br>
                                <p class="text-muted">{{ $customer->name }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Điện thoại</strong>
                                <br>
                                <p class="text-muted">{{ $customer->phone }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                <br>
                                <p class="text-muted">{{ $customer->email }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Địa chỉ</strong>
                                <br>
                                <p class="text-muted">{{ $customer->address }}</p>
                            </div>
                        </div>
                        <hr>
                        <h4 class="font-medium m-t-30">Lịch sử ghi nợ</h4>
                        <div class="table-responsive">
                            <table id="example23" class="table table-bordered m-t-30 table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Số tiền ghi nợ</th>
                                        <th>Trạng thái </th>
                                        <td>Ngày ghi nợ</td>
                                        <th>Ngày hẹn trả</th>
                                        <th>Đã trả nợ vào lúc</th>
                                        <td>Thao tác</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($debits as $debit)
                                    <tr>
                                        <td>{{ $debit->id }}</td>
                                        <td>{{ $debit->formatted_amount }}</td>
                                        <td>{!! $debit->formatStatus !!}</td>
                                        <td>{{ $debit->created_at }}</td>
                                        <td>{{ $debit->deadline }}</td>
                                        <td>{{ $debit->payment_date }}</td>
                                        <td>
                                            <a href="{{ route('debit.edit', ['id' => $debit->id]) }}"
                                                class="btn btn-sm btn-success"><i
                                                    class="fa-sharp fa-solid fa-pen"></i></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#model{{$debit->id}}"
                                                class="btn btn-sm btn-danger"><i
                                                    class="fa-sharp fa-solid fa-trash"></i></a>
                                            <div id="model{{$debit->id}}" class="modal" tabindex="-1" role="dialog"
                                                aria-labelledby="model{{$debit->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="model{{$debit->id}}Label">Xác
                                                                nhận xóa
                                                                đơn ghi nợ</h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-hidden="true"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>Bạn đã chắc chắn xóa đơn ghi nợ <b>{{
                                                                    $debit->formatted_amount }}</b>
                                                                của khách hàng <b>{{ $debit->customer->name }}</b></h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-info waves-effect text-white"
                                                                data-bs-dismiss="modal">Hủy bỏ</button>
                                                            <a href="{{ route('debit.delete', ['id' => $debit->id]) }}"
                                                                type="button"
                                                                class="btn btn-danger waves-effect text-white">Có,
                                                                Chắc chắn xóa</a>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $debits->links('pagination::bootstrap-5') }}
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="tab-pane" id="createDebit" role="tabpanel">
                    <div class="card-body">
                        <form method="POST" action="{{ route('debit.store') }}" class="form-horizontal form-material">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}" />
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Số tiền</label>
                                <div class="col-md-12">
                                    <input type="text" name="amount" value="{{ old('amount') }}"
                                        class="form-control form-control-line @error('amount') is-invalid @enderror">
                                    @error('amount')
                                    <div class="invalid-feedback" style="font-size: 16px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Ngày hẹn trả</label>
                                <div class="col-md-12">
                                    <input type="date" name="deadline" placeholder=""
                                        class="form-control form-control-line">
                                    @error('deadline')
                                    <div class="invalid-feedback" style="font-size: 16px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Ghi chú</label>
                                <div class="col-md-12">
                                    <textarea rows="5" name="note" class="form-control form-control-line"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success text-white">Tạo mới ghi nợ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card-body">
                        <form method="POST" action="{{ route('customer.update', ['id' => $customer->id]) }}"
                            class="form-horizontal form-material">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Tên</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" placeholder="" value="{{ $customer->name }}"
                                        class="form-control form-control-line is-invalid">
                                    @error('name')
                                    <div class="invalid-feedback" style="font-size: 16px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" name="email" placeholder="" value="{{ $customer->email }}"
                                        class="form-control form-control-line" id="example-email">
                                    @error('email')
                                    <div class="invalid-feedback" style="font-size: 16px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Số điện thoại</label>
                                <div class="col-md-12">
                                    <input type="text" name="phone" placeholder="" value="{{ $customer->phone }}"
                                        class="form-control form-control-line">
                                    @error('phone')
                                    <div class="invalid-feedback" style="font-size: 16px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Địa chỉ</label>
                                <div class="col-md-12">
                                    <input type="text" name="address" placeholder="" value="{{ $customer->address }}"
                                        class="form-control form-control-line">
                                    @error('address')
                                    <div class="invalid-feedback" style="font-size: 16px">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Ghi chú</label>
                                <div class="col-md-12">
                                    <textarea rows="5" name="note"
                                        class="form-control form-control-line">{{ $customer->note ?? 'Không có ghi chú nào' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success text-white">Cập nhật thông tin</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
<!-- ============================================================== -->
<!-- End PAge Content -->

@endsection

@push('scripts')
<script>
    function getNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $(document).ready(function() {
        $('input[name=amount]').keyup(function(e) {
            const value = $(this).val().replaceAll('.', '')
            $(this).val(getNumberWithCommas(value));
        });

        $('input[name=deadline]').flatpickr();
    })
</script>
@endpush