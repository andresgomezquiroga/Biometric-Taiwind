<?php

namespace App\Exports;

use App\Models\Ficha;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class AprendicesExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $fichaId;

    public function __construct($fichaId)
    {
        $this->fichaId = $fichaId;
    }

    public function query()
    {
        $ficha = Ficha::findOrFail($this->fichaId);
        return $ficha->members();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre y apellido',
            'Correo',
            'Edad',
            'Tipo de documento',
            'Numero de documento',
        ];
    }
}