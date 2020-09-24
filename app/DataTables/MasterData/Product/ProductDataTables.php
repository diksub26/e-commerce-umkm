<?php

namespace App\DataTables\MasterData\Product;

use App\Model\Product\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTables extends DataTable
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
            ->editColumn('price', function($data){
                return rupiah($data->price);
            })
            ->editColumn('category_id', function($data){
                return isset($data->category->name) ? $data->category->name : '-';
            })
            ->addColumn('action', function($data){
                return $data->edit_button . $data->deleteButton;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param use App\Model\Product\Product;
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->select('id','name','category_id', 'price' ,'size')
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
            Column::make('category_id')
                ->title('Kategori'),
            Column::make('size')
                ->title('Ukuran'),
            Column::make('price')
                ->title('Harga'),
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
        return 'MyProduct_' . date('YmdHis');
    }
}
