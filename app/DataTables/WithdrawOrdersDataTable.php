<?php

namespace App\DataTables;

use App\DataTables\WithdrawOrdersDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\BalanceWithdraw;
class WithdrawOrdersDataTable extends DataTable
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
            ->addColumn('user_name', function(BalanceWithdraw $row){
                return $row->Withdrawable->username;
            })
            ->addColumn('user_balance', function(BalanceWithdraw $row){
                return $row->Withdrawable->total_cashback_can_withdraw();
            })
            ->addColumn('withdraw_value', function(BalanceWithdraw $row){
                return amount_currency($row->withdraw_value);
            })
            ->addColumn('wallet', function(BalanceWithdraw $row){
                return $row->wallet ?? '';
            })
            ->addColumn('wallet_account', function(BalanceWithdraw $row){
                return $row->wallet_account ?? '';
            })
            ->addColumn('status', function(BalanceWithdraw $row){
                return $row->status_order;
            })
            ->addColumn('action', function(BalanceWithdraw $row){
                $data = '<div class="btn-group">
                    <button type="button" class="btn btn-warning">تغير الحالة</button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item '.($row->status == 0 ? 'hidden-item-status':'').'"  href="'.url("change-withdraw-order-status/".$row->id."/0").'" >الى بانتظار تأكيد الدفع </a>
                      <a class="dropdown-item '.($row->status == 1 ? 'hidden-item-status':'').'"  href="'.url("change-withdraw-order-status/".$row->id."/1").'"> الى تأكيد الدفع </a>
                      <a class="dropdown-item '.($row->status == 2 ? 'hidden-item-status':'').'"  href="'.url("change-withdraw-order-status/".$row->id."/2").'"> الى الغاء</a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(BalanceWithdraw $row){
                return $row->created_at;
            })
            ->addColumn('details',function(BalanceWithdraw $row){
                $data  ='<a  href="'.url('users/'.$row->Withdrawable->id).'" class="btn btn-info action-datatable-btn">تفاصيل </a>';
                return $data;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\CashbackWithdrawOrdersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WithdrawOrdersDataTable $model)
    {
        $status = $this->status == 'pending' ? 0 : $this->status;
        $withdraw_pending_orders  = BalanceWithdraw::select('*')->where([
            'withdrawable_type'=> 'App\User',
            'status'           => $status,
        ])->get();

        return $this->applyScopes($withdraw_pending_orders);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('cashbackwithdrawordersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                        'colvis'
                    )
                    ->parameters([
                       'responsive' => true,
                        'autoWidth' => false
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if($this->status == 'pending'):
            return [
                Column::make('id'),
                Column::make('user_name')->title('اسم المستخدم'),
                Column::make('withdraw_value')->title('المبلغ المطلوب'),
                Column::make('wallet')->title('المحفظة'),
                Column::make('wallet_account')->title('رقم حساب المحفظة'),
                Column::make('status')->title('حالة الطلب'),
                Column::make('created_at')->title('تاريخ الانشاء'),
                Column::make('details')->title('تفاصيل')
                    ->exportable(false)
                    ->printable(false),
                Column::computed('action')->title('')
                    ->exportable(false)
                    ->printable(false)
                    ->width(100)
                    ->addClass('text-center'),
            ];
        else:
            return [
                Column::make('id'),
                Column::make('user_name')->title('اسم المستخدم'),
                Column::make('withdraw_value')->title(' قيمة المبلغ المسحوب'),
                Column::make('status')->title('حالة الطلب'),
                Column::make('wallet')->title('المحفظة'),
                Column::make('wallet_account')->title('رقم حساب المحفظة'),
                Column::make('created_at')->title('تاريخ الانشاء'),
                Column::make('details')->title('تفاصيل')
                    ->exportable(false)
                    ->printable(false),
                Column::computed('action')->title('')
                    ->exportable(false)
                    ->printable(false)
                    ->width(100)
                    ->addClass('text-center'),
            ];
        endif;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'WithdrawOrders_' . date('YmdHis');
    }
}
