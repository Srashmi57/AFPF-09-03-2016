<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">

<table width="100%" height="108" border="0" cellpadding="0" cellspacing="0" align="center" class="border-lr deviceWidth"  >
                <tr>
                    <td  style="color:#000;font-family: Helvetica, Arial, Sans-Serif;">
					<p>Dear <?php echo $name;?>,</p>
	 <p>You're receiving this e-mail because you requested a password for your account at artformplatform.com.</p>

<p>You have requested that we email your password to <?php echo $email;?>.</p>

	<p>Your password is :<?php echo $password;?> </p></br></br>


<p>Thanks for using Artform Platform</p></br></br>	
<p>AFPF Team</p>


<img  class="deviceWidth" src="<?php echo Router::url('/', true)?>/images/logo_black.png" alt="" border="0" /></a>	 </td>
                </tr>   
   
		
            </table><!-- End of Banner Text -->

			
		


		   </td>
                  </tr>
				
				
				
				<tr><td width="100%" ></td> </tr>
            </table><!-- End of Footer-->            
            

			</table>

