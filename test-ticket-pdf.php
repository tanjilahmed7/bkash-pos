<?php
$name = "Mahi Uddin Shafayet Kabir";
$reg_id = "1234567891013";
$gate = "12";
$ticket_count = "10582";

require_once('TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// // set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set a barcode on the page footer
$pdf->setBarcode(date('Y-m-d H:i:s'));

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();




// Header Title


$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 12);
$txt = 'WITHOUT A READABLE BARCODE, ENTRY INTO THE VENUE WILL NOT BE ALLOWED';
$pdf->MultiCell($w = 178, $h = 7, $txt, $border = 1, $align = 'centre', $fill = '0,0,0', $ln = 1, $x = '17', $y = '5', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0);


/*
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |   LOGO (Activated)
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |
  |
  |
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 */

$pdf->SetXY(150, 200);
$pdf->Image('image/ticket-logo.png', 10, 19, 102, 60, '', '', 'N', false, 300, '', false, false, 0, false, false, false);


$pdf->SetTextColor(0, 0, 0);



// $pdf->Text(50, 80, 'VENUE : Army Museum');
// $pdf->Text(50, 85, 'Dhaka, Bangladesh');

$pdf->SetFont('helvetica', '', 9);
$pdf->Text(14, 83, '24 Nov - 28 Nov 2016');
$pdf->Text(14, 88, 'Gates will open at 5:00 PM');



$pdf->SetFont('helvetica', '', 9);
$pdf->Text(69, 83, 'ARMY STADIUM');
$pdf->Text(69, 88, 'Dhaka, Bangladesh');



// $pdf->Text(50, 65, 'DATE : 15 - 17 January');
// $pdf->Text(50, 70, 'TIME : Gates open at 30 minutes');
// $name = "Md Shafayet Kabir";
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Text(117, 47, $name);

// $gate = 16;
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Text(117, 57, 'Gate - ' . $gate);

// $Ticket count = 16;
$pdf->SetFont('helvetica', 'B', 17);
$pdf->Text(165, 58, $ticket_count);

$pdf->SetFont('helvetica', '', 10);
$pdf->Text(120, 73, 'Helpline : 01616 111888 (10AM - 11:30PM)');




$pdf->SetFont('helvetica', 'B', 30);
$pdf->Text(124, 81, 'FREE PASS');




// Left
$style_line01 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 18, 10, 96, $style_line01);
// Top
$style_line02 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 18, 200, 18, $style_line02);
// Right
$style_line03 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(200, 18, 200, 96, $style_line03);
// Bottom
$style_line04 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(200, 96, 10, 96, $style_line04);

// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$style_line05 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(66, 80, 66, 96, $style_line05);

$style_line06 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 45, 200, 45, $style_line06);

$style_line07 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 80, 200, 80, $style_line07);



$style_line9 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 18, 112, 96, $style_line9);

$style_line10 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 55, 200, 55, $style_line10);

$style_line11 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 70, 200, 70, $style_line11);


// Left Ticket count
$style_line12 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(155, 55, 155, 70, $style_line12);
// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 10,
    'stretchtext' => 4
);

// PRINT VARIOUS 1D BARCODES
// CODE 39 EXTENDED
//$pdf->Cell(0, 0, 'Aarong Festival TICKET', 0, 1);
// write1DBarcode ($code, $type, $x=“, $y=”, $w=“, $h=”, $xres=“, $style=“, $align=”)

$pdf->write1DBarcode($reg_id, 'C39E', 113, 19, 100, 25, 0.32, $style, 'N');




/*
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |   Artist name and schedule
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |
  |
  |
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 */
$pdf->SetFont('helvetica', 'B', 12, '', 'false');
$pdf->Text(85, 98, 'Schedule');
$pdf->Ln();
$pdf->SetFont('helvetica', '', 10, '', 'false');

