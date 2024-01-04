<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Relawan</title>
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
    header("Content-Disposition: attachment; filename=Data Relawan.xls");
    ?>


    <table>
        <thead>
            <tr>
                <th colspan="5">DATA RELAWAN</th>
            </tr>
            <tr>
                <th>NO</th>
                <!-- <th>FOTO</th> -->
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>NOMOR TELEPON</th>
                <th>PENUGASAN</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result) : ?>
                <?php $no = 1;
                foreach ($result as $row) : ?>
                    <tr>
                        <td <?php if (count($row['penugasan']) > 0) { ?>rowspan="<?= count($row['penugasan']); ?>" <?php } ?>>
                            <center><?= $no++; ?></center>
                        </td>
                        <td <?php if (count($row['penugasan']) > 0) { ?>rowspan="<?= count($row['penugasan']); ?>" <?php } ?>>
                            <center><?= $row['nama']; ?></center>
                        </td>
                        <td <?php if (count($row['penugasan']) > 0) { ?>rowspan="<?= count($row['penugasan']); ?>" <?php } ?>>
                            <center><?= $row['email']; ?></center>
                        </td>
                        <td <?php if (count($row['penugasan']) > 0) { ?>rowspan="<?= count($row['penugasan']); ?>" <?php } ?>>
                            <center>
                                <?= $row['notelp']; ?>
                            </center>
                        </td>
                        <?php if (count($row['penugasan']) >= 1) : ?>
                            <td><?= $row['penugasan'][0]['kelurahan']; ?></td>
                        <?php else : ?>
                            <td style="color : red;">Belum ditugaskan</td>
                        <?php endif; ?>
                    </tr>
                    <?php if (count($row['penugasan']) > 1) : ?>

                        <?php for ($i = 1; $i < count($row['penugasan']); $i++) {  ?>
                            <tr>
                                <td><?= $row['penugasan'][$i]['kelurahan'] ?></td>
                            </tr>
                        <?php } ?>

                    <?php endif; ?>

                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">
                        <center>Tidak ada data relawan</center>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>