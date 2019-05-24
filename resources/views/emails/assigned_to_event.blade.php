<style>

    .font-styles {
        font-family: Arial, Helvetica, sans-serif;
    }

</style>

<img src="{{asset('assets/dist/img/gofun.png')}}" alt="" width="100%" height="100px">
<br>
<br>
<h1 class="font-styles" style="text-align: center">You have been assigned to the following event :  {{$type}}</h1>
<h3 class="font-styles" style="text-align:center">Notes</h3>
<p class="font-styles" style="text-align: center">{{$notes}}</p>
<br>
<br>
<br>
<span style="margin-left: 50%"><a class="font-styles" href="{{route('calendar_detail' , ['id' => $id])}}" style="background-color: #00A000 ; color: white ; padding: 20px ; text-align: center ; text-decoration: none ">View Event</a></span>


