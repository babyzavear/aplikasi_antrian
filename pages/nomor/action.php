<?php
// Mengatasi CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST');
header("Allow: GET, POST");
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// panggil file "database.php" untuk koneksi ke database
require_once "../../config/query.php";
// jika ada ajax request
if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET')) {
    if (isset($_POST['type'])) {
        $action = new config\query;

        if ($_POST['type'] == 'get_antrian') {
            // sql statement untuk menampilkan jumlah data dari tabel "queue_antrian_admisi" berdasarkan "tanggal"
            $query = $action->getAntrian();
            // ambil data hasil query
            // Inisialisasi array untuk menyimpan data
            $dataAntrian = array();

            // Ambil hasil query dan masukkan ke dalam array
            while ($row = mysqli_fetch_assoc($query)) {
                $dataAntrian[] = array(
                    'code_antrian' => $row['code_antrian'],
                    'no_antrian' => sprintf("%03s", (int)$row['no_antrian'])
                );
            }

            // tampilkan data
            echo json_encode([
                'success' => true,
                'message' => 'Success',
                'data' => $dataAntrian
            ]);
        }

        if ($_POST['type'] == 'get_antrian_by_type') {
            // sql statement untuk menampilkan jumlah data dari tabel "queue_antrian_admisi" berdasarkan "tanggal"
            $code_antrian = $_POST['code_antrian'];
            $query = $action->getLastAntrianByType($code_antrian);
            // ambil data hasil query
            // Inisialisasi array untuk menyimpan data
            $dataAntrian = array();

            // Ambil hasil query dan masukkan ke dalam array
            $result = mysqli_fetch_assoc($query);

            // tampilkan data
            echo json_encode([
                'success' => true,
                'message' => 'Success',
                'data' => $result['no_antrian']
            ]);
        }

        if ($_POST['type'] == 'create_antrian') {
            require 'cetak.php';
            $code_antrian = $_POST['code_antrian'];
            $ip_printer = isset($_POST['ip_printer']) ? $_POST['ip_printer'] : '';
            $port_printer = isset($_POST['port_printer']) ? $_POST['port_printer'] : '';

            $query = $action->getLastAntrianByType($code_antrian);

            // Ambil hasil query
            $result = mysqli_fetch_assoc($query);

            // Jika ada data, tampilkan no_antrian
            if ($result['no_antrian'] !== null) {
                $no_antrian = sprintf("%03s", (int)$result['no_antrian'] + 1);
            } else {
                $no_antrian = sprintf("%03s", 1);
            }

            $insert = $action->createAntrian($no_antrian, $code_antrian);

            if ($insert) {
                $querySetting = $action->getSetting();
                // ambil jumlah baris data hasil querySetting
                $rows = mysqli_num_rows($querySetting);

                if ($rows <> 0) {
                    $data = mysqli_fetch_assoc($querySetting);
                } else {
                    $data = [];
                }

                // Cetak hanya jika sukses
                cetak($no_antrian, $code_antrian, $data, $ip_printer, $port_printer);

                echo json_encode([
                    'success' => true,
                    'message' => 'Success',
                    'data' => [
                        'code_antrian' => $code_antrian,
                        'no_antrian' => $no_antrian
                    ]
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'message' => "Gagal menyimpan data ke database: " . mysqli_error($mysqli),
                    'data' => []
                ]);
            }
        }

        if ($_POST['type'] == 'get_list_type_antrian') {
            $querySetting = $action->getSetting();
            // ambil jumlah baris data hasil querySetting
            $rows = mysqli_num_rows($querySetting);

            if ($rows <> 0) {
                $data = mysqli_fetch_assoc($querySetting);
            } else {
                $data = [];
            }

            // tampilkan data
            echo json_encode([
                'success' => true,
                'message' => 'Success',
                'data' => (isset($data['list_type_antrian'])) ? json_decode($data['list_type_antrian']) : []
            ]);
        }
    }
}
