<?php

namespace App\DataTables;

use App\DataTables\WithdrawProfitsOrderAffiliateDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\BalanceWithdraw;
class WithdrawProfitsOrderAffiliateDataTable extends DataTable
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
                return $row->Withdrawable->affiliaters->username;
            })
            ->addColumn('withdraw_value', function(BalanceWithdraw $row){
                return amount_currency($row->withdraw_value);
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
                      <a class="dropdown-item '.($row->status == 0 ? 'hidden-item-status':'').'"  href="'.url("change-withdraw-affiliate-order-status/".$row->id."/0").'" >الى بانتظار تأكيد الدفع </a>
                      <a class="dropdown-item '.($row->status == 1 ? 'hidden-item-status':'').'"  href="'.url("change-withdraw-affiliate-order-status/".$row->id."/1").'"> الى تأكيد الدفع </a>
                      <a class="dropdown-item '.($row->status == 2 ? 'hidden-item-status':'').'"  href="'.url("change-withdraw-affiliate-order-status/".$row->id."/2").'"> الى الغاء</a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(BalanceWithdraw $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\WithdrawProfitsOrderAffiliateDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WithdrawProfitsOrderAffiliateDataTable $model)
    {
        $status = $this->status;
        $withdraw_pending_orders  = BalanceWithdraw::select('*')->where([
            'withdrawable_type'=> 'App\Affiliate',
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
                    ->setTableId('WithdrawProfitsOrderAffiliateDataTable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
                Column::make('withdraw_value')->title(' قيمة المبلغ المطلوب للسحب'),
                Column::make('status')->title('حالة الطلب'),
                Column::make('created_at')->title('تاريخ الانشاء'),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(200)
                    ->addClass('text-center'),
            ];
        else:
            return [
                Column::make('id'),
                Column::make('user_name')->title('اسم المستخدم'),
                Column::make('withdraw_value')->title(' قيمة المبلغ المسحوب'),
                Column::make('status')->title('حالة الطلب'),
                Column::make('created_at')->title('تاريخ الانشاء'),
                Column::computed('action')->title('')
                    ->exportable(false)
                    ->printable(false)
                    ->width(200)
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
        return 'WithdrawProfitsOrderAffiliate_' . date('YmdHis');
    }
}