$schedule = '
<p>
  <b>Day 1: Thursday 24 November 2016 : </b>
  Dance by <i>Sharmila Banerjee and troupe</i> .
  Duet by <i>Pravin Godkhindi (Flute) and Ratish Tagde (Violin)</i> .
  Khayal by <i>V. Girija Devi</i> .
  Sarod by <i>Ust Aashish Khan </i> .
  Jasrangi duet (vocal) by <i>V. Ashwini Bhide Deshpande and Pt Sanjeev Abhyankar</i> .
  Violin by <i>Dr. L Subramaniam</i>
</p>
<p>
  <b>Day 2: Friday 25 November 2016 : </b>
  Odissi (dance) by <i>V. Madhavi Mudgal and troupe</i> . 
  Tabla by <i>students of Bengal Parampara Sangeetalay</i> . 
  Khayal by <i>Priyanka Gope</i> . 
  Santoor by <i>Rahul Sharma</i> . 
  Vocal presentation by <i>Mohammed Shoeb and others</i> . 
  Sitar by <i>Purbayan Chatterjee</i> . 
  Khayal by <i>Pt Ulhas Kashalkar</i> . 
  Duet by <i>Pt Ronu Majumdar</i> (Flute) and <i>U Rajesh (Mandolin)</i>
</p>
<p>
  <b>Day 3: Saturday 26 November 2016 : </b>
  Sarod by <i>students of Bengal Parampara Sangeetalay</i> .
  Carnatic Flute by <i>Shashank Subramanyam</i> .
  Khayal by <i>Dr. Prabha Atre</i> .
  Tabla by <i>Pt Anindo Chatterjee</i> .
  Dhrupad by <i>Pt Uday Bhawalkar</i> .
  Sitar by <i>Pt Sanjoy Bandopadhyay</i> .
  Khayal by <i>Ust Rashid Khan</i>
</p>
<p>
  <b>Day 4: Sunday 27 November 2016 : </b>
  Kathak (dance) by <i>Munmun Ahmed and troupe</i> . 
  Tabla by <i>Nilesh Ranadive</i> . 
  Khayal by <i>Jayateerth Mevundi</i> . 
  Duet (tabla) by <i>Pt Yogesh Samsi</i> and <i>Pt Subhankar Banerjee</i>. 
  Duet (Carnatic vocal) by <i>Ranjani & Gayatri</i> . 
  Sarod by <i>Pt Tejendra Narayan Majumdar</i> . 
  Khayal by <i>Pt Ajoy Chakrabarty</i>
</p>
<p>
  <b>Day 5: Monday 28 November 2016 : </b>
  Vocal presentation by <i>students of the Music Dept, University of Dhaka</i> .
  Sitar by <i>students of Bengal Parampara Sangeetalay</i> .
  Santoor by <i>Pt Shiv Kumar Sharma</i> .
  Khayal by <i>Kumar Mardur</i> .
  Sitar by <i>Pt Kushal Das</i> .
  Khayal by <i>Arati Ankalikar</i> .
  Flute by <i>Pt Hari Prasad Chaurasia</i>
</p>

';

$pdf->SetFont('helvetica', '', 7);
$pdf->writeHTML($schedule, true, false, true, false, '');



$pdf->SetFont('helvetica', '', 8);
$pdf->Text(82, 151, '*Programme starts at 7 PM everyday. The schedule is subject to change without prior notice');

/*
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |   Terms & Conditions
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |
  |
  |
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 */

$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 10, '', 'false');
$pdf->Text(75, 156, 'Terms and conditions');
$pdf->Ln(5);


