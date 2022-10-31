<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\CashBack;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'id','firstname','lastname','phone','country','telegram_number','username', 'email', 'password','reference_affiliate_id','role','email_verified_at','created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function isAdmin(){
        return ($this->role == 1 ? true :false);
    }

    function isUser(){
        return ($this->role == 0 ? true :false);
    }

    function isAffiliater(){
         return ($this->role == 0 || $this->role == 2 ? true :false);
    }

    function isEmployee(){
        return $this->affiliates()->where('employee',1)->exists();
    }


    function adminlte_profile_url(){
        return url('/me/');
    }
    public function profile(){
        return 'ji';
    }

    function adminlte_image(){
        return asset('vendor/adminlte/dist/img/AdminLTELogo.png');
    }

    public function posts(){
        return $this->hasOne(ModelWordpress\ForexCompany::class,'ID','post_id')->withTrashed();
    }

    public function accounts(){
        return $this->hasMany('App\Account','user_id','id')->withTrashed();
    }

    public function expire_cashbacks(){
        return $this->hasMany('App\ExpireCashback','user_id','id');
    }

    public function services_orders(){
        return $this->hasMany('App\ServicesOrder','user_id','id')->withTrashed();
    }

    public function allow_services_order(){
        return $this->services_orders()->where('status','!=',2)->get();
    }

    public function getActiveAccountsAttribute(){
        //active_accounts
        return $this->accounts()->where('status',1)->get();
    }

    public function file_orders(){
        return $this->hasMany('App\FileOrder','user_id','id');
    }

    public function affiliates(){
        return $this->hasOne('App\Affiliate','inviter_id','id');
    }

    public function affiliatee(){
        return $this->belongsTo('App\Affiliate','reference_affiliate_id','id');
    }


    public function is_affiliater(){
        return $this->affiliates()->exists();
    }

    public function is_invited_by_affiliate(){
        return $this->affiliatee()->exists();
    }

    public function directrix_orders(){
        return $this->hasMany('App\DirectrixOrder','user_id','id');
    }

    public function cashbacks(){
        return $this->hasManyThrough(CashBack::class,Account::class,'user_id','account_id','id','id')->withTrashedParents();
    }

    public function vip_order(){
        return $this->hasMany('App\VipOrder','user_id','id');
    }


    public function withdraw_for_services(){
        return $this->hasManyDeep(BalanceWithdraw::class, [Account::class,ServicesOrder::class], [null,null, ['withdrawable_type', 'withdrawable_id']]);
    }

    public function withdraw_form_cashbacks(){
        return $this->morphMany(BalanceWithdraw::class, 'withdrawable');
    }

    public function withdraw_cashbacks_pendings_total(){
        return $this->withdraw_form_cashbacks()->where('status',0)->sum('withdraw_value');
    }

    function total_cashbacks_withdraws(){
        return $this->withdraw_form_cashbacks->where('status',1)->sum('withdraw_value') ?? 0;
    }

    public function wallet_order(){
        return $this->hasMany('App\WalletRechargeOrder','user_id','id');
    }
    function total_recharge(){
        return $this->wallet_order()->where('status',1)->sum('value') ?? 0;
    }

    function total_withdraws(){
        return $this->withdraw_for_services()->sum('withdraw_value') + $this->total_cashbacks_withdraws();
    }

    function total_cashback(){
        $accounts_id = $this->accounts()->pluck('id')->toArray();
        return CashBack::whereIn('account_id',$accounts_id)->sum('value') ?? 0;
    }

    function total_cashback_can_withdraw(){
        $cashback = $this->total_cashback() - $this->total_cashbacks_withdraws();
        if($cashback > $this->withdraw_for_services()->sum('withdraw_value')){
            return $cashback - $this->withdraw_for_services()->sum('withdraw_value');
        }
        return 0;
    }

    function total_balance(){
        return $this->total_recharge() + $this->total_cashback() -  $this->total_withdraws();
    }



    function getAccountBalanceValueAttribute(){
        /* account_balance_value */
        $account = $this->accounts()->where('status',1)->first();
        return $account ? $account->account_balance : 0;
    }

    public function getNotHaveAccountsAttribute(){
        // not_have_accounts
        return $this->accounts()->where('status',1)->exists() ? false : true;
    }
}
