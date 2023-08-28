<?php

namespace App\Exports;

use App\Models\Ficha;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AprendicesExport implements FromQuery, WithHeadings
{

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
            'Nombre',
            'Apellido',
            'Correo',
            'Edad',
            'Tipo de documento',
            'Numero de documento',
        ];
    }
}
