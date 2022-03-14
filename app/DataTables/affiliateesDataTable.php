<?php

namespace App\DataTables;

use App\DataTables\affiliatee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\User;
use DB;
class affiliateesDataTable extends DataTable
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
            ->addColumn('created_at',function(User $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\affiliateesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(affiliateesDataTable $model)
    {
        # return $model->newQuery();
        $users = auth()->user()->affiliates ? auth()->user()->affiliates->affiliatees()->latest()->get() : collect();
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
                    ->setTableId('affiliatesdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Lfrtip')
                    ->orderBy(3)
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
            Column::make('username')->title('اسم المستخدم'),
            Column::make('email')->title('البريد اللكترونى'),
            Column::make('created_at')->title('تاريخ التسجيل'),

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
