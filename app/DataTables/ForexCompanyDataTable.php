<?php

namespace App\DataTables;

use App\DataTables\ForexCompanyDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\ForexCompany;
class ForexCompanyDataTable extends DataTable
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
            ->addColumn('images',function(ForexCompany $row){
                $image = !empty($row->images->first()) ? asset('storage/'.$row->images->first()->image_url) : asset('storage/dashboard/images/upload.svg');
                return '<img src="'.$image.'" class="img-table" />';
            })
            ->addColumn('action', function(ForexCompany $row){
               $data = '<form method="post" action="'.url('forex-companies/'.$row->id).'">
               <input type="hidden" name="_token" value=" '.csrf_token().' ">
               <input type="hidden" name="_method" value="DELETE">
               <button type="submit" class="btn btn-danger">حذف</button>
               </form>';
               $data .='<a href="'.url('forex-companies/'.$row->id.'/edit').'" class="btn btn-info action-datatable-btn">تعديل </a>';
               return $data;
            })
            ->addColumn('company_link',function(ForexCompany $row){
                return '<a href="'.$row->link_company.'"> <i class="fas fa-link"></i> رابط  </a>';
            })
            ->addColumn('created_at',function(ForexCompany $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\ForexCompanyDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ForexCompanyDataTable $model)
    {
        # return $model->newQuery();
        $forex_company = ForexCompany::select('*')->latest()->get();
        return $this->applyScopes($forex_company);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('forexcompanydatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(4)
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

            Column::computed('images')
                    ->title('صورة الشركة')
                    ->with(60)
                    ->printable(false)
                    ->addClass('owner-image'),
            Column::make('name_ar')->title('الاسم باللغة العربية'),
            Column::make('name_en')->title('الاسم باللغة الانجليزية'),
            Column::make('company_link')->title('رابط الشركة'),
            Column::make('created_at')->title('تاريخ الاضافة'),
            Column::computed('action')->title('')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ForexCompany_' . date('YmdHis');
    }
}
