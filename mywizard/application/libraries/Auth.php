<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 *
 *
 *
 */

class Auth
{
	public static $status = array(
		'inactive'	=> 0,
		'active'	=> 1
	);	
	
	// --------------------------------------------------------------------------

	/**
	 * Construct
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
	} 
	
	// --------------------------------------------------------------------------

	/**
	 * Log In Action
	 *
	 * This function does a couple of things.
	 * First, we query to see if the username exists in the database
	 * If it does, we grab the salt from that query.  Then concatenate 
	 * the salt with the posted password, sha1() the whole things together.
	 * so if all goes well, we're golden.
	 *
	 * @param 	string		username
	 * @param 	string 		password
	 * @return 	mixed 		FALSE on failure, id on success
	 */
	public function log_in($username, $password)
	{
		$qry = $this->CI->db->select('id, username, email, password, salt')
							->where('username', $username)
							->get('users');
		
		// No results, we're done.
		if ($qry->num_rows() !== 1)
		{
			return FALSE;
		}

		if (sha1($password.$qry->row('salt')) == $qry->row('password'))
		{
			$data = array(
				'id'		=> $qry->row('id'),
				'username'		=> $qry->row('username'),
				'email'			=> $qry->row('email'),
				'salt'			=> $qry->row('salt'),
			);
			
			$this->CI->session->set_userdata($data);
			
			return $qry->row('id');
		}

		return FALSE;
	}

	// --------------------------------------------------------------------------

	/**
	 * Log Out
	 *
	 * This method destroys the users session, and redirects to 
	 * either the index URL of the app, or a user-defined url
	 * 
	 * @param 	string		url to redirect to:  controller/method
	 * @return 	void
	 */
	public function log_out($redirect = '')
	{
		$this->CI->session->sess_destroy();
		
		$this->CI->load->helper('url');
		
		redirect($redirect);
	}

	// --------------------------------------------------------------------------

	/**
	 * Create new user
	 *
	 * This function creates a new user.  It does check to make
	 * sure a user with the same email or username does not already
	 * exists.  Return FALSE if the user exists, return the new users
	 * id if the user exists.  
	 *
	 * @todo 	consider just using callbacks in the controller
	 * to test for a unique username or email
	 *
	 * @param 	string		username
	 * @param 	string		password
	 * @param 	string		email address
	 * @return 	mixed		id
	 */
	public function create_user($username, $password, $email) 
	{
		$qry = $this->CI->db->where('username', $username)
							->or_where('email', $email)
							->get('users');
		
		if ($qry->num_rows() !== 0)
		{
			return FALSE;
		}
		
		$salt = $this->_create_salt();		
		
		$data = array(
			'username'		=> $username,
			'password'		=> sha1($password.$salt),
			'email'			=> $email,
			'salt'			=> $salt,
			'status'		=> self::$status['active'],
		);
		
		$this->CI->db->where('status', 1)
					 ->insert('users', $data);
		
		return $this->CI->db->insert_id();
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Is the user logged in?
	 *
	 * This method checks to see if the user is logged in or not
	 *
	 * @return 	boolean 	
	 */
	public function is_logged_in()
	{
		if ( ! $this->CI->session->userdata('id'))
		{
			return FALSE;
		}
		
		return TRUE;
	}

	// --------------------------------------------------------------------------

	/**
	 * Change Password
	 *
	 * This method updates the users password
	 * @return void
	 */
	public function change_password($password)
	{
		$password = sha1($password.$this->CI->session->userdata('salt'));
		
		$this->CI->db->where('id', $this->CI->session->userdata('id'))
					 ->set('password', $password)
					 ->update('users');
		
		// garbage collect on unused hashes
		$this->_hash_gc();
	}

	public function change_password_user($password,$id,$user_salt)
	{
		//added by pujie
		echo 'user id ' . $id . '<br>';
		echo 'user salt ' . $user_salt. '<br>';
		$password = sha1($password.$user_salt);
		$this->CI->db->where('id', $id)
					 ->set('password', $password)
					 ->update('users');
		
		// garbage collect on unused hashes
		$this->_hash_gc();
	}
	// --------------------------------------------------------------------------

	/**
	 * Hash garbage collection
	 *
	 * this function will remove expired hashes from the 
	 * simple_auth_passwd_request table
	 *
	 * @return void
	 */
	private function _hash_gc()
	{
		$timeout = ($this->CI->config->item('passwd_change_timeout')) ? 
						$this->CI->config->item('passwd_change_timeout') : 24*60*60;		
		
		$this->CI->db->where('request_time <', time() - $timeout)->delete('simple_auth_passwd_request');	
	}

	// --------------------------------------------------------------------------

	/**
	 * Forgot Password
	 *
	 * This function first checks to see if the user-submitted email address
	 * actually exists.  If it doesn't no point in going forward, so return FALSE
	 * if it does, generate the hash, insert it into the database and pass the hash
	 * back to the controller to use when the user is emailed.
	 *
	 * @param 	string	email address
	 * @return 	mixed	FALSE if no email addy, otherwise an array
	 */
	public function forgot_password($email_address)
	{
		// Does this email address exist in the database?
		$query = $this->CI->db->select('id, username')
							  ->get_where('users',
									array('email' => $email_address));
		
		if ($query->num_rows() === 0)
		{			
			return FALSE; // No user, bail.
		}
		
		// Create a hash 
		$hash = $this->_create_salt();
		
		$data = array(
			'id'		=> $query->row('id'),
			'hash'			=> $hash,
			'request_time'	=> time()
		);
		
		$this->CI->db->insert('simple_auth_passwd_request', $data);
		
		return array(
						'hash'		=> $hash,
						'username'	=> $query->row('username'),
						'id'	=> $query->row('id')
					);
	}

	// --------------------------------------------------------------------------

	/**
	 * Test the reset hash
	 *
	 * This function takes the reset hash from the URL and tests against the 
	 * simple_auth_passwd_reset table.  Note, an optional configuration variable
	 * passwd_change_timeout is used here.  If it it not set, the passwd hash
	 * will be valid for 24 hours.
	 *
	 * @param 	string		hash
	 * @return 	mixed		FALSE or int user id
	 */
	public function test_reset_hash($hash)
	{
		$query = $this->CI->db->get_where('simple_auth_passwd_request', 
								array('hash' => $hash));
		
		if ($query->num_rows() === 0)
		{
			return FALSE;
		}
		
		$timeout = ($this->CI->config->item('passwd_change_timeout')) ? 
						$this->CI->config->item('passwd_change_timeout') : 24*60*60;

		$this->CI->db->where('hash', $hash)->delete('simple_auth_passwd_request');
		
		if (time() - $query->row('request_time') > $timeout)
		{
			return FALSE;
		}
		
		return $query->row('id');
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Create Salt
	 *
	 * This function will create a salt hash to be used in 
	 * authentication
	 *
	 * @todo it might be nice to use /dev/urandom to create the salt, 
	 * but it would need to be configurable, or at least fall back in case
	 * the host does not allow access there.  For the time being
	 * using random_string() from the string helper should do
	 * just plain fine.
	 * 
	 * @return 	string		the salt
	 */
	protected function _create_salt()
	{
		$this->CI->load->helper('string');
		return sha1(random_string('alnum', 32));
	}
}
