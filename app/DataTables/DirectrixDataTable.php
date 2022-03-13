<?php

namespace App\DataTables;

use App\DataTables\DirectrixDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Directrix;
class DirectrixDataTable extends DataTable
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
            ->addColumn('action', function(Directrix $row){
               $data = '<form method="post" action="'.url('experts-files/'.$row->id).'" onsubmit="FormSubmitDelete(event)">
               <input type="hidden" name="_token" value=" '.csrf_token().' ">
               <input type="hidden" name="_method" value="DELETE">
               <button type="submit" class="btn btn-danger">حذف</button>
               </form>';
               $data .='<a href="'.url('directrix-files/'.$row->id.'/edit').'" class="btn btn-info action-datatable-btn">تعديل </a>';
               return $data;
            })
            ->addColumn('status', function(Directrix $row){
               $data = '<div class="btn-group">
                    <button type="button" class="btn '.($row->allow == 0 ? 'btn-danger' : 'btn-success').'">'.($row->allow == 0 ? 'غير مسموح' : 'مسموح').'</button>
                    <button type="button" class="btn '.($row->allow == 0 ? 'btn-danger' : 'btn-success').' dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item '.($row->allow == 0 ? 'hidden-item-status':'').'"  href="'.url("change-status-experts-files/".$row->id."/0").'" >غير مسموح </a>
                      <a class="dropdown-item '.($row->allow == 1 ? 'hidden-item-status':'').'"  href="'.url("change-status-experts-files/".$row->id."/1").'"> مسموح </a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(Directrix $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\ExpertsFilesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DirectrixDataTable $model)
    {
        $ExpertsFiles = Directrix::select('*')->latest()->get();
        return $this->applyScopes($ExpertsFiles);
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
                    ->setTableId('expertsfilesdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
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
        return [
            Column::make('id'),
            Column::make('name')->title('اسم الملف'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::make('status')->title('السماح بالملف'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
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
        return 'ExpertsFiles_' . date('YmdHis');
    }
}
