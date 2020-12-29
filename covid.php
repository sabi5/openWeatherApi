<?php
$apiKey = "fe99acdb101023dca50a69b28d3f6e86";
// $cityName = "Lucknow";
// $cnt = 7;
$googleApiUrl = "https://api.covid19india.org/state_district_wise.json";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
// print_r($response);

curl_close($ch);
$data = json_decode($response);
echo  "<pre>";
print_r($data);
$currentTime = time();
?>

<!doctype html>
<html>
<head>
<title>Covid-19 data</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> 
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"> -->



</head>
<body>
    <div class="report-container">
        <table id ="myTable">
            <thead>
                <tr>
                    <th>State name</th>
                    <th>District name</th>
                    <th>Active</th>
                    <th>Confirmed</th>
                    <th>Death</th>
                    <th>Recovered</th>
                </tr>
            </thead>
            <tbody> 
                <?foreach ($data as $key =>$value){
                    $value = $value->districtData;
                    foreach ($value as $k => $v)
                    {
                ?>       
                <tr>
                    <td><?php echo $key;?></td>
                    <td><?php echo $k;?></td>
                    <td><?php echo $v->active;?></td>
                    <td><?php echo $v->confirmed;?></td>
                    <td><?php echo $v->deceased;?></td>
                    <td><?php echo $v->recovered;?></td>                 
                </tr>
                <? }}?>
            </tbody>
            
        </table>
    </div>
    <script>
    $(document).ready(function(){
    $("#myTable").dataTable();
    });
</script>
</body>
</html>