<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payements
 *
 * @author cedric
 */
class Payements {

    public static function Europabank_RedirectAction() {
        
        $uid = '9058660101';
        $storename = 'nomadon';
        $order_id = 'test 130325 2130';
        $amount = '1200';
        $description = 'Order ' . $order_id . ' at ' . $storename;
        $storename = 'Nomadon';
        $serversecret='S058661532';
        $redirecturl = 'http://www.nomadon.com';
        $signature = sha1(
                $uid .
                $order_id .
                $amount .
                $description .
                $serversecret
        );
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
       
        $request = '<?xml version="1.0" encoding="UTF-8"?>
<MPI_Interface>
<Authorize>
<version>1.1</version>
<Merchant>
<uid>' .
                $uid . '</uid>
<beneficiary>' . $storename . '</beneficiary>
<title>' . $storename . '</title>
<redirecttype>' . 'DIRECT' . '</redirecttype>
<redirecturl>' . $redirecturl . '</redirecturl>
</Merchant>
<Customer>
<country>' . 'BE' . '</country>
<ip>' . $ip . '</ip>
</Customer>
<Transaction>
<orderid>' . $order_id . '</orderid>
<amount>' . $amount . '</amount>
<description>' . $description . '</description>
</Transaction>
<hash>' . $signature . '</hash>
</Authorize>
</MPI_Interface>';
// post request and get reply
                                            
        $xmlurl = self::Europabank_xmlPost('https://www.ebonline.be/test/mpi/authenticate', $request);
      
        if (!$xmlurl)
            return false;
        if (!$xml = simplexml_load_string($xmlurl)) {
            trigger_error('Error reading XML string', E_USER_ERROR);
        }
        if ($xml->Error)
            echo $xml->Error;
        else
            header("Location: " . $xml->Response->url);
        exit();
    }

    public static function Europabank_xmlPost($url, $data, $optional_headers = 'Content-Type: text/xml') {
       
        $params = array('http' => array('method' => 'POST',
                'content' => $data));
        if ($optional_headers !== null) {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp) {
            
            // METTRE UN DEBUGER !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            return false;
        }
  
        $response = @stream_get_contents($fp);
        
       
        return $response;
    }

}

?>
