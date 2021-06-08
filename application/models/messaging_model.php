<?php 
    class Messaging_model extends CI_Model{
        function signup($data){
            $user = array(
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>do_hash($data['password']),
                'status'=>$data['status'],
            );
            // inserting the data to the database
            return $this->db->insert('users', $user);
        }

        function addSMS($data){
            return $this->db->insert('sms',$data);
        }

        
    }
?>