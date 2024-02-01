<?php

namespace App\DataTables;

use App\Models\Aset;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AsetDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * 
     * 
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {


        return (new EloquentDataTable($query))
            ->addColumn('number', function () {
                static $count = 0;
                return ++$count;
            })
            ->escapeColumns('kondisi')
            ->addColumn('kondisi', function ($data) {
                $class = '';

                switch ($data->kondisi) {
                    case 'Baik':
                        $class = 'success';
                        break;
                    case 'Rusak Ringan':
                        $class = 'warning';
                        break;
                    case 'Rusak Berat':
                        $class = 'danger';
                        break;
                    default:
                }

                return '<div>' . ($class ? '<span class="badge rounded-pill bg-' . $class . '">' . htmlentities($data->kondisi, ENT_QUOTES, 'UTF-8') . '</span>' : htmlentities($data->kondisi, ENT_QUOTES, 'UTF-8')) . '</div>';
            })
            ->addColumn('tgl_peroleh', function ($data) {
                return \Carbon\Carbon::parse($data->tgl_peroleh)->format('F Y');
            })
            ->addColumn('umur_aset', function ($data) {
                return $data->umur_aset . ' Tahun';
            })
            ->addColumn('action', function ($row) {
                $modelrole = DB::table('model_has_roles')->where('model_id', auth()->user()->id)->first();
                $role = Role::where('id', $modelrole->role_id)->first();

                $buttons = '<div class="btn-group gap-1">';
                $buttons .= '<a href="' . route('aset.show', ['id' => $row->id]) . '" class="btn btn-info"><i class="fas fa-eye"></i></a>';
                if ($role && $role->name == 'ketua') {
                    $buttons .= '<a href="' . route('aset.edit', ['id' => $row->id]) . '" class="btn btn-primary"><i class="fas fa-pen"></i></a>';
                    $buttons .= '
<a href="#" class="btn btn-danger" onclick="event.preventDefault(); 
if(confirm(\'Anda yakin akan menghapus data ini?\')) {
document.getElementById(\'form-delete-' . $row->id . '\').submit(); 
} else {
return false;
}"
>
<i class="fas fa-trash-alt"></i>
</a>
<form id="form-delete-' . $row->id . '" action="' . route('aset.delete', ['id' => $row->id]) . '" method="post" class="d-none">
' . csrf_field() . '
</form>';
                } elseif ($role && $role->name == 'anggota') {
                    $buttons .= '<a href="' . route('aset.edit', ['id' => $row->id]) . '" class="btn btn-primary"><i class="fas fa-pen"></i></a>';
                }
                $buttons .= '</div>';

                return $buttons;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Aset $model): QueryBuilder
    {
        return $model->with(['kategori', 'lokasi'])->select('asets.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('aset-table')
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
            Column::make('kategori.name')->title('Kategori')->responsivePriority(3)->addClass('dataTable-font'),
            Column::make('kode_aset')->title('Kode Aset')->addClass('dataTable-font'),
            Column::make('nama_aset')->title('Nama Aset')->addClass('dataTable-font'),
            Column::make('brand')->title('Merek')->addClass('dataTable-font'),
            Column::make('harga_peroleh')->title('Harga Aset')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('umur_aset')->title('Massa Pakai')->addClass('dataTable-font'),
            Column::make('tgl_peroleh')->title('Tanggal Peroleh')->addClass('dataTable-font'),
            Column::make('qty')->title('QTY')->addClass('dataTable-font'),
            Column::make('kondisi')->title('Kondisi')->addClass('dataTable-font'),
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
        return 'Aset_' . date('YmdHis');
    }
}
