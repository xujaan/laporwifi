<?php
$conn = mysqli_connect('localhost','root','1234569','laporwifi');

if(!$conn){
    echo mysqli_errno()." ".mysqli_error();
}

if(isset($_GET['lapor'])){
    $nim = $_GET['nim'];
    $lokasi = $_GET['lokasi'];
    $jenis = $_GET['jenis'];
    $laporan = $_GET['isi'];
    $query_lapor = "insert into laporan (id_mahasiswa, lokasi_laporan, jenis_laporan, isi_laporan) values ('$nim', '$lokasi', '$jenis', '$laporan')";
    $result_lapor = $conn->query($query_lapor);
    if($result_lapor){
        $arraystatus['status'] = "sukses";
    }else{
        $arraystatus['status'] = "gagal";    
    }
    echo json_encode($arraystatus);
}elseif(isset($_GET['admin'])){
    $result_admin = $conn->query("SELECT laporan.*, mahasiswa.* from laporan inner join mahasiswa on laporan.id_mahasiswa = mahasiswa.id_mahasiswa order by waktu_laporan desc");
    $rows = array();
    while($r = mysqli_fetch_assoc($result_admin)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}