<?php
//============================================================+
// File name   : example_027.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 027 for TCPDF class
//               1D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 1D Barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf/examples/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

    

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();
// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 10);


// ------------------------------------------------------------------------------------------------------------


$pdf->SetTextColor(255,255,255);
$pdf->SetFont('helvetica', 'B', 12);
$txt = 'WITHOUT A READABLE BARCODE, ENTRY INTO THE VENUE WILL NOT BE ALLOWED';
$pdf->MultiCell($w=178, $h=7, $txt, $border=1, $align='centre', $fill='0,0,0', $ln=1, $x='17', $y='5', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0);







/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|   Top Bordered box area
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|   Line($x1,$y1, $x2,$y2, $style = array())
|
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

// Left
$style_line01 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(10, 18, 10, 100, $style_line01);
// Top
$style_line02 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(10, 18, 200, 18, $style_line02);
// Right
$style_line03 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(200, 18, 200, 100, $style_line03);
// Bottom
$style_line04 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(200, 100, 10, 100, $style_line04);

// -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$style_line05 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(66, 80, 66, 100, $style_line05);

$style_line06 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(112, 45, 200, 45, $style_line06);

$style_line07 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(10, 80, 200, 80, $style_line07);



$style_line9 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(112, 18, 112, 100, $style_line9);

$style_line10 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(112, 55, 200, 55, $style_line10);

$style_line11 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218,218,218));
$pdf->Line(112, 70, 200, 70, $style_line11);


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
$pdf->Image('image/logo_pdf.jpg', 11, 19, 100, 60, '', '', 'N', false, 300, '', false, false, 0, false, false, false);





$pdf->SetTextColor(0,0,0);



// $pdf->Text(50, 80, 'VENUE : Army Museum');
// $pdf->Text(50, 85, 'Dhaka, Bangladesh');

$pdf->SetFont('helvetica', '', 9);
$pdf->Text(11, 84, 'DATE : 27 Nov - 1 Dec 2015');
$pdf->Text(11, 90, 'TIME  : Gates will open at 5:00 PM');



$pdf->SetFont('helvetica', '', 9);
$pdf->Text(69, 84, 'VENUE : ARMY STADIUM');
$pdf->Text(79, 90, 'Dhaka, Bangladesh');



// $pdf->Text(50, 65, 'DATE : 15 - 17 January');
// $pdf->Text(50, 70, 'TIME : Gates open at 30 minutes');
// $name = "Md Shafayet Kabir";
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Text(135, 47, $name);

// $gate = 16;
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Text(140, 57, 'Gate - '.$gate);

$pdf->SetFont('helvetica', '', 10);
$pdf->Text(128, 72, 'Helpline : 01881 111333 (10AM - 8PM)');




$pdf->SetFont('helvetica', 'B', 30);
$pdf->Text(128, 83, 'FREE PASS');


// bar code *************************************************
// $pdf->SetFont('helvetica', '', 10);

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
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);



// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
// write1DBarcode ($code, $type, $x='', $y='', $w='', $h='', $xres='', $style='', $align='')
$pdf->write1DBarcode($registration_number, 'C39', 113, 19, 100, 25, 0.32, $style, 'N');
$pdf->Ln();
// bar code *************************************************






