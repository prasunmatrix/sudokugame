<?php if (!defined('BASEPATH')) EXIT("No direct script access allowed");
require (APPPATH . '/libraries/REST_Controller.php');

class Member extends REST_Controller 
{
  function __construct() 
  {
    parent::__construct();
    //$this->load->model('api/Member_Model');
  } 
  
  // public function index(){
  //   echo "test";
  // }
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
        $data['message']   = 'Please check your parameters';

        $this->response($data, REST_Controller::HTTP_OK);
        
    }  
  }
  public function user_login_post()
  {
    $user_id = $this->input->post('user_id'); 
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
          //echo json_encode($data, REST_Controller::HTTP_OK);  
        }                
      }
    }
    else
    {
        $data['status']    = "Fail";
        $data['message']   = 'Please check your parameters';

        $this->response($data, REST_Controller::HTTP_OK);
    }
  }
  public function game_finalised_post()
  {
    $user_id = $this->input->post('user_id'); 
    $game_id= $this->input->post('game_id');
    $board_id=$this->input->post('board_id');
    $mode=$this->input->post('mode');
    $per_board_time=$this->input->post('per_board_time');

    if($user_id !='' && $game_id !='' && $board_id!='' && $mode!='' && $per_board_time!='')
    {
      $check_user = $this->db->select("*")->from("user_registration")->where("user_id", $user_id)->get()->row();
      if(empty($check_user))
      {
          $data['status']    = "Fail";
          $data['message']   = 'User does not exists';

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
          $gamedata = array(
              'user_id'=> $user_id,
              'game_id'=>$game_id,
              'board_id'=>$board_id,
              'mode'=>$mode,
              'per_board_time'=>$per_board_time
          );

          $insert_data = $this->db->insert("game_finalised", $gamedata);
          if($insert_data)
          {
            $data['status']   = "Success";
            $data['message']  = 'Game successfully started';
            $this->response($data, REST_Controller::HTTP_OK);
          }
          else
          {
            $data['status']   = "Fail";
            $data['message']  = 'Something went wrong with insert data';
            $this->response($data, REST_Controller::HTTP_OK);
          }
            
        }                
      }
    }
    else
    {
        $data['status']    = "Fail";
        $data['message']   = 'Please check your parameters';

        $this->response($data, REST_Controller::HTTP_OK);
    }
  }
  public function game_cancel_post()
  {
    $user_id = $this->input->post('user_id'); 
    $game_id= $this->input->post('game_id');
    $time=$this->input->post('time');
    $difficulty=$this->input->post('difficulty');
    $game_state=$this->input->post('game_state');

    if($user_id !='' && $game_id !='' && $time !='' && $difficulty !='' && $game_state !='')
    {
      $check_user = $this->db->select("*")->from("game_finalised")->where("user_id", $user_id)->get()->row();
      $check_game = $this->db->select("*")->from("game_finalised")->where("game_id", $game_id)->get()->row();
      $check_game_played_user = $this->db->select("*")->from("game_finalised")->where("user_id", $user_id)->where("game_id", $game_id)->get()->row();

      if(empty($check_user))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This user not played any game or user does not exists';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else if(empty($check_game))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This game id does not exists';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else if(empty($check_game_played_user))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This  user not played this game';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else
      {     
        $gamecanceldata = array(
            'user_id'=> $user_id,
            'game_id'=>$game_id,
            'time'=>$time,
            'difficulty'=>$difficulty,
            'game_state'=>$game_state
        );

        $insert_data = $this->db->insert("game_cancel", $gamecanceldata);
        if($insert_data)
        {
          $data['status']   = "Success";
          $data['message']  = 'Game pause data successfully inserted';
          $this->response($data, REST_Controller::HTTP_OK);
        }
        else
        {
          $data['status']   = "Fail";
          $data['message']  = 'Something went wrong with insert data';
          $this->response($data, REST_Controller::HTTP_OK);
        }                  
      }
    }
    else
    {
        $data['status']    = "Fail";
        $data['message']   = 'Please check your parameters';

        $this->response($data, REST_Controller::HTTP_OK);
    }
  }
  public function game_win_post()
  {
    $user_id = $this->input->post('user_id'); 
    $game_id= $this->input->post('game_id');
    $score= $this->input->post('score');
    $num_mistakes= $this->input->post('num_mistakes');
    $game_completed_marks= $this->input->post('game_completed_marks');

    if($user_id !='' && $game_id !='' && $score!='' && $num_mistakes!='' && $game_completed_marks!='')
    {
      $check_user = $this->db->select("*")->from("game_finalised")->where("user_id", $user_id)->get()->row();
      $check_game = $this->db->select("*")->from("game_finalised")->where("game_id", $game_id)->get()->row();
      $check_game_played_user = $this->db->select("*")->from("game_finalised")->where("user_id", $user_id)->where("game_id", $game_id)->get()->row();

      if(empty($check_user))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This user not played any game or user does not exists';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else if(empty($check_game))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This game id does not exists';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else if(empty($check_game_played_user))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This  user not played this game';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else
      { 
        $game_finalised_update=$this->db->where('user_id',$user_id)->where('game_id',$game_id)->update('game_finalised',array('game_state'=>'1','score'=>$score,'num_mistakes'=>$num_mistakes,'game_completed_marks'=>$game_completed_marks));
        if($game_finalised_update) 
        {   
          $gamewindata = array(
              'user_id'=> $user_id,
              'game_id'=>$game_id,
              
          );

          $insert_data = $this->db->insert("current_best_win_streak", $gamewindata);
          if($insert_data)
          {
            $data['status']   = "Success";
            $data['message']  = 'Game win data successfully inserted';
            $this->response($data, REST_Controller::HTTP_OK);
          }
          else
          {
            $data['status']   = "Fail";
            $data['message']  = 'Something went wrong with insert data';
            $this->response($data, REST_Controller::HTTP_OK);
          }
        }
        else
        {
          $data['status']   = "Fail";
          $data['message']  = 'Something went wrong with update table';
          $this->response($data, REST_Controller::HTTP_OK);
        }                    
      }
    }
    else
    {
        $data['status']    = "Fail";
        $data['message']   = 'Please check your parameters';

        $this->response($data, REST_Controller::HTTP_OK);
    }
  }
  public function game_lost_post()
  {
    $user_id = $this->input->post('user_id'); 
    $game_id= $this->input->post('game_id');
    $score= $this->input->post('score');
    $num_mistakes= $this->input->post('num_mistakes');
    $game_completed_marks= $this->input->post('game_completed_marks');

    if($user_id !='' && $game_id !='' && $score!='' && $num_mistakes!='' && $game_completed_marks!='')
    {
      $check_user = $this->db->select("*")->from("game_finalised")->where("user_id", $user_id)->get()->row();
      $check_game = $this->db->select("*")->from("game_finalised")->where("game_id", $game_id)->get()->row();
      $check_game_played_user = $this->db->select("*")->from("game_finalised")->where("user_id", $user_id)->where("game_id", $game_id)->get()->row();

      if(empty($check_user))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This user not played any game or user does not exists';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else if(empty($check_game))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This game id does not exists';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else if(empty($check_game_played_user))
      {
        $data['status']    = "Fail";
        $data['message']   = 'This  user not played this game';

        $this->response($data, REST_Controller::HTTP_OK);
      }
      else
      { 
        $game_finalised_update=$this->db->where('user_id',$user_id)->where('game_id',$game_id)->update('game_finalised',array('game_state'=>'2','score'=>$score,'num_mistakes'=>$num_mistakes,'game_completed_marks'=>$game_completed_marks));
        if($game_finalised_update) 
        {   
          $data['status']   = "Success";
          $data['message']  = 'Game lost data successfully updated';
          $this->response($data, REST_Controller::HTTP_OK);
        }
        else
        {
          $data['status']   = "Fail";
          $data['message']  = 'Something went wrong with update table';
          $this->response($data, REST_Controller::HTTP_OK);
        }                    
      }
    }
    else
    {
        $data['status']    = "Fail";
        $data['message']   = 'Please check your parameters';

        $this->response($data, REST_Controller::HTTP_OK);
    }
  }
}  