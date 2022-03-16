<?php

namespace App\DataTables;

use App\DataTables\affiliatersDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Affiliate;
class affiliatersDataTable extends DataTable
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
            ->addColumn('username',function(Affiliate $row){
                return $row->affiliaters->username;
            })
            ->addColumn('email',function(Affiliate $row){
                return $row->affiliaters->email;
            })
            ->addColumn('employee',function(Affiliate $row){
                return $row->employee == 0 ? 'غير موظف' : 'موظف' ;
            })
             ->addColumn('salaries',function(Affiliate $row){
                return amount_currency($row->value_salaries());
            })
            ->addColumn('comissions',function(Affiliate $row){
                return amount_currency($row->value_comissions());
            })
            
            ->addColumn('count_inviters',function(Affiliate $row){
                return $row->affiliaters()->count();
            })
            ->addColumn('value_profits',function(Affiliate $row){
                return amount_currency($row->value_profits());
            })
            ->addColumn('created_at',function(Affiliate $row){
                return $row->created_at;
            })
            ->addColumn('action',function(Affiliate $row){
                $data  ='<a href="'.url('affiliater/'.$row->affiliaters->id).'" class="btn btn-sm btn-info action-datatable-btn">تفاصيل </a>';
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
        $users = Affiliate::select('*')->latest()->get();
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
                    ->orderBy(7)
                    ->buttons(
                        Button::make('excel')->columns(':visible'),
                        Button::make('print')->columns('visible'),
                        Button::make('reset'),
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
            Column::make('count_inviters')->title('عدد المدعويين'),
            Column::make('salaries')->title('المرتبات'),
            Column::make('comissions')->title('العمولات'),
            Column::make('value_profits')->title('قيمة الارباح'),
            Column::make('created_at')->title('تاريخ الاشتراك'),
            Column::make('employee')->title('صفة المسوق'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title(''),
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
