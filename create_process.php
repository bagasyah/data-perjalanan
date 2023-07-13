<?php
include 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $user_id = $_SESSION['user_id'];
    $status_lap = $_POST['status_lap'];
    $tanggal = $_POST['tanggal'];
    $alamat_awal = $_POST['alamat_awal'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $km_awal = $_POST['km_awal'];
    $km_akhir = $_POST['km_akhir'];
    $no_polisi = $_POST['no_polisi'];
    $tipe_mobil = $_POST['tipe_mobil'];
    $lampu_depan = $_POST['lampu_depan'];
    $lampu_sen_depan = $_POST['lampu_sen_depan'];
    $lampu_sen_belakang = $_POST['lampu_sen_belakang'];
    $lampu_rem = $_POST['lampu_rem'];
    $lampu_mundur = $_POST['lampu_mundur'];
    $bodi = $_POST['bodi'];
    $ban = $_POST['ban'];
    $pedal = $_POST['pedal'];
    $kopling = $_POST['kopling'];
    $gas_rem = $_POST['gas_rem'];
    $oli_mesin = $_POST['oli_mesin'];
    $klakson = $_POST['klakson'];
    $weaper = $_POST['weaper'];
    $air_weaper = $_POST['air_weaper'];
    $air_radiator = $_POST['air_radiator'];
    $note = $_POST['note'];
    $foto1 = $_FILES['foto']['name'];
    $foto1_tmp = $_FILES['foto']['tmp_name'];
    $foto1_path = 'uploads/' . $foto1;
    $foto2 = $_FILES['foto2']['name'];
    $foto2_tmp = $_FILES['foto2']['tmp_name'];
    $foto2_path = 'uploads/' . $foto2;

    if (move_uploaded_file($foto1_tmp, $foto1_path) && move_uploaded_file($foto2_tmp, $foto2_path)) {
        $query = "INSERT INTO laporan (user_id, status_lap, tanggal, alamat_awal, alamat_tujuan, km_awal, km_akhir, no_polisi, tipe_mobil, lampu_depan, lampu_sen_depan, lampu_sen_belakang, lampu_rem, lampu_mundur, bodi, ban, pedal, kopling, gas_rem, oli_mesin, klakson, weaper, air_weaper, air_radiator, note, foto, foto2) VALUES ('$user_id','pending', '$tanggal', '$alamat_awal', '$alamat_tujuan', '$km_awal', '$km_akhir', '$no_polisi', '$tipe_mobil', '$lampu_depan', '$lampu_sen_depan', '$lampu_sen_belakang', '$lampu_rem', '$lampu_mundur', '$bodi', '$ban', '$pedal', '$kopling', '$gas_rem', '$oli_mesin', '$klakson', '$weaper', '$air_weaper', '$air_radiator', '$note', '$foto1', '$foto2')";
        if ($conn->query($query) === TRUE) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "File upload failed.";
    }
}
?>