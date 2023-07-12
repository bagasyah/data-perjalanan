<!DOCTYPE html>
<html>

<head>
    <title>Form Edit Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "laporan_perjalanan";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Proses update data
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $user_id = $_POST['user_id'];
            $alamat_awal = $_POST['alamat_awal'];
            $alamat_tujuan = $_POST['alamat_tujuan'];
            $km_awal = $_POST['km_awal'];
            $km_akhir = $_POST['km_akhir'];
            $foto = $_POST['foto'];
            $tanggal = $_POST['tanggal'];

            // Perintah SQL untuk update data
            $sql = "UPDATE laporan SET alamat_awal='$alamat_awal', alamat_tujuan='$alamat_tujuan', km_awal='$km_awal', km_akhir='$km_akhir', foto='$foto', tanggal='$tanggal' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Data berhasil diperbarui</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        // Ambil data laporan dari database
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query untuk mendapatkan data laporan berdasarkan id
            $sql = "SELECT * FROM laporan WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $alamat_awal = $row['alamat_awal'];
                $alamat_tujuan = $row['alamat_tujuan'];
                $km_awal = $row['km_awal'];
                $km_akhir = $row['km_akhir'];
                $foto = $row['foto'];
                $tanggal = $row['tanggal'];

                // Form untuk mengedit data
                echo "<form method='POST' action=''>
                    <input type='hidden' name='id' value='$id'>
                    <div class='form-group'>
                        <label for='user_id'>User ID:</label>
                        <input type='text' class='form-control' name='user_id' value='$user_id'>
                    </div>
                    <div class='form-group'>
                        <label for='alamat_awal'>Alamat Awal:</label>
                        <input type='text' class='form-control' name='alamat_awal' value='$alamat_awal'>
                    </div>
                    <div class='form-group'>
                        <label for='alamat_tujuan'>Alamat Tujuan:</label>
                        <input type='text' class='form-control' name='alamat_tujuan' value='$alamat_tujuan'>
                    </div>
                    <div class='form-group'>
                        <label for='km_awal'>KM Awal:</label>
                        <input type='text' class='form-control' name='km_awal' value='$km_awal'>
                    </div>
                    <div class='form-group'>
                        <label for='km_akhir'>KM Akhir:</label>
                        <input type='text' class='form-control' name='km_akhir' value='$km_akhir'>
                    </div>
                    <div class='form-group'>
                        <label for='foto'>Foto:</label>
                        <input type='text' class='form-control' name='foto' value='$foto'>
                    </div>
                    <div class='form-group'>
                        <label for='tanggal'>Tanggal:</label>
                        <input type='text' class='form-control' name='tanggal' value='$tanggal'>
                    </div>
                    <input type='submit' class='btn btn-primary' name='submit' value='Update'>
                </form>";
            } else {
                echo "<div class='alert alert-danger'>Tidak ada data laporan dengan ID tersebut.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid ID.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>