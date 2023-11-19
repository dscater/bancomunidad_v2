<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\MaestroRegistro;
use App\Models\SeguimientoAprobado;
use App\Models\SeguimientoRectificacion;
use App\Models\SeguimientoTramite;
use App\Models\Sistema;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class ReporteController extends Controller
{
    public function funcionario_sistemas(Request $request)
    {
        $filtro =  $request->filtro;

        if ($filtro == 'Nombre del funcionario los sistemas y los perfiles') {
            $funcionarios = Funcionario::all();
            $pdf = PDF::loadView('reportes.funcionario_sistemas', compact("funcionarios"))->setPaper('letter', 'portrait');
            // ENUMERAR LAS PÁGINAS USANDO CANVAS
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf->get_canvas();
            $alto = $canvas->get_height();
            $ancho = $canvas->get_width();
            $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

            return $pdf->download('FuncionarioSistemasPerfiles.pdf');
        }
        if ($filtro == 'Sistema y perfiles del sistema') {
            $sistemas = Sistema::all();
            $pdf = PDF::loadView('reportes.sistema_perfiles', compact("sistemas"))->setPaper('letter', 'portrait');
            // ENUMERAR LAS PÁGINAS USANDO CANVAS
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf->get_canvas();
            $alto = $canvas->get_height();
            $ancho = $canvas->get_width();
            $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

            return $pdf->download('SistemaPerfiles.pdf');
        }
    }
}
