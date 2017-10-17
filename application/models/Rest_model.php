<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class rest_model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	function insert($table, $data) {
		return $this->db->insert($table, $data);
	}

	function update($table, $id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}

	function read($table, $id) {
		$query = $this->db->where(['id' => $id, 'deleted' => 0])
					->get($table);
		return $query->result();
	}

	function readAll($table) {
		$query = $this->db->where('deleted', 0)->get($table);
		return $query->result();
	}

	function readAllOrder($table, $order) {
		$query = $this->db->where('deleted', 0)->order_by($order)->get($table);
		return $query->result();
	}

	function searchCalendarMaster($id) {
		$query = $this->db->where(['room_type_id' => $id, 'deleted' => 0])->where('date_to >=', date('Y-m-d'))->order_by('date_from')->get('room_calendars_master');
		return $query->result();
	}

	function verifyDatesRate($type, $fechaInic, $fechaFin){
		$query = $this->db->where('day BETWEEN \''.date('Y-m-d', strtotime($fechaInic)).'\' AND \''.date('Y-m-d', strtotime($fechaFin)).'\'')->where(['room_type_id' => $type, 'deleted' => 0])->get('room_calendars');
		return $query->num_rows();
	}

	function insertRate($data) {
		$this->db->insert('room_calendars_master', $data);
		$master = $this->db->insert_id();

		$i = 0;
		$fecha = $data['date_from'];

		while (strtotime($fecha) <= strtotime($data['date_to'])) {

			$data_fecha = array(
				'master_id' => $master,
				'room_type_id' => $data['room_type_id'],
				'rate' => $data['rate'],
				'day' => $fecha,
				'created_at' => $data['created_at'],
				'updated_at' => $data['updated_at'],
			);
			$this->db->insert('room_calendars', $data_fecha);

			$fecha = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));
			$i++;
		}
		return $i;
	}

	function updateRate($id, $data) {
		$dataUpdate = array(
			'rate' => $data['rate'],
			'updated_at' => $data['updated_at']
			);

		$this->db->where('id', $id)->update('room_calendars_master', $dataUpdate);
		return $this->db->where('master_id', $id)->update('room_calendars', $dataUpdate);
	}

	function deleteRate($id, $data) {
		$this->db->where('id', $id)->update('room_calendars_master', $data);
		return $this->db->where('master_id', $id)->update('room_calendars', $data);
	}

	function selectAllRoomTypes($min_occupancy, $date_from, $date_to) {
		$this->db->select('rt.id, rt.name, rt.base_price, rt.description, rt.main_picture, rt.base_availability, rt.max_occupancy')
					->from('room_types rt')
					->where(['rt.max_occupancy >=' => $min_occupancy, 'deleted' => 0])
					->order_by('rt.max_occupancy ASC, base_price ASC');
		$query = $this->db->get();
		$datos = $query->result_array();

		for ($i=0; $i < count($datos); $i++) {
			$datos[$i]['disponibles'] = $datos[$i]['base_availability'];
			$fecha = date('Y-m-d', strtotime($date_from));
			$fecha_fin = date("Y-m-d", strtotime("-1 day", strtotime($date_to)));

			while (strtotime($fecha) <= strtotime($fecha_fin)){
				$bus = $this->db->from('reservation_nights')
									->where(['room_type_id' => $datos[$i]['id'], 'day' => $fecha, 'status <' => 9])
									->get();
				/*if ($bus->num_rows() == $datos[$i]['base_availability']){
					//unset($datos[$i]);
					break;
				} */if ($datos[$i]['disponibles'] > ($datos[$i]['base_availability'] - $bus->num_rows())){
					$datos[$i]['disponibles'] = ($datos[$i]['base_availability'] - $bus->num_rows());
				}
				$fecha = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));
			}
		}

		return $datos;
	}

	function searchTarifa($room_id, $start_date, $end_date) {
		$rates = array();
		$this->db->select('day, rate')
					->from('room_calendars')
					->where('room_type_id', $room_id)
					->where('day >=', $start_date)
					->where('day <', $end_date)
					->order_by('day');
		$query = $this->db->get();

		foreach ($query->result() as $row) {
			$rates[$row->day] = $row->rate;
		}

		return $rates;
	}

	function selectRoomById($room_id) {
		$this->db->select('rt.id, rt.name, rt.base_price, rt.description, rt.terms, rt.short_name')
					->from('room_types rt')
					->where('rt.id', $room_id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function check_customer($customer_email) {
		$query = $this->db->where(['email' => $customer_email])
					->get('customers');
		return $query;
	}

	function maxOcuppancy() {
		$this->db->select_max('max_occupancy');
		$result = $this->db->get('room_types')->row();  
		return $result->max_occupancy;
	}

	function create_reservation($table, $data, $tarifas, $room_id) {
		$query = $this->db->insert($table, $data);
		$last_id = $this->db->insert_id();
		$tarifas = json_decode($tarifas, true);

		$fecha = $data['checkin'];
		while (strtotime($fecha) <= strtotime($data['checkout'])) {
			if (isset($tarifas[$fecha])){
				$data_insert = array(
					'rate' => $tarifas[$fecha],
					'day' => $fecha,
					'room_type_id' => $room_id,
					'reservation_id' => $last_id,
					);
				$this->db->insert('reservation_nights', $data_insert);
			}
			$fecha = date("Y-m-d", strtotime("+1 day", strtotime($fecha)));
		}

		return $query;
	}

	function bookedHab($date){
		$query = $this->db->select('r.day, h.name, c.first_name, c.last_name, v.checkin, v.checkout, v.occupancy')
						->from('reservation_nights r')
						->join('room_types h', 'h.id = r.room_type_id', 'left')
						->join('reservations v', 'v.id = r.reservation_id', 'left')
						->join('customers c', 'c.id = v.customer_id', 'left')
						->where(['r.day' => $date, 'r.status <' => 9])
						->get();

		return $query->result();
	}

	function availableHab($date){
		$this->db->select('rt.id, rt.name, rt.base_price, rt.max_occupancy, rt.base_availability, rt.base_availability AS disponibles, \''.$date.'\' AS day')
					->from('room_types rt')
					->where(['deleted' => 0])
					->order_by('rt.max_occupancy ASC, base_price ASC');
		$query = $this->db->get();
		$datos = $query->result_array();

		for ($i=0; $i < count($datos); $i++) {
				$bus = $this->db->from('reservation_nights')
									->where(['room_type_id' => $datos[$i]['id'], 'day' => $date, 'status <' => 9])
									->get();
				if ($bus->num_rows() == $datos[$i]['base_availability']){
					unset($datos[$i]);
					break;
				} if ($datos[$i]['disponibles'] > ($datos[$i]['base_availability'] - $bus->num_rows())){
					$datos[$i]['disponibles'] = ($datos[$i]['base_availability'] - $bus->num_rows());
				}
		}

		return array_merge($datos);
	}

	function costHab($date_ini, $date_fin){
		$this->db->select('rt.id, rt.name, rt.base_price, rt.max_occupancy, rt.base_availability, rt.base_availability AS disponibles, \''.$date_ini.' - '.$date_fin.'\' AS day')
					->from('room_types rt')
					->where(['deleted' => 0])
					->order_by('rt.max_occupancy ASC, base_price ASC');
		$query = $this->db->get();
		$datos = $query->result_array();

		for ($i=0; $i < count($datos); $i++) {
				$bus = $this->db->select_sum('rate')
									->from('reservation_nights')
									->where(['room_type_id' => $datos[$i]['id'], 'status <' => 9])
									->where('day BETWEEN \''.$date_ini.'\' AND \''.$date_fin.'\'')
									->get();

				$res = $bus->result();

				if (!empty($res[0]->rate)){
					$datos[$i]['total'] = $res[0]->rate;
				} else {
					$datos[$i]['total'] = 0;
				}
		}

		return $datos;
	}
}