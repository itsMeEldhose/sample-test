<?php
class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Test_model', 'test');
        // $this->load->library('pdf');
    }

    public function index()
    {
        $this->load->view('test_view');
    }
    public function save()
    {
        $name = $this->input->post('name');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $tax = $this->input->post('tax');
        $with_tax = $this->input->post('with_tax');
        $without_tax = $this->input->post('without_tax');

         $this->test->save($name,$quantity,$price,$total,$tax,$with_tax,$without_tax);
        $this->pdf_download($name,$quantity,$price,$total,$tax,$with_tax,$without_tax);
    }
    public function pdf_download($name,$quantity,$price,$total,$tax,$with_tax,$without_tax)
    {
        if (isset($_POST["create_pdf"])) {
            $this->load->library('Pdf');
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $obj_pdf->SetCreator(PDF_CREATOR);
            $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
            $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
            $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $obj_pdf->SetDefaultMonospacedFont('helvetica');
            $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            $obj_pdf->SetAutoPageBreak(TRUE, 10);
            $obj_pdf->SetFont('helvetica', '', 12);
            $obj_pdf->AddPage();
            $content = '';
            $content .= '  
              <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
              <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="5%">ID</th>  
                <th width="20%">Name</th>  
                <th width="15%">Quantity</th>  
                <th width="15%">price</th>  
                <th width="15%">Tax</th>
                <th width="10%">Total</th>  
                <th width="10%">Total With Tax</th>  
                <th width="10%">Total Withput Tax</th>   
           </tr>  ';
          
           
           
            $length = sizeof($name);
            for ($i = 0; $i < $length; $i++) {
            $content .=  ' <tr>
               <th width="5%">'.($i+1).'</th>  
                <th width="20%">' . $name[$i] .'</th>  
                <th width="15%">'.$quantity[$i] . '</th>  
                <th width="15%">' . $price[$i]. '</th>  
                <th width="15%">' . $tax[$i] . '</th>
                <th width="10%">' .$total[$i] .'</th>  
                <th width="10%">' .$with_tax[$i] .'</th>  
                <th width="10%">' .$without_tax[$i] . '</th>  
                </tr>';
            }      
            // $content .= fetch_data();
            $content .= '</table>';
            $obj_pdf->writeHTML($content);
            $obj_pdf->Output('sample.pdf', 'I');
        }
    }
}
