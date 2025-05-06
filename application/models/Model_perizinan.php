<?php

class Model_perizinan extends CI_model
{
    //----Perizinan---//
    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('perizinan');
        $query = $this->db->get();
        return $query;
    }

    public function idmax()
    {
        $this->db->select_max('id_izin', 'idmax');
        $this->db->from('perizinan');
        $query = $this->db->get();
        return $query;
    }

    public function input($data)
    {
        return $this->db->insert('perizinan', $data);
    }

    public function update($data, $id)
    {
        $this->db->where('id_izin', $id);
        return $this->db->update('perizinan', $data);
    }

    public function delete($id_izin)
    {
        $this->db->where('id_izin', $id_izin);
        return $this->db->delete('perizinan');
    }
    //-----Perizinan-----//

    //-----Perizinan_risiko-----//
    public function tampil_data_risiko()
    {
        $this->db->select('*');
        $this->db->from('perizinan_risiko');
        $query = $this->db->get();
        return $query;
    }

    public function input_risiko($data)
    {
        return $this->db->insert('perizinan_risiko', $data);
    }

    public function update_risiko($data, $id)
    {
        $this->db->where('id_izin', $id);
        return $this->db->update('perizinan_risiko', $data);
    }

    public function delete_risiko($id_izin)
    {
        $this->db->where('id_izin', $id_izin);
        return $this->db->delete('perizinan_risiko');
    }
    //-----Perizinan_risiko-----//
}
