<?php

namespace App\Exports;

use App\Models\Ficha;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
<<<<<<< HEAD

class AprendicesExport implements FromQuery, WithHeadings
{

=======



class AprendicesExport implements FromQuery, WithHeadings
{
    
>>>>>>> 1189d210c1278313fe8925d2610a6bd334ed514e
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
