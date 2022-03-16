<div class="modal-header">
    <h4 class="modal-title">اضافةالكاش باك</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('cashback-accounts.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">

                <div class="input-group mb-3">
                     <p class="label-model">اسم العضو</p>
                     <input name="user_name" value="{{ $account_details ? $account_details->user->username : ''  }}" type="text" class="form-control" readonly>
                     <input name="user_id"   value="{{ $account_details ? $account_details->user->id : ''  }}" type="hidden" class="form-control" readonly>
                </div>

                <div class="input-group mb-3">
                    <p class="label-model">اسم شركة التداول</p>
                    <select name="company_id" class="select-companies">
                        @forelse($account_details->user->accounts as $account)
                            <option value="{{ $account->forex_company->id ?? '' }}">{{ $account->forex_company->name_ar ?? '' }} ( {{ $account->account_number ?? '' }} )</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <div class="input-group mb-3">
                    <p class="label-model">شهر التداول</p>
                    <input name="month"  type="month" class="form-control" max="{{ date('Y-m') }}" required>
                </div>

                <div class="input-group mb-3">
                    <p class="label-model">قيمة الكاش باك</p>
                    <input name="value" type="number"  min="0"  step="any" step="0.25"   class="form-control"  required>
                </div>

            </div>
            <div class="col-md-12">
                <div class="input-group container-button">
                    <button type="submit" class="btn btn-success">
                        اضافة قيمة الكاش باك
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
  <script>
        $(document).ready(function(){
           $('.select-companies').select2();
        })
    </script>
