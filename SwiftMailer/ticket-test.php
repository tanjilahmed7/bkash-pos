<?php 
$name = "Md. Shafayet Kabir";
$gate  = 1;
$ticket_count   = 10001;
$reg_id    = 1234565466789;
$email = "shafayet.me@gmail.com";

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
$pdf->Image('image/ticket-logo.jpg', 10, 18, 102, 62, '', '', 'N', false, 300, '', false, false, 0, false, false, false);


$pdf->SetTextColor(0, 0, 0);



// $pdf->Text(50, 80, 'VENUE : Army Museum');
// $pdf->Text(50, 85, 'Dhaka, Bangladesh');

$pdf->SetFont('helvetica', '', 9);
$pdf->Text(14, 83, '26 Dec - 30 Dec 2017');
$pdf->Text(14, 88, 'Gates will open at 4:00 pm');



$pdf->SetFont('helvetica', '', 9);
$pdf->Text(60, 83, 'Abahani Grounds, Dhanmondi');
$pdf->Text(60, 88, 'Dhaka, Bangladesh');



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

$pdf->SetFont('helvetica', 'B', 30);
$pdf->Text(124, 73, 'FREE PASS');

$pdf->SetFont('helvetica', '', 7);
$pdf->Text(113, 87, 'This entry pass is not for sale and the organisers are not liable in any way for');
$pdf->Text(113, 90, 'any unauthorised and unethical purchase/sale of the pass by a third party.');


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
$pdf->Line(58, 80, 58, 96, $style_line05);

$style_line06 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 45, 200, 45, $style_line06);

$style_line07 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 80, 112, 80, $style_line07);



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

$pdf->SetFont('helvetica', '', 7);
$pdf->Text(148, 97, 'Helpline : +88 09639 555 000 (10 am - 08 pm)');



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
$pdf->Text(10, 98, 'Schedule');
$pdf->Ln();
$pdf->SetFont('helvetica', '', 10, '', 'false');

$schedule = '
<ul>
<li><b>Day 1: Tuesday 26 December 2017 : </b>
  <i>Dr L Subramaniam & Astana Symphony Philharmonic Orchestra</i> .
  Sarod by <i>Rajrupa Chowdhury</i> .
  Khayal by <i>Vidushi Padma Talwalkar</i> .
  Sitar by <i>Firoz Khan </i> .
  Khayal by <i>Supriya Das, Bengal Parampara</i> .
  Flute by <i>Rakesh Chaurasia & Sitar by Purbayan Chatterjee</i>
</li>
<li><b>Day 2: Wednesday 27 December 2017 : </b>
  Kathak by <i>Aditi Mangaldas Dance Company</i> . 
  Tabla by <i>Bengal Parampara</i> . 
  Santoor by <i>Pandit Shivkumar Sharma</i> . 
  Khayal by <i>Pandit Ulhas Kashalkar</i> . 
  Sitar by <i>Ustad Shahid Parvez Khan</i> . 
  Dhrupad by <i>Avijiit Kundu, Bengal Parampara</i> .  
  Flute by <i>Pandit Ronu Majumdar & Sarod by Pandit Debojyoti Bose</i>
</li>

<li>
<b>Day 3: Thursday 28 December 2017 : </b>
  Sitar by <i>Bengal Parampara</i> .
  Ghatam & Kanjeera by <i>Vidwan Vikku Vinayakram & Selvaganesh Vinayakram</i>.  
  Khayal by <i>Govt Music College</i> .  
  Sarod by <i>Abir Hossain</i> . 
  Flute by <i>Gazi Abdul Hakim</i> .  
  Dhrupad by <i>Pandit Uday Bhawalkar</i> .  
  Violin by <i>Vidushi Kala Ramnath</i> .   
  Khayal by <i>Pandit Ajoy Chakrabarty</i>
