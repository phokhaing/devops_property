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
class Purchase_order_report extends CI_Controller
{
    /* GLOBAL VARAIBLE */
    private $data       = array();
    private $page       = "reports/purchase_order_report/";
    private $link       = "reports/purchase_order_report";
    private $title      = "purchase_order_report";
    private $moduleName = "reports/purchase_order_report";

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

        $this->load->model('PurchaseOrderModel','purchaseOrderModel');
        $this->load->helper('accessright');
        $this->load->helper('currency');

        /** 
         *------------------------------
         * SET VALUE TO GLOBAL VARAIBLE
         *------------------------------
         */
        
        $this->data['title']      = $this->title;
        $this->data['link']       = $this->link;
        $this->data['status']     = $this->purchaseOrderModel->count();
        $this->data['moduleName'] = $this->moduleName;
    }

    public function index()
    {
        if ($this->authorization->hasPermission($this->moduleName, "list")) {
            $this->data['data'] = $this->purchaseOrderModel->findAll();
            $this->data['projects'] = $this->purchaseOrderModel->findProjectActive();
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
            $this->data['filters'] = $this->purchaseOrderModel->filter();
            $this->data['status'] = $_GET['filter'];
            $this->load->view($this->page ."filter", $this->data);
        }
      }

      public function showAllItems(){
        $this->authorization->hasAccess($this->moduleName);
        if($this->authorization->hasPermission($this->moduleName, "search")){
            $this->data['data'] = $this->purchaseOrderModel->findAll();
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
        $sheet->setCellValue('A1', 'PO No.');
        $sheet->setCellValue('B1', 'Project Name');
        $sheet->setCellValue('C1', 'Name Shope');             
        $sheet->setCellValue('D1', 'Date');
        $sheet->setCellValue('E1', 'Deadline');
        $sheet->setCellValue('F1', 'Contact');
        $sheet->setCellValue('G1', 'Phone');
        $sheet->setCellValue('H1', 'PR No.');
        $sheet->setCellValue('I1', 'Cheque');
        $sheet->setCellValue('J1', 'Payment Term');
        $sheet->setCellValue('K1', 'Warranty');
        $sheet->setCellValue('L1', 'Warranty Contact');
        $sheet->setCellValue('M1', 'Delivery');
        $sheet->setCellValue('N1', 'Delivery Contact');
        $sheet->setCellValue('O1', 'Location');
        $sheet->setCellValue('P1', 'Address');
        $sheet->setCellValue('Q1', 'Reference');
        $sheet->setCellValue('R1', 'Status');
        $sheet->setCellValue('S1', 'Order By');
        $sheet->setCellValue('T1', 'Order Date');
        $sheet->setCellValue('U1', 'Receiver');
        $sheet->setCellValue('V1', 'Request By');
        $sheet->setCellValue('W1', 'Checked By');
        $sheet->setCellValue('X1', 'Approved By');
        $sheet->setCellValue('Y1', 'Sub Total');
        $sheet->setCellValue('Z1', 'Discount');
        $sheet->setCellValue('AA1', 'Deposit');
        $sheet->setCellValue('AB1', 'Grand Total');

        $data = $this->purchaseOrderModel->filter();
        $total_amount = 0;
        $start = 2;
        foreach($data as $row){

          $sheet->setCellValue('A'.$start, $row->po_no);
          $sheet->setCellValue('B'.$start, findProjectName($row->project));
          $sheet->setCellValue('C'.$start, $row->name_shop);
          $sheet->setCellValue('D'.$start, date('d/m/Y', strtotime($row->date)));
          $sheet->setCellValue('E'.$start, date('d/m/Y', strtotime($row->deadline)));
          $sheet->setCellValue('F'.$start, $row->contact);
          $sheet->setCellValue('G'.$start, $row->phone_number);
          $sheet->setCellValue('H'.$start, $row->pr_no);
          $sheet->setCellValue('I'.$start, $row->cheque);
          $sheet->setCellValue('J'.$start, $row->payment_term);
          $sheet->setCellValue('K'.$start, $row->warranty);
          $sheet->setCellValue('L'.$start, $row->warranty_contact);
          $sheet->setCellValue('M'.$start, $row->delivery);
          $sheet->setCellValue('N'.$start, $row->delivery_phone_number);
          $sheet->setCellValue('O'.$start, $row->location);
          $sheet->setCellValue('P'.$start, $row->address);
          $sheet->setCellValue('Q'.$start, $row->reference);
          $sheet->setCellValue('R'.$start, $row->authorize_status);
          $sheet->setCellValue('S'.$start, $row->order_by);
          $sheet->setCellValue('T'.$start, $row->order_date);
          $sheet->setCellValue('U'.$start, $row->reciever);
          $sheet->setCellValue('V'.$start, getUserFullName($row->created_by));
          $sheet->setCellValue('W'.$start, getUserFullName($row->checked_by));
          $sheet->setCellValue('X'.$start, getUserFullName($row->approved_by));
          $sheet->setCellValue('Y'.$start, currency_format(1, $row->sub_total_amount));
          $sheet->setCellValue('Z'.$start, currency_format(1, $row->discount));
          $sheet->setCellValue('AA'.$start, currency_format(1, $row->deposit));
          $sheet->setCellValue('AB'.$start, currency_format(1, $row->total_amount));

          // show items
          if(isset($_GET['filter'])){
            if($_GET['filter'] == 'all' || $_GET['filter'] == 'approved_detail' || $_GET['filter'] == 'unauthorize_detail'){
              $items = findPurchaseOrderItemByID($row->id);
              if(!empty($items)){
                $start = $start+1;
                $sheet->getStyle('A'.$start.':AB'.$start)->getFont()->setBold(true);
                $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->setCellValue('B'.$start, 'No.');
                $sheet->setCellValue('C'.$start, 'Description');
                $sheet->setCellValue('D'.$start, 'UOM');
                $sheet->setCellValue('E'.$start, 'Quantity');
                $sheet->setCellValue('F'.$start, 'Price');
                $sheet->setCellValue('G'.$start, 'Total');

                foreach ($items as $key => $item){
                  $start = $start+1;
                  $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                  $sheet->setCellValue('B'.$start, $key+1);
                  $sheet->setCellValue('C'.$start, $item->description);   
                  $sheet->setCellValue('D'.$start, findMeasurementName($item->uom));   
                  $sheet->setCellValue('E'.$start, $item->quantity);   
                  $sheet->setCellValue('F'.$start, currency_format(1, $item->price));
                  $sheet->setCellValue('G'.$start, currency_format(1, $item->total));
                }
              }
            }
          }

          $start = $start+1;
          $total_amount += $row->total_amount;
        }        

        // show total 
        $sheet->getStyle('AA'.$start.':AB'.$start)->getFont()->setBold(true);
        $sheet->setCellValue('AA'.$start, 'Total Amount:');
        $sheet->setCellValue('AB'.$start, currency_format(1, $total_amount));
        
        // set
        $style = [
              'borders' => [
                'allBorders' => [
                  'borderStyle' => Border::BORDER_THIN,
                  'color' => ['argb' => 'FF000000'],
                ],
              ],
            ];
        $sheet->getStyle('A1:AB1')->getFont()->setBold(true);	
        // $sheet->getStyle('A1:M'.$start)->applyFromArray($style);	
        $sheet->getStyle('A1:A'.$start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        // $sheet->getStyle('A1:M'.$start)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Purchase Order Report';
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
      }
}?>