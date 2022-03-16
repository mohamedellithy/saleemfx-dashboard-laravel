<?php

namespace App\DataTables;

use App\DataTables\OrderCoursesDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\OrderCourse;
use Carbon\Carbon;

class OrderCoursesDataTable extends DataTable
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
            ->addColumn('course_name',function(OrderCourse $row){
                return $row->course->post_title ?? '';
            })
            ->addColumn('course_start_at',function(OrderCourse $row){
                return $row->course->post_date ?? '';
            })
            ->addColumn('created_at',function(OrderCourse $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\ServicesOrdersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderCoursesDataTable $model)
    {
        $courses_orders = OrderCourse::select('*')->get();
        return $this->applyScopes($courses_orders);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ordersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(8)
                    ->buttons(
                        Button::make('excel')->columns(':visible'),
                        Button::make('print'),
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
            Column::make('firstname')->title('الاسم الاول'),
            Column::make('lastname')->title('الاسم الثانى'),
            Column::make('email')->title('البريد اللكترونى'),
            Column::make('phone')->title('رقم الجوال'),
            Column::make('telegram_number')->title('رقم التيليجرام')->visible(false),
            Column::make('course_name')->title('اسم الدورة'),
            Column::make('course_start_at')->title('موعد بدأ الدورة'),
            Column::make('created_at')->title('تاريخ التسجيل')
                 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
