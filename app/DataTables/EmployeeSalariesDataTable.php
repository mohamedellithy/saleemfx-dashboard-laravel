<?php

namespace App\DataTables;

use App\DataTables\ProfitAffiliateEmployeesDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\ProfitAffiliate;
class EmployeeSalariesDataTable extends DataTable
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
    public function query(affiliatersDataTable $model)
    {
        # return $model->newQuery();
        $profits = auth()->user()->affiliates ? auth()->user()->affiliates->employee_salaries : collect();
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
                    ->orderBy(2)
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
            Column::make('value_profits')->title('المرتب'),
            Column::make('created_at')->title('تاريخ اضافة المرتب')
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
