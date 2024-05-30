<?php
if (!function_exists('dmYtoYmd')) {
    function dmYtoYmd($dmY)
    {

        $dmY = DateTime::createFromFormat('d-m-Y', $dmY);
        if (!$dmY) {
            return $dmY;
        }
        return $dmY->format('Y-m-d');
    }
}
if (!function_exists('YmdToDmy')) {
    function YmdToDmy($Ymd)
    {
        if (($Ymd) == null)
            return '';
        $dmY = DateTime::createFromFormat('Y-m-d', $Ymd);
        if (!$dmY) {
            return $dmY;
        }
        return $dmY->format('d-m-Y');
    }
}
if (!function_exists('badgeStatusUser')) {
    function badgeStatusUser()
    {
        return [
            'active' => [
                'class' => 'badge-success-light',
                'text' => 'Active',
            ],
            'inactive' => [
                'class' => 'badge-warning-light',
                'text' => 'Inactive',
            ]
        ];
    }
}
if (!function_exists('badgeStatusMahasiswa')) {
    function badgeStatusMahasiswa()
    {
        return [
            'lulus' => [
                'class' => 'badge-success-light',
                'text' => 'Lulus',
            ],
            'belum' => [
                'class' => 'badge-danger-light',
                'text' => 'Belum',
            ]
        ];
    }
}

if (!function_exists('badgeStatusKegiatan')) {
    function badgeStatusKegiatan()
    {
        return [
            'pengajuan' => [
                'class' => 'badge-warning-light',
                'text' => 'Pengajuan',
            ],
            'ditolak' => [
                'class' => 'badge-danger-light',
                'text' => 'Ditolak',
            ],
            'diterima' => [
                'class' => 'badge-success-light',
                'text' => 'Diterima',
            ]
        ];
    }
}

if (!function_exists('isMinPoint')) {
    function isMinPoint($angkatan, $point)
    {
        $minPoint = getMinPoint($angkatan);
        return $point >= $minPoint;
    }
}

if (!function_exists('getJenisPredikat')) {
    function getJenisPredikat($key = null)
    {
        $predikats =  [
            'BM' => "Belum Memenuhi",
            'B' => 'Baik',
            'SB' => 'Sangat Baik',
            'S' => 'Sempurna'
        ];
        return isset($key) ? (isset($predikats[$key]) ? $predikats[$key] : null) : $predikats;
    }
}

if (!function_exists('getPredikatPoint')) {
    function getPredikatPoint($angkatan, $point)
    {
        $penambahan = 300;
        $minPoint = getMinPoint($angkatan);
        $akhir1 = $minPoint + $penambahan;
        $akhir2 = $akhir1 + $penambahan;

        $predikat = getJenisPredikat('BM');
        if ($point > $akhir2) {
            $predikat = getJenisPredikat('S');
        } else if ($point > $akhir1) {
            $predikat = getJenisPredikat('SB');
        } else if ($point >= $minPoint) {
            $predikat = getJenisPredikat('B');
        }
        return $predikat;
    }
}

if (!function_exists('getPredikatPoints')) {
    function getPredikatPoints($angkatan)
    {
        $penambahan = 300;
        $minPoint = getMinPoint($angkatan);
        $akhir1 = $minPoint + $penambahan;
        $akhir2 = $akhir1 + $penambahan;

        return [
            [
                'predikat' => 'Belum Memenuhi',
                'keterangan' => 'Belum Memenuhi',
                'range' => 0 . ' - ' . ($minPoint - 1),
                'min' => 0,
                'max' => ($minPoint - 1),
                'class' => 'predikat-belum-memenuhi',
                'passed' => false,
                'background' => '#f6676b',
            ],
            [
                'predikat' => 'Baik',
                'keterangan' => 'Lulus Kategori Baik',
                'range' => $minPoint . ' - ' . $akhir1,
                'min' => $minPoint,
                'max' => $akhir1,
                'class' => 'predikat-baik',
                'passed' => true,
                'background' => '#fc9956',

            ],
            [
                'predikat' => 'Sangat Baik',
                'keterangan' => 'Lulus Kategori Sangat Baik',
                'range' => ($akhir1 + 1) . ' - ' . $akhir2,
                'min' => ($akhir1 + 1),
                'max' => $akhir2,
                'class' => 'predikat-sangat-baik',
                'passed' => true,
                'background' => '#f7d460',
            ],
            [
                'predikat' => 'Sempurna',
                'keterangan' => 'Lulus Kategori Sempurna',
                'range' => ($akhir2 + 1) . ' - ' . 'xx',
                'min' => ($akhir2 + 1),
                'max' => 9999999,
                'class' => 'predikat-sempurna',
                'passed' => true,
                'background' => '#abd162',
            ],
        ];
    }
}

