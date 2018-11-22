<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Log;

use PHPMailer\PHPMailer\PHPMailer;

class OrderController extends Controller
{
    public function placeOrders() {
    	$products = Session::get('products');
    	$mailBody = '';
        $i = 1;
        $total = 0;
        if($products) {
            foreach($products as $product) {
                // echo $i.". ".$product['product_name'];
                // echo "\n";
                $i++;
                $total += $product['product_qty'];

                $mailBody .= $i.". Product Name: ".$product['product_name'].". Product Price: ".$product['product_qty']."\n";

                Session::push('orders', [
		        	'product_id' => $product['product_id'],
		        	'product_name' => $product['product_name'],
		          	'product_qty' => $product['product_qty']
			    ]);

			    Session::forget('products');
			    Log::info('An order is placed.');
            }
            // echo "Total: ".$total;
       		$mailBody .= "Total: ".$total;
        }

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'anjalimc9@gmail.com';                 // SMTP username
		    $mail->Password = 'mango81725';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('anjalimc9@gmail.com', 'Shopping Cart');
		    $mail->addAddress('arun.lal@titechnologies.in', 'Ti');     // Add a recipient
		    // $mail->addAddress('ellen@example.com');               // Name is optional
		    // $mail->addReplyTo('info@example.com', 'Information');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    //Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Order Details';
		    $mail->Body  = $mailBody;
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    if($mail->send()) {
			    return redirect()->route('home');
		    } else {
			    echo 'Message not sent';
		    }
		} catch (Exception $e) {
		    // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
    }
}
