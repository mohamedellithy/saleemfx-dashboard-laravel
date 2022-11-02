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
                $data = "<a class='btn btn-info btn-sm' href='".url('my-accounts/'.$row->id.'/edit')."' style='margin:0px 2px'>".__('master.edit_account')."</a>";
                if($row->status == 0):
                    $data .= '<form method="post" action="'.url('my-accounts/'.$row->id).'" onsubmit="FormSubmitDelete(event)">
                    <input type="hidden" name="_token" value=" '.csrf_token().' ">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger btn-sm">'.__('master.delete').'</button>
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
        $accounts = auth()->user()->accounts()->where('deleted_at',null);
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
                    ->orderBy(5)
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
            Column::make('company_name')->title(__('master.company_name')),
            Column::make('account_number')->title(__('master.company_account_number')),
            Column::make('account_balance')->title(__('master.forex_company_cost_d')),
            Column::make('status')->title(__('master.order_status')),
            Column::make('created_at')->title(__('master.created_at')),
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
