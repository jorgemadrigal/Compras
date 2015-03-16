<?php
Class Merchant_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_merchants($limit=0, $offset=0, $order_by='id', $direction='DESC')
    {
        $this->db->order_by($order_by, $direction);
        if($limit>0)
        {
            $this->db->limit($limit, $offset);
        }

        $result = $this->db->get('merchants');
        return $result->result();
    }
    
    function count_merchants()
    {
        return $this->db->count_all_results('merchants');
    }
    
    function get_merchant($id)
    {
        $result = $this->db->get_where('merchants', array('id'=>$id));
        return $result->row();
    }

    function get_merchant_by_email($email)
    {
        $result = $this->db->get_where('merchants', array('email'=>$email));
        return $result->row();
    }

    function save_merchant($merchant)
    {
        if ($merchant['id'])
        {
            $this->db->where('id', $merchant['id']);
            $this->db->update('merchants', $merchant);
            return $merchant['id'];
        }
        else
        {
            $this->db->insert('merchants', $merchant);
            return $this->db->insert_id();
        }
    }


/**
 * Limpiar
 */

    function is_merchant_logged_in($merchant)
    {
        if ($merchant['id'])
        {
            $this->db->where('id', $merchant['id']);
            $this->db->update('merchants', $merchant);
            return $merchant['id'];
        }
        else
        {
            $this->db->insert('merchants', $merchant);
            return $this->db->insert_id();
        }
    }


    /*
    these functions handle logging in and out
    */
    function logout()
    {
        $this->CI->session->unset_userdata('customer');
        //force expire the cookie
        $this->generateCookie('[]', time()-3600);
        $this->go_cart->destroy(false);
    }

    private function generateCookie($data, $expire)
    {
        setcookie('GoCartCustomer', $data, $expire, '/', $_SERVER['HTTP_HOST']);
    }
    
    function login($email, $password, $remember=false)
    {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('active', 1);
        $this->db->where('password',  sha1($password));
        $this->db->limit(1);
        $result = $this->db->get('customers');
        $customer   = $result->row_array();
        
        if ($customer)
        {
            
            // Retrieve customer addresses
            $this->db->where(array('customer_id'=>$customer['id'], 'id'=>$customer['default_billing_address']));
            $address = $this->db->get('customers_address_bank')->row_array();
            if($address)
            {
                $fields = unserialize($address['field_data']);
                $customer['bill_address'] = $fields;
                $customer['bill_address']['id'] = $address['id']; // save the addres id for future reference
            }
            
            $this->db->where(array('customer_id'=>$customer['id'], 'id'=>$customer['default_shipping_address']));
            $address = $this->db->get('customers_address_bank')->row_array();
            if($address)
            {
                $fields = unserialize($address['field_data']);
                $customer['ship_address'] = $fields;
                $customer['ship_address']['id'] = $address['id'];
            } else {
                 $customer['ship_to_bill_address'] = 'true';
            }
            
            
            // Set up any group discount 
            if($customer['group_id']!=0) 
            {
                $group = $this->get_group($customer['group_id']);
                if($group) // group might not exist
                {
                    $customer['group'] = $group;
                }
            }
            
            if($remember)
            {
                $loginCred = json_encode(array('email'=>$email, 'password'=>$password));
                $loginCred = base64_encode($this->aes256Encrypt($loginCred));
                //remember the user for 6 months
                $this->generateCookie($loginCred, strtotime('+6 months'));
            }
            
            // put our customer in the cart
            $this->go_cart->save_customer($customer);

        
            return true;
        }
        else
        {
            return false;
        }
    }

}