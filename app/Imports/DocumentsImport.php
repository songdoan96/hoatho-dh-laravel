<?php

namespace App\Imports;

use App\Models\Document;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;

class DocumentsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return new Document([
            "bophan" =>   $row["bo_phan"],
            "sttbophan" => (string)$row["stt_tung_bo_phan"],
            "vanbanso" => $row["van_ban_so"],
            "danhmuc" => $row["danh_muc"],
            "phanloai" => $row["phan_loai"],
            "ngaybanhanh" => (string)$row["ngay_ban_hanh_lan_dau"],
            "ngaysuadoi" => (string)$row["ngay_sd_cap_nhat"],
            "lansuadoi" => (int)$row["lan_sua_doi"],
            "thoigianluu" => $row["thoi_gian_luu_tru"],
            "noiluutru" => $row["noi_luu_tru_ho_so"],
            "ghichu" => $row["ghi_chu"],
        ]);
    }
}
