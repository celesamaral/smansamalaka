<!DOCTYPE html>
<html lang="en">

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
            <h4 class="text-align-center">DATA SISWA BARU</h4>
        </center>
        <!-- End Tooltips Examples -->
        <table class="table table-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>JK</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($data_siswa as $siswa) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $siswa->siswa_nisn ?></td>
                        <td><?= $siswa->siswa_nis ?></td>
                        <td><?= $siswa->siswa_nama ?></td>
                        <td><?= $siswa->siswa_jk ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

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