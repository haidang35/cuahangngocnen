@extends('dashboard::layouts.master')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Add Customers</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Customers</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                    class="fa fa-plus-circle"></i> Create New</button>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tạo mới khách hàng</h4>
                <form method="POST" action="{{ route('customer.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Tên khách hàng</label>
                            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror"
                                placeholder="Tên khách hàng" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback" style="font-size: 16px">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Số điện thoại (Nếu có)</label>
                            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại"
                                value="{{ old('phone') }}" required>
                            <div class="valid-feedback">
                                Chính xác
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Địa chỉ email (Nếu có)</label>
                            <input type="text" name="email" class="form-control" placeholder="Địa chỉ email"
                                value="{{ old('email') }}" required>
                            <div class="valid-feedback">
                                Chính xác
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Địa chỉ nhà (Nếu có)</label>
                            <input type="text" name="address" class="form-control" placeholder="Địa chỉ nhà"
                                value="{{ old('address') }}" required>
                            <div class="valid-feedback">
                                Chính xác
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea type="text" name="note" class="form-control" placeholder="Ghi chú"
                                value="{{ old('note') }}"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary text-white" type="submit">Submit form</button>
                </form>
                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                // (function() {
                //     'use strict';
                //     window.addEventListener('load', function() {
                //         // Fetch all the forms we want to apply custom Bootstrap validation styles to
                //         var forms = document.getElementsByClassName('needs-validation');
                //         // Loop over them and prevent submission
                //         var validation = Array.prototype.filter.call(forms, function(form) {
                //             form.addEventListener('submit', function(event) {
                //                 if (form.checkValidity() === false) {
                //                     event.preventDefault();
                //                     event.stopPropagation();
                //                 }
                //                 form.classList.add('was-validated');
                //             }, false);
                //         });
                //     }, false);
                // })();
                </script>
            </div>
        </div>
    </div>
</div>
@endsection