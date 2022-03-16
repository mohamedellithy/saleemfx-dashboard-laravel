<?php

namespace App\DataTables;

use App\DataTables\ProfitAffiliateEmployeesDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\ProfitAffiliate;
class ProfitAffiliateEmployeesDataTable extends DataTable
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
            ->addColumn('value_profits',function(ProfitAffiliate $row){
                return amount_currency($row->value);
            })
            ->addColumn('created_at',function(ProfitAffiliate $row){
                return $row->created_at;
            })
            ->addColumn('action',function(ProfitAffiliate $row){
                $data  ='<a href="'.url('affiliater/'.$row->affiliater->affiliaters->id).'" class="btn btn-sm btn-info action-datatable-btn">تفاصيل </a>';
                return $data;
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
        $users = ProfitAffiliate::select('*')->where('salary',1)->get();
        return $this->applyScopes($users);
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
                    ->dom('Blfrtip')
                    ->orderBy(3)
                    ->buttons(
                        Button::make('excel')->columns(':visible'),
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
            Column::make('inviter')->title('المسوق الالكترونى'),
            Column::make('value_profits')->title('المرتب'),
            Column::make('created_at')->title('تاريخ اضافة المرتب'),
            Column::make('action')->title('')
            
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
