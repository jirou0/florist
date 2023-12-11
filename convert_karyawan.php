<?php
// Sisipkan file konfigurasi database jika diperlukan
@include 'config.php';

// Query data dari tabel atau sumber data Anda
$query = "SELECT * FROM karyawan";
$result = mysqli_query($conn, $query);

// Buat file CSV dan tambahkan header
$filename = "data_karyawan.csv";
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
$output = fopen("php://output", "w");

// Tentukan lebar kolom (sesuaikan dengan kebutuhan)
$columnWidths = array(
    'Nama' => 20,
    'Tempat Tanggal Lahir' => 30,
    'Email' => 25,
    'No Telepon' => 15,
    'Alamat' => 30,
    'Keahlian' => 15,
    'Jabatan' => 15,
);

// Header kolom yang deskriptif
$header = array_keys($columnWidths);

// Set karakter pemisah kolom (gunakan karakter yang sesuai)
$delimiter = ';';

// Tulis header ke dalam file CSV dengan karakter pemisah yang diatur
fputcsv($output, $header, $delimiter);

// Tambahkan data dari tabel atau sumber data Anda
while ($row = mysqli_fetch_assoc($result)) {
    $data = array(
        str_pad($row['name'], $columnWidths['Nama']),
        str_pad($row['birthplace'], $columnWidths['Tempat Tanggal Lahir']),
        str_pad($row['email'], $columnWidths['Email']),
        str_pad($row['no_hp'], $columnWidths['No Telepon']),
        str_pad($row['address'], $columnWidths['Alamat']),
        str_pad($row['keahlian'], $columnWidths['Keahlian']),
        str_pad($row['jabatan'], $columnWidths['Jabatan']),
    );

    // Tulis data ke dalam file CSV dengan karakter pemisah yang diatur
    fputcsv($output, $data, $delimiter);
}

fclose($output);

// Tutup koneksi database jika diperlukan
mysqli_close($conn);
?>
