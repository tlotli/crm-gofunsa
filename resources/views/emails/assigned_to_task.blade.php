<style>

    .font-styles {
        font-family: Arial, Helvetica, sans-serif;
    }

</style>

<img src="{{asset('assets/dist/img/gofun.png')}}" alt="" width="100%" height="300px">
<br>
<br>
<h1 class="font-styles" style="text-align: center">You have been assigned to the following task</h1>
<h3 class="font-styles" style="text-align:center">Notes</h3>
<p class="font-styles" style="text-align: center">{{$notes}}</p>
<br>
<br>
<br>
<span style="margin-left: 50%"><a class="font-styles" href="{{route('tasks_assigned_to_users')}}" style="background-color: #00A000 ; color: white ; padding: 20px ; text-align: center ; text-decoration: none ">View Task</a></span>


