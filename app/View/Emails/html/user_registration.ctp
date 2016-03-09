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


<p> Hello <?php echo $name;?>,</p>

<p align="justify"> Welcome to our website! You, or someone using your email address, has completed registration at artformplatform.com. You can complete registration by clicking the following link: <a href="<?php echo $activate_url;?>"><?php echo $activate_url;?></a>  If this is an error, ignore this email and you will be removed from our mailing list.
</p>
<p><b>Thanks</b></p>
