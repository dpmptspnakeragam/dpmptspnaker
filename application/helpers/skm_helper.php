<?php

if (!function_exists('kategori_mutu')) {
    function kategori_mutu($nilai)
    {
        if ($nilai >= 88.31 && $nilai <= 100.00) {
            return "A (Sangat Baik)";
        } elseif ($nilai >= 76.61 && $nilai <= 88.30) {
            return "B (Baik)";
        } elseif ($nilai >= 65.00 && $nilai <= 76.60) {
            return "C (Kurang Baik)";
        } elseif ($nilai >= 25.00 && $nilai <= 64.99) {
            return "D (Tidak Baik)";
        } else {
            return "Tidak Diketahui";
        }
    }
}
