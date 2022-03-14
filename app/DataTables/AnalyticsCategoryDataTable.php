<?php

namespace App\DataTables;

use App\dataTables\AnalyticsCategoryDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\AnalyticsCategory;
class AnalyticsCategoryDataTable extends DataTable
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
            ->addColumn('action', function(AnalyticsCategory $row){
               $data = '<form method="post" action="'.url('analytics-categories/'.$row->id).'">
               <input type="hidden" name="_token" value=" '.csrf_token().' ">
               <input type="hidden" name="_method" value="DELETE">
               <button type="submit" class="btn btn-sm btn-danger">حذف</button>
               </form>';
               $data .='<a href="'.url('analytics-categories/'.$row->id.'/edit').'" class="btn btn-sm btn-info action-datatable-btn">تعديل </a>';
               return $data;
            })
            ->addColumn('created_at',function(AnalyticsCategory $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\AnalyticsCategoryDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AnalyticsCategoryDatatable $model)
    {
        $analytics_category = AnalyticsCategory::latest()->get();
        return $this->applyScopes($analytics_category);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('analyticscategorydatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(3)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
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
        return [
            Column::make('id'),
            Column::make('name_ar'),
            Column::make('name_en'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
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
        return 'AnalyticsCategory_' . date('YmdHis');
    }
}
