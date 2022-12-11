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
            <h4 class="text-align-center">DATA GURU</h4>
        </center>
        <!-- End Tooltips Examples -->
        <table class="table">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>JK</th>
                    <th>Tempat Lahir</th>
                    <th>Tgl Lahir</th>
                    <th>HP</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_guru as $guru) : ?>
                    <tr>
                        <td><?= $guru->guru_nip ?></td>
                        <td><?= $guru->guru_nama ?></td>
                        <td><?= $guru->guru_jk ?></td>
                        <td><?= $guru->guru_tempat_lahir ?></td>
                        <td><?= $guru->guru_tgl_lahir ?></td>
                        <td><?= $guru->guru_hp ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


</body>

</html>