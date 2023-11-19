<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class FormularioController extends Controller
{
    public $validacion = [
        "funcionario_id" => "required",
        "tipo_acceso" => "required",
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $formularios = Formulario::all();
        return response()->JSON(['formularios' => $formularios, 'total' => count($formularios)], 200);
    }

    public function store(Request $request)
    {
        if (isset($request->tipo_acceso) && $request->tipo_acceso != "") {
            if (
                $request->tipo_acceso == "ALTO DE ACCESO" ||
                $request->tipo_acceso == 'BAJA DE ACCESO'
            ) {
                $this->validacion["cargo_id"] = "required";
                unset($request["agencia_origen"]);
                unset($request["agencia_destino"]);
            } else {
                $this->validacion["agencia_origen"] = "required";
                $this->validacion["agencia_destino"] = "required";
                unset($request["cargo_id"]);
            }
        }

        $request->validate($this->validacion, $this->mensajes);
        $request["codigo"] = Formulario::ultimoCodigo();
        $request["fecha_registro"] = date("Y-m-d");
        if (!$request->fecha_solicitud) {
            unset($request["fecha_solicitud"]);
        }
        if (!$request->fecha_respuesta) {
            unset($request["fecha_respuesta"]);
        }

        if (!$request->hora_solicitud) {
            unset($request["hora_solicitud"]);
        }
        if (!$request->hora_respuesta) {
            unset($request["hora_respuesta"]);
        }
        $formulario = Formulario::create(array_map('mb_strtoupper', $request->all()));

        return response()->JSON([
            'sw' => true,
            'formulario' => $formulario,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Formulario $formulario)
    {
        if (isset($request->tipo_acceso) && $request->tipo_acceso != "") {
            if (
                $request->tipo_acceso == "ALTO DE ACCESO" ||
                $request->tipo_acceso == 'BAJA DE ACCESO'
            ) {
                $this->validacion["cargo_id"] = "required";
                unset($request["agencia_origen"]);
                unset($request["agencia_destino"]);
            } else {
                $this->validacion["agencia_origen"] = "required";
                $this->validacion["agencia_destino"] = "required";
                unset($request["cargo_id"]);
            }
        }

        if (!$request->fecha_solicitud) {
            unset($request["fecha_solicitud"]);
        }
        if (!$request->fecha_respuesta) {
            unset($request["fecha_respuesta"]);
        }

        if (!$request->hora_solicitud) {
            unset($request["hora_solicitud"]);
        }
        if (!$request->hora_respuesta) {
            unset($request["hora_respuesta"]);
        }

        $request->validate($this->validacion, $this->mensajes);
        $formulario->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'formulario' => $formulario,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Formulario $formulario)
    {
        return response()->JSON($formulario);
    }

    public function destroy(Formulario $formulario)
    {
        $formulario->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator("ADMIN")
            ->setLastModifiedBy('Administración')
            ->setTitle('Formularios')
            ->setSubject('Formularios')
            ->setDescription('Formularios')
            ->setKeywords('PHPSpreadsheet')
            ->setCategory('Listado');

        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');

        $styleTexto = [
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 9,
                'color' => ['argb' => 'ffffff'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '80B900']
            ],
        ];

        $estilo_conenido = [
            'font' => [
                'size' => 8,
            ],
            'alignment' => [
                // 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $fila = 1;

        $sheet->setCellValue('A' . $fila, 'FORMULARIOS');
        $sheet->getStyle('A' . $fila . ':K' . $fila)->getAlignment()->setHorizontal('center');;
        $sheet->getStyle('A' . $fila . ':K' . $fila)->applyFromArray($styleTexto);
        $sheet->mergeCells("A" . $fila . ":K" . $fila);  //COMBINAR CELDAS
        $fila++;
        $sheet->setCellValue('A' . $fila, 'EXPEDIDO: ' . date('Y-m-d'));
        $sheet->getStyle('A' . $fila . ':K' . $fila)->getAlignment()->setHorizontal('center');;
        $sheet->mergeCells("A" . $fila . ":K" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila . ':K' . $fila)->applyFromArray($styleTexto);
        $fila++;

        $sheet->mergeCells("A" . $fila . ":K" . $fila);  //COMBINAR CELDAS
        $fila++;

        // ENCABEZADO
        $sheet->setCellValue('A' . $fila, 'CÓDIGO');
        $sheet->setCellValue('B' . $fila, 'FECHA DE SOLICITUD');
        $sheet->setCellValue('C' . $fila, 'FECHA DE RESPUESTA');
        $sheet->setCellValue('D' . $fila, 'HORA DE SOLICITUD');
        $sheet->setCellValue('E' . $fila, 'HORA DE RESPUESTA');
        $sheet->setCellValue('F' . $fila, 'FUNCIONARIO');
        $sheet->setCellValue('G' . $fila, 'TIPO DE ACCESO');
        $sheet->setCellValue('H' . $fila, 'AGENCIA ORIGEN');
        $sheet->setCellValue('I' . $fila, 'AGENCIA DESTINO');
        $sheet->setCellValue('J' . $fila, 'CARGO');
        $sheet->setCellValue('K' . $fila, 'FECHA DE REGISTRO');
        // $sheet->setWidth(['A' =>  5, 'B' =>  10, 'C' => 10, 'D' => 10, 'E' => 10, 'F' => 10, 'G' => 10, 'H' => 10, 'I' => 10, 'k' => 10, 'K' => 10, 'L' => 10, 'M' => 10, 'N' => 10, 'O' => 10, 'P' => 10, 'Q' => 10, 'R' => 10, 'S' => 10]);
        $sheet->getStyle('A' . $fila . ':K' . $fila)->applyFromArray($styleArray);
        $fila++;

        $cont = 1;
        $formularios = Formulario::all();
        foreach ($formularios as $formulario) {
            $sheet->setCellValue('A' . $fila, $formulario->codigo);
            $sheet->setCellValue('B' . $fila, $formulario->fecha_solicitud ? date("d/m/Y", strtotime($formulario->fecha_solicitud)) : "");
            $sheet->setCellValue('C' . $fila, $formulario->fecha_respuesta ? date("d/m/Y", strtotime($formulario->fecha_respuesta)) : "");
            $sheet->setCellValue('D' . $fila, $formulario->hora_solicitud);
            $sheet->setCellValue('E' . $fila, $formulario->hora_respuesta);
            $sheet->setCellValue('F' . $fila, $formulario->funcionario->full_name);
            $sheet->setCellValue('G' . $fila, $formulario->tipo_acceso);
            if ($formulario->tipo_acceso == 'CAMBIO DE AGENCIA') {
                $sheet->setCellValue('H' . $fila, $formulario->origen->nombre);
                $sheet->setCellValue('I' . $fila, $formulario->destino->nombre);
            } else {
                $sheet->setCellValue('J' . $fila, $formulario->cargo->nombre);
            }
            $sheet->setCellValue('K' . $fila, date("d/m/Y", strtotime($formulario->fecha_registro)));

            $sheet->getStyle('A' . $fila . ':K' . $fila)->applyFromArray($estilo_conenido);
            $fila++;
        }

        // $sheet->getRowDimension(6)->setRowHeight(-1);
        // AJUSTAR EL ANCHO DE LAS CELDAS
        foreach (range('A', 'K') as $columnID) {
            $sheet->getStyle($columnID)->getAlignment()->setWrapText(true);
            $sheet->getColumnDimension($columnID)
                ->setAutoSize(true);
            if ($columnID == 'K') {
            } else {
                // $sheet->getColumnDimension($columnID)
                //     ->setAutoSize(true);
            }
        }

        // DESCARGA DEL ARCHIVO
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Usuarios.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
