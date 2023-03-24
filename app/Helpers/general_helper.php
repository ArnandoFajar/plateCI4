<?php

/**
 * Untuk mendapatkan semua nama kolom dalam tabel database
 * @param string $table 
 * 
 * @return array
 */
function allfields($table)
{
    $db      = db_connect();
    $query = $db->query("SHOW COLUMNS FROM " . $table . ";")->getResultArray();
    $fields = [];
    foreach ($query as $q) {
        array_push($fields, $q['Field']);
    }
    return $fields;
}

function encrypt_url($p)
{
    $encrypter = \Config\Services::encrypter();
    return bin2hex($encrypter->encrypt($p));
}

function decrypt_url($p)
{
    $encrypter = \Config\Services::encrypter();
    return $encrypter->decrypt(hex2bin($p));
}

function convertTanggal($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split       = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function convertBulan($bulan)
{
    switch ($bulan) {
        case '1':
            return 'January';
            break;
        case '2':
            return 'February';
            break;
        case '3':
            return 'Maret';
            break;
        case '4':
            return 'April';
            break;
        case '5':
            return 'Mei';
            break;
        case '6':
            return 'Juni';
            break;
        case '7':
            return 'Juli';
            break;
        case '8':
            return 'Agustus';
            break;
        case '9':
            return 'September';
            break;
        case '10':
            return 'Oktober';
            break;
        case '11':
            return 'November';
            break;
        default:
            return 'Desember';
            break;
    }
}

/**
 * mengambil format nilai rupiah
 * @param int $angka angka yang ingin dimasukkan
 * @param bool $rupiah jika true maka tersedia tanda Rp. jika tidak maka hanya separator saja
 * @param string $separator format separator pemisah ribuan
 * @param int $koma desimal berapa jumlah
 * @return string
 */
function rupiah($angka, $rupiah = true, $separator = '.', $koma = 0)
{
    if ($rupiah) {
        $formatnumber = "Rp " . number_format($angka, $koma, ',', $separator);
    } else {
        $formatnumber = number_format($angka, $koma, ',', $separator);
    }
    return $formatnumber;
}


/**
 * Untuk membuang key yang tidak diinginkan
 * @param array $array
 * @param string|array $keys 
 * 
 * @return array
 */
function array_except($arr, $keys)
{
    if (is_array($keys)) {
        foreach ($keys as $k) {
            if (!empty($arr[$k])) {
                unset($arr[$k]);
            }
        }
    } else {
        unset($arr[$keys]);
    }
    return $arr;
}

/**
 * Penjumlahan tanggal, tanggal awal ditambah berapa hari dalam satuan angka
 * @param string $dateawal tanggal awal
 * @param int $day dijumlah berapa hari satuan angka
 * @return string
 */
function penjumlahanTanggal($dateawal, $day)
{
    $tgl1    = $dateawal; // menentukan tanggal awal
    $tgl2    = date('Y-m-d', strtotime($day . ' days', strtotime($tgl1))); // penjumlahan tanggal sebanyak $day hari
    return $tgl2; // cetak tanggal
}

/**
 * Mencari nilai selisih dari 2 tangggal
 * @param string $dateawal tanggal awal
 * @param string $dateakhir tanggal akhir
 * @return string
 */
function selisihTanggal($dateawal, $dateakhir)
{
    $tgl1 = new DateTime($dateawal);
    $tgl2 = new DateTime($dateakhir);
    $jarak = $tgl2->diff($tgl1);
    return $jarak->days;
}

/**
 * bubble sort 
 */
function bubble_Sort($my_array = null)
{
    do {
        $swapped = false;
        for ($i = 0, $c = count($my_array) - 1; $i < $c; $i++) {
            if ($my_array[$i] > $my_array[$i + 1]) {
                list($my_array[$i + 1], $my_array[$i]) =
                    array($my_array[$i], $my_array[$i + 1]);
                $swapped = true;
            }
        }
    } while ($swapped);
    return $my_array;
}

/**
 * get boolean state sunday date or not
 * @param string $date
 * @return bool
 */
function isSunday($date)
{
    return (date('N', strtotime($date)) > 6);
}

/**
 * digunakan untuk create, jika ada id yang sama di softdelete maka data tersebut akan dihapus dipermanen lalu diganti dengan data yang baru
 * namun jika bukan softdelete maka aksi create ditolak karena id sudah digunakan
 * @param string $table
 * @param string $primarykey field primary key
 * @param string $key id primary key
 * @return array pesan berhasil atau pesan gagal
 */
function createCheckSoftDeleteOrCheckExist($table, $primaryKey, $key)
{
    $db         = db_connect();
    $softdelete = $db->table($table)->where('deleted_at !=', null)->where($primaryKey, $key)->get()->getResultArray();

    // jika ada softdelete maka hapus
    if (!empty($softdelete)) {
    }
}
