<?php
//
// *** To Email ***
// $to = 'quocla.21it@vku.udn.vn';
// //
// // *** Subject Email ***
// $subject = 'test';
// //
// // *** Content Email ***
// $content = 'test';
// //
// //*** Head Email ***
// $headers = "From: quocla.21it@vku.udn.vn\r\n";
// //
// //*** Show the result... ***
// if (mail($to, $subject, $content, $headers))
// {
// 	echo "Success !!!";
// } 
// else 
// {
//    	echo "ERROR";
// }

include_once('backend/Order.php');

$order = new Order();
$order->sendMailToCustomer(4);