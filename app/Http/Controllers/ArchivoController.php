<?php

namespace App\Http\Controllers;

use App\Classes\ImportadorES;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    /**
     * Muestra formulario para importar archivo de checador.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario()
    {
        return view('archivos.archivoForm');
    }

    /**
     * Guarda e importa información de archivo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cargar(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $archivoCargado = $request->file->store('checador');

        $importador = new ImportadorES($archivoCargado);
        $importador->importarArchivo();

        return redirect()->route('importar-form')->with(['mensaje' => 'Importación Exitosa', 'tipo' => 'success']);
    }
}
