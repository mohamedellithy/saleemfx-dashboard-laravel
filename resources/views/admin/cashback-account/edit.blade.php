<div class="modal-header">
    <h4 class="modal-title">تعديل الكاش باك</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('cashback-accounts.update',$cashback_details->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">

                <div class="input-group mb-3">
                    <p class="label-model">اسم العضو</p>
                    <input name="user_name" value="{{ $cashback_details->account ? $cashback_details->account->user->username : ''  }}" type="text" class="form-control" readonly>
                </div>

                <div class="input-group mb-3">
                    <p class="label-model">اسم شركة التداول</p>
                    <input name="company_name" value="{{ $cashback_details->account ? $cashback_details->account->forex_company->name_ar : ''  }}" type="text" class="form-control" readonly>
                </div>


                <div class="input-group mb-3">
                    <p class="label-model">رقم حساب شركة التداول</p>
                    <input name="image" type="number" value="{{ $cashback_details->account ? $cashback_details->account->account_number : ''  }}" class="form-control" readonly>
                </div>

                <div class="input-group mb-3">
                    <p class="label-model">شهر التداول</p>
                    <input name="month" value="{{ $cashback_details ? date('Y-m',strtotime($cashback_details->month)) : ''  }}" type="month" max="{{ date('Y-m') }}" class="form-control" required>
                </div>

                <div class="input-group mb-3">
                    <p class="label-model">قيمة الكاش باك</p>
                    <input name="value" type="number"  min="0"  step="any" step="0.25" value="{{ $cashback_details ? $cashback_details->value : ''  }}"  class="form-control"  required>
                </div>

            </div>
            <div class="col-md-12">
                <div class="input-group container-button">
                    <button type="submit" class="btn btn-success">
                        تعديل قيمة الكاش باك
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
