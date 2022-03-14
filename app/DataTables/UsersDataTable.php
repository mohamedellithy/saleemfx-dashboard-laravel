<?php

namespace App\DataTables;

use App\DataTables\UsersDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use DB;
class UsersDataTable extends DataTable
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
            ->addColumn('action', function(User $row){
               $data  ='<a href="'.url('users/'.$row->id).'" class="btn btn-sm btn-info action-datatable-btn">تفاصيل </a>';
               $data .= '<form method="post" action="'.url('users/'.$row->id).'" onsubmit="FormSubmitDelete(event)">
               <input type="hidden" name="_token" value="'.csrf_token().'" />
               <input type="hidden" name="_method" value="DELETE" />
               <button type="submit" class="btn btn-sm btn-danger">حذف</button>
               </form>';
               return $data;
            })
            ->addColumn('created_at',function(User $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\UsersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UsersDataTable $model)
    {
        # return $model->newQuery();
        $users_Qry = User::select('*')->where('role',0);

        if($this->companyID){
            $users_Qry = $users_Qry->whereHas('accounts',function(Builder $query){
                $query->where('accounts.forex_company_id',$this->companyID);
            });
        }

        if($this->serviceID){
            $users_Qry = $users_Qry->whereHas('services_orders',function(Builder $query){
                $query->where('services_orders.service_id',$this->serviceID);
            });
        }

        if($this->vipOrders){
            if($this->vipOrders == 1):
               $users_Qry = $users_Qry->whereHas('vip_order');
            else:
               $users_Qry = $users_Qry->doesntHave('vip_order');
            endif;
        }

        if($this->cashbacks){
            if($this->cashbacks == 1):
                $users_Qry = $users_Qry->has('accounts.cashback');
            else:
                $users_Qry = $users_Qry->doesntHave('accounts.cashback');
            endif;
        }


        $users = $users_Qry->get();
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
                    ->setTableId('usersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(8)
                    ->buttons(
                        Button::make('export')->columns(':visible'),
                        Button::make('print')->columns('visible'),
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
            Column::make('username')->title('اسم المستخدم'),
            Column::make('phone')->title('رقم الجوال'),
            Column::make('country')->title('الدولة')->visible(false),
            Column::make('telegram_number')->title('رقم التيليجرام'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
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


# if ($request->has('action') && in_array($request->get('action'), ['print', 'pdf'])) {
# if ($request->has('visible_columns')) {
# $visibleColumns = (array) $request->get('visible_columns');
