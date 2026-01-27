<?php include_once("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #FAF3E0; /* cream muda */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4a4a4a;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #f3e5c6;
            color: #4a4a4a;
        }

        tr:nth-child(even) {
            background-color: #faf7f1;
        }

        tr:hover {
            background-color: #f1eadb;
        }

        img {
            width: 90px;
            height: 110px;
            object-fit: cover;
            border-radius: 8px;
        }

        a {
            text-decoration: none;
            padding: 6px 12px;
            color: white;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-add {
            background-color: #fbfbeeff;
            display: inline-block;
            margin-bottom: 15px;
        }

        .btn-edit {
            background-color: #f8f1deff;
        }

        .btn-delete {
            background-color: #fffbd4ff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Siswa</h2>
    <a href="tambah.php" class="btn-add">Tambah Siswa Baru</a>

    <table>
        <tr>
            <th>Nama</th>
            <th>No. Presensi</th>
            <th>Kelas</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php
        $result = $mysqli->query("SELECT * FROM siswa ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            $foto_path = "uploads/" . htmlspecialchars($row['foto_filename']);

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nomor_presensi']) . "</td>";
            echo "<td>" . htmlspecialchars($row['kelas']) . "</td>";
            echo "<td>";

            if (!empty($row['foto_filename']) && file_exists($foto_path)) {
                echo "<img src='" . $foto_path . "' alt='Foto " . htmlspecialchars($row['nama']) . "'>";
            } else {
                echo "Tidak ada foto";
            }

            echo "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>
                    <a href='hapus.php?id=" . $row['id'] . "' 
                       onclick='return confirm(\"Yakin ingin menghapus data ini?\")' 
                       class='btn-delete'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
