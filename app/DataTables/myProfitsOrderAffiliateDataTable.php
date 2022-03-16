<?php

namespace App\DataTables;

use App\App\myProfitsOrderAffiliate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\BalanceWithdraw;
class myProfitsOrderAffiliateDataTable extends DataTable
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
            ->addColumn('created_at',function(BalanceWithdraw $row){
                return $row->created_at;
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
        $status = $this->status;
        $withdraw_pending_orders  = auth()->user()->affiliates ? auth()->user()->affiliates->withdraw()->where([
            'withdrawable_type'=> 'App\Affiliate',
            'status'           => $status,
        ])->get() : collect();


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
                    ->setTableId('affiliateWithdrawOrdersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Lfrtip')
                    ->orderBy(4)
                    ->buttons(
                        Button::make('excel')->columns(':visible'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
        if($this->status == 'pending'):
            return [
                Column::make('id'),
                Column::make('user_name')->title('اسم المستخدم'),
                Column::make('withdraw_value')->title(' قيمة المبلغ المطلوب للسحب'),
                Column::make('status')->title('حالة الطلب'),
                Column::make('created_at')->title('تاريخ الانشاء')
            ];
        else:
            return [
                Column::make('id'),
                Column::make('user_name')->title('اسم المستخدم'),
                Column::make('withdraw_value')->title(' قيمة المبلغ المسحوب'),
                Column::make('status')->title('حالة الطلب'),
                Column::make('created_at')->title('تاريخ الانشاء')
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
        return 'affiliateWithdrawOrders_' . date('YmdHis');
    }
}
