<?php

namespace App\DataTables;

use App\DataTables\myProfitAffiliatesDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\ProfitAffiliate;
class myProfitAffiliatesDataTable extends DataTable
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
            ->addColumn('inviter',function(ProfitAffiliate $row){
                return $row->affiliater->affiliaters->email;
            })
            ->addColumn('invitee',function(ProfitAffiliate $row){
                return $row->affiliatee->email;
            })
            ->addColumn('value_profits',function(ProfitAffiliate $row){
                return amount_currency($row->value);
            })
            ->addColumn('created_at',function(ProfitAffiliate $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Datatables\affiliatersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(myProfitAffiliatesDataTable $model)
    {
        # return $model->newQuery();
        $profits = auth()->user()->affiliates ? auth()->user()->affiliates->employee_comissions : collect();
        return $this->applyScopes($profits);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('affiliatersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Lfrtip')
                    ->orderBy(4)
                    ->buttons(
                        Button::make('export')->columns(':visible'),
                        Button::make('print')->columns('visible'),
                        Button::make('reset'),
                        Button::make('reload'),
                        'colvis'
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
            Column::make('inviter')->title(__('master.affiliater-marketing')),
            Column::make('invitee')->title(__('master.invitee')),
            Column::make('value_profits')->title(__('master.profit_value')),
            Column::make('created_at')->title(__('master.the-date-of-adding-the-profit')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
