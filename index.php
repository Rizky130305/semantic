<?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_semantic_web_pendaftar_kampus_impian";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query data
$sql = "SELECT * FROM pendaftar_kampus_impian";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hasil Pendaftaran Kampus Impian</title>
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  </head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      padding: 20px;
      background-color: #2e8b57;s
      color: white;
      margin: 0;
    }

    .container {
      margin: 20px;
      padding: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      border: 1px solid #ddd;
      word-wrap: break-word;
    }

    th {
      background-color: #f2f2f2;
    }

    input[type="text"] {
      width: 100%;
      padding: 6px;
      margin: 5px 0;
      box-sizing: border-box;
    }

    /* Responsif untuk tampilan di layar kecil */
    @media screen and (max-width: 768px) {
      table {
        border: 0;
      }

      table,
      th,
      td {
        display: block;
        width: 100%;
      }

      th {
        display: none; /* Sembunyikan header pada layar kecil */
      }

      td {
        text-align: right;
        padding-left: 50%; /* Spasi untuk label */
        position: relative;
        border-bottom: 1px solid #ddd;
      }

      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
      }

      /* Menyesuaikan input pencarian */
      input[type="text"] {
        padding: 4px;
      }
    }
  </style>
  <body>
    <h1>Pendaftaran Kampus Impian</h1>
    <table id="dataTable" class="display">
      <thead>
        <tr>
          <th>Kode Pendaftar</th>
          <th>Nama Pendaftar</th>
          <th>Jalur Pendaftaran</th>
          <th>Gelombang</th>
          <th>Sistem Kuliah</th>
          <th>Jenis kelamin</th>
          <th>Tgl Lahir</th>
          <th>Tmp Lahir</th>
          <th>Agama</th>
          <th>Kota</th>
          <th>Jurusan</th>
          <th>Tahun lulus</th>
          <th>Pilihan 1</th>
        </tr>
        <tr>
          <th><input type="text" placeholder="Cari Kode" /></th>
          <th><input type="text" placeholder="Cari Nama Pendaftar" /></th>
          <th><input type="text" placeholder="Cari Jalur pendaftaran" /></th>
          <th><input type="text" placeholder="Cari Gelombang" /></th>
          <th><input type="text" placeholder="Cari Sistem Kuliah" /></th>
          <th><input type="text" placeholder="Cari Jenis Kelamin" /></th>
          <th><input type="text" placeholder="Cari Tgl Lahir" /></th>
          <th><input type="text" placeholder="Cari Tmp Lahir" /></th>
          <th><input type="text" placeholder="Cari Agama" /></th>
          <th><input type="text" placeholder="Cari Kota" /></th>
          <th><input type="text" placeholder="Cari Jurusan" /></th>
          <th><input type="text" placeholder="Cari Tahun Lulus" /></th>
          <th><input type="text" placeholder="Cari Pilihan 1" /></th>
        </tr>
      </thead>
      <tbody>
        <?php
            if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {
        echo "
        <tr>
          <td>{$row['Kode_Pendaftar']}</td>
          <td>{$row['Nama_Pendaftar']}</td>
          <td>{$row['Jalur_Pendaftaran']}</td>
          <td>{$row['Gelombang']}</td>
          <td>{$row['Sistem_Kuliah']}</td>
          <td>{$row['Jenis_Kelamin']}</td>
          <td>{$row['Tgl_Lahir']}</td>
          <td>{$row['Tmp_lahir']}</td>
          <td>{$row['Agama']}</td>
          <td>{$row['Kota']}</td>
          <td>{$row['Jurusan']}</td>
          <td>{$row['Tahun_Lulus']}</td>
          <td>{$row['Pilihan_1']}</td>
        </tr>
        "; } } ?>
      </tbody>
    </table>
    <script>
      $(document).ready(function () {
        // Inisialisasi DataTables
        var table = $("#dataTable").DataTable({
          pageLength: 7,
          lengthMenu: [7, 10, 20, 50],
          orderCellsTop: true,
          language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
              previous: "Sebelumnya",
              next: "Berikutnya",
            },
          },
        });

        // Tambahkan filter pencarian di header kolom
        $("#dataTable thead tr:eq(1) th").each(function (i) {
          $("input", this).on("keyup change", function () {
            if (table.column(i).search() !== this.value) {
              table.column(i).search(this.value).draw();
            }
          });
        });
      });
    </script>
  </body>
</html>
