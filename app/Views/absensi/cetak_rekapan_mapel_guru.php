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
                        <b>DINAS PENDIDIKAN DAN KEBUDAYAAN</b><br>
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
            <h4 class="text-align-center">REKAP DAFTAR HADIR</h4>
        </center>
        <!-- End Tooltips Examples -->
        <p>Mata Pelajaran : <?= $mapel->mapel_nama ?> <?= $mapel->mapel_kelas ?></p>
        <p>Kelas : <?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Hadir</th>
                    <th>Sakit</th>
                    <th>Ijin</th>
                    <th>Tanpa Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_siswa as $siswa) : ?>
                    <tr>
                        <td><?= $siswa->siswa_nama ?></td>
                        <td><?= $siswa->absensi->H ?></td>
                        <td><?= $siswa->absensi->I ?></td>
                        <td><?= $siswa->absensi->S ?></td>
                        <td><?= $siswa->absensi->A ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</body>

</html>