<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    //loads the login view
    public function index()
    {
    	// $this->session->sess_destroy();
    	// die();
        // $this->output->enable_profiler(TRUE); //enables the profiler
        $this->load->view('main');

    }

    //processes the student login
    public function login()
    {

        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $this->session->set_userdata('email', $email);
        //var_dump($this->session->all_userdata('email'));

        // $session = $this->session->userdata('name');
        // var_dump($session);

        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");

        if($this->form_validation->run())
        {
                $this->load->model('login_model');
                $query = $this->login_model->get_student_by_email($email);

                if($query['email'] == $email && $query['password'] == md5($password))
                {
                    $user = $this->login_model->get_student_by_email($email);

                    // var_dump($array);
                    //current date
                    //get current appointments
                    //get future appointments
                    //load welcome view

                    $curr_apps = $this->login_model->get_current_appointment_by_id($user['id']);
                    $future_apps = $this->login_model->get_future_appointment_by_id($user['id']);

                    $user['current_apps'] = $curr_apps;
                    $user['future_apps'] = $future_apps;

                    $this->load->view('/welcome', $user);
                }else{
                    echo "INVALID LOGIN";
                     $this->load->view('main');
                }
        }else{
            echo validation_errors();
            $this->load->view('main');
        }
    }


    public function add_appointment()
    {
        $post = $this->input->post();

        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $task = $this->input->post('task');



        $this->load->library("form_validation");
        $this->form_validation->set_rules("date", "Date", "trim|required");
        $this->form_validation->set_rules("time", "Time", "trim|required");
        $this->form_validation->set_rules("task", "Task", "trim|required");

        if($this->form_validation->run())
        {
            $this->load->model("login_model"); //loads the model

            $user_name = $this->session->userdata('email');
            // var_dump($user_name);

            $user = $this->login_model->get_student_by_email($user_name);

            $login_id = $user["id"];

            $temp = array(
                "task" => $task,
                "date" => $date,
                "time" => $time,
                "status" => "Pending",
                "created_at" => date("Y-m-d, H:i:s"),
                "updated_at" => date("Y-m-d, H:i:s"),
                "login_id" => $login_id
            );

            // date_format($date, 'Y-m-d');
            //  var_dump($date);
            $curr_date = date("m-d-Y");
            // var_dump($curr_date);

            $t_stamp1 = strtotime($date);
            $t_stamp2 = strtotime($curr_date);

            if($t_stamp1 == $t_stamp2)
            {
                // var_dump("equal");
                $add_appointment = $this->login_model->add_current_appointment($temp);

            }
            if($t_stamp1 > $t_stamp2)
            {
                // var_dump("future");
                $add_appointment = $this->login_model->add_future_appointment($temp);
            }
        }else{
            $curr_apps = $this->login_model->get_current_appointment_by_id($login_id);
            $future_apps = $this->login_model->get_future_appointment_by_id($login_id);

            $user['current_apps'] = $curr_apps;
            $user['future_apps'] = $future_apps;

            $this->load->view('/welcome', $user);

        }
        // var_dump($user_name);
        $curr_apps = $this->login_model->get_current_appointment_by_id($login_id);
        $future_apps = $this->login_model->get_future_appointment_by_id($login_id);

        $user['current_apps'] = $curr_apps;
        $user['future_apps'] = $future_apps;

        $this->load->view('/welcome', $user);

    }

    public function deleteCurrent($id)
    {
        //loads the model
        $this->load->model("login_model");

        $user_name = $this->session->userdata('email');

        $user = $this->login_model->get_student_by_email($user_name);
        $login_id = $user["id"];


        //query DB and delete
        $delete = $this->login_model->delete_current_appointment_by_id($id);

        // var_dump($user);
        $curr_apps = $this->login_model->get_current_appointment_by_id($login_id);
        $future_apps = $this->login_model->get_future_appointment_by_id($login_id);

        $user['current_apps'] = $curr_apps;
        $user['future_apps'] = $future_apps;

        // var_dump($user);
        $this->load->view('/welcome', $user);
    }

    public function editView($id)
    {
        $array['my_id'] = $id;

        $this->load->view('/edit', $array);
    }

    public function editCurrent($id)
    {
        $this->load->model("login_model");

        $user_name = $this->session->userdata('email');

        $user = $this->login_model->get_student_by_email($user_name);
        $login_id = $user["id"];


        //query DB and update
        $update = $this->login_model->update_current_appointment($id);

        // var_dump($user);
        $curr_apps = $this->login_model->get_current_appointment_by_id($login_id);
        $future_apps = $this->login_model->get_future_appointment_by_id($login_id);

        $user['current_apps'] = $curr_apps;
        $user['future_apps'] = $future_apps;

        $this->load->view('/welcome', $user);
    }


    //register student
    public function register()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cpassword = $this->input->post('confirm_password');
        $birthday = $this->input->post('birthday');

        $this->load->library("form_validation");

        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm password", "trim|required|matches[password]");


        // var_dump($this->form_validation->run() == TRUE);

        if($this->form_validation->run())
        {
           $this->load->model("login_model"); //loads the model
           $temp = array(
                 "name" => $name,
                 "email" => $email,
                 "password" => md5($password),
                 "birthday" => $birthday,
                 "created_at" => date("Y-m-d, H:i:s"),
                 "updated_at" => date("Y-m-d, H:i:s")
            );
            $add_student = $this->login_model->add_login($temp);
        }else{
            echo validation_errors();
        }
        $this->load->view('main');
    }
}
