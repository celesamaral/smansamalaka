<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
</head>

<body>
    <div id="container">
        <h1>Welcome to CodeIgniter!</h1>
        <div id="body">
            <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en"> -->

<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- <link href="http://localhost/smansamalaka/public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<body>
    <div class="container">
        <table class="table table-borderless">
            <tr>
                <td style="width: 15%;"><img height="75px" src="http://localhost/smansamalaka/public/assets/img/logo-ntt.jpg" alt="" class="img-fluid"></td>

                <td>
                    <center>
                        <b class="text-danger">PEMERINTAH PROVINSI NUSA TENGGARA TIMUR</b><br>
                        <b>DINAS PENDIDIKAN DAN KEBUDAYAAN KABUPATEN MALAKA</b><br>
                        <b>SMA NEGERI 1 MALAKA BARAT</b><br>
                        <b>JL. MAROERAI - BESIKAMA, 85763</b><br>
                        <b>email : smansamalbar@gmail.com</b>
                    </center>


                </td>
                <td style="width: 15%;"><img height="75px" src="http://localhost/smansamalaka/public/assets/img/logo-sekolah.jpg" alt="" class="img-fluid"></td>
            </tr>
        </table>
        <hr>
        <center>
            <h4 class="text-align-center">JADWAL MENGAJAR</h4>
        </center>
        <!-- End Tooltips Examples -->
        <p><b>Guru : <?= guru()->guru_nama ?></b></p>
        <p><b>Tahun Ajaran : </b> <?= tahunajaran()->tahunajaran_tahun ?> Semester <?= tahunajaran()->tahunajaran_semester ?></p>
        <table class="table table-bordered small">
            <thead>
                <tr>
                    <th style="padding: 1px;">Mata Pelajaran</th>
                    <th style="padding: 1px;">Kelas</th>
                    <th style="padding: 1px;">Hari</th>
                    <th style="padding: 1px;">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_jadwal as $jadwal) : ?>
                    <tr>
                        <td style="padding: 1px;"><?= $jadwal->mapel_nama ?></td>
                        <td style="padding: 1px;"><?= $jadwal->kelas_tingkat ?> <?= $jadwal->jurusan_nama ?> <?= $jadwal->kelas_abjad ?></td>
                        <td style="padding: 1px;"><?= $jadwal->jadwal_hari ?></td>
                        <td style="padding: 1px;"><?= $jadwal->jadwal_mulai ?> - <?= $jadwal->jadwal_selesai ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Vaidasi -->

    <table class="table table-borderless">
        <tr>
            <td style="width: 50%;"></td>
            <td>
                <div class="text-center">
                    <span class="text-center">Malaka Barat, <?= date('d-m-Y') ?></span><br>
                    <span class="text-center">Kepala Sekolah SMA Negeri 1 Malaka Barat,</span> <br><br><br>
                    <span class="text-center"><?= kepalasekolah()->kepalasekolah_nama ?></span><br>
                    <span class="text-center">NIP.<?= kepalasekolah()->kepalasekolah_nip ?></span>
                </div>
            </td>
        </tr>
    </table>


</body>

</html>