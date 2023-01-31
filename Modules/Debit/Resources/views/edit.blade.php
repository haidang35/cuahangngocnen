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
                <h4 class="card-title">Sửa ghi nợ</h4>
                <form method="POST" action="{{ route('debit.update', ['id' => $debit->id]) }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Khách hàng</label>
                            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror"
                                placeholder="" value="{{ $debit->customer->name }}" required>
                           

                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Số tiền</label>
                            <input type="text" name="amount" class="form-control @error('amount')is-invalid @enderror" placeholder="Số tiền"
                                value="{{ number_format($debit->amount, 0, ',', ',')}}" required>
                                @error('amount')
                                <div class="invalid-feedback" style="font-size: 16px">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ngày ghi nợ</label>
                            <input type="text" disabled name="created_at" class="form-control" placeholder="Ngày ghi nợ"
                                value="{{ $debit->created_at }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ngày hẹn trả</label>
                            <input type="text" name="deadline" class="form-control" placeholder="Ngày hẹn trả"
                                value="{{ $debit->deadline }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Đã trả nợ vào lúc</label>
                            <input type="text" name="payment_date" class="form-control" placeholder="Đã trả nợ vào lúc"
                                value="{{ $debit->payment_date }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea type="text" name="note" class="form-control" placeholder="Ghi chú"
                                >{{ $debit->note }}</textarea>
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
@push('scripts')
<script>
    function getNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $(document).ready(function() {
        $('input[name=amount]').keyup(function(e) {
            const value = $(this).val().replaceAll(/,/g, '')
            $(this).val(getNumberWithCommas(value));
        })

        $('input[name=payment_date]').flatpickr();
        $('input[name=deadline]').flatpickr();
    })
</script>
@endpush