<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CommonController extends Controller
{
    public function getData($table = null, $cloumn = null, $id = null){
        $data = '';
        if(!empty($table)){
            if(!empty($cloumn) && !empty($id)){
                // $data = collect(DB::select("SELECT * FROM $table WHERE $cloumn = $id"));
                $data = DB::table($table)->where($cloumn,$id)->get();
            }else{
                // $data = DB::select("SELECT * FROM $table");
                $data = DB::table($table)->get();
            }
        }
        return response()->json($data);
    }

    public function download_pdf(Request $request){

        $table_contant = $request->input('table_contant');
        $title = $request->input('title');
        $orientation = $request->input('orientation');
        $documentFileName = Date("d-m-Y")."-".$title.".pdf";

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'fontDir' => array_merge($fontDirs, [
                public_path().'/assets/fonts/',
            ]),
            'fontdata' => $fontData + [ // lowercase letters only in font key
                'nikosh' => [
                    'R' => 'Nikosh.ttf',
                    'useOTL' => 0xFF,
					'useKashida' => 75,
                ]
            ],
            'default_font_size' => 10,
            'default_font' => 'nikosh',
            'format' => 'A4',
            'orientation' => $orientation,
        ]);

        // Set some header informations for output
        // $header = [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        // ];

        //Add Table Style Here
        $table_contant .= "<style>
                                table {
                                    font-family: arial, sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                }

                                td, th {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                }
                            </style>";

        // To support Bootstrap add this line
        //$bootstrap = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="'.$documentFileName.'"');

        $mpdf->WriteHTML($table_contant);
        $mpdf->OutputHttpDownload($documentFileName,'I');

    }

    public function download_xl(Request $request){

        $html_table = "";

        if ($request->input('table_contant')) {

            $html_table = $request->input('table_contant');

            if(strpos($request->input('table_contant'),'<img src="')){
                $html_table_sub = substr($request->input('table_contant'),strpos($request->input('table_contant'),'<img src="')+10);
                $html_table_sub_img = substr($html_table_sub,0, strpos($html_table_sub,'"'));
                if(file_exists($html_table_sub_img)){
                    $html_table = $request->input('table_contant');
                }else{
                    $path = route('public/assets/uploads/images/company/image-not-found-icon.png');
                    $host = '//'.$_SERVER['HTTP_HOST'];
                    $path = str_replace($host,"../",$path);
                    $html_table = str_replace($html_table_sub_img,$path,$html_table);
                }
            }
        }

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($html_table);
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical('center');

        foreach (range('A', 'I') as $letra) {
            $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
        }

        $response = response()->streamDownload(function () use ($spreadsheet) {
            $writer = new xlsx($spreadsheet);
            $writer->save('php://output');
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return $response;
    }
}
