<?php


  // shurjoPay sandbox URL
  $payment_url = "https://XXXXX/sp-data.php"; // Please ask over email  
  // Merchant Return URL
  $return_url = 'http://XXXXX/return.php'; // Please ask over email
  // Customer IP
  $clientIP = '127.0.0.1';
  $merchant_username = '*******'; // Please ask over email
  $merchant_password = '*******'; // Please ask over email
  $merchant_transaction_id_prefix = 'XXX'; // Please ask over email


  $uniq_transaction_key = $merchant_transaction_id_prefix.uniqid();  
  $amount = validate($_POST['pamount']);  

  $xml_data = 'spdata=<?xml version="1.0" encoding="utf-8"?>
                <shurjoPay><merchantName>'.$merchant_username.'</merchantName>
                <merchantPass>'.$merchant_password.'</merchantPass>
                <userIP>'.$clientIP.'</userIP>
                <uniqID>'.$uniq_transaction_key.'</uniqID>
                <totalAmount>'.$amount.'</totalAmount>
                <paymentOption>shurjopay</paymentOption>
                <returnURL>'.$return_url.'</returnURL></shurjoPay>';

  
  $ch = curl_init();  
  curl_setopt($ch,CURLOPT_URL,$payment_url);
  curl_setopt($ch,CURLOPT_POST, 1);          
  curl_setopt($ch,CURLOPT_POSTFIELDS,$xml_data);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec($ch);
  curl_close ($ch);
  print_r($response);



  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if(is_numeric($data))
      return $data;
  }
?>