<?php

namespace App\DataTables;

use App\Exports\ExportLaporan;
use App\Models\Aset;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanDataTable extends DataTable
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
            ->addColumn('tgl_peroleh', function ($data) {
                return \Carbon\Carbon::parse($data->tgl_peroleh)->format('F Y');
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Aset $model): QueryBuilder
    {
        return $model->with(['kategori', 'lokasi', 'penyusutan'])->select('asets.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('laporan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons([
                Button::make('excel')->addClass('text-success text-bold rounded')->action('window.location.href = "' . route("laporan.export") . '"'),
                // Button::make('excel')->action('window.location.href = "' . route("excelPHP") . '"'),
                Button::make('print')->addClass('text-bold rounded'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('kode_aset')->title('Kode Aset')->addClass('dataTable-font'),
            Column::make('kategori.name')->title('Kategori')->addClass('dataTable-font'),
            Column::make('nama_aset')->title('Nama Aset')->addClass('dataTable-font'),
            Column::make('tgl_peroleh')->title('Tahun Peroleh')->addClass('dataTable-font'),
            Column::make('qty')->title('QTY')->addClass('dataTable-font'),
            Column::make('harga_peroleh')->title('Harga Aset')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('penyusutan.penyusutan_pertahun')->title('Penyusutan Pertahun')->addClass('dataTable-font'),
            Column::make('penyusutan.nilai_penyusutan')->title('Nilai Penyusutan')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('penyusutan.nilai_pelepasan')->title('Nilai Pelepasan')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('penyusutan.nilai_buku')->title('Nilai Buku')->addClass('dataTable-font')->renderJs('number', '.', ',', '', ' Rp. '),
            Column::make('lokasi.lokasi')->title('Lokasi Aset')->addClass('dataTable-font'),
            Column::make('lokasi.penanggung_jawab')->title('Penanggung Jawab')->addClass('dataTable-font'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Laporan_' . date('YmdHis');
    }

    public function excelCustom()
    {
        $tahun = \Carbon\Carbon::now()->year;

        $data = [
            [
                'LAPORAN ASET DAN PENYUSUTAN ASET'
            ],
            [
                'KOPERASI KESEJAHTERAAN KARYAWAN PERKEBUNAN NUSANTARA VI'
            ],
            [
                'TAHUN ' . $tahun
            ],
            [
                ''
            ],
            [
                '#',
                'Kode Aset',
                'Kategori',
                'Nama Aset',
                'Tanggal Peroleh',
                'Unit',
                'Nilai Perolehan',
                'Penyusutan Pertahun',
                'Nilai Penyusutan',
                'Nilai Pelepasan',
                'Nilai Buku',
                'Lokasi Aset',
                'Penanggung Jawab',
                'Kontak',
                'Keterangan',
            ],
        ];

        $laporan =
            Aset::with(['kategori', 'lokasi', 'penyusutan'])->select('asets.*')
            ->whereNull('asets.deleted_at')
            ->get();


        foreach ($laporan as $index => $laporan) {
            $hargaPeroleh = 'Rp ' . number_format($laporan->harga_peroleh, 0, ',', '.');
            $nilaiPenyusutan = 'Rp ' . number_format($laporan->penyusutan->nilai_penyusutan, 0, ',', '.');
            $nilaiPelepasan = 'Rp ' . number_format($laporan->penyusutan->nilai_pelepasan, 0, ',', '.');
            $nilaiBuku = 'Rp ' . number_format($laporan->penyusutan->nilai_buku, 0, ',', '.');
            $tgl_perolehan = \Carbon\Carbon::parse($laporan->tgl_peroleh)->format('d F Y');
            $data[] = [
                $index + 1,
                $laporan->kode_aset,
                $laporan->kategori->name,
                $laporan->nama_aset,
                $tgl_perolehan,
                $laporan->qty,
                $hargaPeroleh,
                $laporan->penyusutan->penyusutan_pertahun,
                $nilaiPenyusutan,
                $nilaiPelepasan,
                $nilaiBuku,
                $laporan->lokasi->lokasi,
                $laporan->lokasi->penanggung_jawab,
                $laporan->lokasi->kontak,
                $laporan->lokasi->keterangan,
            ];
        }

        return Excel::download(new ExportLaporan($data), 'laporan_Aset_Penyusutan_' . date('dmY') . '.xlsx');
    }
}
