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
            <h4 class="text-align-center">PENILAIAN SISWA</h4>
        </center>
        <!-- End Tooltips Examples -->

        <?php $no = 1; ?>
        <p>Mata Pelajaran : <?= $mapel->mapel_nama ?> <?= $mapel->mapel_kelas ?></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>

                    <?php foreach ($data_kd as $kd) { ?>
                        <th>KD <?= $no++; ?></th>
                    <?php } ?>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_siswa as $nilai) { ?>

                    <tr>
                        <?php
                        $kd_count = 0;
                        $kd_total = 0;
                        ?>
                        <td><?= $nilai->siswa_nama ?></td>
                        <?php foreach ($nilai->nilai as $kd) { ?>
                            <?php
                            $kd_count++;
                            $kd_nilai =  ($kd->tugas1 + $kd->tugas2 + $kd->ulangan1 + $kd->ulangan2) / 4;
                            $kd_total += $kd_nilai; ?>
                            <td><?= $kd_nilai ?></td>
                        <?php } ?>
                        <td><?= $nilai->uts ?></td>
                        <td><?= $nilai->uas ?></td>
                        <td><?= $nilai->akhir ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</body>

</html>