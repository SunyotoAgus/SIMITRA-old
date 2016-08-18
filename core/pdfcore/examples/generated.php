<?php

if (!isset($_POST['id'])) {
    echo 'please provide id';
    exit;
} else {

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


    $ones = array(
        "",
        " satu",
        " dua",
        " tiga",
        " empat",
        " lima",
        " enam",
        " tujuh",
        " delapan",
        " sembilan",
        " sepuluh",
        " sebelas",
        " dua belas",
        " tiga belas",
        " empat belas",
        " lima belas",
        " enam belas",
        " tujuh belas",
        " delapan belas",
        " sembilan belas"
    );

    $tens = array(
        "",
        "",
        " dua puluh",
        " tiga puluh",
        " empat puluh",
        " lima puluh",
        " enam puluh",
        " tujuh puluh",
        " delapan puluh",
        " sembilan puluh"
    );

    $triplets = array(
        "",
        " ribu",
        " juta",
        " miliar",
        " triliun",
        " qadriliun",
        " quantiliun",
        " sextiliun",
        " septiliun",
        " oktiliun",
        " noniliun"
    );

// recursive fn, converts three digits per pass
    function convertTri($num, $tri) {
        global $ones, $tens, $triplets;

        // chunk the number, ...rxyy
        $r = (int) ($num / 1000);
        $x = ($num / 100) % 10;
        $y = $num % 100;

        // init the output string
        $str = "";

        // do hundreds
        if ($x > 0) {
            $str = " seratus";
            if ($x > 1) {
                $str = $ones[$x] . " ratus";
            }
        }


        // do ones and tens
        if ($y < 20)
            $str .= $ones[$y];
        else
            $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];

        // add triplet modifier only if there
        // is some output to be modified...
        if ($str != "")
            $str .= $triplets[$tri];

        // continue recursing?
        if ($r > 0)
            return convertTri($r, $tri + 1) . $str;
        else
            return $str;
    }

// returns the number as an anglicized string
    function convertNum($num) {
        $num = (int) $num;    // make sure it's an integer

        if ($num < 0)
            return "negative" . convertTri(-$num, 0);

        if ($num == 0)
            return "zero";

        return convertTri($num, 0);
    }

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


    $query = 'select trx.*, cat.*, trx.nama as trxnama , mtr.nama as mtrnama, mtr.*  from transaksi trx join profilmitra mtr on trx.dataid = mtr.dataid join trxkategory cat on trx.catid = cat.catid where trx.trxid=' . $_POST['id'];
    $res = mysqli_query($connection, $query);
    $row = $res->fetch_assoc();


// add a page
    $pdf->AddPage();
// create some HTML content
    $html = '<table id="customers" border="1" style="padding:10px;">
                <tbody >
                    <tr style="text-align: center;">
                    
                        <td colspan="6" rowspan="3">
                        <img src="images/logo.png" width="100" alt="" /><br/>
PT. BUKIT ASAM (PERSERO)<br/>
                        <span style="font-size:11px">Unit Pelabuhan Tarahan</span><br/>
                        <b>TANDA PEMBAYARAN</b></td>
                        <td>TGL</td>
                        <td>BLN</td>
                        <td>THN</td>
                        <td>No.</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td size="20"></td>
                        <td colspan="2">Kode Karyawan</td>
                        <td></td>
                    </tr>
                    <tr size="50">
                        <td rowspan="1" colspan="10"><b>Pembayaran kepada</b> : ' . $row['mtrnama'] . ' <br/>
                        <b>A l a m a t</b> : ' . $row['alamatjalan'] . ', ' . $row['alamatkec'] . ', ' . $row['alamatkab'] . '</td>
                    </tr>
                    <tr>
                        <td colspan="6"><b>No. Cek</b> :</td>
                        <td colspan="4" size="20"><b>Rp. ' . number_format($row['pinjaman']) . '</b></td>
                    </tr>
                    <tr>
                        <td colspan="10"><b>Jumlah</b> : ' . ucwords(convertNum($row['pinjaman'])) . ' Rupiah</td>
                    </tr>
                    <tr>
                        <td colspan="10"><b>Uraian</b> : ' . $row['trxnama'] . '</td>
                    </tr>
                    <tr style="text-align: center;">
                        <td colspan="2"><b>Kode Perkiraan</b></td>
                        <td colspan="4" size="20"><b>Kategori</b></td>
                        <td colspan="2"><b>Debet</b></td>
                        <td colspan="2"><b>Kredit</b></td>
                    </tr>
                    <tr style="width: 100%">
                        <td colspan="2"></td>
                        <td colspan="4">' . $row['catnama'] . '</td>
                        <td colspan="2">Rp. ' . number_format($row['pinjaman']) . '</td>
                        <td colspan="2"></td>
                    </tr>
                    
                    
                </tbody>
            </table>
            <table border="1" style="padding:10px">
<tr style="width: 100%">
                        <td colspan="2">
                        Dibuat
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        ' . $row['dibuat'] . '
                        <br/>
                        Tgl : 
                        </td>
                        <td colspan="2">
                        Diperiksa
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        ' . $row['dicek'] . '
                        <br/>
                        Tgl : 
                        </td>
                        <td colspan="2">
                        Setuju Dibayar
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        ' . $row['disetujui'] . '
                        <br/>
                        Tgl : 
                        </td>
                        <td colspan="2">
                        Yang Menerima
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        ' . $row['mtrnama'] . '
                        <br/>
                        Tgl : 
                        </td>
                    </tr>            
</table>
            
';

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
}

