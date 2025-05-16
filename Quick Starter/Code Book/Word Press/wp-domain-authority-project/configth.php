<?PHP
header('Access-Control-Allow-Origin: *');

$request_domain = $_GET['dn'];
//echo $request_domain;

$url = "https://www.sem-theme.com/wp-json/options/registered_store_detail";
$response = file_get_contents($url);
$registeredStores = json_decode($response, true);
// parse_str($parts['query'], $output);-
// echo $output['page'];

//  echo "<pre>";
//  print_r($registeredStores);
//  echo "</pre>";

$status = false;
for ($x = 0; $x <= count($registeredStores); $x++) {
    $shopify_domain = strval($registeredStores[$x]['shopify_domain']);
    //  echo $shopify_domain;
    if(strval($request_domain) === $shopify_domain){
       $status = true;
    break;
    
    }
    else{
         $status = false;
       
    }
    if($x == count($registeredStores) - 1){
        if($status == false){
            echo '<div style="position: fixed; width: 100%; height: 100%; background: rgb(33, 33, 33); color: white; z-index: 99999; top: 0px; left: 0px; text-align: center; padding-top: 20%; font-size: 22px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">This license is not valid with this domain name. </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Please go to </font></font><a href="https://www.sem-theme.com" style="color:red;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">https://www.sem-theme.com</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> to get one.</font></font></div>';   
        }
    }
}