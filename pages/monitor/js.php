<!-- Get API Key -> https://responsivevoice.org/ -->
<script src="assets/vendor/js/responsivevoice.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        // buat variabel untuk menampilkan audio bell antrian
        var bell = document.getElementById('tingtung');
        var queuePanggil = [];
        var currentPanggil = 0;
        var isPlay = false;


 // Fungsi untuk mengambil data antrian sekarang dari server
 const getAntrianSekarang = () => {
    $.ajax({
        url: 'pages/panggilan/action.php?time=' + new Date().getTime(),
        method: 'GET',  // atau 'GET' sesuai kebutuhan
        data: {
            type: 'get_antrian_sekarang'
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                response.data.forEach(function(element) {
                    $('#antrian-sekarang').html(element.antrian);
                    $('.namaLoketMonitor').html('Loket ' + (element.loket ? element.loket : 'Loket tidak tersedia'));
                });
            } else {
                $('#antrian-sekarang').html('-');
                $('.namaLoketMonitor').html('-');
            }
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
};

// Memanggil fungsi getAntrianSekarang ketika halaman dimuat
$(document).ready(function() {
    getAntrianSekarang();
     // Panggil getAntrianSekarang setiap 5 detik
     setInterval(getAntrianSekarang, 1000);
});




        // Get antrian sekarang
        const get_antrian = () => $.ajax({
    url: 'pages/panggilan/action.php',
    method: 'GET',
    data: {
        type: 'get_antrian_sekarang'
    },
    async: false,
    cache: false,
    dataType: 'json',
    success: function(result) {
        if (result.success === true) {
            if (result.data.length > 0) {
                result.data.forEach(function(element, index) {
                    // Menampilkan data antrian
                    $('#code-antrian-' + element.code_antrian.toLowerCase()).html(element.antrian).fadeIn('slow');
                    // Menampilkan data loket
                    $('#loket-' + element.code_antrian.toLowerCase()).html('Loket ' + (element.loket ? element.loket : 'tidak tersedia')).fadeIn('slow');
                });
            } else {
                $("[id^='code-antrian']").html('-');
                $("[id^='loket']").html('Loket tidak tersedia');
            }
        }
    },
    error: function(xhr, status, error) {
        console.log('Error: ', error);
    }
});

        const checkQueuePanggil = (key, arrayOfQueue) => {
            var result = false;
            for (let i = 0; i < arrayOfQueue.length; i++) {
                if (arrayOfQueue[i].id === key) {
                    result = true;
                }
            }

            return result;
        }

        const get_panggilan = () => {
            $.ajax({
                url: 'pages/monitor/action.php',
                method: 'POST',
                data: {
                    type: 'get_panggilan'
                },
                async: false,
                cache: false,
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        if (result.data.length > 0) {
                            result.data.forEach(function(element, index) {
                                if (checkQueuePanggil(element.id, queuePanggil)) {
                                    return;
                                }
                                queuePanggil.push(element);
                                if (!isPlay) {
                                    panggilAntrian();
                                }
                            });
                        }
                    }
                }
            });
        };

        const delete_panggilan = (id) => {
            $.ajax({
                url: 'pages/monitor/action.php',
                method: 'POST',
                data: {
                    type: 'delete_panggilan',
                    id: id
                },
                async: false,
                cache: false,
                dataType: 'json',
                success: function(result) {
                    console.log(result.message);
                }
            });
        }

        get_antrian();
        get_panggilan();
        // auto reload data antrian setiap 1 detik untuk menampilkan data secara realtime
        setInterval(function() {
            get_antrian();
            get_panggilan();
        }, 1000);

        function panggilAntrian() {
            if (queuePanggil.length > 0) {
                queuePanggil.forEach((value, index) => {
                    if (!isPlay) {
                        isPlay = true;
                        $("#antrian-sekarang").html(value.antrian);
                        $(".namaLoketMonitor").html(value.loket.toUpperCase());
                        // mainkan suara bell antrian
                        bell.currentTime = 0;
                        bell.pause();
                        bell.play();

                        // set delay antara suara bell dengan suara nomor antrian
                        durasi_bell = bell.duration * 770;

                        // mainkan suara nomor antrian
                        setTimeout(function() {
                            let no_antrian = value.antrian
                            let format_no_antrian = no_antrian[0] + ", " + no_antrian.slice(1)
                            responsiveVoice.speak("Nomor Antrian, " + format_no_antrian + ", menuju, " + value.loket, "Indonesian Female", {
                                rate: 0.9,
                                pitch: 1,
                                volume: 1,
                                onend: () => {
                                    queuePanggil.splice(index, 1);
                                    isPlay = false;
                                    delete_panggilan(value.id);
                                    if (queuePanggil.length > 0) {
                                        panggilAntrian();
                                    }
                                }
                            });
                        }, durasi_bell);
                    }
                });
            }
        }
    });
</script>

<script>
    jam();

    function jam() {
        var e = document.getElementById("time"),
            d = new Date(),
            h,
            m,
            s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ":" + m + ":" + s;

        setTimeout("jam()", 1000);
    }

    function set(e) {
        e = e < 10 ? "0" + e : e;
        return e;
    }
</script>