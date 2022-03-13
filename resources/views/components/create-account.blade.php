<div class="modal fade create-account" id="modal-lg" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">انشاء حساب جديد</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('my-accounts.store') }}">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xs-12" style="margin:auto;">
                            <img src="{{ asset('images/accounts.png') }}" />
                        </div>
                        
                        <div class="col-md-12">
                           
                            <div class="input-group mb-3">
                                <p class="label-model">اختار الشركة</p>
                                <select name='select-companies' class="select-companies" required>
                                    <option>اختار الشركة </option>
                                        @forelse($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name_ar ?? $company->name_en  }} </option>
                                        @empty
                                            <option>لا يوجد شركات </option>
                                        @endforelse
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <p class="label-model">رقم الحساب الخاص بك</p>
                                <input name="account_number" type="text" class="form-control"  required>
                            </div>

                            <div class="input-group mb-3">
                                <p class="label-model">قيمة التداول فى الشركة</p>
                                <input name="account_balance" type="number" step="1" class="form-control"  required>
                            </div>

                        </div>
                        
                        <div class="col-md-12">
                            <div class="input-group container-button">
                                <button type="submit" class="btn btn-success">
                                    اضافة الحساب
                                </button>
                            </div>
                        </div>
                    
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
