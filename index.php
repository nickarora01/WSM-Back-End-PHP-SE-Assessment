<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
  *,body,html{
     box-sizing:border-box;
     margin:0;
     padding:0;
     font-family:'Open Sans', sans-serif;
     font-size:1rem;
  }
  #input-field{
    border:2px solid grey;
    outline:0;
    height:2rem;
    color:grey;
  }
  #data{
   color:white;
   width:7rem;
   height:3rem;
   background-color:#00CC99;
   border-radius:5px;
   border:0;
   outline:0;
  }
  #show{
   color:white;
   width:7rem;
   height:3rem;
   background-color:#00CC99;
   border-radius:5px;
   border:0;
   outline:0;
  }
  form{
      margin:1rem 0 0 6rem;
  }
  td{
      width:4rem;
      border:3px solid black;
      margin
  }
  table{
    border:3px solid black;
  }
</style>
</head>
<body>
<form method="post">
<label>Please enter the accountId you like to display</label><br>
<br>
<input type="text" placeholder="Enter the id" id="input-field" name="id-value"><br>
<br>
<button id="data" name="submit">Get Data</button>
<form>
<button id="show">Show All</button>
<table id="table-content">
</table>   
<div class="show-id">
<?php
if (isset($_POST['submit'])) {
    $dataid = $_POST['id-value'];
    require_once __DIR__ . '/vendor/autoload.php';
    $con= new MongoDB\Client("mongodb://localhost:27017");
    $db=$con->demodb;
    $table=$db->demoCollections->find();
    $result='';
    foreach ( $table as $row ){
    if($row['accountId']==$dataid){
     $result='<table><th>AccountId</th><th>AccountName</th><th>ExternalAccountId</th><th>CurrencyCode</th><th>Status</th>';
     $result.= "<tr><td>".$row["accountId"]."</td><td> ".$row["accountName"]."</td><td>".$row["externalAccountId"]."</td><td>".$row["currencyCode"]."</td><td>".$row["status"]."</td></tr></table>";
    }
   }
   echo $result;
  }
?>
<?php
session_start();
function render(){
require_once __DIR__ . '/vendor/autoload.php';
$con= new MongoDB\Client("mongodb://localhost:27017");
$db=$con->demodb;
$table=$db->demoCollections->find();
$result='<table><th>AccountId</th><th>AccountName</th><th>ExternalAccountId</th><th>CurrencyCode</th><th>Status</th>';
 foreach ( $table as $row ){
 $result.= "<tr><td>".$row["accountId"]."</td><td> ".$row["accountName"]."</td><td>".$row["externalAccountId"]."</td><td>".$row["currencyCode"]."</td><td>".$row["status"]."</td></tr></table>";
}
 return $result;
}
?>
</div>
<script>
const showBtn=document.getElementById('show');
const idBtn=document.getElementById('data');
const inputField=document.getElementById('input-field');
const tabledata=document.getElementById('table-content');
showBtn.addEventListener('click',(event)=>{
    event.preventDefault();
    tabledata.innerHTML='<?php echo render(); ?>';
    
})
idBtn.addEventListener('click',(event)=>{
    if(inputField.value===''){
        alert("Please enter a some value");
        return;
    }
})
</script>
</body>
</html>
<!-- <td>.$current['externalAccountId'].</td>.
 <td>.$current['currencyCode'].</td>.
 <td>.$current['status'].</td>.
 <td>.$current['type'].</td>. -->