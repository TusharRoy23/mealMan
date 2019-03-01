<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_model extends CI_Model {

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function countAll($table, $con = FALSE, $group = FALSE) {
        $this->db->from($table);

        if ($con)
            $this->db->where($con);

        if ($group)
            $this->db->group_by($group);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getAllData($table, $con = FALSE, $group = FALSE, $order = FALSE, $type='') {
        $this->db->from($table);

        if ($con)
            $this->db->where($con);

        if ($group)
            $this->db->group_by($group);

        if($order)
            $this->db->order_by($order, $type);

        $query = $this->db->get();

        if ($this->db->affected_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getById($table, $id) {
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($this->db->affected_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function getByCon($table, $con) {
        $this->db->from($table);
        $this->db->where($con);
        $query = $this->db->get();

        if ($this->db->affected_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function saveData($table, $data) {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function saveBatchData($table, $data) {
        $this->db->insert_batch($table, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function addActivityLog($actyp, $tnstyp, $trnsno, $memo = FALSE) {
        $actlog['acttype'] = $actyp;
        $actlog['userid'] = userStorageData()->id;
        $actlog['transtype'] = $tnstyp;
        $actlog['transno'] = $trnsno;
        $actlog['note'] = $memo;
        $actlog['actip'] = $_SERVER['REMOTE_ADDR'];
        $actlog['acttime'] = date('Y-m-d H:i:s');

        $this->db->insert('activity_log', $actlog);
        return TRUE;
    }

    public function updateData($table, $where, $data) {
        $this->db->update($table, $data, $where);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function inactiveById($table, $id) {
        $this->db->update($table, array('status' => 0), array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function inactiveByCon($table, $con) {
        $this->db->update($table, array('status' => 0), $con);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function activeById($table, $id) {
        $this->db->update($table, array('status' => 1), array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function activeByCon($table, $con) {
        $this->db->update($table, array('status' => 1), $con);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteById($table, $id) {
        $this->db->update($table, array('status' => 0), array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteByCon($table, $con) {
        $this->db->update($table, array('status' => 0), $con);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function comboBox($table, $valfield, $datafield, $condition = NULL, $selectnull = TRUE) {
        $this->db->select($valfield);
        $this->db->select($datafield);
        $this->db->from($table);

        if ($condition != NULL) {
            $this->db->where($condition);
        }

        $query = $this->db->get();
        $result = $query->result();

        if ($this->db->affected_rows() > 0) {
            $combo_array = array();
            if ($selectnull) {
                $combo_array[] = 'Select';
            }
            foreach ($result as $arr) {
                $combo_array[$arr->$valfield] = $arr->$datafield;
            }

            return $combo_array;
        } else {
            return FALSE;
        }
    }

    public function getByQuery($query)
    {
    	$result = $this->db->query($query);

    	if ($result->num_rows() > 0) {
    		return $result->result_array();
    	} else {
    		return 0;
    	}
    }

    public function getSingleByQuery($query)
    {
        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return 0;
        }
    }

    public function updateQuery($query)
    {
        $this->db->query($query);
        if ($this->db->affected_rows()) {
            return TRUE;
        }
        else
            return FALSE;
    }

    public function getSingleData($table, $con = FALSE, $group = FALSE, $order = FALSE, $type='') {
        $this->db->from($table);

        if ($con)
            $this->db->where($con);

        if ($group)
            $this->db->group_by($group);

        if($order)
            $this->db->order_by($order, $type);

        $query = $this->db->get();

        if ($this->db->affected_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function getTableId($customId, $dbName)
    {
        $this->db->select('id');
        $this->db->where('customId', $customId);
        $query = $this->db->get($dbName);

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        else
            return 0;
    }
}

/* End of file Index_model.php */
/* Location: ./application/models/Index_model.php */