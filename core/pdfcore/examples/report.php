<?php


//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
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
     * @abstract TCPDF - Example: WriteHTML and RTL support
     * @author Nicola Asuni
     * @since 2008-03-04
     */
// Include the main TCPDF library (search for installation path).
    require_once('tcpdf_include.php');

// create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Didin Kha');
    $pdf->SetTitle('Generated Voucher');
    $pdf->SetSubject('TCPDF');
    $pdf->SetKeywords('TCPDF, PDF, Voucher');


// set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


// set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

// ---------------------------------------------------------
// set font
    $pdf->SetFont('dejavusans', '', 10);
    $housename = "localhost";
    $username = "root";
    $password = "";
    $db = "simitra";
    $connection = new mysqli($housename, $username, $password, $db);

    $query = "(select droptgl as 'Tanggal', 'Dropping' as 'Reason', amount as 'Jumlah' from dropping)
union
(select start as 'Tanggal', concat('Membuat Transaksi ', nama) as 'Reason', pinjaman as 'Jumlah' from transaksi)
union
(select tglangsur as 'Tanggal', concat('Angsuran bulan ', angsuranke, ' untuk transaksi ', (select nama from transaksi where trxid = monitor.trxid)) as 'Reason', jmlangsur as 'Jumlah' from monitor)
order by Year(Tanggal), Month(Tanggal), Day(Tanggal)";
    $res = mysqli_query($connection, $query);
    


// add a page
    $pdf->AddPage();
// create some HTML content
    $html = '<br/><br/><img style="margin:0px" src="images/logo.png" width="100" alt="" />
        <h2 style="margin:0px">PT. Bukit Asam (PERSERO) Tbk</h2>
        <p style="margin:0px">Unit Pelabuhan Tarahan</p>
        <br/><br/>
        <center></center>
        <br/><h3>Laporan Keuangan</h3><br/>
            ';
    $html .= '<table border="1"  style="padding:10px;">';
    $no = 1;
    while($row = $res->fetch_assoc()){
        $html.= "<tr>";
        $html.= "<td style=\"text-align: center\" width=\"50\">$no</td>";
        $html.= "<td width=\"102\">" . $row['Tanggal'] . "</td>";
        $html.= "<td width=\"383\">" . $row['Reason'] . "</td>";
        $html.= "<td width=\"140\">Rp. " . number_format($row['Jumlah']) . "</td>";
        $html.= "</tr>";
        $no = $no + 1;
    }
    $html.= '</table>';
    
// output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// reset pointer to the last page
    $pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
    $pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

