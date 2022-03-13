<?php

namespace App\Imports;

use App\CashBack;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Account;
use App\ForexCompany;
use Illuminate\Support\Facades\Hash;
class CashBacksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
            set_time_limit(80000000);
            
            if(!empty($row[0])){
                $account = Account::where([
                    'account_number'=>trim($row[0]),
                    'status' =>1
                ])->first();
                try{
                    if($account){
                        # here add value affiliates to account that have it
                        if($account->user){
                            if($account->user->is_invited_by_affiliate()):
                                $account->user->affiliatee->profits()->create([
                                    'value'     =>  \App\Http\Controllers\CashBackController::affiliate_profit(trim($row[1]),$account->user->affiliatee->id),
                                    'invitee_id'=>$account->user->id
                                ]);
                            endif;
                            
                            return new CashBack([
                                //
                                'account_id' => $account->id,
                                'value'      => trim($row[1]),
                                'month'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(trim($row[2]))->format('Y-m'),
                            ]);
                        }
                    }
                } catch(\Exception $exception){
                    
                }
            }
        
        
    }
}
