<?php

namespace App\Http\Controllers;

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
                $data = DB::select("SELECT * FROM $table WHERE $cloumn = $id");
            }else{
                $data = DB::select("SELECT * FROM $table");
            }
        }
        return response()->json($data);
    }

    public function download_pdf(Request $request){

        $table_contant = $request->input('table_contant');
        $title = $request->input('title');

        $documentFileName = Date("d-m-Y")."-".$title.".pdf";

        // Create the mPDF document
        $mpdf = new Mpdf( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];

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

        $mpdf->WriteHTML($table_contant);

        // Save PDF on your public storage
        Storage::disk('public')->put($documentFileName, $mpdf->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header); //

    }

    public function download_xl(Request $request){

        // $files = glob('./tmp_export_xl/*'); // get all file names
        // foreach ($files as $file) { // iterate files
        //     if (is_file($file)) {
        //         unlink($file); // delete file
        //     }
        // }
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

            // $temporary_html_file = './tmp_export_xl/' . time() . '.html';

            // file_put_contents($temporary_html_file, $html_table);
            // $reader = IOFactory::createReader('Html');
            // $spreadsheet = $reader->load($temporary_html_file);

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
            $spreadsheet = $reader->loadFromString($html_table);

            $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical('center');

            foreach (range('A', 'I') as $letra) {
                $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
            }
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

            if ($request->input('title')) {
                $filename = $request->input('title')."-".Date("d-m-Y")."-(Time-".date('h_i_s', time()).")".'.xlsx';
            } else {
                $filename = time().'.xlsx';
            }


            $writer->save($filename);

            // header('Content-Type: application/x-www-form-urlencoded');
            // header('Content-Transfer-Encoding: Binary');
            // header("Content-disposition: attachment; filename=$filename");

            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Disposition: attachment;filename="'.$filename.'"');
            // header('Cache-Control: max-age=0');
            // return readfile($filename);
            
            $header = [
                'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition: attachment;filename="'.$filename.'"',
                'Cache-Control: max-age=0',
            ];

            Storage::disk('public')->put($filename, $writer->save($filename));
            // Get file back from storage with the give header informations
            return Storage::disk('public')->download($filename, 'Request', $header); //
        }

        // $htmlString = '<table>
        //           <tr>
        //               <td>Hello World</td>
        //           </tr>
        //           <tr>
        //               <td>Hello<br />World</td>
        //           </tr>
        //           <tr>
        //               <td>Hello<br>World</td>
        //           </tr>
        //       </table>';

        // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
        // $spreadsheet = $reader->loadFromString($htmlString);

        // // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        // // $writer->save('write.xls');

        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="myfile.xlsx"');
        // header('Cache-Control: max-age=0');

        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('write.xlsx');

    }
}
