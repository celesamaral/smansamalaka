<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

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
            <h4 class="text-align-center">HASIL BELAJAR SISWA</h4>
        </center>
        <p>Nama : <?= $siswa->siswa_nama ?></p>
        <p>Tahun Ajaran : <?= $tahunajaran->tahunajaran_tahun ?></p>
        <p>Semester : <?= $tahunajaran->tahunajaran_semester ?></p>
        <!-- End Tooltips Examples -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>KD 1</th>
                    <th>KD 2</th>
                    <th>KD 3</th>
                    <th>KD 4</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_mapel as $mapel) { ?>
                    <tr>
                        <td><?= $mapel->mapel_nama ?></td>
                        <?php foreach ($mapel->nilai as $nilai) : ?>
                            <?php $nilai_kd = 0;
                            $nilai_kd += ($nilai->tugas1 + $nilai->tugas2 + $nilai->ulangan1 + $nilai->ulangan2) / 4;
                            ?>
                            <td><?= $nilai_kd ?></td>
                        <?php endforeach; ?>
                        <td><?= $mapel->uts ?></td>
                        <td><?= $mapel->uas ?></td>
                        <td><?= $mapel->akhir ?></td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>

        <!-- Vaidasi -->

        <table class="table table-borderless">
            <tr>
                <td style="width: 50%;"></td>
                <div class="text-center">
                    <br>
                    <span class="text-center">Orang Tua Siswa</span> <br><br><br>
                    <span class="text-center">(....................................))</span><br>
                </div>
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
        <tr>
            <td colspan="2">
                <div class="text-center">
                    <br>
                </div>
            </td>
        </tr>
        </table>


    </div>
</body>

</html>