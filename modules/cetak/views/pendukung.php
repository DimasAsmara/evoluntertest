<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Pendukung</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        table td img {
            width: 100px;
        }


        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Pendukung.xls");
    ?>


    <table>
        <thead>
            <tr>
                <th colspan="13">DATA PENDUKUNG</th>
            </tr>
            <tr>
                <th>NO</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>NOMOR TELEPON</th>
                <th>EMAIL</th>
                <th>KELURAHAN</th>
                <th>TPS</th>
                <th>UMUR</th>
                <th>GENDER</th>
                <th>RW</th>
                <th>RT</th>
                <th>ALAMAT</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result) : ?>
                <?php $no = 1;
                foreach ($result as $row) : ?>
                    <tr>
                        <td>
                            <center><?= $no++; ?></center>
                        </td>
                        <td>
                            <center><?= '_' . $row->nik; ?></center>
                        </td>
                        <td>
                            <center><?= $row->nama; ?></center>
                        </td>
                        <td>
                            <center>
                                <?= $row->notelp; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $row->email; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $row->kelurahan; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $row->tps; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= ifnull($row->umur, ' - '); ?> <?= ($row->umur) ? 'Tahun' : ''; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= gender_encode($row->gender); ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $row->rw; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= $row->rt; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?= ifnull($row->alamat, ' - ') ?>
                            </center>
                        </td>
                        <?php if ($row->new_data == 'Y') : ?>
                            <td style="color : green;">DATA BARU DARI RELAWAN</td>
                        <?php else : ?>
                            <td> - </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="13">
                        <center>Tidak ada data pendukung</center>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>