<!-- API KEY ae65eacf997f4d13bd8b518036eb1300 -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
  h1 {
    margin-left: auto;
    margin-right: auto;
    width:460px;
  }
  #div1 {
    height: auto;
    width: 300px;
    margin-left: auto;
    margin-right: auto;
  }
  form {
    border: 1px solid black;
    height: auto;
    width: 300px;
  }
  table {
    border: 1px solid black;
  }
  table {
    border-collapse: collapse;
  }
  #table1 {
    margin-left: auto;
    margin-right: auto;
    width:400px;
    margin-top: 40px;
    text-align:center;
  }
  #table1 table, #table1 th, #table1 td {
    border: 1px solid black;
  }
  /*table2 is a div . the table inside the div is given an id='details'*/
  #table2 {
    margin-left: auto;
    margin-right: auto;
    width:350px;
    margin-top: 40px;
  }
  #details {
    text-align:center;
  }
  #no_res {
    width: 310px;
    margin-left: auto;
    margin-right: auto;
  }
  </style>
</head>
<?php
  $tex = "Keyword*";
  $database = $chamber = $keyword = "";

  if(empty($_POST["database"])) {

  } else {
    $database = $_POST["database"];
    if ($database == "Legislators") {
      $tex = "State/Representative*";
    } else if ($database == "Committees") {
      $tex = "Committee ID*";
    } else if ($database == "Bills") {
      $tex = "Bill ID*";
    } else if ($database == "Amendments") {
      $tex = "Amendment ID*";
    } else {
      $tex = "Keyword*";
    }
  }

  if(empty($_POST["chamber"])) {

  } else {
    $chamber = $_POST["chamber"];
  }

  if(empty($_POST["keyword"])) {

  } else {
    $keyword = $_POST["keyword"];
  }
