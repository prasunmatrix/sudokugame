<?php if (!defined('BASEPATH')) EXIT("No direct script access allowed");
require (APPPATH . '/libraries/REST_Controller.php');

class User extends REST_Controller 
{
  function __construct() 
  {
    parent::__construct();
    //$this->load->model('api/Member_Model');
  } 
  
  public function registration_post()
  {

    $user_id     = $this->input->post('user_id'); 
    $name    = $this->input->post('name');
    $email   = $this->input->post('email');
    $contact_no = $this->input->post('contact_no');
    $password = $this->input->post('password');

    if($user_id !='' && $name !='' && $email !='' && $contact_no !='' && $password !='')
    {
        $check_email = $this->db->select("*")->from("user_registration")->where("email", $email)->get()->row();

        $check_mobile = $this->db->select("*")->from("user_registration")->where("contact_no", $contact_no)->get()->row();

        if(!empty($check_email))
        {
            $data['status']    = "Fail";
            $data['message']   = 'Email address already registered';                

            $this->response($data, REST_Controller::HTTP_OK);
        }
        else if(!empty($check_mobile))
        {
            $data['status']    = "Fail";
            $data['message']   = 'Mobile number already registered';

            $this->response($data, REST_Controller::HTTP_OK);
        }
        else
        {
            
            $saved_data['user_id']     = $user_id;
            $saved_data['name']        = $name;
            $saved_data['email']       = $email;
            $saved_data['contact_no']  = $contact_no;
            $saved_data['password']    = base64_encode($password);

            $insert_data = $this->db->insert("user_registration", $saved_data);

            if($insert_data)
            {
                $data['status']    = "Success";
                $data['message']   = 'Registration successfully done';

                $this->response($data, REST_Controller::HTTP_OK);
            }
            else
            {
                $data['status']    = "Fail";
                $data['message']   = 'Something went wrong with insert data';

                $this->response($data, REST_Controller::HTTP_OK);
            }
        }
    }
    else
    {
        $data['status']    = "Fail";
        $data['message']   = 'Please check your parameters750';

        $this->response($data, REST_Controller::HTTP_OK);
        
    }
  die;  
  }
  public function user_login_post()
  {
    echo $user_id = $this->input->post('userid'); 
    $password = base64_encode($this->input->post('password'));
    if($user_id !='' && $password !='')
    {
      $check_user = $this->db->select("*")->from("user_registration")->where("user_id", $user_id)->where("password", $password)->get()->row();
      if(empty($check_user))
      {
          $data['status']    = "Fail";
          $data['message']   = 'Account does not exists';

          $this->response($data, REST_Controller::HTTP_OK);
      }
      else
      {
        $is_active        = $check_user->status;        
        if($is_active == 0)
        {
            $data['status']    = "Fail";
            $data['message']   = 'Your account is not activate';

            $this->response($data, REST_Controller::HTTP_OK);
        }
        else
        {     
          $userdata = array(
              'name'        => $check_user->name,
              'email'       =>$check_user->email,
              'contact_no'  => $check_user->contact_no,
          );

          $data['status']   = "Success";
          $data['message']  = 'Login successfully done';
          $data['response'] = $userdata;

          $this->response($data, REST_Controller::HTTP_OK);
            
        }                
      }
    }
    else
    {
        $data['status']    = "Fail1234";
        $data['message']   = 'Please check your parameters5554';

        $this->response($data, REST_Controller::HTTP_OK);
    }
  }

  function index_get()
  {
    echo 'test';
  }
}  