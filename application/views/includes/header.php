<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        #main{
            padding: 5px;
            min-width: 400px;
            min-height: 160px;
            border:2px solid #ddd;
            border-spacing: inherit;
            border-width: medium;
            border-radius: 10px;
            border-style:double;
            background: #FFFF;
            box-shadow:0 0 7px  #f0f0f0;
        }
        .img{
        width: 60px;

        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;


        }

        #tem{

            color:#2e86de;
            font-family: 'Nunito', sans-serif;
        }

        .content{
        float: left;

        display: flex;
        justify-content: center;
        align-items: center;
        width: 100px;height: 100px;
        font-weight: bold;
        font-family: monospace;
        font-size: 14px;

        }

        #temp{
        color:#273c75;
        font-family: 'Nunito', sans-serif;
        margin: 0;
        }

        #tem{
        background: -webkit-linear-gradient(dodgerblue, #333);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>


<div>
    <div id="main">
        <div class="row" style="padding:10px;">
            <div class="img col-4">
                <img src="" id="img"/ >
            </div>
            <div class="content col-4" >
                <h3 id="temp"></h3>
            </div>

            <div class="content col-4" id="name" >
                <h3 id="tem">12</h3>
            </div>
        </div>

            <div class="container" style=" color:#7f8fa6;">
            <div class="row" style="padding:10px;">

                <div class="col" style="font-size:13px; font-weight:bold;" id="max">
                max:12
                </div>
                <div class="col" style="font-size:13px; font-weight:bold;" id="min">
                min:12
                </div>
                <div class="col-5" style="font-size:13px; font-weight:bold;" id="feel">
                Hissedilen:12
                </div>

            </div>

            <br>
            <div class="col">
                <div class="input-group mb-3">
            <input type="text" class="form-control"  placeholder="Search Your City..." aria-label="Recipient's username" aria-describedby="basic-addon2" style="margin-bottom:5px">
            <div class="input-group-append mt-3">
                <button class="btn btn-outline-secondary" type="button">Search</button>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>

<nav style="display:flex;justify-content:center">
    <a href="./users">Users>></a>
    <a href="./tasks" style="margin-right:15px">Tasks>></a>
</nav>
<script>
  


link = "https://api.openweathermap.org/data/2.5/weather?q=geyve&units=metric&apikey=dc989810ec5879216998f7685d8d2057";
var request = new XMLHttpRequest();
request.open('GET',link,true);
request.onload = function(){
 var obj = JSON.parse(this.response);
 if (request.status >= 200 && request.status < 400) {
 var temp = obj.main.temp;
 var temp2=Math.ceil(temp);
 var feel=obj.main.feels_like;
 document.querySelector("#feel").innerHTML="Feels Like:"+feel+"&#176;c";

 document.querySelector("#max").innerHTML="Max:"+obj.main.temp_max+"&#176;c";
 document.querySelector("#min").innerHTML="Min:"+obj.main.temp_min+"&#176;c";

 console.log(temp+" derece");
 console.log(feel);
 console.log(obj)
 var icon=obj.weather[0].icon;
 console.log(obj.weather[0].icon);
 console.log(obj.name);
 var name= document.querySelector("#tem").innerHTML=obj.name;
 var t=document.querySelector("#temp").innerHTML=temp2+"&#176;c";
 var img=document.querySelector("#img");
 img.setAttribute("src","http://openweathermap.org/img/wn/"+icon+"@2x.png")


 }
 else{
  console.log("The city doesn't exist! Kindly check");
 }
}
request.send();



document.querySelector(".btn").addEventListener("click",()=>{


   var res=document.querySelector(".form-control").value;


  link = "https://api.openweathermap.org/data/2.5/weather?q="+res+"&units=metric&apikey=dc989810ec5879216998f7685d8d2057";
  var request = new XMLHttpRequest();
  request.open('GET',link,true);
  request.onload = function(){
   var obj = JSON.parse(this.response);
   if (request.status >= 200 && request.status < 400) {
   var temp = obj.main.temp;
   var temp2=Math.ceil(temp);
   var feel=obj.main.feels_like;
   document.querySelector("#feel").innerHTML="Hissedilen:"+feel+"&#176;c";

   document.querySelector("#max").innerHTML="Max:"+obj.main.temp_max+"&#176;c";
   document.querySelector("#min").innerHTML="Min:"+obj.main.temp_min+"&#176;c";

   console.log(temp+" derece");
   console.log(feel);
   console.log(obj)
   var icon=obj.weather[0].icon;
   console.log(obj.weather[0].icon);
   console.log(obj.name);
   var name= document.querySelector("#tem").innerHTML=obj.name;
   var t=document.querySelector("#temp").innerHTML=temp2+"&#176;c";
   var img=document.querySelector("#img");
   img.setAttribute("src","http://openweathermap.org/img/wn/"+icon+"@2x.png")


   }
   else{
    console.log("The city doesn't exist! Kindly check");
   }
  }
  request.send();


})
  
</script>



