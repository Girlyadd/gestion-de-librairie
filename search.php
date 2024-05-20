<!DOCTYPE html>
<html>
    <head>
        <title>live Search</title>
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="max-width:50%;">
    <div class="text-center mt-5 mb-4"> 
        <h2> Chercher livre </h2>
    </div>
   <input type="text" class="form-control" id="live_search"  autocomplete="off" placeholder="Search ...">
    </div>
    <div id="searchresult"></div>
    <script src = https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js> </script>

    <script type="text/javascript"> 
    $(document).ready(function(){
        $("#live_search").keyup(function(){
            var input = $(this).val();
            //alert(input);
            if(input != ""){
                $.ajax({
                    url:"searchbook.php",
                    type:"POST",
                    data:{input:input},

                    success:function(data){
                        $("#searchresult").html(data);
                    }
                });
            }else {
                $("#searchresult").css("display","none");
            }
        });
    });
    </script>
</body>
</html>

