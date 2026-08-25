<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_events($search = NULL) {
        return $this->get_paginated_events($search, 'all', 'start_date_asc', 1000, 0)['events'];
    }

    public function get_paginated_events($search = NULL, $filter = 'all', $sort = 'start_date_asc', $limit = 6, $offset = 0, $user_id = NULL) {
        $this->db->reset_query();

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('description', $search);
            $this->db->or_like('location', $search);
            $this->db->group_end();
        }

        // Apply Sorting
        if ($sort === 'name_asc') {
            $this->db->order_by('name', 'ASC');
        } elseif ($sort === 'name_desc') {
            $this->db->order_by('name', 'DESC');
        } elseif ($sort === 'start_date_desc') {
            $this->db->order_by('start_date', 'DESC');
        } else {
            $this->db->order_by('start_date', 'ASC');
        }

        $all_events = $this->db->get('events')->result();

        // Attach Quotas, Approval Bands, and Registrations
        $filtered = array();
        foreach ($all_events as $event) {
            $event->quotas = $this->Quota_model->get_quotas_by_event($event->id);
            $event->approval_bands = $this->Approval_model->get_bands_by_event($event->id);
            $event->registrations = $this->Registration_model->get_registrations_by_event($event->id);

            // Compute overall utilization
            $totalCap = 0;
            if (!empty($event->quotas)) {
                foreach ($event->quotas as $q) {
                    $totalCap += (int)$q->quota_limit;
                }
            }
            $activeRegs = 0;
            $is_registered = false;
            if (!empty($event->registrations)) {
                foreach ($event->registrations as $r) {
                    if ($r->status !== 'rejected') $activeRegs++;
                    if ($user_id && $r->user_id == $user_id) {
                        $is_registered = true;
                    }
                }
            }
            $pct = $totalCap > 0 ? min(100, round(($activeRegs / $totalCap) * 100)) : 0;
            $event->utilization_pct = $pct;
            $event->total_capacity = $totalCap;
            $event->active_regs = $activeRegs;

            // Apply filter
            if ($filter === 'registered') {
                if ($is_registered) {
                    $filtered[] = $event;
                }
            } elseif ($filter === 'critical' || $filter === 'high_demand' || $filter === 'waitlist_open') {
                if ($pct >= 90) {
                    $filtered[] = $event;
                }
            } elseif ($filter === 'healthy' || $filter === 'available' || $filter === 'seats_available') {
                if ($pct < 90) {
                    $filtered[] = $event;
                }
            } else {
                $filtered[] = $event;
            }
        }

        $total_records = count($filtered);
        $paged_events = array_slice($filtered, $offset, $limit);

        return array(
            'events' => $paged_events,
            'total' => $total_records
        );
    }

    public function get_event($id) {
        $event = $this->db->get_where('events', array('id' => $id))->row();
        if ($event) {
            $event->quotas = $this->Quota_model->get_quotas_by_event($event->id);
            $event->approval_bands = $this->Approval_model->get_bands_by_event($event->id);
            $event->registrations = $this->Registration_model->get_registrations_by_event($event->id);
        }
        return $event;
    }

    public function create_event($data) {
        $this->db->insert('events', $data);
        return $this->db->insert_id();
    }

    public function update_event($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('events', $data);
    }

    public function delete_event($id) {
        return $this->db->delete('events', array('id' => $id));
    }
}
