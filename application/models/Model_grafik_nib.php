<?php

class Model_grafik_nib extends CI_model
{

    // -----------------------------Grafik NIB----------------------------- //
    public function tampil_data_nib()
    {
        $this->db->select('*');
        $this->db->from('grafik_nib_pmdn');
        $query = $this->db->get();
        return $query;
    }

    public function input_nib($data)
    {
        return   $this->db->insert('grafik_nib_pmdn', $data);
    }

    public function update_nib($data, $id)
    {
        $this->db->where('id_grafik', $id);
        return  $this->db->update('grafik_nib_pmdn', $data);
    }

    public function get_by_id_nib($id_grafik)
    {
        return $this->db->get_where('grafik_nib_pmdn', ['id_grafik' => $id_grafik])->row();
    }

    public function delete_nib($id_grafik)
    {
        $this->db->where('id_grafik', $id_grafik);
        return  $this->db->delete('grafik_nib_pmdn');
    }
    // -----------------------------Grafik NIB----------------------------- //

    // -----------------------------Grafik Risiko----------------------------- //
    public function tampil_data_risiko()
    {
        $this->db->select('*');
        $this->db->from('grafik_risiko');
        $query = $this->db->get();
        return $query;
    }

    public function input_risiko($data)
    {
        return  $this->db->insert('grafik_risiko', $data);
    }

    public function update_risiko($data, $id)
    {
        $this->db->where('id_grafik', $id);
        return   $this->db->update('grafik_risiko', $data);
    }

    public function get_by_id_risiko($id_grafik)
    {
        return $this->db->get_where('grafik_risiko', ['id_grafik' => $id_grafik])->row();
    }

    public function delete_risiko($id_grafik)
    {
        $this->db->where('id_grafik', $id_grafik);
        return  $this->db->delete('grafik_risiko');
    }
    // -----------------------------Grafik Risiko----------------------------- //

    // -----------------------------Grafik Kecamatan----------------------------- //
    public function tampil_data_kecamatan()
    {
        $this->db->select('*');
        $this->db->from('grafik_proyekkec');
        $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function input_kecamatan($data)
    {
        return $this->db->insert('grafik_proyekkec', $data);
    }

    public function update_kecamatan($data, $id)
    {
        $this->db->where('id_grafik', $id);
        return   $this->db->update('grafik_proyekkec', $data);
    }

    public function get_by_id_kecamatan($id_grafik)
    {
        return $this->db->get_where('grafik_proyekkec', ['id_grafik' => $id_grafik])->row();
    }

    public function delete_kecamatan($id_grafik)
    {
        $this->db->where('id_grafik', $id_grafik);
        return  $this->db->delete('grafik_proyekkec');
    }
    // -----------------------------Grafik Kecamatan----------------------------- //

    // -----------------------------Grafik KBLI----------------------------- //
    public function tampil_data_kbli()
    {
        $this->db->select('*');
        $this->db->from('grafik_kbli');
        $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function input_kbli($data)
    {
        return $this->db->insert('grafik_kbli', $data);
    }

    public function update_kbli($data, $id)
    {
        $this->db->where('id_grafik', $id);
        return  $this->db->update('grafik_kbli', $data);
    }

    public function get_by_id_kbli($id_grafik)
    {
        return $this->db->get_where('grafik_kbli', ['id_grafik' => $id_grafik])->row();
    }

    public function delete_kbli($id_grafik)
    {
        $this->db->where('id_grafik', $id_grafik);
        return $this->db->delete('grafik_kbli');
    }
    // -----------------------------Grafik KBLI----------------------------- //

    public function tampil_data_periode()
    {
        $this->db->select('*');
        $this->db->from('periode_grafik_oss');
        $query = $this->db->get();
        return $query;
    }

    public function update_periode($data, $id)
    {
        $this->db->where('id_periode', $id);
        return $this->db->update('periode_grafik_oss', $data);
    }
}
