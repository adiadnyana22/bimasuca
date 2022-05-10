<?php
    switch($_GET['fungsi']){
        case 'kalkulator_emisi':
            // Standard declaration
            $total_emisi = 0;
            // Ambil Input
            $mobil = $_POST['mobil'];
            $motor = $_POST['motor'];
            $komputer = $_POST['komputer'];
            $kulkas = $_POST['kulkas'];
            // Rumus
            $total_emisi += 2412*$mobil;
            $total_emisi += 852*$motor;
            $total_emisi += 921*$komputer;
            $total_emisi += 2672*$kulkas;
            // Kesetaraan hasil emisi
            $convertBatuBara = ($total_emisi / 23060 * 100) / 100;
            $convertKayu = ($total_emisi / 14666 * 100) / 100;
            $convertBensin = ($total_emisi / 33025 * 100) / 100;
            $convertLPG = ($total_emisi / 24121 * 100) / 100;
            // Substring and val
            $val_total = strval($total_emisi);
            $substrBatu = substr($convertBatuBara, 0, 4);
            $substrKayu = substr($convertKayu, 0, 4);
            $substrBensin = substr($convertBensin, 0, 4);
            $substrLPG = substr($convertLPG, 0, 4);
            // Return JSON
            header("Content-Type: application/json");
            echo json_encode(array(
                "BTU" => $val_total,
                "Batubara" => $substrBatu,
                "Kayu" => $substrKayu,
                "Bensin" => $substrBensin,
                "LPG" => $substrLPG
            ));
            exit();
        break;
    }
?>