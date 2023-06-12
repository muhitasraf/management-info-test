<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
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

        // Create the mPDF document
        // $mpdf = new Mpdf( [
        //     'mode' => 'utf-8',
        //     'format' => 'A4',
        //     'margin_header' => '3',
        //     'margin_top' => '20',
        //     'margin_bottom' => '20',
        //     'margin_footer' => '2',
        // ]);

        // $col = $_POST['td'] ?? 0;
        // // $row = $_POST['tr'] ?? 0;
        // if($col >= 10){
        //     $orientation = 'L';
        // }else{
        //     $orientation = 'P';
        // }

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
        // dd($request->all());
        // $file = new Filesystem;
        // // $file->cleanDirectory(public_path()."/tmp_export_xl");
        // // $file->makeDirectory(public_path()."/tmp_export_xl");
        $html_table = "";
        //dd($request->input('table_contant'));
        if ($request->input('table_contant')) {
            // dd($request->input('table_contant'));
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

            // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
            // $spreadsheet = $reader->loadFromString($html_table);

            // $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
            // $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical('center');

            // foreach (range('A', 'I') as $letra) {
            //     $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
            // }

            // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

            // if ($request->input('title')) {
            //     $filename = $request->input('title')."-".Date("d-m-Y")."-(Time-".date('h_i_s', time()).")".'.xlsx';
            // } else {
            //     $filename = time().'.xlsx';
            // }

            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Disposition: attachment;filename="'.$filename.'"');
            // header('Cache-Control: max-age=0');

            // $header = [
            //     'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            //     'Content-Disposition: attachment; filename="hello world.xlsx"',
            //     'Cache-Control: max-age=0'
            // ];

            // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

            // $writer->save('php://output');

            // exit;

            // ob_end_clean();
            // $writer->save('php://output');exit;
            // $writer->save($filename);

            // readfile("tmp_export_xl/".$filename);

            // Storage::disk('public')->put($filename, $writer->save($filename));
            // Get file back from storage with the give header informations
            // return Storage::disk('public')->download($filename, 'Request', $header);
        }
        // dd($html_table);

        $spreadsheet = new Spreadsheet();
        // $activeWorksheet = $spreadsheet->getActiveSheet();
        // $activeWorksheet->setCellValue('A1', 'Hello World !');
        $htmlString = '<table class="table table-striped table-bordered table_content"><thead><tr><th>SN</th><th>Name</th><th>User Name</th><th>Email</th><th>Action</th></tr></thead><tbody><tr><td>1</td><td>Muhit Asraf</td><td>muhit</td><td>muhit@gmail.com</td><td class="text-center"><button class="btn btn-sm btn-info mx-1 hide-btn" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fa-solid fa-pen-to-square"></i></button><button class="btn btn-sm btn-danger hide-btn"><i class="fa-solid fa-trash"></i></button></td></tr><tr><td>2</td><td>Saad Ali</td><td>saad_ali</td><td>mocarepes@mailinator.com</td><td class="text-center"><button class="btn btn-sm btn-info mx-1 hide-btn" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fa-solid fa-pen-to-square"></i></button><button class="btn btn-sm btn-danger hide-btn"><i class="fa-solid fa-trash"></i></button></td></tr></tbody></table>';

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        $spreadsheet = $reader->loadFromString($html_table);

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="hello world.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $writer->save('php://output');
        exit;

    }
}
