<?php

namespace App\DataTables\Transaccion;

use App\Models\CuentaUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CuentaUserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($cu){
                return view('transacciones.cuentauser-action',['cu'=>$cu])->render();
            })
            ->addColumn('user_identificacion', function($cu){
                return $cu->user->identificacion;
            })
            ->editColumn('tipo_cuenta_id',function($cu){
                return $cu->tipoCuenta->nombre;
            })
            ->editColumn('user_id',function($cu){
                return $cu->user->apellidos_nombres;
            })
            ->filterColumn('user_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("concat(apellidos,'',nombres) like ?", ["%{$keyword}%"]);
                });            
            })  
            ->filterColumn('user_identificacion', function($query, $keyword) {
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
                });
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaccion/CuentaUser $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CuentaUser $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cuentauser-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->searchable(false)
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('numero')->title('Número'),      
            Column::make('tipo_cuenta_id')->title('Cuenta'),
            Column::make('user_id')->title('Apellidos & Nombres'),
            Column::make('user_identificacion')->title('Identificación'),
            Column::make('valor_disponible'),
            Column::make('estado'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Transaccion-CuentaUser_' . date('YmdHis');
    }
}
