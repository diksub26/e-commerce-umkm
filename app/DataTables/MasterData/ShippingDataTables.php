<?php

namespace App\DataTables\MasterData;

use App\Model\Shipping\Shipping;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingDataTables extends DataTable
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
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                return $data->edit_button . $data->deleteButton;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param App\Model\Product\Shipping $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shipping $model)
    {
        return $model->select('id', 'name')
            ->where('umkm_id', auth()->user()->umkm->id)
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('my-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('
                    <"top class.row" 
                        <"#btn_table.col-12 mb-5" B>
                        <"#dt_length.col-sm-4"l>
                        <"#dt_filter.col text-sm-right"f> 
                    >rt
                    <"bottom"ip><"clear">')
                    ->orderBy(1, 'asc')
                    ->parameters([
                        'lengthMenu' => [[25, 50, 100, -1], [25, 50, 100, "All"]]
                    ])
                    ->buttons(
                        Button::make('create')
                        ->addClass('btn-success'),
                        Button::make('reload')
                        ->addClass('btn-outline-secondary'),
                        Button::make('print')
                        ->addClass('btn-outline-primary'),
                        Button::make('excel')
                        ->addClass('btn-outline-success'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
            ->title('No.')
            ->searchable(false)
            ->orderable(false),
            Column::make('name')
                ->title('Nama'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
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
        return 'MsShipping_' . date('YmdHis');
    }
}
