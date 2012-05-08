<?php
class About extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->library('menu');
	$this->load->model('general');
}
function index(){
	$data['menu'] = $this->general->create_menu();
	$data['css'] = $this->general->css();
	$this->load->view('Help/about',$data);
}
function phpinfo(){
	phpinfo();
}
function update_no_fb(){
	$clients=new Client();
	$clients->get();
	$c=0;
	foreach($clients as $client){
		$client->no_fb=$client->branch->abbr . ++$c;
	}
}
function num_format(){
	$this->load->view('common/header');
	$this->load->view('common/priceformat');
	$this->load->view('common/footer');
}
function test_common(){
	echo $this->common->remove_single_quote("fu'ad minta ma'af");
}
function test_observer(){
/*	$user=new User();
	$user->where('id',16)->get();
	$user2=new User();
	$user2->where('id',5)->get();
	$user2->save_observer($user);
	$user=new User();
	$user->where('id',14)->get();
	$user2=new User();
	$user2->where('id',5)->get();
	$user2->save_observer($user);
*/
	$user=new User();
	$user->where('id',1)->get();
	$user2=new User();
	$user2->where('id',5)->get();
	$user2->save_observer($user);
}
function check_is_sales(){
	$user=new User();
	$user->where('id',28)->get();
	$user->sale->get();
	if($user->sale->exists())
		echo 'exist';
	else 
		echo 'not exist';
}
function user_religion(){
	$user=new User();
	$user->where('id',5)->get();
	$religion=new Religion();
	$religion->where('id',4)->get();
	$user->save($religion);
}
function test_array(){
	$arr=array('one'=>'test_one','two'=>'test_two','three');
	foreach ($arr as $a=>$b)
	if(is_array($a))
	echo $arr[$a] . '<br>';
}
}
