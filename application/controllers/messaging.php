<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Messaging extends CI_Controller{

        public function index(){
            $this->load->library('session');
            if($this->session->userdata('userId')){
                redirect('user');
            }elseif($this->session->userdata('adminId')){
                redirect('admin');
            }
            else{
                    $data['title'] = 'Login';
                    $this->load->view('messaging/login',$data);
                }
        }

        public function load_register(){
            $this->load->library('session');
            if($this->session->userdata('userId')){
                redirect('user');
            }elseif($this->session->userdata('adminId')){
                redirect('admin');
            }
            else{
                $data['title'] = 'Register';
                $this->load->view('messaging/register',$data);
                }
        }

        public function login(){
            $data= array(
                'email'=>$this->input->post('email'),
                'password'=>do_hash($this->input->post('password')),
            );
            $this->db->where('email',$data['email']);
                    $query = $this->db->get('users');
                    if ($query->num_rows() === 0){
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Email Does Not Exist !!');
                        window.location.href='/messaging';
                        </script>");
                        exit();
                    }elseif($query->num_rows() > 0){
                        foreach($query->result() as $row){
                            if($data['password'] !== $row->password){
                                echo ("<script LANGUAGE='JavaScript'>
                                window.alert('Wrong Password !!');
                                window.location.href='/messaging';
                                </script>");
                                exit(); 
                            }else{
                                if($row->status != 0){
                                    $user_session = array(
                                        'userTitle'=>'Admin Panel',
                                        'adminId'=> random_string('sha1'),
                                        'userName'=>$row->name,
                                        'userEmail'=>$row->email,
                                        'userPassword'=>$row->password,
                                        'userStatus'=>$row->status,
                                    );
                                    $this->session->set_userdata($user_session);
                                    redirect('admin');
                                }else{
                                    $user_session = array(
                                        'userTitle'=>'User Panel',
                                        'userId'=>random_string('sha1'),
                                        'userName'=>$row->name,
                                        'userEmail'=>$row->email,
                                        'userPassword'=>$row->password,
                                        'userStatus'=>$row->status,
                                    );
                                    $this->session->set_userdata($user_session);
                                    redirect('user');
                                }   
                            }                            
                            }
                    }
        }

        public function register(){
                $data = array(
                    'name'=> $this->input->post('name'),
                    "email" => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'confirmpassword'=>$this->input->post('confirmpassword'),
                    'status'=>0
                );
    
                if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Please enter a valid email');
                    window.location.href='/messaging/load_register';
                    </script>");
                    exit();
                }elseif($data['password'] !== $data['confirmpassword']){
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Passwords do not match !!');
                    window.location.href='/messaging/load_register';
                    </script>");
                    exit();
                }else{
                    $this->db->where('email',$data['email']);
                    $query = $this->db->get('users');
                    if ($query->num_rows() > 0){
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Email Already Exist');
                        window.location.href='/messaging/load_register';
                        </script>");
                        exit();
                    }
                    else{
                    // $this->load->model('messaging_model');
                        if($this->messaging_model->signup($data)){
                            echo ("<script LANGUAGE='JavaScript'>
                            window.alert('Successfully Registered');
                            window.location.href='/messaging';
                            </script>");
                            exit();
                        }else{
                            echo 'User Addition Failed';
                        }
                    }
    
                }
        }

        public function admin(){
            $this->load->library('Session');
            if($this->session->userdata('adminId')){
                $this->load->view('/messaging/adminPanel',$this->session->userdata('userId','userTitle','userName'));
            }elseif($this->session->userdata('userId')){
                redirect('user');
            }
            else{
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Please Login First');
                window.location.href='/messaging';
                </script>");
            }
        }
        
        public function user(){
            $this->load->library('session');
            if($this->session->userdata('userId')){
                $this->load->view('/messaging/userPanel',$this->session->userdata('userId','userTitle','userName'));
            }elseif($this->session->userdata('adminId')){
                redirect('admin');
            }
            else{
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Please Login First');
                    window.location.href='/messaging';
                    </script>");
                }
        }

        public function logout(){
            $this->session->unset_userdata('userId');
            $this->session->unset_userdata('adminId');
            redirect('/');
        }

        public function load_addSMS(){
            $this->load->library('session');
            if($this->session->userdata('userId')){
                $data['title'] = 'Add SMS';
                $this->load->view('messaging/addSMS',$data);
            }else{
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Please Login First');
                    window.location.href='/messaging';
                    </script>");
                }
        }

        public function addSMS(){
            $data = array(
                'processid'=> random_string('sha1'),
                'name'=> $this->session->userdata('userName'),
                'email'=>$this->session->userdata('userEmail'),
                'schoolname' => $this->input->post('schoolname'),
                'totalsms'=> $this->input->post('totalsms'),
                'status'=>0,
            );

            if($this->messaging_model->addSMS($data)){
                // if($this->session->userdata('status') !== 0){
                //     $url = 'admin';
                // }else{
                //     $url = 'user';
                // }
                    
                $this->db->where('status',1);
                $query = $this->db->get('users');
                $admins = [];
                if ($query->num_rows() === 0){
                    echo ("<script LANGUAGE='JavaScript'>
                     window.alert('There is no Admin !!');
                     window.location.href='/messaging';
                     </script>");
                    exit();
                }elseif($query->num_rows() > 0){
                    foreach($query->result() as $row){
                        array_push($admins,$row->email);
                    }
                }
                
                $this->load->library('email');
                $message = "$data[name] has sent a new SMS request for approval \r\nSchool Name : $data[schoolname] \r\nSMS: $data[totalsms]";
                $this->email->from('rahul.baghla1707@gmail.com', 'Rahul Baghla');
                $this->email->to(implode(', ', $admins));
                $this->email->subject('Confirmation Email');
                $this->email->message($message);
        
                if($this->email->send()){
                    echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Request Submitted Successfully');
                        window.location.href='/messaging/user';
                        </script>");
                }else{
                    echo "Failed to send email";
                    show_error($this->email->print_debugger());             
                }
            }    
        }   

        public function processSMS($processid){
            $status['status'] = 1;
            $this->db->where('processid',$processid);
			$this->db->update('sms', $status);

            $this->db->where('processid',$processid);
            $query = $this->db->get('sms');
            if($query->num_rows() === 0){
                exit();
            }else{
                foreach($query->result() as $row){
                    $data = array(
                        'email'=>$row->email,
                        'schoolname'=>$row->schoolname,
                        'totalsms'=>$row->totalsms,
                    );
                }
            }
                $admin = $this->session->userdata('userName');
                $this->load->library('email');
                $message = "$admin has processed your request \r\nOf $data[totalsms] SMS for $data[schoolname]";
                $this->email->from('rahul.baghla1707@gmail.com', 'Rahul Baghla');
                $this->email->to($data['email']);
                $this->email->subject('Processed Email');
                $this->email->message($message);
        
                if($this->email->send()){
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Accepted Successfully');
                    window.location.href='/messaging/admin';
                    </script>");
                }else{
                    echo "Failed to Accept";
                    show_error($this->email->print_debugger());             
                }
            // redirect('admin');
        }

        public function deleteSMS($processid){
                        
            $this->db->where('processid',$processid);
            $query = $this->db->get('sms');
            if($query->num_rows() === 0){
                exit();
            }else{
                foreach($query->result() as $row){
                    $data = array(
                        'email'=>$row->email,
                        'schoolname'=>$row->schoolname,
                        'totalsms'=>$row->totalsms,
                    );
                }
            }
            $this->db->delete('sms', array('processid' => $processid));

                $admin = $this->session->userdata('userName');
                $this->load->library('email');
                $message = "$admin has cancelled your request \r\nOf $data[totalsms] SMS for $data[schoolname]";
                $this->email->from('rahul.baghla1707@gmail.com', 'Rahul Baghla');
                $this->email->to($data['email']);
                $this->email->subject('Cancelled Email');
                $this->email->message($message);

                if($this->email->send()){ 
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Cancelled Successfully');
                    window.location.href='/messaging/admin';
                    </script>");
                }else{
                    echo "Failed to Accept";
                    show_error($this->email->print_debugger());             
                }


            
            // redirect('admin');
        }

        public function load_addAdmin(){
            $this->load->library('session');
            if($this->session->userdata('adminId')){
                $data['title'] = 'Add Admin';
                $this->load->view('messaging/addAdmin',$data);
            }else{
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Please Login First');
                    window.location.href='/messaging';
                    </script>");
                }
        }

        public function addAdmin(){
            $data['status'] = 1;
            
            $this->db->where('email',$this->input->post('email'));
            $query = $this->db->get('users');
            if ($query->num_rows() === 0){
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Email Not Found !!');
                    window.location.href='/messaging/load_addAdmin';
                    </script>");
                    exit();
            }else{
                foreach($query->result() as $row){
                    if($row->status != 0){
                        echo ("<script LANGUAGE='JavaScript'>
                            window.alert('Already Admin');
                            window.location.href='/messaging/load_addAdmin';
                            </script>");
                        exit(); 
                    }else{
                        $this->db->update('users', $data);
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('Admin Added Successfully');
                        window.location.href='/messaging/admin';
                        </script>");
                        exit();
                    }
                 exit();
                }
            }    
        }

        
    }
?>