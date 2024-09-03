<?php

namespace config;

require_once 'database.php';

class query extends database
{
    private $tanggal;

    public function __construct()
    {
        parent::__construct();
        $this->tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7); // Format tanggal untuk seluruh query
    }

    public function getSetting()
    {
        $query = mysqli_query($this->mysqli, "SELECT * FROM queue_setting ORDER BY id DESC LIMIT 1") 
            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function saveSetting($id = '', $nama_instansi, $logo, $alamat, $telpon, $email, $running_text, $youtube_id, $list_loket, $list_type_antrian, $warna_primary, $warna_secondary, $warna_accent, $warna_background, $warna_text, $printer)
    {
        if ($id == '') {
            $save = mysqli_query($this->mysqli, "INSERT INTO queue_setting (nama_instansi, logo, alamat, telpon, email, running_text, youtube_id, list_loket, list_type_antrian, warna_primary, warna_secondary, warna_accent, warna_background, warna_text, printer) 
                VALUES ('$nama_instansi', '$logo', '$alamat', '$telpon', '$email', '$running_text', '$youtube_id', '$list_loket', '$list_type_antrian', '$warna_primary', '$warna_secondary', '$warna_accent', '$warna_background', '$warna_text', '$printer')") 
                or die('Ada kesalahan pada query save : ' . mysqli_error($this->mysqli));
            return $save;
        } else {
            $save = mysqli_query($this->mysqli, "UPDATE queue_setting SET 
                nama_instansi='$nama_instansi', logo='$logo', alamat='$alamat', telpon='$telpon', email='$email', running_text='$running_text', youtube_id='$youtube_id', 
                list_loket='$list_loket', list_type_antrian='$list_type_antrian', warna_primary='$warna_primary', warna_secondary='$warna_secondary', warna_accent='$warna_accent', 
                warna_background='$warna_background', warna_text='$warna_text', printer='$printer' WHERE id='$id'") 
                or die('Ada kesalahan pada query save : ' . mysqli_error($this->mysqli));
            return $save;
        }
    }

    public function getAntrian()
{
    $query = mysqli_query($this->mysqli, "SELECT code_antrian, MAX(no_antrian) AS no_antrian
        FROM queue_antrian_admisi WHERE tanggal='$this->tanggal' GROUP BY code_antrian") 
        or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
    return $query;
}

public function getLastAntrianByType($code_antrian)
    {
        $query = mysqli_query($this->mysqli, "SELECT MAX(no_antrian) as no_antrian FROM queue_antrian_admisi WHERE tanggal='$this->tanggal' AND code_antrian='$code_antrian'") or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }
    

    public function getListAntrianByType($code_antrian, $start, $end)
    {
        $startTanggal = !empty($start) ? $start : $this->tanggal;
        $endTanggal = !empty($end) ? $end : $this->tanggal;

        $query = mysqli_query($this->mysqli, "SELECT id, no_antrian, code_antrian, status, status FROM queue_antrian_admisi WHERE tanggal BETWEEN '$startTanggal' AND '$endTanggal' AND code_antrian='$code_antrian'") or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function createAntrian($no_antrian, $code_antrian)
    {
        $antrian = $code_antrian . $no_antrian; // Menggabungkan code_antrian dan no_antrian
        $query = mysqli_query($this->mysqli, "INSERT INTO queue_antrian_admisi (tanggal, no_antrian, code_antrian, antrian) 
            VALUES ('$this->tanggal', '$no_antrian', '$code_antrian', '$antrian')") 
            or die('Ada kesalahan pada query insert: ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function updateAntrian($id)
    {
        // Tentukan waktu yang akan disimpan di kolom updated_date, dengan timezone GMT+7
        $updated_date = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
        $tanggal_hari_ini = gmdate("Y-m-d", time() + 60 * 60 * 7); // Dapatkan tanggal hari ini
    
        // Update status menjadi 1 terlebih dahulu
        $updateStatusQuery = mysqli_query($this->mysqli, "UPDATE queue_antrian_admisi SET status='1', updated_date='$updated_date' WHERE id='$id' AND tanggal='$tanggal_hari_ini'");
    
        if (!$updateStatusQuery) {
            die('Ada kesalahan pada query update status: ' . mysqli_error($this->mysqli));
        }
    
        // Jika update status berhasil, update kolom 'loket'
        $antrianQuery = mysqli_query($this->mysqli, "SELECT antrian FROM queue_antrian_admisi WHERE id='$id' AND tanggal='$tanggal_hari_ini'");
        
        if (!$antrianQuery) {
            die('Ada kesalahan pada query select antrian: ' . mysqli_error($this->mysqli));
        }
    
        $antrianRow = mysqli_fetch_assoc($antrianQuery);
        $antrian = $antrianRow['antrian'];
    
        // Debugging: Cek nilai $antrian
        if (empty($antrian)) {
            die('Nilai antrian tidak ditemukan.');
        }
    
        // Ambil nilai 'loket' dari tabel 'queue_penggilan_antrian' berdasarkan 'antrian' dan 'tanggal'
        $loketQuery = mysqli_query($this->mysqli, "SELECT `loket` FROM `queue_penggilan_antrian` WHERE `antrian` = '$antrian' AND `tanggal` = '$tanggal_hari_ini' LIMIT 1");
    
        if (!$loketQuery) {
            die('Ada kesalahan pada query select loket: ' . mysqli_error($this->mysqli));
        }
    
        // Debugging: Cek apakah ada hasil dari query dan nilai $loket
        if ($loketRow = mysqli_fetch_assoc($loketQuery)) {
            $loket = $loketRow['loket'];
    
            if (empty($loket)) {
                die('Nilai loket tidak ditemukan atau kosong.');
            }
    
            // Update kolom 'loket' di tabel 'queue_antrian_admisi' berdasarkan nilai 'antrian' dan tanggal
            $updateLoketQuery = mysqli_query($this->mysqli, "UPDATE queue_antrian_admisi SET loket='$loket' WHERE antrian='$antrian' AND tanggal='$tanggal_hari_ini'");
    
            if (!$updateLoketQuery) {
                die('Ada kesalahan pada query update loket: ' . mysqli_error($this->mysqli));
            }
    
            return $updateLoketQuery; // Mengembalikan hasil update loket
        } else {
            die('Loket tidak ditemukan untuk antrian dan tanggal ini.');
        }
    }

    public function getJumlahAntrian()
    {
        $query = mysqli_query($this->mysqli, "SELECT code_antrian, COUNT(id) AS jumlah 
            FROM queue_antrian_admisi WHERE tanggal='$this->tanggal' GROUP BY code_antrian") 
            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function getAntrianSekarang()
    {
        $query = mysqli_query($this->mysqli, "SELECT id, code_antrian, no_antrian, loket, antrian, status 
            FROM queue_antrian_admisi WHERE tanggal='$this->tanggal' AND status='1' ORDER BY updated_date") 
            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function getAntrianSelanjutnya()
    {
        $query = mysqli_query($this->mysqli, "SELECT id, no_antrian, code_antrian, loket, status 
            FROM queue_antrian_admisi WHERE tanggal='$this->tanggal' AND status='0' GROUP BY code_antrian ORDER BY no_antrian ASC") 
            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function getSisaAntrian()
    {
        $query = mysqli_query($this->mysqli, "SELECT code_antrian, COUNT(id) AS jumlah 
            FROM queue_antrian_admisi WHERE tanggal='$this->tanggal' AND status='0' GROUP BY code_antrian") 
            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function createPanggilan($antrian, $loket)
    {
        $query = mysqli_query($this->mysqli, "INSERT INTO queue_penggilan_antrian(antrian, loket, tanggal) VALUES('$antrian', '$loket','$this->tanggal')") or die('Ada kesalahan pada query insert: ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function getPanggilan()
    {
        $query = mysqli_query($this->mysqli, "SELECT id, antrian, loket FROM queue_penggilan_antrian ORDER BY id ASC") or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }

    public function getSettingGeneral()
    {
        $query = mysqli_query($this->mysqli, "SELECT * FROM setting_general LIMIT 1") 
            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($this->mysqli));
        return $query;
    }
   
}