$terms = '
<ol>
    <li>The e-Ticket (containing the barcode) must be presented every time when entering the venue during the 5 (five) day event.</li>
    <li>There will be an initial screening of the pass at the main gate, followed by scanning of the pass at the numbered gates of the stadium.</li>                     
    <li>The barcode must be readable by the scanner. Without a readable barcode, entry into the venue will not be allowed.</li>                
    <li>Photocopies of the e-Ticket will not be allowed. People with photocopies will not be allowed entry at the stadium gates.</li>
    <li><strong>e-Tickets cannot be printed at the venue.</strong></li>
    <li><strong>There will be no registration at the venue.</strong></li> 
    <li>A wristband will be put on each audience member at the gate and re-entry into the venue will not be allowed without the wristband under any circumstance.</li>
    <li>The wristband will be considered unacceptable for entry if it appears to have been tampered with.</li>
    <li><strong>Multiple re-entry will not be allowed.</strong></li>
    <li>The organizers reserve the right to pat down a pass holder at the entry point, for security reasons, if deemed necessary.</li>
    <li>Audience members are requested to carry an official photo-ID with them.</li>
    <li>Due to security checks, there may be certain delays at entry gates. Your cooperation and patience in this regard is appreciated.</li>
    <li>Gates will open at 5:00 pm.</li>
    <li><strong>Gates will close at 12:00 am.</strong></li>
    <li>Children below the age of 12 (twelve) will not be allowed entry at the event.</li>
    <li><strong>No bags will be allowed inside.</strong> Men are requested not to bring any item other than their mobile phones, wallets and keys which may be carried in their pockets. Women are requested not to bring purses larger than 8 inches by 4 inches. Any bag larger than this will not be allowed inside.</li>
    <li>There will be no provision to leave bags anywhere. The organizers cannot take responsibility for any bags brought to the stadium.</li>
     <li>The organizers reserve the right to check bags at entry points for security reasons. Bags refer only to ladies purses of size 8 inches by 4 inches, and laptop bags carried by members of the press who are registered with Bengal.</li>
    <li>No food or drink/water may be brought in from outside. Food will be available at the food court at a reasonable price. Water is available free of charge.</li>
    <li><strong>All kinds of tobacco, tobacco related products will not be allowed to be taken into the venue.</strong></li>
    <li>Seats are limited and are on a first come, first served basis. However, the organizers reserve the right to change the seating arrangement and provide an alternative seat for the pass holder.</li> 
    <li><strong>No seats can be reserved for anyone by keeping bags, shawls or anything else.</strong></li> 
    <li>The organizers reserve the right to refuse entry or to remove from the premises, people or persons deemed as a security threat or an element of disturbance.</li>
    <li>The organizers reserve the right to conduct security searches from time to time and also reserve the right to confiscate any item which may cause danger or disruption to other members of the audience and if deemed as a security threat.</li>
    <li>CCTV and film cameras will be present at the venue. Attending the event signifies the pass holders consent to the filming and sound recording of themselves as members of the audience with no obligations of any kind on the organizers part.</li>
    <li>The organizers will not take any responsibility for loss or theft of any personal belongings or any loss, injury and damage to the holder of an e-Ticket.</li>
    <li><strong>Cameras of any kind</strong> whatsoever (other than those in mobile phones) <strong>are totally prohibited</strong>. The organizers reserve the right to confiscate such items.</li>
    <li>Phones must be kept on silent mode during a performance.</li>
    <li><strong>Audience members are requested to keep in mind the spirit of the event and not distract other listeners.</strong></li>
    <li>Members of the audience should remain seated while in the performance area.</li>
    <li><strong>If stadium capacity is full, then gates will close without prior notice.</strong></li>
    <li><strong>There will be no parking available at the venue.</strong></li>
</ol>';

$pdf->SetFont('helvetica', '', 6, '', 'false');
$pdf->writeHTML($terms, true, false, true, false, '');


// $pdf->SetXY(150, 200);
// TCPDF::Image($file,$x = '',$y = '',$w = 0,$h = 0,$type = '',$link = '',$align = '',$resize = false,$dpi = 300,$palign = '',$ismask = false,$imgmask = false,$border = 0,$fitbox = false,$hidden = false,$fitonpage = false,$alt = false,$altimgs = array())

$pdf->Image('image/footer.png', 10, 257, 190, 15, '', '', '', false, 300);


// ---------------------------------------------------------
//Close and output PDF document

$pdf_content = $pdf->Output('Free Pass Aarong Festival 2018.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
