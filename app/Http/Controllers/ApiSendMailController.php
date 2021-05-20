<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Exception;

class ApiSendMailController extends Controller
{
	private $send = 'admin@orbostrealestate.net.au';
	private $cc = 'sandy@agency3.com.au';
	private $bcc = 'firdaus@agency3.com.au';

	function send_contact( Request $request )
	{
		$response = array();

		$response['message'] = "";

		$validateData = Validator::make( $request->all(), [
			'first_name'	=> 'bail|required',
			'last_name'	=> 'bail|required',
			'email'		=> 'bail|required|email',
			'message'		=> 'bail|required',
		]);

		$errors = $validateData->errors();

		if ( !( count($errors->all() ) > 0 ) ) {
			$data = array(
				'first_name' 	=> $request->first_name, 
				'last_name' 	=> $request->last_name, 
				'email'		=> $request->email, 
				'phone'		=> $request->phone, 
				'message'		=> $request->message,
				'request'		=> 'send_contact'
			);

			try {
				Mail::to( $this->send )
				->cc( $this->cc )
				->bcc( $this->bcc )
				->send( new SendMail( $data ) );

				if ( !Mail::failures() ) {
					$response['message'] = "success";

				} else {
					$response['message'] = "failed";
				}

			} catch ( Exception $e ) {
				$response['message'] = $e->getMessage();
			}

		} else {
			foreach ( $errors->all() as $e ) {
				$response['message'] .= $e . ', ';
			}

			$response['message'] .= "All Input Cannot Be Empty!";
		}

		echo json_encode( $response );
	}

	function send_appraisal( Request $request )
	{
		$response = array();

		$response['message'] = "";

		$validateData = Validator::make( $request->all(), [
			'first_name'	=> 'bail|required',
			'last_name'	=> 'bail|required',
			'email'		=> 'bail|required|email',
			'address'		=> 'bail|required',
			'suburb'		=> 'bail|required',
		]);

		$errors = $validateData->errors();

		if ( !( count($errors->all() ) > 0 ) ) {
			$data = array(
				'first_name' 	=> $request->first_name, 
				'last_name' 	=> $request->last_name, 
				'email'		=> $request->email, 
				'phone'		=> $request->phone, 
				'address'		=> $request->address,
				'suburb'		=> $request->suburb,
				'request'		=> 'send_appraisal'
			);

			try {
				Mail::to( $this->send )
				->cc( $this->cc )
				->bcc( $this->bcc )
				->send( new SendMail( $data ) );

				if ( !Mail::failures() ) {
					$response['message'] = "success";

				} else {
					$response['message'] = "failed";
				}

			} catch ( Exception $e ) {
				$response['message'] = $e->getMessage();
			}

		} else {
			foreach ( $errors->all() as $e ) {
				$response['message'] .= $e . ', ';
			}

			$response['message'] .= "All Input Cannot Be Empty!";
		}

		echo json_encode( $response );
	}
}
