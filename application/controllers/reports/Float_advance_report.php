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
class Float_advance_report extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "reports/float_advance_report/";
    private $link       = "reports/float_advance_report";
    private $title      = "float_advance_report";
    private $moduleName = "reports/float_advance_report";

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

        $this->load->model('FloatAdvanceModel','floatAdvanceModel');
        $this->load->helper('accessright');
        $this->load->helper('currency');

        /** 
         *------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *------------------------------
         */
        
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->floatAdvanceModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->floatAdvanceModel->findAll();
            $this->data['projects'] = $this->floatAdvanceModel->findProjectActive();
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
            $this->data['filters'] = $this->floatAdvanceModel->filter();
            $this->data['status'] = $_GET['filter'];
            $this->load->view($this->page ."filter", $this->data);
        }
      }

      public function showAllItems(){
        $this->authorization->hasAccess($this->moduleName);
        if($this->authorization->hasPermission($this->moduleName, "search")){
            $this->data['data'] = $this->floatAdvanceModel->findAll();
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
        $sheet->setCellValue('A1', 'Ref No.');
        $sheet->setCellValue('B1', 'Project Name');
        $sheet->setCellValue('C1', 'Department');
        $sheet->setCellValue('D1', 'Branch');
        $sheet->setCellValue('E1', 'Staff Request');
        $sheet->setCellValue('F1', 'Purpose');
        $sheet->setCellValue('G1', 'R.Date');
        $sheet->setCellValue('H1', 'Deadline');
        $sheet->setCellValue('I1', 'Reference');
        $sheet->setCellValue('J1', 'Status');
        $sheet->setCellValue('K1', 'Prepared By');
        $sheet->setCellValue('L1', 'Checked By');
        $sheet->setCellValue('M1', 'Approved By');
        $sheet->setCellValue('N1', 'Total');

        $data = $this->floatAdvanceModel->filter();
        $total_amount = 0;
        $start = 2;
        foreach($data as $row){
          $sheet->setCellValue('A'.$start, $row->ref_no);
          $sheet->setCellValue('B'.$start, findProjectName($row->project));
          $sheet->setCellValue('C'.$start, getDepartmentName($row->department));
          $sheet->setCellValue('D'.$start, getBranchName($row->branch));
          $sheet->setCellValue('E'.$start, getUserFullName($row->staff_request));
          $sheet->setCellValue('F'.$start, $row->purpose);
          $sheet->setCellValue('G'.$start, date('d/m/Y', strtotime($row->r_date)));
          $sheet->setCellValue('H'.$start, date('d/m/Y', strtotime($row->deadline)));
          $sheet->setCellValue('I'.$start, $row->reference);
          $sheet->setCellValue('J'.$start, $row->authorize_status);
          $sheet->setCellValue('K'.$start, getUserFullName($row->created_by));
          $sheet->setCellValue('L'.$start, getUserFullName($row->checked_by));
          $sheet->setCellValue('M'.$start, getUserFullName($row->approved_by));
          $sheet->setCellValue('N'.$start, currency_format(1, $row->total_amount));

          // show items
          if(isset($_GET['filter'])){
            if($_GET['filter'] == 'all' || $_GET['filter'] == 'approved_detail' || $_GET['filter'] == 'unauthorize_detail'){
              $items = findFloatAdvanceItemByID($row->id);
              if(!empty($items)){
                $start = $start+1;
                $sheet->getStyle('A'.$start.':N'.$start)->getFont()->setBold(true);
                $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue('B'.$start, 'No.');
                $sheet->setCellValue('C'.$start, 'Description');
                $sheet->setCellValue('D'.$start, 'Total');
                $sheet->setCellValue('E'.$start, 'Remarks');

                foreach ($items as $key => $item){
                  $start = $start+1;
                  $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                  $sheet->setCellValue('B'.$start, $key+1);
                  $sheet->setCellValue('C'.$start, $item->description);   
                  $sheet->setCellValue('D'.$start, currency_format(1, $item->total));
                  $sheet->setCellValue('E'.$start, $item->remark);
                }
              }
            }
          }

          $start = $start+1;
          $total_amount += $row->total_amount;
        }        

        // show total 
        $sheet->getStyle('M'.$start.':N'.$start)->getFont()->setBold(true);
        $sheet->setCellValue('M'.$start, 'Total Amount:');
        $sheet->setCellValue('N'.$start, currency_format(1, $total_amount));
        
        // set
        $style = [
              'borders' => [
                'allBorders' => [
                  'borderStyle' => Border::BORDER_THIN,
                  'color' => ['argb' => 'FF000000'],
                ],
              ],
            ];
        $sheet->getStyle('A1:N1')->getFont()->setBold(true);	
        // $sheet->getStyle('A1:M'.$start)->applyFromArray($style);	
        $sheet->getStyle('A1:A'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        // $sheet->getStyle('A1:M'.$start)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Float Advance Report';
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
      }
}?>