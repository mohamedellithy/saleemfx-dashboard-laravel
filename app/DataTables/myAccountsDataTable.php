<?php

namespace App\DataTables;

use App\DataTables\myAccountsDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Account;
class myAccountsDataTable extends DataTable
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
            ->addColumn('company_name', function(Account $row){
                return $row->forex_company->name_ar ?? $row->forex_company->name_en;
            })
            ->addColumn('status', function(Account $row){
                return $row->status_text;
            })
            ->addColumn('action', function(Account $row){
                $data = "<a class='btn btn-info btn-sm' href='".url('my-accounts/'.$row->id.'/edit')."' style='margin:0px 2px'>تعديل الحساب</a>";
                if($row->status == 0):
                    $data .= '<form method="post" action="'.url('my-accounts/'.$row->id).'" onsubmit="FormSubmitDelete(event)">
                    <input type="hidden" name="_token" value=" '.csrf_token().' ">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                    </form>';
                else:
                    $data .= '';
                endif;
                
                

                return $data;
            })
            ->addColumn('created_at',function(Account $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\myAccountsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(myAccountsDataTable $model)
    {
        # return $model->newQuery();
        $accounts = auth()->user()->accounts;
        return $this->applyScopes($accounts);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('myaccountsdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Lfrtip')
                    ->orderBy(1)
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
            Column::make('company_name')->title('اسم الشركة'),
            Column::make('account_number')->title('رقم حساب الشركة'),
            Column::make('account_balance')->title('قيمة التداول فى الشركة'),
            Column::make('status')->title('حالة الطلب'),
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
        return 'myAccounts_' . date('YmdHis');
    }
}
