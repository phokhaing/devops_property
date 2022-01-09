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
class Goods_received_note_report extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "reports/goods_received_note_report/";
    private $link       = "reports/goods_received_note_report";
    private $title      = "goods_received_note_report";
    private $moduleName = "reports/goods_received_note_report";

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

        $this->load->model('GoodsReceivedNoteModel','goodsReceivedNoteModel');
        $this->load->helper('accessright');
        $this->load->helper('currency');

        /** 
         *------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *------------------------------
         */
        
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->goodsReceivedNoteModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->goodsReceivedNoteModel->findAll();
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
            $this->data['filters'] = $this->goodsReceivedNoteModel->filter();
            $this->data['status'] = $_GET['filter'];
            $this->load->view($this->page ."filter", $this->data);
        }
      }

      public function showAllItems(){
        $this->authorization->hasAccess($this->moduleName);
        if($this->authorization->hasPermission($this->moduleName, "search")){
            $this->data['data'] = $this->goodsReceivedNoteModel->findAll();
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
        $sheet->setCellValue('A1', 'Ordered No.');
        $sheet->setCellValue('B1', 'Received From');
        $sheet->setCellValue('C1', 'GRN No.');
        $sheet->setCellValue('D1', 'Date');
        $sheet->setCellValue('E1', 'Phone Number');
        $sheet->setCellValue('F1', 'Address');
        $sheet->setCellValue('G1', 'Reference');
        $sheet->setCellValue('H1', 'Status');
        $sheet->setCellValue('I1', 'Prepared By');
        $sheet->setCellValue('J1', 'Checked By');
        $sheet->setCellValue('K1', 'Total Amount');

        $data = $this->goodsReceivedNoteModel->filter();
        $total_amount = 0;
        $start = 2;
        foreach($data as $row){
          $sheet->setCellValue('A'.$start, $row->ordered_no);
          $sheet->setCellValue('B'.$start, findCompanyName($row->received_from));
          $sheet->setCellValue('C'.$start, $row->grn_no);
          $sheet->setCellValue('D'.$start, date('d/m/Y', strtotime($row->date)));
          $sheet->setCellValue('E'.$start, $row->phone);
          $sheet->setCellValue('F'.$start, $row->address);
          $sheet->setCellValue('G'.$start, $row->reference);
          $sheet->setCellValue('H'.$start, $row->authorize_status);
          $sheet->setCellValue('I'.$start, getUserFullName($row->created_by));
          $sheet->setCellValue('J'.$start, getUserFullName($row->checked_by));
          $sheet->setCellValue('K'.$start, currency_format(1, $row->total_amount));

          // show items
          if(isset($_GET['filter'])){
            if($_GET['filter'] == 'all' || $_GET['filter'] == 'checked_detail' || $_GET['filter'] == 'unauthorize_detail'){
              $items = findGoodsReceivedNoteItemByID($row->id);
              if(!empty($items)){
                $start = $start+1;
                $sheet->getStyle('A'.$start.':K'.$start)->getFont()->setBold(true);
                $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue('B'.$start, 'No.');
                $sheet->setCellValue('C'.$start, 'Item No.');
                $sheet->setCellValue('D'.$start, 'Description');
                $sheet->setCellValue('E'.$start, 'Ref No.');
                $sheet->setCellValue('F'.$start, 'UOM');
                $sheet->setCellValue('G'.$start, 'Price');
                $sheet->setCellValue('H'.$start, 'Remarks');

                foreach ($items as $key => $item){
                  $start = $start+1;
                  $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                  $sheet->setCellValue('B'.$start, $key+1);
                  $sheet->setCellValue('C'.$start, $item->item_no);   
                  $sheet->setCellValue('D'.$start, $item->description);   
                  $sheet->setCellValue('E'.$start, $item->ref_no);   
                  $sheet->setCellValue('F'.$start, findMeasurementName($item->uom));
                  $sheet->setCellValue('G'.$start, currency_format(1, $item->price));
                  $sheet->setCellValue('H'.$start, $item->remark);
                }
              }
            }
          }

          $start = $start+1;
          $total_amount += $row->total_amount;
        }        

        // show total 
        $sheet->getStyle('J'.$start.':K'.$start)->getFont()->setBold(true);
        $sheet->setCellValue('J'.$start, 'Total Amount:');
        $sheet->setCellValue('K'.$start, currency_format(1, $total_amount));
        
        // set
        $style = [
              'borders' => [
                'allBorders' => [
                  'borderStyle' => Border::BORDER_THIN,
                  'color' => ['argb' => 'FF000000'],
                ],
              ],
            ];
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);	
        // $sheet->getStyle('A1:M'.$start)->applyFromArray($style);	
        $sheet->getStyle('A1:A'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        // $sheet->getStyle('A1:M'.$start)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Goods Received Note Report';
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
      }
}?>