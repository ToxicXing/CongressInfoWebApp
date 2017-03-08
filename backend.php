<?php
  header('content-type: application/json; charset=utf-8');
  header("access-control-allow-origin: *");
  // header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
  $apikey = "ae65eacf997f4d13bd8b518036eb1300";
  if ($_GET['scope'] == "state") {
    $url = "http://congress.api.sunlightfoundation.com/legislators?apikey=".$apikey."&per_page=all";
    $json = file_get_contents($url);
    echo $json;
  } else if ($_GET['scope'] == "house") {
    $url = "http://congress.api.sunlightfoundation.com/legislators?chamber=house&apikey=".$apikey."&per_page=all";
    $json = file_get_contents($url);
    echo $json;
  } else if ($_GET['scope'] == "senate") {
    $url = "http://congress.api.sunlightfoundation.com/legislators?chamber=senate&apikey=".$apikey."&per_page=all";
    $json = file_get_contents($url);
    echo $json;
  } else if (isset($_GET['bioguide_id'])) {
    $bioguide_id = $_GET['bioguide_id'];
    $legislators_url = "http://congress.api.sunlightfoundation.com/legislators?bioguide_id=".$bioguide_id."&apikey=".$apikey;
    $legislators_json = file_get_contents($legislators_url);

    $committees_url = "http://congress.api.sunlightfoundation.com/committees?member_ids=".$bioguide_id."&apikey=".$apikey."&per_page=5";
    $committees_json = file_get_contents($committees_url);

    $bills_url = "http://congress.api.sunlightfoundation.com/bills?sponsor_id=".$bioguide_id."&apikey=".$apikey."&per_page=5";
    $bills_json = file_get_contents($bills_url);
    echo json_encode(array("personal_info"=>$legislators_json, "top5com"=>$committees_json, "bills" => $bills_json));
  } else if(isset($_GET['bills'])) {
    $active_bills_url = "http://congress.api.sunlightfoundation.com/bills?history.active=true&apikey=".$apikey."&per_page=50";
    $active_biils_json = file_get_contents($active_bills_url);
    $new_bills_url = "http://congress.api.sunlightfoundation.com/bills?history.active=false&apikey=".$apikey."&per_page=50";
    $new_bills_json = file_get_contents($new_bills_url);
    echo json_encode(array("active_bills"=>$active_biils_json, "new_bills"=>$new_bills_json));
  } else if (isset($_GET['bill_id'])) {
    $bill_id = $_GET['bill_id'];
    $bill_details_url = "http://congress.api.sunlightfoundation.com/bills?bill_id=".$bill_id."&apikey=".$apikey."&per_page=50";
    $bill_details_json = file_get_contents($bill_details_url);
    echo $bill_details_json;
  } else if(isset($_GET['committees'])) {
    $committees_url = "http://congress.api.sunlightfoundation.com/committees?apikey=".$apikey."&per_page=all";
    $committees_json = file_get_contents($committees_url);
    echo $committees_json;
  }
?>
