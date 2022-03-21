<?php

namespace App\DataTables;

use App\DataTables\MyDirectrix;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Directrix;
class MyDirectrixDataTable extends DataTable
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
                $data ='<a href="'.url('storage/'.$row->attachments()->first()->attachment_url).'" class="btn btn-sm btn-success btn-sm" download>تحميل</a>';
                if($row->allow == 0):
                    $order = auth()->user()->directrix_orders()->where('directrix_file_id',$row->id)->first();
                    if(empty($order)):
                        $data ='<form method="post" action="'.url('directrix-files-orders').'">
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" name="directrix_file_id" value="'.$row->id.'">
                                    <button type="submit" href="'.url('storage/'.$row->attachments()->first()->attachment_url).'" class="btn btn-sm btn-warning btn-sm"> طلب  </button>
                                </form>';
                    else:
                        if($order->status == 0):
                            $data = '<label class="badge bg-primary bg-sm" style="padding: 8px;">جارى مراجعة الطلب</label>';
                        elseif($order->status == 2):
                            $data = '<label class="badge bg-danger bg-sm" style="padding: 8px;">تم رفض الطلب</label>';
                        endif;
                    endif;
                endif;
                return $data;
            })->addColumn('created_at',function(Directrix $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\MyExpertsFilesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MyDirectrixDataTable $model)
    {
        $files = Directrix::select('*')->orderBy('created_at','desc');
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
            Column::make('name')->title('اسم ملف المؤشر'),
            Column::make('description')->title('وصف ملف المؤشر'),
            Column::make('created_at')->title('تاريخ'),
            Column::computed('action')->title('تحميل')
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
