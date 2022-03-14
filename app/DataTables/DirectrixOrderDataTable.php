<?php

namespace App\DataTables;

use App\DataTables\DirectrixOrderDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\DirectrixOrder;
class DirectrixOrderDataTable extends DataTable
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
            ->addColumn('username', function(DirectrixOrder $row){
                return $row->user->username ?? '-';
            })
            ->addColumn('file_name', function(DirectrixOrder $row){
                return $row->directrix_file->name ?? '-';
            })
            ->addColumn('action', function(DirectrixOrder $row){
                $data = '<div class="btn-group">
                    <button type="button" class="btn btn-sm '.($row->status == 1 ? 'btn-success' : 'btn-danger').'">'.$row->status_order.'</button>
                    <button type="button" class="btn btn-sm '.($row->status == 1 ? 'btn-success' : 'btn-danger').' dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item '.($row->status == 0 ? 'hidden-item-status':'').'"  href="'.url("change-status-directrix-files-order/".$row->id."/0").'"> قيد التنفيذ </a>
                      <a class="dropdown-item '.($row->status == 1 ? 'hidden-item-status':'').'"  href="'.url("change-status-directrix-files-order/".$row->id."/1").'"> مسموح </a>
                      <a class="dropdown-item '.($row->status == 2 ? 'hidden-item-status':'').'"  href="'.url("change-status-directrix-files-order/".$row->id."/2").'" >غير مسموح </a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(DirectrixOrder $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\ExpertsFilesOrderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DirectrixOrderDataTable $model)
    {
        $directrix_file_order = DirectrixOrder::select('*')->latest()->get();
        return $model->applyScopes($directrix_file_order);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('directrixfilesorderdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::make('username'),
            Column::make('file_name'),
            Column::make('created_at'),
            Column::computed('action')
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
        return 'DirectrixFilesOrder_' . date('YmdHis');
    }
}
