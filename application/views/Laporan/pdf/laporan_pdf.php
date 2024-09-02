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
        LAPORAN PENJUALAN
        <br>SD ANDIR MUKTI
    </p><br><br>

    <table style="width: 50%;">
    <?php foreach($jual as $j):?>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $j['nama']?></td>
        </tr>
        <tr>
            <td>Tanggal Penjualan</td>
            <td>:</td>
            <td><?= $j['tgl_jual']?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td><b><?= $j['status']?></b></td>
        </tr>
        <tr>
            <td>Dibuat Oleh</td>
            <td>:</td>
            <td><?= $j['name']?></td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Lampiran</td>
            <td style="vertical-align: top;">:</td>
            <?php if($j['bukti'] != NULL):?>
			<td><img width="100" src="uploads/<?= $j['bukti'] ?>"/></td>
            <?php else :?>
                <td></td>
            <?php endif?>
        </tr>
        <?php endforeach; ?>
    </table>
    <br><br>
    <table border="1" width="100%">
        <tr>
            <th>No</th>    
            <th>Nama Kategori</th>    
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        <?php 
            $total = 0;
            $i = 1; 
        ?>
            <?php foreach($detailjual as $dj) :?>
                <?php 
                    $jumlah = $dj['jumlah'] * $dj['harga_satuan']; 
                    $total += $jumlah;
                ?>
                <tr align="center">
                    <th scope="row"><?= $i; ?></th>
                        <td><?= $dj['nama_kategori']?></td>
                        <td><?= $dj['nama_barang']?></td>
                        <td><?= $dj['jumlah']?></td>
                        <td><?= 'Rp. '.number_format($dj['harga_satuan']); ?></td>
                        <td><?= 'Rp. '.number_format($jumlah);?></td>
                </tr>
                
        <?php $i++; ?>
        <?php endforeach; ?>  
                
                
    </table>
    <br><br>
    <table width="50%">
        <tr>
            <td><b>Jumlah</b></td>
            <td><b>:</b></td>
            <td><b><?= 'Rp. '.number_format($total); ?></b></td>
        </tr>
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