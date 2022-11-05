<?php

namespace App\DataTables;

use App\Models\Credito;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CreditoDataTable extends DataTable
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
            ->addColumn('action', function($c){
                return view('creditos.action',['c'=>$c])->render();
            })
            ->editColumn('tipo_credito_id',function($c){
                return $c->tipoCredito->nombre;
            })
            
            ->editColumn('cuenta_user_id',function($c){
                return $c->cuentaUser->numero;
            })
            ->filterColumn('cuenta_user_id', function($query, $keyword) {
                $query->whereHas('cuentaUser', function($query) use ($keyword) {
                    $query->whereRaw("numero like ?", ["%{$keyword}%"]);
                });
            })
            ->editColumn('apellidos_nombres',function($c){
                return $c->cuentaUser->user->apellidos_nombres;
            })
            ->filterColumn('apellidos_nombres', function($query, $keyword) {
                $query->whereHas('cuentaUser', function($query) use ($keyword) {
                    $query->whereHas('user', function($query) use ($keyword) {
                        $query->whereRaw("concat(apellidos,'',nombres) like ?", ["%{$keyword}%"]);
                    });
                });
            })
            ->editColumn('identificacion',function($c){
                return $c->cuentaUser->user->identificacion;
            })
            ->filterColumn('identificacion', function($query, $keyword) {
                $query->whereHas('cuentaUser', function($query) use ($keyword) {
                    $query->whereHas('user', function($query) use ($keyword) {
                        $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
                    });
                });
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Credito $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Credito $model): QueryBuilder
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
                    ->setTableId('credito-table')
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
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('numero')->title('N° crédito'),
            
            Column::make('cuenta_user_id')->title('Cuenta usuario'),
            Column::make('apellidos_nombres')->title('Apellidos & Nombres')->orderable(false),
            Column::make('identificacion')->title('Identificacion')->orderable(false),
            Column::make('monto')->searchable(false),
            Column::make('dia_pago')->searchable(false),
            Column::make('fecha_vencimiento')->searchable(false),
            Column::make('tasa_efectiva_anual')->searchable(false),
            Column::make('tasa_nominal')->searchable(false),
            Column::make('numero_cuotas')->searchable(false),
            Column::make('plazo')->searchable(false),
            Column::make('pago_mensual')->searchable(false),
            Column::make('pagos_totales')->searchable(false),
            Column::make('interes_totales')->searchable(false),
            Column::make('ahorro_programado')->searchable(false),
            Column::make('total_ahorro_programado')->searchable(false),
            Column::make('tipo_credito_id')->searchable(false)->title('Tipo crédito'),
            Column::make('estado'),
            Column::make('detalle'),
            Column::make('actividad'),
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Credito_' . date('YmdHis');
    }
}
