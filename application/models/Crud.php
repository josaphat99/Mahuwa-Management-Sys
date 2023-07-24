<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model
{
    public function get_data($table, $clause=[],$ordre=null,$limit=null)
	{ 
        $this->db->order_by($ordre);
		$this->db->limit($limit);
        $this->db->where($clause);
        return $this->db->get($table)->result();
	}
	
	public function get_data_desc($table,$clause=[],$limit=null)
	{
		$this->db->order_by('id','DESC');
        $this->db->limit($limit);
        $this->db->where($clause);
        return $this->db->get($table)->result();
	}

	public function add_data($table, $data){
		$this->db->insert($table, $data);
	}

	public function delete_data($table, $clause)
	{
		$this->db->where($clause);
		$this->db->delete($table);
	}

	public function update_data($table, $clause, $data)
	{
		$this->db->where($clause);
		$this->db->update($table, $data);
	}

    public function join_data($table,$table2,$join,$order,$sens,$clause=[],$limit=null)
    {
        $this->db->select("*,".$table.'.id as id')
                 ->from($table)
                 ->join($table2,$join)
                 ->order_by($order,$sens)
                 ->limit($limit)
                 ->where($clause);

        return $this->db->get()->result();
    }

	//join account and student

	public function join_account_student($option_id)
	{
		$this->db->select("*, account.id as id, student.id as id_student")
				 ->from('account')
				 ->join('student','account.student_id = student.id')
				 ->order_by('account.id','DESC')
				 ->where(['role'=>'student','student.option_id'=>$option_id]);
		
		return $this->db->get()->result();
	}

	
	//join equipment, category

	public function join_equipment_category($category=null,$limit=null)
	{
		$where = null;

		
		$this->db->select("*, equipment.id as id, category_equipment.id as id_category")
				 ->from('equipment')
				 ->join('category_equipment','equipment.category_id = category_equipment.id')
				 ->order_by('equipment.id','DESC')
				 ->limit($limit);
		
		if($category != null)
		{
			$this->db->where(['category'=>$category]);
		}
		
		return $this->db->get()->result();
	}

	//join store requisition, equipment, department

	public function join_storereq_ep_dept($department_id=null,$req_status=null,$limit=null)
	{		
		$this->db->select("*, store_requisition.id as id, store_requisition.quantity as st_quantity, equipment.id as id_equipment,equipment.quantity as eq_quantity, department.id as id_department")
				 ->from('store_requisition')
				 ->join('equipment','store_requisition.equipment_id = equipment.id')
				 ->join('department','store_requisition.department_id = department.id')
				 ->order_by('store_requisition.id','DESC')
				 ->limit($limit);

		if($department_id != null)
		{
			$this->db->where(['department.id'=>$department_id]);
		}
		if($req_status != null)
		{
			$this->db->where(['store_requisition.status' => $req_status]);
		}
		
		return $this->db->get()->result();
	}

	//join mouvement, equipment

	public function join_mouvement_equipment($equipment_id=null,$type=null,$limit=null)
	{
		$where = null;

		$this->db->select("*, mouvement_equipment.id as id,mouvement_equipment.quantity as quantity, equipment.id as id_equipment,  equipment.quantity as eq_quantity")
				 ->from('mouvement_equipment')
				 ->join('equipment','mouvement_equipment.equipment_id = equipment.id')
				 ->order_by('mouvement_equipment.id','DESC')
				 ->limit($limit);
		
		if($equipment_id != null)
		{
			$this->db->where(['equipment_id'=>$equipment_id]);
		}

		if($type != null)
		{
			$this->db->where(['type'=>$type]);
		}
		
		return $this->db->get()->result();
	}

	public function join_pch_st_eq($eq_id=null,$department_id=null,$limit=null,$status=null)
	{
		$this->db->select("*, purchase_order.id as id,purchase_order.date as date,purchase_order.status as status, store_requisition.status as st_status, store_requisition.date as st_date,store_requisition.id as st_id, equipment.id as id_equipment")
				 ->from('purchase_order')
				 ->join('store_requisition','purchase_order.store_requisition_id = store_requisition.id')
				 ->join('curency','purchase_order.curency_id = curency.id')
				 ->join('equipment','store_requisition.equipment_id = equipment.id')
				 ->join('department','department.id = store_requisition.department_id')
				 ->order_by('purchase_order.id','DESC')
				 ->limit($limit);
		
		if($eq_id != null)
		{
			$this->db->where(['equipment.id'=>$eq_id]);
		}

		if($department_id != null)
		{
			$this->db->where(['department.id'=>$department_id]);
		}

		if($status != null)
		{
			$this->db->where(['purchase_order.status'=>$status]);
		}
		
		return $this->db->get()->result();
	}
}  
