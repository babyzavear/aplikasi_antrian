<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
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
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    if (isset($_GET['type'])) {
        $action = new config\query;

        if ($_GET['type'] == 'get_antrian_sekarang') {
            // sql statement untuk menampilkan data "no_antrian" dari tabel "queue_antrian_admisi" berdasarkan "tanggal" dan "status = 1"
            $query = $action->getAntrianSekarang();
            // ambil jumlah baris data hasil query
            $rows = mysqli_num_rows($query);
            $dataJmlAntrian = array();

            if ($rows <> 0) {
                // ambil data hasil query
                while ($row = mysqli_fetch_assoc($query)) {
                    $data['id']         = $row["id"];
                    $data['code_antrian'] = $row["code_antrian"];
                    $data['no_antrian']     = $row["no_antrian"];
                    $data['antrian']     = $row["antrian"];
                    $data['loket']     = $row["loket"];
                    $data['status']     = $row["status"];

                    array_push($dataJmlAntrian, $data);
                }

                echo json_encode([
                    'success' => true,
                    'message' => 'Success',
                    'data' => $dataJmlAntrian
                ]);
            }else {
                echo json_encode([
                    'success' => true,
                    'message' => 'Success',
                    'data' => []
                ]);
            }
        }

        if ($_POST['type'] == 'delete_panggilan') {
            $id = $_POST['id'];
            $query = $action->deletePanggilan($id);

            if ($query) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Delete Success on id ' . $id
                ]);
            }else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error'
                ]);
            }

        }
    }
}
