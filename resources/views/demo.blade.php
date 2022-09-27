<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <form action="">
        <input type="email" name="email" id="" placeholder="Email">
        <input type="password" name="password" id="" placeholder="Password">
        <input type="submit" value="Login">
    </form>
<script>
    $(document).ready(function(){
        $(document).ready(function(){

            var userId=1;
            var projectId=1;
            var date=new Date().toLocaleDateString();
            var trackingDate=1663901994;
            var trackingHour=10;
            var tracking=[
                {
      "image": "https://tracker-app.s3.ap-southeast-1.amazonaws.com/Screenshot/bkggjalo2yc95h2lmiug6f",
      "keyCounters": [





        {
          "hjdvhvh kumar maurya":true,
          "shiftKey": false,
          "altKey": false,
          "ctrlKey": false,
          "metaKey": false,
          "keycode": 14,
          "rawcode": 8,
          "type": "keyup",
          "hitCount": 1
        }
      ]
    },
    {
      "image": "https://tracker-app.s3.ap-southeast-1.amazonaws.com/Screenshot/w6pz3jki697lrpyrh0ck3m",
      "keyCounters": [

        {
          "shiftKey": false,
          "altKey": false,
          "ctrlKey": false,
          "metaKey": false,
          "keycode": 17,
          "rawcode": 87,
          "type": "keyup",
          "hitCount": 1
        }
      ]
    },
    {
      "image": "https://tracker-app.s3.ap-southeast-1.amazonaws.com/Screenshot/fyljuqzrmk8f1ui5wih1pf",
      "keyCounters": []
    }
            ];


        var object={
                userId:userId,
                projectId:projectId,
                date:date,
                trackingDate:trackingDate,
                trackingHours:trackingHour,
                tracking:tracking,

            };


        // $.ajax({
        //     type:"POST",
        //     url:"{{ url('/tracker-info/create') }}",
        //     data:{
                // userId:userId,
                // projectId:projectId,
                // date:date,
                // trackingDate:trackingDate,
                // trackingHours:trackingHour,
                // tracking:tracking,
                // timezone:"shfhvdfg",
                // hourLimit:50,
        //         _token:"{{ csrf_token() }}",
        //     },
        //     success:function(response){
        //         console.log(response);
        //     }
        // });


        $.ajax({
            type:"GET",
            url:"{{ url('/tracker-info/getDataByWeekly') }}",
            data:{
                userId:1,
                projectId:1,

                _token:"{{ csrf_token() }}",
            },
            success:function(response){
                console.log(response);
            }
        });



        });
    });
</script>
</body>
</html>
