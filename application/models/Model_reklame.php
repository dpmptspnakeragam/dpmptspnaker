<?php

class Model_reklame extends CI_model
{
    public function tampil_data()
    {
        $this->db->select('reklame.*, reklame_lokasi.*, kecamatan.nama_kecamatan, nagari.nama_nagari');
        $this->db->from('reklame');
        $this->db->join('reklame_lokasi', 'reklame.id_reklame = reklame_lokasi.id_reklame', 'left');
        $this->db->join('kecamatan', 'reklame_lokasi.kec_pasang = kecamatan.id', 'left');
        $this->db->join('nagari', 'reklame_lokasi.nag_pasang = nagari.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function idmax()
    {
        $this->db->select_max('id_reklame', 'idmax');
        $this->db->from('reklame');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        $this->db->insert('reklame', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_reklame', $id);
        $this->db->update('reklame', $data);
    }

    public function delete($id_reklame)
    {
        $this->db->where('id_reklame', $id_reklame);
        $this->db->delete('reklame');
    }

    public function deleteLokasi($id_reklame)
    {
        $this->db->where('id_reklame', $id_reklame);
        $this->db->delete('reklame_lokasi');
    }

    public function hitung_berlaku()
    {
        $tgl_sekarang = date('Y-m-d');
        $select = "count(*) as hitung_berlaku";
        $this->db->select($select);
        $this->db->from('reklame');
        $this->db->where('masa_berlaku >=', $tgl_sekarang);
        $query = $this->db->get()->row()->hitung_berlaku;
        return $query;
    }

    public function hitung_berlakuhabis()
    {
        $tgl_sekarang = date('Y-m-d');
        $select = "count(*) as hitung_berlakuhabis";
        $this->db->select($select);
        $this->db->from('reklame');
        $this->db->where('masa_berlaku <', $tgl_sekarang);
        $query = $this->db->get()->row()->hitung_berlakuhabis;
        return $query;
    }

    public function hitung_setor()
    {
        $status = 'Sudah Setor';
        $select = "count(*) as hitung_setor";
        $this->db->select($select);
        $this->db->from('reklame');
        $this->db->where('ket', $status);
        $query = $this->db->get()->row()->hitung_setor;
        return $query;
    }

    public function hitung_belumsetor()
    {
        $status = 'Belum Setor';
        $select = "count(*) as hitung_belumsetor";
        $this->db->select($select);
        $this->db->from('reklame');
        $this->db->where('ket', $status);
        $query = $this->db->get()->row()->hitung_belumsetor;
        return $query;
    }

    public function hitung_total()
    {
        $this->db->select('Count(*) as hitung_total');
        $this->db->from('reklame');
        $query = $this->db->get()->row()->hitung_total;
        return $query;
    }

    public function get_nagari_by_kecamatan($id_kecamatan)
    {
        return $this->db->select('id, nama_nagari')
            ->get_where('nagari', ['id_kecamatan' => $id_kecamatan])
            ->result();
    }

    public function get_id_kecamatan_by_nama($nama_kecamatan)
    {
        $this->db->where('nama_kecamatan', $nama_kecamatan);
        $query = $this->db->get('kecamatan');
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        }
        return null;
    }

    public function get_kecamatan()
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->order_by('nama_kecamatan', 'asc');
        return $this->db->get()->result_array();
    }


    public function tampil_data_filtered($id_kecamatan = null, $bulan_awal = null, $bulan_akhir = null, $tahun = null)
    {
        $this->db->select('r.*, l.alamat_pasang, l.lat, l.long, k.nama_kecamatan, n.nama_nagari');
        $this->db->from('reklame r');
        $this->db->join('reklame_lokasi l', 'r.id_reklame = l.id_reklame');
        $this->db->join('nagari n', 'l.nag_pasang = n.id');
        $this->db->join('kecamatan k', 'l.kec_pasang = k.id');

        if (!empty($id_kecamatan)) {
            $this->db->where('k.id', $id_kecamatan);
        }

        if (!empty($bulan_awal) && !empty($bulan_akhir)) {
            $this->db->where('MONTH(r.tgl_pasang) >=', $bulan_awal);
            $this->db->where('MONTH(r.tgl_pasang) <=', $bulan_akhir);
        } elseif (!empty($bulan_awal)) {
            $this->db->where('MONTH(r.tgl_pasang)', $bulan_awal);
        } elseif (!empty($bulan_akhir)) {
            $this->db->where('MONTH(r.tgl_pasang)', $bulan_akhir);
        }

        if (!empty($tahun)) {
            $this->db->where('YEAR(r.tgl_pasang)', $tahun);
        }

        return $this->db->get()->result_array();
    }

    public function export_tgl($tgl_dari, $tgl_sampai, $ket)
    {
        $this->db->select('*');
        $this->db->from('reklame');
        $this->db->join('kecamatan', 'reklame.kec_pasang=kecamatan.id');
        $this->db->join('nagari', 'reklame.nag_pasang=nagari.id');
        $this->db->where('tgl_input >=', $tgl_dari);
        $this->db->where('tgl_input <=', $tgl_sampai);
        $this->db->where('ket', $ket);
        $query = $this->db->get()->result();
        return $query;
    }

    public function simpanReklame($data)
    {
        $this->db->insert('reklame', $data);
        return $this->db->insert_id();
    }

    public function simpanBanyakLokasi($lokasi)
    {
        $this->db->insert_batch('reklame_lokasi', $lokasi);
    }

    public function updateReklame($id, $data)
    {
        $this->db->where('id_reklame', $id);
        $this->db->update('reklame', $data);
    }

    public function deleteLokasiByReklameId($id_reklame)
    {
        $this->db->where('id_reklame', $id_reklame);
        $this->db->delete('reklame_lokasi');
    }

    public function insertLokasi($data)
    {
        $this->db->insert('reklame_lokasi', $data);
    }
}
