<?php

namespace App\DataTables;

use App\DataTables\ServicesOrdersDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\ServicesOrder;
use Carbon\Carbon;

class ServicesOrdersDataTable extends DataTable
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
            ->addColumn('user_name',function(ServicesOrder $row){
                return $row->user->username ?? '';
            })
            ->addColumn('services_name',function(ServicesOrder $row){
                return $row->services->post_title;
            })
            ->addColumn('status_subscription',function(ServicesOrder $row){
                $status_subscription = ( $row->status == 1 ? ( $row->expire_at < Carbon::now()->toDateTimeString() ) ?'منتهية':'سارية' : 'لم تبدأ');
                return $status_subscription;
            })
            ->addColumn('month',function(ServicesOrder $row){
                $expire_at = intval( Carbon::parse($row->created_at)->floatDiffInMonths($row->expire_at) );
                return ($expire_at != 0 ? $expire_at : '1').' شهر ';
            })
            ->addColumn('total',function(ServicesOrder $row){
                return amount_currency($row->value);
            })
            ->addColumn('have_accounts',function(ServicesOrder $row){
                return $row->acount ? $row->acount->forex_company->name_ar : "لا يوجد حساب";
            })
            ->addColumn('have_number_accounts',function(ServicesOrder $row){
                return $row->acount ? $row->acount->account_number : "لايوجد حساب";
            })
            ->addColumn('expire_at',function(ServicesOrder $row){
                return $row->expire_at ?? 'اشتراك دائم';
            })
            ->addColumn('action', function(ServicesOrder $row){
               $data = '<div class="btn-group">
                    <button type="button" class="btn btn-warning">'.($row->status == 1 ? 'مقبول' : ($row->status == 2 ? 'مرفوض' :'قيد التنفيذ') ).'</button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item '.($row->status == 0 ? 'hidden-item-status':'').'"  href="'.url("change-status-services-order/".$row->id."/0").'" >الى قيد التنفيذ </a>
                      <a class="dropdown-item '.($row->status == 1 ? 'hidden-item-status':'').'"  href="'.url("change-status-services-order/".$row->id."/1").'"> الى الموافقة </a>
                      <a class="dropdown-item '.($row->status == 2 ? 'hidden-item-status':'').'"  href="'.url("change-status-services-order/".$row->id."/2").'"> الى الرفض</a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(ServicesOrder $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\ServicesOrdersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ServicesOrdersDataTable $model)
    {
        $services_orders = ServicesOrder::select('*')->get();
        return $this->applyScopes($services_orders);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('servicesordersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
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
            Column::make('user_name')->title('اسم المستخدم'),
            Column::make('services_name')->title('اسم الخدمة'),
            Column::make('month')->title('الاشهر'),
            Column::make('expire_at')->title('تاريخ انتهاء الاشتراك'),
            Column::make('total')->title('التكلفة'),
            Column::make('have_accounts')->title('حساب تداول'),
            Column::make('have_number_accounts')->title('رقم حساب تداول'),
            Column::make('status_subscription')->title('حالة الاشتراك'),
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
        return 'ServicesOrders_' . date('YmdHis');
    }
}
