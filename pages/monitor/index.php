<?php
$css = 'css.php';
$hariIni = new DateTime();
function hariIndo($hariInggris)
{
    switch ($hariInggris) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'hari tidak valid';
    }
}
$list_type_antrian = (!empty($data['list_type_antrian'])) ? json_decode($data['list_type_antrian'], true) : [];
?>
<main class="flex-shrink-0">
    <div class="d-flex justify-content-between align-items-center px-3" style="height: 10vh; background-color:<?= $data['warna_primary'] ? $data['warna_primary'] : '#6B5935' ?>;">
        <img class="img-fluid d-block" src="<?= $data['logo'] && file_exists('assets/img/' . $data['logo']) ? 'assets/img/' . $data['logo'] : 'assets/img/default.png' ?>" alt="Image" class="mr-3" style="max-width: 50px;">
        <div class="text-white text-center">
            <h5 class="nama-instansi fw-bold"><?= $data['nama_instansi'] ? $data['nama_instansi'] : ''; ?></h5>
            <p class="fw-lighter lh-1 m-1">
                <?= $data['alamat'] ? $data['alamat'] : ''; ?>
                Tlp. <?= $data['telpon'] ? $data['telpon'] : ''; ?>
            </p>
          
        </div>

        <div style="color:<?= $data['warna_text'] ? $data['warna_text'] : '#fff' ?> ">
            <i class="bi bi-calendar2-check"></i>
            <span id="date"><?= hariIndo(date('l')) . ", " . strftime('%d %B %Y', $hariIni->getTimestamp()); ?></span>
            <br>
            <i class="bi bi-clock-history"></i>
            <span id="time"></span>
        </div>
    </div>

    <div class="running-text" style="background-color: <?= $data['warna_secondary'] ? $data['warna_secondary'] : '#0B2F9F'; ?>; color: white; padding: 1px; text-align: center; overflow: hidden; white-space: nowrap;">
         <marquee behavior="scroll" direction="right" scrollamount="5">
        <?= $data['running_text'] ? $data['running_text'] : '';?>
         </marquee>
        </div>
    <div class="d-flex justify-content-between mx-1 mt-1" style="height: 45vh;">
        <div class="col-md-7 p-1" style="height: 45vh;">
            <iframe class="rounded embed-responsive-item" style="width: 100%; height: 45vh;" allow="autoplay" src="https://www.youtube.com/embed/<?= $data['youtube_id'] ? $data['youtube_id'] : ''; ?>?rel=0&modestbranding=1&autohide=1&mute=0&showinfo=0&controls=1&loop=1&autoplay=1&playlist=<?= $data['youtube_id'] ? $data['youtube_id'] : ''; ?>">
            </iframe>
        </div>
        <div class="col-md-5 p-1" style="color:<?= $data['warna_text'] ? htmlspecialchars($data['warna_text']) : '#fff'; ?>; height: 45vh;">
    <div class="card text-center text-white bg-info" style="height: 45vh;">
        <h5 class="card-header fw-bold">NOMOR ANTRIAN SEKARANG</h5>
        <div class="card-body text-center d-flex justify-content-center align-items-center">
            <!-- Elemen untuk menampilkan nomor antrian dan loket -->
        <h1 id="antrian-sekarang" class="text-center fw-bold py-0" style="font-size: 120px;">-</h1>

        </div>
        <h2 class="card-footer namaLoketMonitor fw-bold">-</h2>
        
    </div>
</div>
    </div>
    <div class="d-flex justify-content-center px-1" style="height: 30vh; margin-top: 12px;">
    <?php
    $bg_color = ['bg-secondary'];
    $key_bg = 0;
    ?>
    <?php if (count($list_type_antrian) > 0) : ?>
        <?php foreach ($list_type_antrian as $key_lta => $val_lta) : ?>
            <?php
            $bg = $bg_color[$key_bg];
            $key_bg = ($key_bg + 1) % count($bg_color);
            ?>
            <div class="card text-center text-white mx-1 <?= htmlspecialchars($bg); ?>" style="width: 100%; height: 30vh;">
                <h5 class="card-header fw-bold" style="font-size: 85%;"><?= htmlspecialchars($val_lta['type_antrian']); ?></h5>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <!-- Menampilkan data antrian -->
                    <h1 id="code-antrian-<?= strtolower(htmlspecialchars($val_lta['code_antrian'])) ?>" class="text-center fw-bold" style="font-size: 60px;">-</h1>
                </div>
                <h5 class="card-footer fw-bold">
                    <!-- ID elemen untuk loket berdasarkan code_antrian -->
                    <span id="loket-<?= strtolower(htmlspecialchars($val_lta['code_antrian'])) ?>">Loket tidak tersedia</span>
                </h5>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</main>
<!-- load file audio bell antrian -->
<audio id="tingtung" src="assets/audio/tingtung.mp3"></audio>
<?php $js = 'js.php'; ?>