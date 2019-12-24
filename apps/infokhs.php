<?php 

include("konfigurasi.php");
$url="https://infokhs.umm.ac.id/login";
function curl($url, $postinfo, $cookie)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

if (isset($_GET['nim'])) {
    $data = curl($url, false, false);
    preg_match('/Set-Cookie: (.*)\b/', $data, $kuki);
    $cookie = $kuki[1];

    $nim = $_GET['nim'];
    $pic = $_GET['password'];
    $postinfo = "username=$nim&password=$pic";
    $login = curl($url, $postinfo, $cookie);
    
    if (preg_match('/\bprofil\b/i', $login)) {
        preg_match('/<h3 ?.*>(.*)<\/h3>/', $login, $resultnamalengkap);
        preg_match_all("/<li ?.*>(.*)<\/li>/", $login, $resultdetail);
        preg_match_all('/<img\s+(?=[^>]*?(?<=\s)class\s*=\s*\"img-responsive.*avatar-view.*\")[^>]*?(?<=\ssrc=")([^"]*)/', $login, $linkfoto);
        $arrayresult['khs_login']  = "true";
        $arrayresult['khs_nim']  = $nim;
        $arrayresult['khs_namalengkap'] = $resultnamalengkap[1];
        $arrayresult['khs_fakultas'] = substr($resultdetail[1][2],9);
        $arrayresult['khs_jurusan'] = substr($resultdetail[1][3],14);
        $arrayresult['khs_email'] = $resultdetail[1][5];
        $arrayresult['khs_nohp'] = $resultdetail[1][4];
        $arrayresult['khs_foto'] = $linkfoto[1][0];
        $resultceknim = $conn->query("select id_mahasiswa from mahasiswa where id_mahasiswa = '$nim' limit 1");
        $numceknim = mysqli_num_rows($resultceknim);
        $arrayresult['ondb'] = $numceknim;
        if($arrayresult['ondb'] == '0'){
            $querymhs = "insert into mahasiswa (id_mahasiswa, nama_mahasiswa, fakultas_mahasiswa, jurusan_mahasiswa) values ('".$nim."','".addslashes($arrayresult['khs_namalengkap'])."','".$arrayresult['khs_fakultas']."','".$arrayresult['khs_jurusan']."')";
            $resultmhs = $conn->query($querymhs);
        }
    } else {
        $arrayresult['khs_login'] = "false";
    }
    echo json_encode($arrayresult)."\n";
}else{
    echo "Aman terkendali.";
}