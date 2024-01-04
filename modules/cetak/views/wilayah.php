<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Wilayah</title>
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
    header("Content-Disposition: attachment; filename=Data Wilayah.xls");
    ?>


    <table>
        <thead>
            <tr>
                <th colspan="5">DATA WILAYAH</th>
            </tr>
            <tr>
                <th>NO</th>
                <th>KELURAHAN</th>
                <th>JUMLAH TPS</th>
                <th>JUMLAH PENDUDUK</th>
                <th>RELAWAN</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result) : ?>
                <?php $no = 1;
                foreach ($result as $row) : ?>
                    <tr>
                        <td rowspan="<?= count($row['relawan']); ?>">
                            <center><?= $no++; ?></center>
                        </td>
                        <td rowspan="<?= count($row['relawan']); ?>">
                            <center><?= $row['nama']; ?></center>
                        </td>
                        <td rowspan="<?= count($row['relawan']); ?>">
                            <center><?= $row['jumlah_tps']; ?></center>
                        </td>
                        <td rowspan="<?= count($row['relawan']); ?>">
                            <center>
                                <?= $row['jumlah_penduduk']; ?>
                            </center>
                        </td>
                        <?php if (count($row['relawan']) >= 1) : ?>
                            <td><?= $row['relawan'][0]['relawan']; ?></td>
                        <?php else : ?>
                            <td style="color : red;">Belum ditugaskan</td>
                        <?php endif; ?>
                    </tr>
                    <?php if (count($row['relawan']) > 1) : ?>

                        <?php for ($i = 1; $i < count($row['relawan']); $i++) {  ?>
                            <tr>
                                <td><?= $row['relawan'][$i]['relawan'] ?></td>
                            </tr>
                        <?php } ?>

                    <?php endif; ?>

                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">
                        <center>Tidak ada data wilayah</center>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>