if (!function_exists('getMinPoint')) {
    function getMinPoint($angkatan)
    {
        if ($angkatan >= 2023)
            return 2000;
        if ($angkatan == 2022)
            return 1500;
        if ($angkatan == 2021)
            return 750;
        return 150;
    }
}

if (!function_exists('getEmailConfig')) {
    function getEmailConfig($params = [])
    {
        $mailConfig = [
            'transport' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => 465,
            'encryption' => 'tls',
            // 'username' => 'ilham.rahmadhani@bakrie.ac.id',
            // 'password' => 'pojncvszejoioulp',
            'timeout' => null
        ];

        return $params + $mailConfig;
    }
}

if (!function_exists('getStatusMaroon')) {
    function getStatusMaroon($idSistemKuliah)
    {
        $status = '';
        switch ($idSistemKuliah) {
            case '1':
                $status = 'belum';
                break;
            case '2':
            case '11':
            case '21':
                $status = 'lulus';
                break;
        }
        return $status;
    }
}

if (!function_exists('getSelisihHari')) {
    function getSelisihHari($start, $end)
    {
        $earlier = new DateTime($start);
        $later = new DateTime($end);
        if ($earlier > $later) {
            return null;
        }
        $days = $earlier->diff($later)->format("%r%a") + 1;
        return $days;
    }
}

if (!function_exists('isBisaCetak')) {
    function isBisaCetak($minPoint, $currentPoint, $statusMaroon)
    {
        return (($currentPoint >= $minPoint) || $statusMaroon == 'lulus');
    }
}

if (!function_exists('syaratExitLetter')) {
    function syaratExitLetter($mahasiswa, $predikatPoints, $minPoint)
    {
        $output = [];
        $output['is_special'] =  getStatusMaroon($mahasiswa->idsistemkuliah) == 'lulus';

        foreach ($predikatPoints as $key => $value) {
            if ($mahasiswa->current_point >= $value['min'] && $mahasiswa->current_point <= $value['max']) {
                $output['description_point'] = $value;
                break;
            }
        }
        $syarat['semester']['passed'] = $mahasiswa->semester >= 7;
        $syarat['semester']['text'] = 'Saat ini mahasiswa berada di <span
        class="badge badge-' . ($syarat['semester']['passed'] ? 'predikat-sempurna' : 'predikat-belum-memenuhi') . '">Semester ' . $mahasiswa->semester . '</span>';

        $syarat['predikat']['passed'] = $output['description_point']['passed'];
        $syarat['predikat']['text'] = '<span>Status maroon point mahasiswa adalah</span> <span
        class="badge badge-' . $output['description_point']['class'] . '">' . $output['description_point']['predikat'] . '</span>';

        $syarat['sidang']['passed'] = (bool) $mahasiswa->tanggal_sidang;
        $syarat['sidang']['text'] = null;

        $output['syarat'] = $syarat;
        $output['is_passed'] = true;
        foreach ($syarat as $k => $_syarat) {
            if (!$syarat[$k]['passed']) {
                $output['is_passed'] = false;
                break;
            }
        }
        return $output;
    }
}


if (!function_exists('rupiah')) {
    function rupiah($number)
    {
        if (!is_numeric($number)) {
            return $number;
        }

        return "Rp " . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('hResponse')) {
    function hResponse($success, $message = '', $data = [])
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
    }
}

if (!function_exists('dbg')) {
    function dbg(...$messages)
    {
        debugbar()->info($messages);
    }
}

if (!function_exists('setPageTitle')) {
    function setPageTitle($pageTitle)
    {
        \Illuminate\Support\Facades\View::share('pageTitle', $pageTitle);
    }
}