</li>
<li><b>Day 4: Friday 29 December 2017 : </b>
  Dance offerings: Manipuri, Bharatnatyam and Kathak by <i>Sweety Das, Amit Chowdhury, Snata Shahrin, Sudeshna Swayamprabha, Mehraj Haque, Zuairiyah Mauli</i> . 
  Sarod by <i>Bengal Parampara</i> . 
  Khayal by <i>Ustad Rashid Khan</i> . 
  Sarod by <i>Pandit Tejendra Narayan Majumdar</i> & Violin by <i>Dr Mysore Manjunath</i>. 
  Khayal by <i>Pandit Jasraj</i> . 
  Cello by <i>Saskia Rao de-Haas</i> . 
  Sitar by <i>Pandit Budhaditya Mukherjee</i>
</li>
<li><b>Day 5: Saturday 30 December 2017 : </b>
  Odissi by <i>Vidushi Sujata Mohapatra</i> .
  Mohan Veena by <i>Pandit Vishwa Mohan Bhatt</i> .
  Khayal by <i>Brajeswar Mukherjee</i> .
  Sitar by <i>Pandit Kushal Das & Kalyanjit Das</i> .
  Khayal by <i>Pandit Kaivalyakumar</i> .
  Flute by <i>Pt Hari Prasad Chaurasia</i>
</li>
</ul>
';

$pdf->SetFont('helvetica', '', 7);
$pdf->writeHTML($schedule, true, false, true, false, '');



$pdf->SetFont('helvetica', '', 6);
$pdf->Text(70, 145, '*Programme starts at 7 pm every day and continues until dawn the next day. The schedule is subject to change without prior notice');

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
$pdf->Text(10, 147, 'Terms and conditions');
$pdf->Ln(3);



$terms = '

<ul>
  <br><strong># Entering the venue:</strong>
  <li><b>The pass (containing the barcode) must be presented every time</b> when entering the venue during the 5 (five) day event. There will be an initial screening of the pass at the main gate, followed by scanning of the pass at the entry points into the field. The barcode must be readable by the scanner. Without a readable barcode, entry into the venue will not be allowed. <b>The pass cannot be printed at the venue. There will be no registration at the venue.</b></li>
  <li>A wristband will be put on each audience member at the gate and re-entry into the venue will not be allowed without the wristband under any circumstance. The wristband will be considered unacceptable for entry if it appears to have been tampered with. Multiple re-entry will not be allowed.</li>
  <li><b>Gates will close at 12:00 am.</b> However, depending on field capacity and keeping safety and security in mind, the organiser may close the gates before 12.00 am without giving any prior notice.</li>
  <li>Children below the age of 12 (twelve) will not be allowed entry at the event.</li>

  <br><strong># Security:</strong>
  <li>The organizers reserve the right to pat down a pass holder at the entry point, for security reasons, if deemed necessary. Due to security checks, there may be certain delays at entry gates. Your cooperation and patience in this regard is appreciated.</li>
  <li>The organizers reserve the right to refuse entry or to remove from the premises, any person who causes any disturbance, possess any threat to security, or breaches any of the terms and conditions for entry into the venue. Audience members are requested to carry an official photo-ID with them.</li>
  <li>The organizers reserve the right to conduct security searches from time to time and confiscate any item which may cause danger or disruption to other members of the audience and if deemed as a security threat.</li>

  <br><strong># Items not allowed:</strong>
