<?php

namespace App\DataTables;

use App\DataTables\MyExpertsFilesDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\ExpertsFiles;
class MyExpertsFilesDataTable extends DataTable
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
            ->addColumn('action', function(ExpertsFiles $row){
                $data ='<a href="'.url('storage/'.$row->attachments()->first()->attachment_url ?? '').'" class="btn btn-success btn-sm" download rel="noopener noreferrer">'.__('master.download').'</a>';
                if($row->allow == 0):
                    $order = auth()->user()->file_orders()->where('expert_file_id',$row->id)->first();
                    if(empty($order)):
                        $data ='<form method="post" action="'.url('experts-files-orders').'">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="expert_file_id" value="'.$row->id.'">
                                    <button type="submit" href="'.url('storage/'.$row->attachments()->first()->attachment_url).'" class="btn btn-sm btn-warning btn-sm"> '.__('master.request').'  </button>
                                </form>';
                    else:
                        if($order->status == 0):
                            $data = '<label class="badge bg-primary bg-sm" style="padding: 8px;">'.__('master.waiting-for-request-review').'/label>';
                        elseif($order->status == 2):
                            $data = '<label class="badge bg-danger bg-sm" style="padding: 8px;">'.__('master.refused').'</label>';
                        endif;
                    endif;
                endif;
                return $data;
            })->addColumn('created_at',function(ExpertsFiles $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\MyExpertsFilesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MyExpertsFilesDataTable $model)
    {
        $files = ExpertsFiles::select('*')->orderBy('created_at','desc');
        return $this->applyScopes($files);
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
                    ->setTableId('myexpertsfilesdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Lfrtip')
                    ->orderBy(3)
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
            Column::make('name')->title(__('master.expert-file-name')),
            Column::make('description')->title(__('master.description-of-the-expert-file')),
            Column::make('created_at')->title(__('master.created_at')),
            Column::computed('action')->title(__('master.download'))
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
        return 'MyExpertsFiles_' . date('YmdHis');
    }
}
