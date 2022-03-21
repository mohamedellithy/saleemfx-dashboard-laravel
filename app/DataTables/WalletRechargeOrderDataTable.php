<?php

namespace App\DataTables;

use App\DataTables\WalletRechargeOrderDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\WalletRechargeOrder;
class WalletRechargeOrderDataTable extends DataTable
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
            ->addColumn('username', function(WalletRechargeOrder $row){
                return $row->user ? $row->user->username : '-';
            })
            ->addColumn('value', function(WalletRechargeOrder $row){
                return amount_currency($row->value);
            })
            ->addColumn('paymentmethod', function(WalletRechargeOrder $row){
                return $row->payment_method ? $row->payment_method->ar_payment_name : '-';
            })
            ->addColumn('details', function(WalletRechargeOrder $row){
                $data  ='<a class="btn btn-info" href="'.url('wallet-recharge-orders/'.$row->id).'"> تفاصيل الطلب </a>';
                return $data;
            })
            ->addColumn('status', function(WalletRechargeOrder $row){
                return $row->status_order;
            })
            ->addColumn('action', function(WalletRechargeOrder $row){
                $data = '<div class="btn-sm btn-group">
                    <button type="button" class="btn btn-sm '.($row->status == 0 ? 'btn-danger' : 'btn-success').'">تغير الحالة</button>
                    <button type="button" class="btn btn-sm '.($row->status == 0 ? 'btn-danger' : 'btn-success').' dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item '.($row->status == 0 ? 'hidden-item-status':'').'"  href="'.url("change-wallet-recharge-orders/".$row->id."/0").'" >قيد التنفيذ </a>
                      <a class="dropdown-item '.($row->status == 1 ? 'hidden-item-status':'').'"  href="'.url("change-wallet-recharge-orders/".$row->id."/1").'"> قبول الطلب </a>
                      <a class="dropdown-item '.($row->status != 0 ? 'hidden-item-status':'').'"  href="'.url("change-wallet-recharge-orders/".$row->id."/2").'"> رفض الطلب </a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(WalletRechargeOrder $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\WalletRechargeOrderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WalletRechargeOrderDataTable $model)
    {
        if($this->status != null):
            $this->status--;
            $orders = WalletRechargeOrder::select('*')->where('status',$this->status)->orderBy('created_at','desc');
        else:
            $orders = WalletRechargeOrder::select('*')->orderBy('created_at','desc');
        endif;
        return $this->applyScopes($orders);
        # return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('walletrechargeorderdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(5)
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
            Column::make('id'),
            Column::make('value')->title('قيمة المبلغ'),
            Column::make('username')->title('اسم العضو'),
            Column::make('paymentmethod')->title('بوابة الدفع'),
            Column::make('status')->title('حالة الطلب'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::make('details')->title('تفاصيل الطلب')->exportable(false)->printable(false),
            Column::computed('action')->title('')
                  ->exportable(false)
                  ->printable(false)
                  ->width(160)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'WalletRechargeOrder_' . date('YmdHis');
    }
}
