<?php

namespace App\DataTables;

use App\DataTables\CashBackDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\CashBack;
class CashBackDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->addColumn('checkbox_select',function(CashBack $row){
                $data = "<input class='select-items-db' type='checkbox' name='checkbox' value='".$row->id."' />";
                return $data;
            })
            ->addColumn('company_name',function(CashBack $row){
                return $row->account ? $row->account->forex_company->name_ar : '';
            })
            ->addColumn('user_name',function(CashBack $row){
                return $row->account ? $row->account->user->username : '';
            })
            ->addColumn('account_number',function(CashBack $row){
                return $row->account ? $row->account->account_number : '';
            })
            ->addColumn('value', function(CashBack $row){
                return amount_currency($row->value);
            })
            ->addColumn('cashback_active', function(CashBack $row){
                if($row->cashback_allow_to_withdraw()):
                    $data = '<i class="fas fa-circle" style="color:#51d851"></i>';
                else:
                    $data = '<i class="fas fa-circle" style="color:red"></i>';
                endif;

                return $data;
            })
            ->addColumn('action', function(CashBack $row){
                $data = '<form class="form-delete" method="post" action="'.url('cashback-accounts/'.$row->id).'">
                    <input type="hidden" name="_token" value=" '.csrf_token().' ">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger btn-sm">حذف</button>
                    </form>';
                $data .= '<div class="btn-sm btn-group btn-sm" style="margin:0px 3px;">
                    <button type="button" class="btn '.($row->allow == 0 ? 'btn-info' : 'btn-success').' btn-sm">اجراءات</button>
                    <button type="button" class="btn '.($row->allow == 0 ? 'btn-info' : 'btn-success').' btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item updateCashback" data-ID="'.$row->id.'">تعديل </a>
                      <a class="dropdown-item addCashback"    data-ID="'.$row->account->id.'"> اضافة </a>
                      <a class="dropdown-item "   href="'.url('users/'.$row->id).'"> تفاصيل </a>
                    </div>
                  </div>';
               return $data;
            })->addColumn('created_at',function(CashBack $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\CashBackDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CashBackDataTable $model)
    {
        $cashback_Query = CashBack::select('*');
        if($this->from){
            $cashback_Query = $cashback_Query->whereBetween('created_at',[$this->from,$this->to]);
        }

        if($this->filter_cashbacks){

            $date_max_ended = strtotime("-".Options()->setting['max_date_cashback_withdraw']." months");

            if($this->filter_cashbacks     == 1):

                $cashback_Query = $cashback_Query->where('created_at','<',date('Y-m-d H:i:s',$date_max_ended));

            elseif($this->filter_cashbacks == 2):

                $cashback_Query = $cashback_Query->where('created_at','>=',date('Y-m-d H:i:s',$date_max_ended));

            endif;
        }

        $cashback_Query = $cashback_Query->orderBy('created_at','desc');
        return $this->applyScopes($cashback_Query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('cashbackdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(7)
                    ->buttons(
                        Button::make('excel')->columns(':visible'),
                        Button::make('print'),
                        Button::make('reset')
                    )
                    ->parameters([
                       'responsive' => true,
                        'autoWidth' => false,
                        'lengthMenu' => [
                            [ 25, 50,100,-1 ],
                            [ '25 rows', '50 rows', '100 rows', 'Show all' ]
                        ]
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('checkbox_select')->title(''),
            Column::make('id')->title('رقم'),
            Column::make('month')->title('الشهر'),
            Column::make('company_name')->title('اسم الشركة'),
            Column::make('user_name')->title('اسم المستخدم'),
            Column::make('account_number')->title('رقم الحساب')->searchable(true),
            Column::make('value')->title('قيمة المبلغ'),
            Column::make('cashback_active')->title('قابل للسحب'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::computed('action')->title('')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CashBackDataTables_' . date('YmdHis');
    }
}