/*
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|   Background Transaparent Image (SetAlpha)
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
|
|   
|
|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/

// $pdf->SetAlpha(0.1);
// $pdf->Image('image/ticket_background.png', 55, 40, 95, 200, '', '', '', false, 300);







$pdf->SetAlpha(1);
$pdf->Ln(7);





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
$pdf->Text(85, 103, 'Schedule');
$pdf->Ln();
$pdf->SetFont('helvetica', '', 10, '', 'false');

$schedule = '
<p>
<b>Day 1: Friday 27 November 2015 : </b>
Bharatnatyam by <i>Pallavi Dance Center</i> . Tabla Kirtan by <i>Parampara Sangeetalay</i> . Carnatic Flute by <i>Jayaprada Ramamoorthy</i> . Dhrupad by <i>Music Department, University of Rajshahi </i>. Santoor by <i>Rahul Sharma</i> . Vocal by <i>Kaushiki Chakrabarty</i> . Sitar by <i>Pandit Kushal Das</i> . Vocal by <i>Vidushi Bombay Jayashri</i>
</p>
<p>
<b>Day 2: Saturday 28 November 2015 : </b>
Dhrupad by <i>Avijit Kundu, Parampara Sangeetalay</i> . Saraswati Veena by <i>Jayanthi Kumaresh</i> . Vocal by <i>Susmita Debnath Suchi, Parampara Sangeetalay</i> . Dhrupad by <i>Pandit Uday Bhawalkar</i> . Tabla solo by <i>Pandit Suresh Talwalkar</i> . Jugalbandi - Vocal by <i>Dr. Balmurali Krishna</i> and Flute by <i>Pandit Ronu Majumdar</i> . Esraj by <i>Shubhayu Sen Majumdar</i> . Vocal by <i>Pandit Ajoy Chakrabarty</i>
</p>
<p>
<b>Day 3: Sunday 29 November 2015 : </b>
Manipuri by <i>Warda Rihab and troupe</i> . Dhrupad by <i>Ustad Wasif Dagar</i> . Sarod by <i>Yousuf Khan</i> . Vocal by <i>Vidushi Shubha Mudgal</i> . Mridangam ensemble by <i>Guru Karaikudi Mani</i> . Vocal by <i>Vidushi Shruti Sadolikar</i> . Violin by <i>Dr. N Rajam</i>
</p>
<p>
<b>Day 4: Monday 30 November 2015 : </b>
Kuchipudi by <i>Guru Raja and Radha Reddy</i> . Carnatic violin by <i>Ganesh and Kumaresh Rajagopalan</i> . Santoor by <i>Pandit Shivkumar Sharma</i> . Sarod by <i>Pandit Tejendra Narayan Majumdar</i> . Vocal by <i>Pandit Ulhas Kashalkar</i> . Tabla solo by <i>Ustad Zakir Hussain</i>
</p>
<p>
<b>Day 5: Tuesday 1 December 2015 : </b>
Dhamar by <i>Geetobitan : Animesh Chowdhury and troupe</i> . Bharatnatyam by <i>Vidushi Alarmel Valli</i> . Surbahar by <i>Irshad Khan</i> . Vocal by <i>Sameehan Kashalkar</i> . Sitar by <i>Ustad Shujaat Khan</i> . Vocal by <i>Ustad Rashid Khan</i> . Flute by <i>Pandit Hariprasad Chaurasia</i>
</p>

';

$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTML($schedule, true, false, true, false, '');



$pdf->SetFont('helvetica', '', 8);
$pdf->Text(82, 172, '*Programme starts at 7PM everyday. The schedule is subject to change without prior notice');

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
$pdf->Text(75, 177, 'Terms and conditions');
$pdf->Ln();

$terms = '
<ol>
    <li>The e-ticket (containing <b>the barcode</b>) must be presented every time when entering the venue during the 5 (five) day event.</li>
    <li>There will be an initial screening of the ticket at the main gate, followed by scanning of the ticket at the numbered gates of the stadium.</li>
    <li>The barcode must be readable by the scanner. <b>Without a readable barcode</b>, entry into the venue <b>will not be allowed</b>.</li>
    <li>This ticket (containing the barcode) must be printed in laser and on good quality paper to ensure readability. (Please read condition no. 3)</li>
    <li>There will be <b>no printing facility at the venue</b> this year.</li>
    <li>There will be <b>no registration at the venue</b> this year.</li>
    <li>A wristband will be put on each audience member at the gate and re-entry into the venue will not be allowed without the wristband under any circumstance.</li>
    <li>The wristband will be considered unacceptable for entry if it appears to have been tampered with.</li>
    <li>The organizers reserve the right to check all bags at entry points for security reasons.</li>
    <li>The organizers also reserve the right to pat down a ticket holder at the entry point, for security reasons, if deemed necessary.</li>
    <li><b>Gates will open at 5:00 pm.</b></li>
    <li><b>Gates will close at 1:00 am.</b></li>
    <li>Children below the age of 12 (twelve) will not be allowed entry at the event.</li>
    <li>No food or drink may be brought in from outside. Food will be available at the food court at a reasonable price. Water is available free of charge.</li>
    <li>All kinds of tobacco, tobacco related products will not be allowed to be taken into the venue.</li>
    <li><b>Seats are limited and are on a first come, first served basis.</b> However, the organizers reserve the right to change the seating arrangement and provide an alternative seat for the ticket holder.</li>
    <li><b>Seats cannot be reserved</b> for anyone by a member of the audience.</li>
    <li>The organizers reserve the right to refuse entry or to remove from the premises, people or persons deemed as a security threat or an element of disturbance.</li>
    <li>The organizers reserve the right to conduct security searches from time to time and also reserve the right to confiscate any item which may cause danger or disruption to other members of the audience and if deemed as a security threat.</li>
    <li>CCTV and film cameras will be present at the venue. Attending the event signifies the ticket holders consent to the filming and sound recording of themselves as members of the audience with no obligations of any kind on the organizers part.</li>
    <li>The organizers will not take any responsibility for loss or theft of any personal belongings or any loss, injury and damage to the holder of this ticket.</li>
    <li><b>Cameras of any kind whatsoever (other than those in mobile phones) are totally prohibited. The organizers reserve the right to confiscate such items.</b></li>
    <li>Phones must be kept on silent mode during a performance.</li>
    <li>Members of the audience should remain seated while in the performance area.</li>
</ol>';

$pdf->SetFont('helvetica', '', 6, '', 'false');
$pdf->writeHTML($terms, true, false, true, false, '');


// $pdf->SetXY(150, 200);

// TCPDF::Image($file,$x = '',$y = '',$w = 0,$h = 0,$type = '',$link = '',$align = '',$resize = false,$dpi = 300,$palign = '',$ismask = false,$imgmask = false,$border = 0,$fitbox = false,$hidden = false,$fitonpage = false,$alt = false,$altimgs = array())

$pdf->Image('image/footer_image.jpg', 10, 257, 190, 15, '', '', '', false, 300);


$pdf_content=$pdf->Output('BCMF2015_e_ticket.pdf', 'S');






// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

require_once 'swift/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

ob_start();
require_once($dir . '/mail_body_content.php');
$html_message = ob_get_contents();
ob_end_clean();

$mailer = new Swift_Mailer(new Swift_MailTransport()); // Create new instance of SwiftMailer
$message = Swift_Message::newInstance();
$message->setSubject('Aarong Festival 2018'); // Message subject
$message->setFrom('no-reply@bengalfoundation.org'); // From:
$message->attach(Swift_Attachment::newInstance($pdf_content, 'BCMF2015_e_ticket.pdf', 'application/pdf')); // Attach the generated PDF from earlier
$message->setTo(array(
// "shafayet.me@gmail.com" => "Shafayet (Gmail)",
    $email => $name
    ));
// $message->setCc(array("shajib_vb@yahoo.com" => "shajib (Yahoo)"));
// $message->setBcc(array("shajib.vb@gmail.com" => "Shajib (Gmail)"));
$message->setBody($html_message, 'text/html');

// Send the email, and show user message
if ($mailer->send($message)) {
    $success = true;
    echo "<script>alert('Ticket Found. Your Free e-Ticket has been sent to your email address. Please check inbox (or spam), print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed.'), window.location='http://www.bengalfoundation.org/'</script>";  
} else {
    $error = true;
    echo "<script>alert('Sorry mail not sent.'), window.location='http://www.bengalfoundation.org/'</script>";  
}


?>

