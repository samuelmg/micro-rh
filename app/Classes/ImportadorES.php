<?php

namespace App\Classes;

use App\Checador;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

/**
 * Clase que permite importar las Entradas/Salidas registradas en el checador
 */
class ImportadorES
{
    private $archivo;
    private $data;

    /**
     * Genera la ruta para la importación del archivo
     * @param type $archivo
     * @return void
     */
    public function __construct($archivo)
    {
        $this->archivo = storage_path('app/' . $archivo);
    }

    /**
     * Método para realizar la importación del archivo cargado
     *
     * @return void
     */
    public function importarArchivo()
    {
        $this->getSheetData();
        $this->storeData();
    }

    /**
     * Obtiene la información del archivo y la conserva en $data
     * @return type
     */
    private function getSheetData()
    {
        $inputFileType = IOFactory::identify($this->archivo);
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($this->archivo);
        $this->data = $spreadsheet->getActiveSheet()->toArray(null, false, false, true);
    }

    /**
     * Guarda la información en la tabla checador
     *
     * Brinca el primer registro que corresponde a las cabeceras de la hoja
     *
     * @return type
     */
    private function storeData()
    {
        foreach ($this->data as $key => $row) {
            if ($key > 1) {
                Checador::create([
                    'numero' => $row['A'],
                    'nombre' => $row['B'],
                    'fecha_hora' => $this->getDateTimeString($row['C']),
                    'registro' => $row['D'],
                    'dispositivo' => $row['E'],
                ]);
            }
        }
    }

    /**
     * Obtiene la cadena de fecha y hora en el formato requerido para insertar a la DB
     *
     * El archivo contiene la fecha y hora como una cadena en un formato no compatible con la DB
     * por lo que es necesario convertirlo.s
     *
     * @param type $fechaHora
     * @return type
     */
    private function getDateTimeString($fechaHora)
    {
        return \Carbon\Carbon::createFromFormat('d/m/Y H:i:s a', $fechaHora)->toDateTimeString();
    }
}