<li><b>No bags will be allowed inside.</b> Men are requested not to bring any item other than their mobile phones, wallets and keys which may be carried in their pockets. Women are requested not to bring purses larger than 8 inches by 4 inches. Any bag larger than this will not be allowed inside, except laptop bags carried by members of the press who are registered with Bengal Foundation. There will be no provision to leave bags anywhere. The organizers cannot take responsibility for any bags brought to the venue. The organizers reserve the right to check bags at entry points for security reasons.</li>
<li><b>No food or drink/water may be brought in from outside.</b> Food and beverage is available at the food court. Only water is available free of charge.</li>
<li><b>Cameras</b> of any kind whatsoever (other than those in mobile phones) <b>are totally prohibited.</b> The organizers reserve the right to confiscate such items.</li>
<li><b>No tobacco, tobacco related products, firearms, sharp objects, inflammable material, bottles, whistles and/or any sounding object, cameras, cans or similar objects will be allowed to be taken into the venue.</b></li> 


  <br><strong># Audience:</strong>
  <li><b>Seats are limited and are on a first come, first served basis.</b> The organizers reserve the right to change the seating arrangement. <b>No seats can be reserved for anyone by keeping bags, shawls or other items.</b></li>
  <li>A member of the audience shall not have the right to record or make video of, any of the performances during the event.</li>
  <li>Phones must be kept on silent mode during a performance. Audience members are requested to keep in mind the spirit of the event and do anything to distract other listeners. Members of the audience should remain seated while in the performance area.</li>

  <br><strong># Miscellaneous:</strong>
  <li>There will be cameras, recorders and CCTVs at the venue. By attending the event, the pass holder gives consent to photographing and audio-visual recording of itself. The organizer shall have the right to publish or broadcast the photographs and audio-visual recordings without incurring any liability whatsoever to the pass holder.</li>
  <li>The organizers will not take any responsibility for loss or theft of any personal belongings or any loss, injury and damage to the holder of a pass which may happen inside or outside the <b>Abahani Grounds premises.</b></li>
  <li>By registering for the event, the pass holder authorizes the organizer to use all and any information provided in the course of registration within reasonable limits.</li>
  <li><b>There will be no parking facilities at the venue.</b></li>
</ul>  
';

$pdf->SetFont('helvetica', '', 6, '', 'false');
$pdf->writeHTML($terms, true, false, true, false, '');

$pdf->SetFont('helvetica','B', 6);
// $pdf->SetTextColor(206,0,0);
$pdf->Text(17, 252, 'By using this free pass, the passholder acknowledges having read, understood and accepted all the terms and conditions of Aarong Festival 2018 listed above.');

// $pdf->SetXY(150, 200);
// TCPDF::Image($file,$x = '',$y = '',$w = 0,$h = 0,$type = '',$link = '',$align = '',$resize = false,$dpi = 300,$palign = '',$ismask = false,$imgmask = false,$border = 0,$fitbox = false,$hidden = false,$fitonpage = false,$alt = false,$altimgs = array())




$pdf->Image('image/footer.jpg', 10, 256, 190, 10, '', '', '', false, 300);
$pdf->setPrintFooter(false);
$pdf->SetFooterMargin(0);
$pdf->SetAutoPageBreak(TRUE, 0);

// ---------------------------------------------------------
//Close and output PDF document

// $pdf_content = $pdf->Output('Free Pass Aarong Festival 2018.pdf', 'I'); // To Display PDF
$pdf_content = $pdf->Output('Free Pass Aarong Festival 2018.pdf', 'S'); // To send PDF

//============================================================+
// END OF FILE
//============================================================+



require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

ob_start();
require_once('mail_body_content.php');
$html_message = ob_get_contents();
ob_end_clean();

$mailer = new Swift_Mailer(new Swift_MailTransport()); // Create new instance of SwiftMailer
$message = Swift_Message::newInstance();
$message->setSubject('Aarong Festival 2018'); // Message subject
$message->setFrom('no-reply@aarongfestival.com'); // From:
$message->attach(Swift_Attachment::newInstance($pdf_content, 'BCMF2015_e_ticket.pdf', 'application/pdf')); // Attach the generated PDF from earlier
$message->setTo(array(
// "shafayet.me@gmail.com" => "Shafayet (Gmail)",
    $email => $name
    ));
$message->setCc(array("shajib_vb@yahoo.com" => "shajib (Yahoo)"));
$message->setBcc(array("shajib.vb@gmail.com" => "Shajib (Gmail)"));
$message->setBody($html_message, 'text/html');

// Send the email, and show user message
if ($mailer->send($message)) {
    $success = true;
    echo "<script>alert('Ticket Found. Your Free e-Ticket has been sent to your email address. Please check inbox (or spam), print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed.'), window.location='https://aarongfestival.com/'</script>";  
} else {
    $error = true;
    echo "<script>alert('Sorry mail not sent.'), window.location='https://aarongfestival.com/'</script>";  
}
?>