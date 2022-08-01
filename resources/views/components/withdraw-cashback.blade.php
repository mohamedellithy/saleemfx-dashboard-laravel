 <div class="modal fade withdraw-cashback" id="modal-lg" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">طلب سحب ارباح </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="badge badge-info" style="font-size:100%"> الكاش باك الخاص بك   : {{ amount_currency(auth()->user()->total_cashback_can_withdraw()) }}</p>
                    @if(auth()->user()->total_cashback_can_withdraw() > 0)
                        <form method="post" action="{{ route('my-cashbacks.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <p class="label-model">قيمة المبلغ المطلوب للسحب</p>
                                        <input name="value" type="number" class="form-control" max="{{ auth()->user()->total_cashback_can_withdraw() }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <p class="label-model">اختار المحفظة لاستقبال الأرباح</p>
                                        <select name='wallet' class="select-companies" required>
                                            <option value>اختار المحفظة  </option>
                                            @forelse($payments as $payment)
                                                <option value="{{ $payment->ID }}"> {{ $payment->ar_payment_name }} </option>
                                            @empty
                                                <option> لا يوجد اى وسائل دفع متاحه</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <p class="label-model">رقم الحساب أو البريد الخاص بالحساب</p>
                                        <input name="wallet_account" type="text" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group container-button">
                                        <button type="submit" class="btn btn-success">
                                            ارسال الطلب
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <p class="alert alert-danger">   لا يمكنك اجراء عمليات سحب من الرصيد رصيدك الحالى غير كافى لاتمام عملية السحب</p>
                    @endif
                </div>

            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
