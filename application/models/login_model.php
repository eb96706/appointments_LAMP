<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

     function add_login($users)
     {
         $query = "INSERT INTO users (name, email, password, birthday, created_at, updated_at) VALUES (?,?,?,?,?,?)";
         $values = array($users['name'], $users['email'], $users['password'], $users['birthday'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
         return $this->db->query($query, $values);
     }

     function add_current_appointment($users)
     {
         $query = "INSERT INTO  current_appointments (task, time, status, created_at, updated_at, login_id) VALUES (?,?,?,?,?,?)";
         $values = array($users['task'], $users['time'], $users['status'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), $users['login_id']);
         return $this->db->query($query, $values);
     }

     function add_future_appointment($users)
     {
         $query = "INSERT INTO  future_appointments (task, date, time, created_at, updated_at, login_id) VALUES (?,?,?,?,?,?)";
         $values = array($users['task'], $users['date'], $users['time'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), $users['login_id']);
         return $this->db->query($query, $values);
     }

    function get_student_by_email($email)
   {
       return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
   }

   function get_current_appointment_by_id($id)
   {
       return $this->db->query("SELECT * FROM current_appointments WHERE login_id = ?", array($id))->result_array();
   }

   function get_future_appointment_by_id($id)
   {
       return $this->db->query("SELECT * FROM future_appointments WHERE login_id = ?", array($id))->result_array();
   }

   function delete_current_appointment_by_id($id)
   {
       return $this->db->query("DELETE FROM current_appointments WHERE id = ?", array($id));
   }

   function update_current_appointment($id)
   {
    //    var_dump($_POST);

       $query = "UPDATE current_appointments SET task=?, time=?, status=? WHERE id=$id";
       $values = array($_POST['task'],$_POST['time'], $_POST['status']);
       return $this->db->query($query, $values);
   }
}
?>