?>
<body>
  <h1>Congress Information Search</h1>
  <div id="div1">
    <form name = "mainForm" method="post" action="<?php echo $SERVER['PHP_SELF'];?>">
      Congress Database
      <select id="sel" name = "database" onChange = "changeKeyword(this.options[this.selectedIndex].value);">
        <option value = "wrong"> Select your option</option>
        <option value = "Legislators" <?php if($_POST['database'] == 'Legislators') echo selected; ?>> Legislators</option>
        <option value = "Committees" <?php if($_POST['database'] == 'Committees') echo selected; ?>> Committees</option>
        <option value = "Bills" <?php if($_POST['database'] == 'Bills') echo selected; ?>> Bills</option>
        <option value = "Amendments" <?php if($_POST['database'] == 'Amendments') echo selected; ?>> Amendments</option>
      </select>
      <script>
        function changeKeyword(selected) {
          if(selected == "Legislators") {
              document.getElementById("key").innerHTML = "State/Representative*";
          } else if(selected == "Committees") {
              document.getElementById("key").innerHTML = "Committee ID*";
          } else if(selected == "Bills") {
              document.getElementById("key").innerHTML = "Bill ID*";
          } else if(selected == "Amendments") {
              document.getElementById("key").innerHTML = "Amendment ID*";
          } else {
            document.getElementById("key").innerHTML = "Keyword*";
          }
        }
      </script>
      <br>
      Chamber
      <input  id="senate" name = "chamber" type="radio" value = "senate" <?php if($_POST['chamber'] == "senate") echo checked; ?>>Senate
      <input  id="house" name = "chamber" type="radio" value = "house" <?php if($_POST['chamber'] == "house") echo checked; ?>>House
      <br>
      <p id = "key" style="display:inline"><?php echo $tex ?></p>

      <input id="keyword" name = "keyword" type = "input"  <?php if (isset($_POST['keyword'])) echo 'value="'.$_POST['keyword'].'"';?>>
      <br>
      <input type = "submit" value = "Search" onclick="return checkEmpty()">
      <script>
        function checkEmpty() {
          var database_selected = chamber_selected = keyword_filled = false;
          var db = document.mainForm.database;
          var chamber = document.mainForm.chamber;
          if (db.options[db.selectedIndex].value != "wrong") {
            database_selected = true;
          }
          for (var i = 0; i < chamber.length; i++) {
            if (chamber[i].checked) {
              chamber_selected = true;
            }
          }
          if (document.mainForm.keyword.value != "") {
            keyword_filled = true;
          }
          if (database_selected && chamber_selected && keyword_filled) {
            return true;
          } else {
            var alertText = "Please enter the following missing information: ";
            if (!database_selected) {
              alertText += "Congress database, ";
            }
            if (!chamber_selected) {
              alertText += "Chamber, ";
            }
            if (!keyword_filled) {
              alertText += "Keyword ";
            }
            alert(alertText);
            return false;
          }
        }
      </script>
      <input type = "button" value = "clear" onclick = "resetall()">
      <script>
        function resetall(){
          document.getElementById("sel").selectedIndex = 0;
          document.getElementById("senate").checked = true;
          document.getElementById("keyword").value = "";
          document.getElementById("key").innerHTML="keyword*";
          var table1 = document.getElementById('table1');
          if (typeof table1 != 'undefined'){
            table1.parentNode.removeChild(table1);
          }
          var table2 = document.getElementById('table2');
          table2.innerHTML="";
        }
      </script>
      <br>
      <a href="http://sunlightfoundation.com" target="_blank"> Powered by Sunlight Foudation</a>
    </form>
  </div>
  <div id="table2"></div>
  <?php
  $state_map = array(
     'alabama'=>'AL',
     'alaska'=>'AK',
     'arizona'=>'AZ',
     'arkansas'=>'AR',
     'california'=>'CA',
     'colorado'=>'CO',
     'connecticut'=>'CT',
     'delaware'=>'DE',
     'florida'=>'FL',
     'georgia'=>'GA',
     'hawaii'=>'HI',
     'idaho'=>'ID',
     'illinois'=>'IL',
     'indiana'=>'IN',
     'iowa'=>'IA',
     'kansas'=>'KS',
     'kentucky'=>'KY',
     'louisiana'=>'LA',
     'maine'=>'ME',
     'maryland'=>'MD',
     'massachusetts'=>'MA',
     'michigan'=>'MI',
     'minnesota'=>'MN',
     'mississippi'=>'MS',
     'missouri'=>'MO',
     'montana'=>'MT',
     'nebraska'=>'NE',
     'nevada'=>'NV',
     'new hampshire'=>'NH',
     'new jersey'=>'NJ',
     'new mexico'=>'NM',
     'new york'=>'NY',
     'north carolina'=>'NC',
     'north dakota'=>'ND',
     'ohio'=>'OH',
     'oklahoma'=>'OK',
     'oregon'=>'OR',
     'pennsylvania'=>'PA',
     'rhode island'=>'RI',
     'south carolina'=>'SC',
     'south dakota'=>'SD',
     'tennessee'=>'TN',
     'texas'=>'TX',
     'utah'=>'UT',
     'vermont'=>'VT',
     'virginia'=>'VA',
     'washington'=>'WA',
     'west virginia'=>'WV',
     'wisconsin'=>'WI',
     'wyoming'=>'WY'
 );
 $abbr_map = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
);
  ?>
  <?php
  if ($database == "Legislators") {
    $table = "<table id='table1'> <tr> <th>Name</th> <th>State</th> <th>Chamber</th> <th>Details</th> </tr>";
    $state = strtolower($keyword);
    if (array_key_exists($state, $state_map)) {
      $url = "http://congress.api.sunlightfoundation.com/legislators?chamber=". $chamber ."&state=". $state_map[$state] ."&apikey=ae65eacf997f4d13bd8b518036eb1300";
    } else if (preg_match('/\s/',$keyword)){
      $f_name = explode(" ", $keyword);
      $fir_name = $f_name[0];
      $lst_name = $f_name[1];
      $url ="http://congress.api.sunlightfoundation.com/legislators?chamber=senate&first_name=".$fir_name."&last_name=".$lst_name."&apikey=ae65eacf997f4d13bd8b518036eb1300";
    } else {
      $url = "http://congress.api.sunlightfoundation.com/legislators?chamber=".$chamber ."&query=". $keyword ."&apikey=ae65eacf997f4d13bd8b518036eb1300";
    }
    $json = file_get_contents($url);
    $obj = json_decode($json);
    if (count($obj -> results) == 0) {
      echo "<div id='no_res'>The API returned zero results for the request.</div>";
    } else {
      for ($i = 0; $i < count($obj -> results); $i++) {
        $item = $obj -> results[$i];
        $firstName = $item -> first_name;
        $lastName = $item -> last_name;
        $title = $item -> title;
          $json_title = json_encode($title);
        $fullName = $firstName." ".$lastName;
          $json_fullName = json_encode($fullName);
        $state = $item -> state;
        $chamber2 = $item -> chamber;
        $bioguide_id = $item -> bioguide_id;
          $json_bioguide_id = json_encode($bioguide_id);
        $termEnd = $item -> term_end;
          $json_termEnd = json_encode($termEnd);
        $website = $item -> website;
          $json_website = json_encode($website);
        $facebook = $item -> facebook_id;
          $json_facebook = json_encode($facebook);
        $office = $item -> office;
          $json_office = json_encode($office);
        $twitter = $item -> twitter_id;
          $json_twitter = json_encode($twitter);
        $table .= "<tr> <td>$firstName". " " ."$lastName</td> <td>".$abbr_map[$state]."</td> <td>".$chamber2."</td><td><a href='' onclick = 'Legislators_details($json_bioguide_id,$json_title, $json_fullName,$json_termEnd,$json_website,$json_office,$json_facebook,$json_twitter); return false;'>View Details</a></td></tr>";
      }
      $table .= "</table>";
      echo $table;
    }
  } else if ($database == "Committees") {
    $url = "http://congress.api.sunlightfoundation.com/committees?committee_id=".$keyword."&chamber=".$chamber."&apikey=N000189&apikey=ae65eacf997f4d13bd8b518036eb1300";
    $json = file_get_contents($url);
    $obj = json_decode($json);
    if (count($obj -> results) == 0) {
      echo "<div id='no_res'>The API returned zero results for the request.</div>";
    } else {
        $table = "<table id='table1'><tr><th>Committee ID</th><th>Committee Name</th><th>Chamber</th></tr>";
        for ($i = 0; $i < count($obj -> results); $i++) {
          $item = $obj -> results[$i];
          $committee_id = $item -> committee_id;
          $name = $item -> name;
          $chamber2 = $item -> chamber;
        }
        $table .= "<tr><td>$committee_id</td><td>$name</td><td>$chamber2</td></tr>";
    }
    $table .= "</table>";
    echo $table;
  } else if ($database == "Bills") {
    $url ="http://congress.api.sunlightfoundation.com/bills?bill_id=".$keyword."&chamber=".$chamber."&apikey=ae65eacf997f4d13bd8b518036eb1300";
    $json = file_get_contents($url);
    $obj = json_decode($json);
    if (count($obj -> results) == 0) {
      echo "<div id='no_res'>The API returned zero results for the request.</div>";
    } else {
        $table = "<table id = 'table1'><tr><th>Bill ID</th><th>Short Title</th><th>Chamber</th><th>View Details</th></tr>";
        for ($i = 0; $i < count($obj -> results); $i++) {
          $item = $obj -> results[$i];
          $bill_id = $item -> bill_id;
            $json_bill_id = json_encode($bill_id);
          $short_title = $item -> short_title;
            $json_short_title = json_encode($short_title);
          $chamber2 = $item -> chamber;
          $sponsor = $item -> sponsor;
          $firstName = $sponsor -> first_name;
          $lastName = $sponsor -> last_name;
          $title = $sponsor -> title;
          $sponsorName = $title." ".$firstName." ".$lastName;
            $json_sponsorName = json_encode($sponsorName);
          $introducedOn = $item -> introduced_on;
            $json_introducedOn = json_encode($introducedOn);
          $versionName = $item -> last_version -> version_name;
          $lastActionAt = $item -> last_action_at;
          $last_acton_with_date = $versionName .", ". $lastActionAt;
            $json_last_action_with_date = json_encode($last_acton_with_date);
          $bill_url = $item -> last_version -> urls -> pdf;
            $json_bill_url = json_encode($bill_url);
        }
        $table .= "<tr><td>$bill_id</td><td>$short_title</td><td>$chamber2</td><td><a href='' onclick='bills_detials($json_bill_id, $json_short_title, $json_sponsorName, $json_introducedOn, $json_last_action_with_date, $json_bill_url); return false;'>View Details</a></td></tr>";
    }
    $table .= "</table>";
    echo $table;
  } else if ($database == "Amendments") {
    $url ="http://congress.api.sunlightfoundation.com/amendments?amendment_id=".$keyword."&chamber=".$chamber."&apikey=ae65eacf997f4d13bd8b518036eb1300";
    $json = file_get_contents($url);
    $obj = json_decode($json);
    if (count($obj -> results) == 0) {
      echo "<div id='no_res'>The API returned zero results for the request.</div>";
    } else {
        $table = "<table id='table1'><tr><th>Amendment ID</th><th>Amendment Type</th><th>Chamber</th><td>Introduced on</td></tr>";
        for ($i = 0; $i < count($obj -> results); $i++) {
          $item = $obj -> results[$i];
          $amendment_id = $item -> amendment_id;
          $amendment_type = $item -> amendment_type;
          $chamber2 = $item -> chamber;
          $introduced_on = $item -> introduced_on;
        }
        $table .= "<tr><td>$amendment_id</td><td>$amendment_type</td><td>$chamber2</td><td>$introduced_on</td></tr>";
    }
    $table .= "</table>";
    echo $table;
  }
   ?>
  <script>
    function Legislators_details(bioguide_id,title,fullName,termEnd,website,office,facebook,twitter) {
      facebook_addr = "https://www.facebook.com/" + facebook;
      twitter_addr = "https://twitter.com/" + twitter;
      var table_cont = "<table id='details'><tr><td colspan='2'><img src = 'https://theunitedstates.io/images/congress/225x275/"+ bioguide_id +".jpg'/></td></tr>";
      table_cont += "<tr><td>Full Name</td><td>"+title+" "+fullName+"</td></tr>";
      table_cont += "<tr><td>Term Ends on</td><td>"+termEnd+"</td></tr>";
      if(website==null) {
        table_cont += "<tr><td>Website</td><td>NA</td></tr>";
      } else {
        table_cont += "<tr><td>Website</td><td><a target='_blank' href ='"+website+"'>"+website+"</a></td></tr>";
      }
      table_cont += "<tr><td>Office</td><td>"+office+"</td></tr>";
      if (facebook == null) {
        table_cont += "<tr><td>Facebook</td><td>NA</td></tr>";
      } else {
        table_cont += "<tr><td>Facebook</td><td><a target='_blank' href='"+facebook_addr+"'>"+fullName+"</a></td></tr>";
      }
      if (twitter == null) {
        table_cont += "<tr><td>Facebook</td><td>NA</td></tr>";
      } else {
        table_cont += "<tr><td>Facebook</td><td><a target='_blank' href='"+twitter_addr+"'>"+fullName+"</a></td></tr>";
      }
      table_cont += "</table>"
      document.getElementById('table1').innerHTML= "";
      document.getElementById('table2').innerHTML= table_cont;
    }

    function bills_detials(bill_id, title, sponsorName, introducedOn, last_action_with_date, bill_url){
      var table_cont = "<table id='details'><tr><td>Bill ID</td><td>"+bill_id+"</td></tr>";
      table_cont += "<tr><td>Bill Title</td><td>"+title+"</td></tr>";
      table_cont += "<tr><td>Sponsor</td><td>"+sponsorName+"</td></tr>";
      table_cont += "<tr><td>Introduced on</td><td>"+introducedOn+"</td></tr>";
      table_cont += "<tr><td>Last action with date</td><td>"+last_action_with_date+"</td></tr>";
      if (title == null) {
        table_cont += "<tr><td>Bill URL</td><td><a target='_blank' href='"+bill_url+"'>"+bill_id+"</a></td></tr>";
      } else {
        table_cont += "<tr><td>Bill URL</td><td><a target='_blank' href='"+bill_url+"'>"+title+"</a></td></tr>";
      }
      table_cont += "</table>"
      document.getElementById('table1').innerHTML= "";
      document.getElementById('table2').innerHTML= table_cont;
    }
  </script>
</body>
</html>
