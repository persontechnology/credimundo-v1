<?php

namespace App\DataTables;

use App\Models\Transaccion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransaccionDataTable extends DataTable
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
            ->addColumn('action', 'transaccion.action')
            ->addColumn('total', function($t){
                 return $t->total_efectivo_cheque;
            })
            ->addColumn('identificacion_user',function($t){
                return $t->cuentaUser->user->identificacion;
            })
            ->addColumn('apellidos_nombres_user',function($t){
                return $t->cuentaUser->user->apellidos_nombres;
            })
            ->filterColumn('apellidos_nombres_user',function($query, $keyword){
                $query->whereHas('cuentaUser', function($query) use ($keyword) {
                    $query->whereHas('user', function($query) use ($keyword) {
                        $query->whereRaw("concat(apellidos,'',nombres) like ?", ["%{$keyword}%"]);
                    });            
                });            
            })
            ->filterColumn('identificacion_user',function($query, $keyword){
                $query->whereHas('cuentaUser', function($query) use ($keyword) {
                    $query->whereHas('user', function($query) use ($keyword) {
                        $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
                    });            
                });            
            })
            ->editColumn('tipo_transaccion_id',function($t){
                return $t->tipoTransaccion->nombre;
            })
            ->editColumn('cuenta_user_id',function($t){
                return $t->cuentaUser->numero;
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaccion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaccion $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transaccion-table')
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
                  ->addClass('text-center'),
            Column::make('tipo_transaccion_id')->searchable(false)->title('Tipo Transacción'),
            Column::make('valor_efectivo'),
            Column::make('valor_cheque'),
            Column::make('total'),
            Column::make('valor_disponible'),
            Column::make('cuenta_user_id')->searchable(false)->title('N° Cuenta'),
            Column::make('identificacion_user')->title('Identificación'),
            Column::make('apellidos_nombres_user')->title('Apellidos & Nombres'),
            Column::make('numero')->title('N° documento'),
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
        return 'Transaccion_' . date('YmdHis');
    }
}
