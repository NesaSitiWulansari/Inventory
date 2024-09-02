<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title{
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>

</head><body>
    <table style="width: 100%; line-height: 1.4;">
        <tr>
            <td>
                <img src="assets/img/Logoyayasan.png" style="position: auto; width: 90px; height: auto;">
            </td>
            <td align="center">
                YAYASAN ANDIR MUKTI BANDUNG
                <span style="font-weight: bold;">
                    <br>SEKOLAH DASAR ANDIR MUKTI
                </span>
                <br>AKREDITASI "B" (BAIK)
                <br>Jl. Jend. Sudirman Blk No. 799 Kec. Bandung Kulon Kota Bandung
                <br>No. Telp : (022) 20594906 email : sd.andirmukti1967@gmail.com
            </td>
            <td align="right">
                <img src="assets/img/Logo.png" style="position: auto; width: 90px; height: auto;">
            </td>
        </tr>
    </table>

    <hr class="line-title">

    <p align="center" style="font-weight: bold;">
        LAPORAN PEMINJAMAN
        <br>SD ANDIR MUKTI
    </p><br><br>

    <table style="width: 80%;">
        <?php foreach($pinjam as $p):?>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $p['name']?></td>
            </tr>
            <tr>
                <td>Tanggal Pinjam</td>
                <td>:</td>
                <td><?= $p['tgl_pinjam']?></td>
            </tr>
            <tr>
                <td>Tanggal Kembali</td>
                <td>:</td>
                <td><?= $p['tgl_kembali']?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td><b><?= $p['status']?></b></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><?= $p['keterangan']?></td>
            </tr>
            <?php endforeach; ?>
    </table>

    <br><br>

    <table border="1" width="100%">
        <tr class="text-center">
            <th>No</th>  
            <th>Nama Kategori</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Kondisi Awal</th>
            <th>Kondisi Akhir</th>
            <th>Status</th>
        </tr>
        <?php $i = 1; ?>
                    <?php foreach($detailpinjam as $dp) :?>
                        <tr align="center">
                            <th scope="row"><?= $i; ?></th>
                                <td><?= $dp['nama_kategori']?></td>
                                <td><?= $dp['nama_barang']?></td>
                                <td><?= $dp['jumlah']?></td>
                                <td><?php if($dp['kondisi_awal'] != NULL):?>
                                    <img width="100" src="assets/KondisiAwal/<?= $dp['kondisi_awal'] ?>"/><br>
                                    <?= $dp['ket_awal']?>
                                    <?php else :?>
                                        
                                    <?php endif?>
                                </td>
			                    <td><?php if($dp['kondisi_Akhir'] != NULL):?>
                                    <img width="100" src="assets/KondisiAkhir/<?= $dp['kondisi_Akhir'] ?>"/><br>
                                    <?= $dp['ket_akhir']?>
                                    <?php else :?>
                                        
                                    <?php endif?>
                                </td>
                                <td><?php if ($dp['status_p'] == 0) : ?>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myDetailModal<?= $dp['id_peminjaman']?>">Menunggu</button>
                                    <?php elseif ($dp['status_p'] == 1) :?>    
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myDetailModal<?= $dp['id_peminjaman']?>">Setuju</button>
                                    <?php elseif ($dp['status_p'] == 2) :?>    
                                        <button class="btn btn-danger btn-sm">Tidak Setuju</button>
                                    <?php elseif ($dp['status_p'] == 3) :?>    
                                        <button class="btn btn-success btn-sm">Kembali</button>
                                    <?php endif; ?>
                                </td>
                        </tr>
                    <?php $i++; ?>
        <?php endforeach; ?>
    </table><br><br><br>

<table style="width: 100%; line-height: 1.4;" align="right">
    <tr>
        <td align="center">
            Bandung, <?php echo date('d-M-Y'); ?>
            <br>Kepala Sekolah SD Andir Mukti <br><br><br>
            <span style="font-weight: bold;"><br><?= $login['name']; ?></span>
            <br>NIP. 
        </td>
    </tr>
</table>
    
</body></html>