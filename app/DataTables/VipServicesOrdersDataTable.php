<?php

namespace App\DataTables;

use App\DataTables\VipServicesOrdersDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\VipOrder;
class VipServicesOrdersDataTable extends DataTable
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
            ->addColumn('user_name',function(VipOrder $row){
                return $row->user->username;
            })
            ->addColumn('status',function(VipOrder $row){
                return $row->status_text;
            })
            ->addColumn('action', function(VipOrder $row){
               $data = '<div class="btn-sm btn-group">
                    <button type="button" class="btn btn-sm btn-warning">'.($row->status == 1 ? 'مقبول' : ($row->status == 2 ? 'مرفوض' :'قيد التنفيذ') ).'</button>
                    <button type="button" class="btn btn-sm btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item '.($row->status == 0 ? 'hidden-item-status':'').'"  href="'.url("change-status-vip-order/".$row->id."/0").'" >الى قيد التنفيذ </a>
                      <a class="dropdown-item '.($row->status == 1 ? 'hidden-item-status':'').'"  href="'.url("change-status-vip-order/".$row->id."/1").'"> الى الموافقة </a>
                      <a class="dropdown-item '.($row->status == 2 ? 'hidden-item-status':'').'"  href="'.url("change-status-vip-order/".$row->id."/2").'"> الى الرفض</a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(VipOrder $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\VipServicesOrdersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VipServicesOrdersDataTable $model)
    {
        $vip_services_orders = VipOrder::select('*')->orderBy('created_at','desc');
        return $this->applyScopes($vip_services_orders);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('vipservicesordersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(3)
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
        return [
            Column::make('id'),
            Column::make('user_name')->title('اسم المستخدم'),
            Column::make('status')->title('حالة الاشتراك'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::computed('action')->title('')
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
        return 'VipServicesOrders_' . date('YmdHis');
    }
}
