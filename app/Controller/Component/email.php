<?php
class EmailComponent extends Object
{
/* CHANGE THESE VALUES !! */
	var $admin_email='eddie@example.com';
	var $info_email='eddie@example.com';
	var $site_name='Artform Platform';
	var $email_domain='example.com';
 
 
	/**
	 * Sends an email TO THE ADMIN with any message
	 *
	 * @param string $message
	 */	
	function adminemail($message)
	{
	  		$to  = $this->admin_email;
			// subject
			$subject = 'Admin Alert from '.$this->site_name;					
 
 
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$this->site_name." <noreply@".$this->email_domain.">\n";
	  		$headers .= 'X-Sender: <noreply@'.$this->email_domain.'>\n';
	  		$headers .= 'X-Mailer: PHP\n';
 
 
			// Mail it
			mail($to, $subject, $message, $headers);
	}
 
	/**
	 * Send a message to myself, from contact page
	 * 
	 * @param string $from_email
	 * @param string $from_name
	 * @param string $message
	 * 
	 * Note: from email will be used as reply-to, allowing you to respond to any questions or comments directly.
	 */
	function infoemail($f_email,$f_name,$message)
	{
	  		$to  = $this->info_email;
			// subject
			$subject = 'Contact / Info Request for '.$this->site_name;					
 
 
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$this->site_name." <noreply@".$this->email_domain.">\n";
	  		$headers .= 'X-Sender: <noreply@'.$this->email_domain.'>\n';
	  		$headers .= 'X-Mailer: PHP\n';
			$headers .= "Reply-To: ".$f_name." <".$f_email.">\n\n";	  
 
 
			// Mail it
			mail($to, $subject, $message, $headers);
	}
 
	/**
	 * 
	 * Send a message to a user 
	 * @param string $email
	 * @param string $name
	 * @param string $message
	 */
	function useremail($email, $name, $message)
	{
			$to  = $email;
			// subject
			$subject = 'Message from '.$this->site_name.' for '.$name;					
 
 
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$this->site_name." <noreply@".$this->email_domain.">\n";
	  		$headers .= 'X-Sender: <noreply@'.$this->email_domain.'>\n';
	  		$headers .= 'X-Mailer: PHP\n';
 
 
			// Mail it
			mail($to, $subject, $message, $headers);
 
 
 
	}
 
}?>