<?php

namespace App\DataTables;

use App\DataTables\AccountsDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Account;
class AccountsDataTable extends DataTable
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
            ->addColumn('user_name', function(Account $row){
                return $row->user->username ??'غير موجود';
            })
            ->addColumn('company_name', function(Account $row){
                return $row->forex_company->name_ar ?? '';
            })
            ->addColumn('status', function(Account $row){
                return $row->status_text;
            })
            ->addColumn('action', function(Account $row){
               $data = '<div class="btn-group">
                    <button type="button" class="btn btn-warning">تغير الحالة</button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item '.($row->status == 0 ? 'hidden-item-status':'').'"  href="'.url("change-status-account/".$row->id."/0").'" >الى قيد التنفيذ </a>
                      <a class="dropdown-item '.($row->status == 1 ? 'hidden-item-status':'').'"  href="'.url("change-status-account/".$row->id."/1").'"> الى الموافقة </a>
                      <a class="dropdown-item '.($row->status == 2 ? 'hidden-item-status':'').'"  href="'.url("change-status-account/".$row->id."/2").'"> الى الرفض</a>
                      <a class="dropdown-item '.($row->status != 1  ? 'hidden-item-status':'').'" href="'.url("change-status-account/".$row->id."/3").'">الى انهاء الحساب</a>
                    </div>
                  </div>';
               return $data;
            })
            ->addColumn('created_at',function(Account $row){
                return $row->created_at;
            })
            ->addColumn('updated_at',function(Account $row){
                return $row->updated_at;
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\AccountsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AccountsDataTable $model)
    {
        $accounts = Account::select('*')->latest()->get();
        return $this->applyScopes($accounts);
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
                    ->setTableId('accountsdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(5)
                    ->buttons(
                        Button::make('export'),
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
            Column::make('company_name')->title('اسم الشركة'),
            Column::make('account_number')->title('رقم حساب الشركة'),
            Column::make('account_balance')->title('مبلغ الايداع'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::make('updated_at')->title('تاريخ تحديث الحالة'),
            Column::make('status')->title('حالة الطلب'),
            Column::computed('action')->title('')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
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
        return 'Accounts_' . date('YmdHis');
    }
}
