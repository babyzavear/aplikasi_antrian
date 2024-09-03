<main class="flex-shrink-0">
    <div class="container">
        <?php
        require_once "config/query.php";
        $action = new config\query;
        $query = $action->getSetting();
        // ambil jumlah baris data hasil query
        $rows = mysqli_num_rows($query);

        if ($rows <> 0) {
            $data = mysqli_fetch_assoc($query);
        } else {
            $data = [];
        }
        ?>
        <!-- tampilkan pesan selamat datang -->
        <div class="alert alert-light border border-success mb-3 mt-3" role="alert">
            <div class="text-center">
                <img src="<?= $data['logo'] && file_exists('assets/img/' . $data['logo']) ? 'assets/img/' . $data['logo'] : 'assets/img/default.png' ?>" alt="Logo" width="60px" class="">
                <h4 class="mt-2 mb-0 fw-bold"><?= $data['nama_instansi'] ? $data['nama_instansi'] : ''; ?></h4>
                <p>
                    <small>Silahkan pilih halaman yang ingin ditampilkan</small>
                </p>
            </div>
        </div>

        <div class="row gx-3 text-center">
            <!-- link halaman nomor antrian -->
            <div class="col-sm-6 mb-3">
                <div class="card border border-success shadow-sm">
                    <div class="card-body p-3">
                        <div class="feature-icon-3 bg-success bg-gradient mb-3">
                            <i class="bi-people"></i>
                        </div>
                        <h4 class="fw-bold">NOMOR ANTRIAN</h4>
                        <p class="mb-3">Halaman Nomor Antrian digunakan pengunjung untuk mengambil nomor antrian.</p>
                        <a href="index.php?pages=nomor" class="btn btn-success px-4 py-2">
                            TAMPILKAN <i class="bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- link halaman panggilan antrian -->
            <div class="col-sm-6 mb-3">
                <div class="card border border-success shadow-sm">
                    <div class="card-body p-3">
                        <div class="feature-icon-3 bg-success bg-gradient mb-3">
                            <i class="bi-mic"></i>
                        </div>
                        <h4 class="fw-bold">PANGGILAN ANTRIAN</h4>
                        <p class="mb-3">Halaman Panggilan Antrian digunakan petugas loket untuk memanggil antrian.</p>
                        <a href="javascript:;" class="btn btn-success px-4 py-2" data-bs-toggle="modal" data-bs-target="#panggilAntrian">
                            TAMPILKAN <i class="bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3 text-center">
            <!-- link halaman monitor antrian -->
            <div class="col-sm-6 mb-3">
                <div class="card border border-success shadow-sm">
                    <div class="card-body p-3">
                        <div class="feature-icon-3 bg-success bg-gradient mb-3">
                            <i class="bi-display"></i>
                        </div>
                        <h4 class="fw-bold">MONITOR ANTRIAN</h4>
                        <p class="mb-3">Halaman Monitor Antrian digunakan menampilkan antrian pada monitor.</p>
                        <a href="index.php?pages=monitor" class="btn btn-success px-4 py-2">
                            TAMPILKAN <i class="bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- link halaman setting antrian -->
            <div class="col-sm-6 mb-3">
                <div class="card border border-success shadow-sm">
                    <div class="card-body p-3">
                        <div class="feature-icon-3 bg-success bg-gradient mb-3">
                            <i class="bi-gear"></i>
                        </div>
                        <h4 class="fw-bold">SETTING ANTRIAN</h4>
                        <p class="mb-3">Halaman Setting Antrian digunakan untuk setting antrian.</p>
                        <a href="index.php?pages=setting" class="btn btn-success px-4 py-2">
                            TAMPILKAN <i class="bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="panggilAntrian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="panggilAntrianLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="panggilAntrianLabel">Pilih Loket Antrian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select" id="loketAntrian">
                        <option value="" selected>Pilih Loket Antrian</option>
                        <?php $loket = json_decode($data['list_loket'], true); ?>
                        <?php if (count($loket) > 0) : ?>
                            <?php foreach ($loket as $lk) : ?>
                                <option value="<?= $lk['no_loket']; ?>"><?= $lk['nama_loket']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tampilAntrian">Tampilkan</button>
                </div>
            </div>
        </div>
    </div>
</main>