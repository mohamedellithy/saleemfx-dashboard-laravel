<?php

namespace App\DataTables;

use App\DataTables\AccountsCashBackDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Account;
class AccountsCashBackDataTable extends DataTable
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
                return $row->forex_company->name_ar ?? '';
            })
            ->addColumn('user_name', function(Account $row){
                return $row->user ? $row->user->username: 'غير موجود' ;
            })
            ->addColumn('date_of_last_cashback', function(Account $row){
                $last = $row->cashback()->where(['deleted_at'=>null])->first();
                return $last ? date('Y-m',strtotime($last->month)) : '-';
            })
            ->addColumn('action', function(Account $row){
                $data = '<button data-ID="'.($row->id ?? '').'" type="button" class="btn btn-info btn-sm addCashback">اضافة كاش باك</button>';
               return $data;
            })
            ->addColumn('created_at', function(Account $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AccountsCashBackDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AccountsCashBackDataTable $model){
        $accounts = Account::select('*')->where([
            'status'    =>1
        ])->orderBy('created_at','desc');
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
                    ->setTableId('accountscashbackdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(4)
                    ->buttons(
                        Button::make('create'),
                        Button::make('excel')->columns(':visible'),
                        Button::make('print'),
                        Button::make('reset')
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
            Column::make('account_number')->title('رقم الحساب'),
            Column::make('company_name')->title('اسم الشركة'),
            Column::make('user_name')->title('اسم المستخدم'),
            Column::make('date_of_last_cashback')->title('تاريخ اخر كاش باك'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::make('action')->title('')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AccountsCashBack_' . date('YmdHis');
    }
}
