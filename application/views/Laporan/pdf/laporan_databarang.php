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
        LAPORAN DATA STOK BARANG
        <br>SD ANDIR MUKTI
    </p><br><br>
    
    <table border="1" width="100%">
        <tr>
            <th>No</th>    
            <th>Nama Barang</th>
            <th>Nama Kategori</th>
            <th>Stok</th>
            <th>Nama Satuan</th>
            <th>Harga Satuan</th>
        </tr>
        <?php 
            $i = 1; 
        ?>
            <?php foreach($barang as $ba) :?>
                <tr align="center">
                    <th scope="row"><?= $i; ?></th>
                        <td><?= $ba['nama_barang']?></td>
                        <td><?= $ba['nama_kategori']?></td>
                        <td><?= $ba['stok']?></td>
                        <td><?= $ba['nama_satuan']?></td>
                        <td><?= 'Rp. '.number_format($ba['harga_satuan']) ?></td>
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