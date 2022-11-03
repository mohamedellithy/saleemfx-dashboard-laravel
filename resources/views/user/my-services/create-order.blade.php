<div class="modal-header">
    <h4 class="modal-title">{{ __('master.subscrib_services') }} ( {{ $services_details->post_title }} )</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>

<div class="modal-body">
        @if($type == 'create')
            <form method="POST" action="{{ route('my-services.store') }}">
            @csrf
        @elseif($type == 'edit')
            <form method="POST" action="{{ route('my-services.update',$orderId) }}">
            @csrf
            @method('PUT')
        @endif

        <div class="row">
            <input  name="service_id" type="hidden"  value="{{ $services_details->ID }}"  class="form-control"  required>

            @if(!auth()->user()->not_have_accounts)
                <div class="col-md-12">
                    <div class="input-group mb-3">
                        <p class="label-model">{{ __('master.forex_account') }}</p>
                        <select name="account_id" class="select-account">
                            @forelse(auth()->user()->active_accounts as $account)
                                <option value="{{ $account->id }}" {{ $account->id ==  $accounts_forex->id  ? 'selected' : '' }} > {{ $account->forex_company->name_ar ?? '' }} </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
            @endif

            @if(auth()->user()->not_have_accounts)

                <div class="col-md-12">
                    <div class="input-group mb-3">
                        <p class="label-model"> {{ __('master.service-subscription-price') }} ( $ )</p>
                        <input  name="value" type="text"  value="{{ $services_details->meta->service_price }}"  class="form-control"  required readonly>
                    </div>

                    <div class="input-group mb-3">
                        <p class="label-model">{{ __('master.months_account') }}</p>
                        <select name="period" class="select-periods">
                            @for($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}"> {{ $month }} {{ __('master.month') }}  -  ( {{ amount_currency($services_details->meta->service_price * $month) }} ) </option>
                            @endfor
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <p class="label-model">{{ __('master.totale_cost') }}</p>
                        {{ amount_currency() }} <h3 class="total-cost"> {{ $services_details->meta->service_price * 1 }}  </h3>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-group container-button">
                        <button type="submit" class="btn btn-success">
                          {{ __('master.subscription-to-the-service') }}
                        </button>
                    </div>
                </div>

            @elseif($accounts_forex->account_balance >= $services_details->meta->minimum_subscription)

                <div class="col-md-12">
                     <p class="alert alert-info"> {{ __('master.forex_arabic_name') }}: {{ $accounts_forex->forex_company->name_ar ?? 0 }} / : {{ $accounts_forex->account_number ?? 0 }} </p>
                     <p class="alert alert-info"> {{ __('master.forex_company_cost') }}: {{ $accounts_forex->account_balance ?? 0 }} </p>
                     <p class="alert alert-info"> {{ __('master.minimum-subscription-for-the-service') }} : {{ amount_currency($services_details->meta->minimum_subscription) }} </p>

                </div>

                <div class="col-md-12">


                    <div class="input-group mb-3">
                        <p class="label-model"> {{ __('master.service-subscription-price') }} ( $ )</p>
                        <input  name="value" type="text"  value="{{ $services_details->meta->service_price_for_account_forex }}"  class="form-control"  required readonly>
                    </div>

                    <div class="input-group mb-3">
                        <p class="label-model">{{ __('master.months_account') }}</p>
                        <select name="period" class="select-periods">
                            @for($month = 1; $month <= 12; $month++)
                                <option value="{{ $month }}"> {{ $month }} {{ __('master.month') }}  -  ( {{ amount_currency($services_details->meta->service_price_for_account_forex * $month) }} ) </option>
                            @endfor
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <p class="label-model">{{ __('master.totale_cost') }}</p>
                        {{ amount_currency() }} <h3 class="total-cost-for-acccount-forex"> {{ $services_details->meta->service_price_for_account_forex * 1 }}  </h3>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="input-group container-button">
                        <button type="submit" class="btn btn-success">
                         {{ __('master.subscrib_services') }}
                        </button>
                    </div>
                </div>

            @else

                <div class="col-md-12">
                    <p class="alert alert-danger"> {{ __('master.descrip_forex_value') }} </p>
                    <p class="alert alert-info"> {{ __('master.forex_company_cost_d') }} : {{ amount_currency($accounts_forex->account_balance) }} </p>
                    <p class="alert alert-info"> {{ __('master.minimum-subscription-for-the-service') }} : {{ amount_currency($services_details->meta->minimum_subscription) }} </p>
                </div>

            @endif

        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('.select-periods , .select-account').select2();
    });

    $(document).on('change','.select-periods',function(){
        var period_count = $(this).val();
        $('.total-cost').html("{{ $services_details->meta->service_price ?? 0 }}" * period_count);
        $('.total-cost-for-acccount-forex').html("{{ $services_details->meta->service_price_for_account_forex ?? 0 }}" * period_count);
    });

    jQuery('.modal-lg').off().on('change','.select-account',function(e){
        var SERVICES_ID =  "{{ $services_details->ID }}";
        var type_form   =  "{{ $type }}";
        var orderId     =  "{{$orderId}}";
        var account_id  =  $(this).val();
        console.log( account_id);
        $.ajax({
            type:'GET',
            url:"{{ route('my-services.create') }}",
            data:{
                ID:SERVICES_ID,
                type_form:type_form,
                order_id:orderId,
                account_id:account_id
            },
            success:function(data){
                jQuery('.modal-content').html(data.html)
            }
        });
        return 0;
    });
</script>
