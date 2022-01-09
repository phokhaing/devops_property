<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
use PhpOffice\PhpSpreadsheet\Worksheet;

/** 
 *------------------------------------------------------
 * @author: khaing.pho1991@gmail.com
 * @param: 10/July/2020
 * @param: controller for manager application infomation 
 *------------------------------------------------------
 */
class Special_payment_request_report extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "reports/special_payment_request_report/";
    private $link       = "reports/special_payment_request_report";
    private $title      = "special_payment_request_report";
    private $moduleName = "reports/special_payment_request_report";

    /** 
      *------------------------------------------
      * DEFAULT CONSTRUTOR OF application CONTROLLER
      *------------------------------------------
      */
    public function __construct()
    {
        parent::__construct();
        if (!$this->user->loggedin) redirect('login');
        $this->authorization->hasAccess($this->moduleName);

        $this->load->model('SpecialPaymentRequestModel','specialPaymentRequestModel');
        $this->load->helper('accessright');
        $this->load->helper('currency');

        /** 
         *------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *------------------------------
         */
        
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->specialPaymentRequestModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->specialPaymentRequestModel->findAll();
            $this->template->loadContent($this->page . "list", $this->data);
        }
    }

    /** 
      *------------------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 12/March/2020
      * @param: method for filter data
      *------------------------------------------------------------------------
      */
      public function findFilter(){
        $this->authorization->hasAccess($this->moduleName);
        if($this->authorization->hasPermission($this->moduleName, "search")){
            $this->data['filters'] = $this->specialPaymentRequestModel->filter();
            $this->data['status'] = $_GET['filter'];
            $this->load->view($this->page ."filter", $this->data);
        }
      }

      public function showAllItems(){
        $this->authorization->hasAccess($this->moduleName);
        if($this->authorization->hasPermission($this->moduleName, "search")){
            $this->data['data'] = $this->specialPaymentRequestModel->findAll();
            $this->load->view($this->page ."list_items", $this->data);
        }
      }

    /** 
      *------------------------------------------------------------------------
      * @author: khaing.pho1991@gmail.com
      * @param: 03/November/2020
      * @param: method for export data as excel file
      *------------------------------------------------------------------------
      */
      public function export_excel(){
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        // header
        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Full Name');
        $sheet->setCellValue('C1', 'Gender');              
        $sheet->setCellValue('D1', 'Position');
        $sheet->setCellValue('E1', 'Division');
        $sheet->setCellValue('F1', 'Staff ID');
        $sheet->setCellValue('G1', 'Subject');
        $sheet->setCellValue('H1', 'Content');
        $sheet->setCellValue('I1', 'Reason');
        $sheet->setCellValue('J1', 'Reference');
        $sheet->setCellValue('K1', 'Status');
        $sheet->setCellValue('L1', 'Date');
        $sheet->setCellValue('M1', 'Prepared By');
        $sheet->setCellValue('N1', 'Prepared At');
        $sheet->setCellValue('O1', 'Checked By');
        $sheet->setCellValue('P1', 'Checked At');
        $sheet->setCellValue('Q1', 'Approved By');
        $sheet->setCellValue('R1', 'Approved At');
        $sheet->setCellValue('S1', 'Rejected By');
        $sheet->setCellValue('T1', 'Rejected At');
        $sheet->setCellValue('U1', 'Created By');
        $sheet->setCellValue('V1', 'Created At');
        $sheet->setCellValue('W1', 'Updated By');
        $sheet->setCellValue('X1', 'Updated At');

        $data = $this->specialPaymentRequestModel->filter();
        $total_amount = 0;
        $start = 2;
        foreach($data as $row){
            $sheet->setCellValue('A'.$start, $row->id);
            $sheet->setCellValue('B'.$start, $row->fullname);
            $sheet->setCellValue('C'.$start, $row->gender);
            $sheet->setCellValue('D'.$start, $row->position);
            $sheet->setCellValue('E'.$start, $row->division);
            $sheet->setCellValue('F'.$start, $row->staff_id);
            $sheet->setCellValue('G'.$start, $row->subject);
            $sheet->setCellValue('H'.$start, $row->content);
            $sheet->setCellValue('I'.$start, $row->reason);
            $sheet->setCellValue('J'.$start, $row->reference);
            $sheet->setCellValue('K'.$start, $row->authorize_status);
            $sheet->setCellValue('L'.$start, ($row->date != null ? date('d/m/Y', strtotime($row->date)) : ''));
            $sheet->setCellValue('M'.$start, getUserFullName($row->created_by));
            $sheet->setCellValue('N'.$start, ($row->created_at != null ? date('d/m/Y H:i:sa', strtotime($row->created_at)) : ''));
            $sheet->setCellValue('O'.$start, getUserFullName($row->checked_by));
            $sheet->setCellValue('P'.$start, ($row->checked_at != null ? date('d/m/Y H:i:sa', strtotime($row->checked_at)) : ''));
            $sheet->setCellValue('Q'.$start, getUserFullName($row->approved_by));
            $sheet->setCellValue('R'.$start, ($row->approved_at != null ? date('d/m/Y H:i:sa', strtotime($row->approved_at)) : ''));
            $sheet->setCellValue('S'.$start, getUserFullName($row->rejectd_by));
            $sheet->setCellValue('T'.$start, ($row->rejectd_at != null ? date('d/m/Y H:i:sa', strtotime($row->rejectd_at)) : ''));
            $sheet->setCellValue('U'.$start, getUserFullName($row->created_by));
            $sheet->setCellValue('V'.$start, ($row->created_at != null ? date('d/m/Y H:i:sa', strtotime($row->created_at)) : ''));
            $sheet->setCellValue('W'.$start, getUserFullName($row->updated_by));
            $sheet->setCellValue('X'.$start, ($row->updated_at != null ? date('d/m/Y H:i:sa', strtotime($row->updated_at)) : ''));
          $start = $start+1;
        }        
        
        // set
        $style = [
              'borders' => [
                'allBorders' => [
                  'borderStyle' => Border::BORDER_THIN,
                  'color' => ['argb' => 'FF000000'],
                ],
              ],
            ];
        $sheet->getStyle('A1:X1')->getFont()->setBold(true);	
        // $sheet->getStyle('A1:M'.$start)->applyFromArray($style);	
        $sheet->getStyle('A1:A'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        // $sheet->getStyle('A1:M'.$start)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Special Payment Request';
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
      }
}?>