<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Composer Autoloader
require FCPATH . 'vendor/autoload.php';
// excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
// word
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
// guzzle
use GuzzleHttp\Client;

class Welcome extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        redirect('login/operatorlogin');
        // redirect('login/adminlogin');
    }

    public function excel($value='')
    {
        // documentation
        // https://phpspreadsheet.readthedocs.io/en/latest/
        
        $file_name = "hello_world.xlsx";
        //
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        //
        // header
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-disposition: attachment; filename='.$file_name);
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function word($value='')
    {
        // documentation
        // https://github.com/PHPOffice/PHPWord

        //
        $path = "/tmp/";
        $file_name = "helloWorld.docx";
        // Creating the new document...
        $phpWord = new PhpWord();
        //
        $section = $phpWord->addSection();
        //
        // Adding Text element to the Section having font styled by default...
        $section->addText(
            '"Learn from yesterday, live for today, hope for tomorrow. '
                . 'The important thing is not to stop questioning." '
                . '(Albert Einstein)'
        );
        // Adding Text element with font customized inline...
        $section->addText(
            '"Great achievement is usually born of great sacrifice, '
                . 'and is never the result of selfishness." '
                . '(Napoleon Hill)',
            array('name' => 'Tahoma', 'size' => 10)
        );
        // Adding Text element with font customized inline...
        $section->addText(
            '"Great achievement is usually born of great sacrifice, '
                . 'and is never the result of selfishness." '
                . '(Napoleon Hill)',
            array('name' => 'Tahoma', 'size' => 10)
        );
        // Adding Text element with font customized using named font style...
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $section->addText(
            '"The greatest accomplishment is not in never falling, '
                . 'but in rising again after you fall." '
                . '(Vince Lombardi)',
            $fontStyleName
        );

        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=".$file_name);
        // Saving the document as OOXML file...
        $objWriter = WordIOFactory::createWriter($phpWord, 'Word2007');
        //
        $objWriter->save($path.$file_name);
        //
        readfile($path.$file_name);
        //
        unlink($path.$file_name);
    }

    public function pdf($value='')
    {
        // documentation
        // https://tcpdf.org/examples/

        // load library
        $this->load->library('tcpdf');
        //
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        //

        $html = <<<EOD
            <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
            <i>This is the first example of TCPDF library.</i>
            <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
            <p>Please check the source code documentation and other examples for further information.</p>
            <p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
            EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        //
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');
    }

    public function upload($value='')
    {
        echo '<title>Upload Form</title>';
        if(! empty($value)){
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
        // load csrf data
        $csrf = [
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
        ];
        echo '
        <form action="'.site_url("welcome/upload_process").'" method="post" enctype="multipart/form-data">
        <input type="hidden" name="'.$csrf["name"].'" value="'.$csrf["hash"].'" />
          Select image to upload:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit">
        </form>
        ';
    }

    public function upload_process($value='')
    {
        $image = time().'-'.$_FILES["fileToUpload"]['name'];
        //
        $config['upload_path']          = 'resource/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']            = $image;
        //
        $this->load->library('tupload', $config);
        //
        if ( ! $this->tupload->do_upload_image('fileToUpload'))
        {
                $error = array('error' => $this->tupload->display_errors());

                self::upload($error);
        }
        else
        {
                $data = array('upload_data' => $this->tupload->data());

                self::upload($data);
        }
    }

    public function guzzle()
    {
        $client = new Client();
        // GET
        $response = $client->request('GET', 'https://reqres.in/api/users');
        // // POST
        // $response = $client->request('POST', '/api/login', [
        //     'json' => [
        //         'email' => 'eve.holt@reqres.in',
        //         'password' => 'cityslicka'
        //     ]
        // ]);
        $body = $response->getBody();
        $body_array = json_decode($body);
        print_r($body_array);
    }

}
