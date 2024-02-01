<?php

namespace App\DataTables;

use App\Models\Penyusutan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenyusutanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('number', function () {
                static $count = 0;
                return ++$count;
            })
            ->addColumn('tgl_perolehan', function ($data) {
                return \Carbon\Carbon::parse($data->tgl_peroleh)->format('F Y');
            })
            ->addColumn('action', function ($row) {
                $buttons = '<div class="btn-group gap-1">';
                $buttons .= '<a href="' . route('penyusutan.edit', ['id' => $row->id]) . '" class="btn btn-primary"><i class="fas fa-pen"></i></a>';
//                 $buttons .= '
// <a href="#" class="btn btn-danger" onclick="event.preventDefault(); 
// if(confirm(\'Anda yakin akan menghapus data ini?\')) {
// document.getElementById(\'form-delete-' . $row->id . '\').submit(); 
// } else {
// return false;
// }"
// >
// <i class="fas fa-trash-alt"></i>
// </a>
// <form id="form-delete-' . $row->id . '" action="' . route('kategori.delete', ['id' => $row->id]) . '" method="post" class="d-none">
// ' . csrf_field() . '
// </form>';
                $buttons .= '</div>';

                return $buttons;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Penyusutan $model): QueryBuilder
    {
        return $model->with('aset')->select('penyusutans.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('penyusutan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('number')
                ->title('#')
                ->orderable(false)
                ->searchable(false)
                ->width(30)
                ->addClass('text-center dataTable-font')
                ->responsivePriority(1),
            Column::make('aset.nama_aset')->title('Nama Aset')->responsivePriority(3)->addClass('dataTable-font'),
            Column::make('tgl_perolehan')->title('Tanggal Peroleh')->addClass('dataTable-font'),
            Column::make('harga_peroleh')->title('Harga Aset')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('penyusutan_pertahun')->title('Penyusutan Pertahun')->addClass('dataTable-font'),
            Column::make('nilai_penyusutan')->title('Nilai Penyusutan')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('nilai_pelepasan')->title('Nilai Pelepasan')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('nilai_buku')->title('Nilai Buku')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
                ->width(100)
                ->addClass('text-center dataTable-font')
                ->responsivePriority(2),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Penyusutan_' . date('YmdHis');
    }
}