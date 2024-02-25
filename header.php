<?php include $_SERVER['DOCUMENT_ROOT'] . "/config.php"; ?>

<!-- 
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{THE_REQUEST} ^[A-Z]{3,9}\ /(([^/]+/)*([^/.]+))\.php[\ ?]
    RewriteRule \.php$ /%1/ [R=301,NC,L]
    RewriteRule ^(.*)/$ /$1.php [NC,L]
</IfModule>
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SchedOle</title>
    <link rel="icon" type="image/x-icon" href="/images/schedole_logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/6841c1cc4e.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            var navbar_height =  $('.navbar').outerHeight();
            $(window).scroll(function()
            {  
                var clickover = $(event.target);
                var _opened = $(".navbar-collapse").hasClass("navbar-collapse collapse show");
                if (_opened === true && !clickover.hasClass("navbar-toggler")) {
                    $("button.navbar-toggler").click();
                }
                if ($(this).scrollTop() > 120)
                {   
                    setTimeout(function(){
                        $('.navbar-wrap').css('height', navbar_height + 'px');
                        $('body').css('margin-top', 1.8* $('#navbar_top').height());
                        $('#navbar_top').addClass("fixed-top");
                    }, 100);
                }
                else
                {
                    setTimeout(function(){
                        $('#navbar_top').removeClass("fixed-top");
                        $('body').css('margin-top', 0);
                        $('.navbar-wrap').css('height', 'auto');
                    }, 100);
                }   
            }); 
        });
    
    </script>
    <style>
        @font-face {
            font-family: "SpaceMono";
            src: url("/fonts/SpaceMono/SpaceMono-Regular.ttf") format("ttf");
        }
        @font-face{
            font-family: "SpaceMono";
            src: url("/fonts/SpaceMono/SpaceMono-Bold.ttf") format("ttf");
            font-weight: bold;
        }
        @font-face{
            font-family: "SpaceMono";
            src: url("/fonts/SpaceMono/SpaceMono-Italic.ttf") format("ttf");
            font-style: italic;
        }
        @font-face{
            font-family: "SpaceMono";
            src: url("/fonts/SpaceMono/SpaceMono-BoldItalic.ttf") format("ttf");
            font-style: italic;
            font-weight: bold;
        }

        *{
            font-family: "SpaceMono";
        }
        .navbar-toggler:focus{
            box-shadow: 0 0 0;
        }
        input[type=submit] {
        background-color: #04AA6D;
        border: none;
        color: white;
        padding: 16px 32px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        }
        .nav-link{
            color:black;
        }
        .nav-link.active{
            color: #f1f0b0 !important;
        }
        .nav-link:hover{
            color: #f1f0b0 !important;
        }
        .btn-danger{
            
            background-color: #f1f0b0;
            border-color: #f1f0b0;
            color: #0e4794 !important;
        }
        .btn:hover{
            background-color: #e5e4a5;
            border-color: #e5e4a5;
            color: #0e4794 !important;
        }
        .driver-img{
            border-radius: 100%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .passanger-img{
            border-radius: 100%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .card-content{
            margin: 10px 0px;
        }
        .original-button {
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            text-decoration: none;
            color: black;
            font-size: 18px;
            border-radius: 20px;
            height: 40px;
            font-weight: bold;
            border:0px;
            width: 100%;
            border-bottom: 5px solid #9f6f10;
            transition: 0.3s;
            background-color: #e4a01a;
        }

        .original-button:hover:enabled {
          border-bottom-width: 0;
          transform: translateY(5px);
        }
        button:disabled,
        button[disabled]{
          border: 1px solid #999999;
          background-color: #cccccc;
          color: #666666;
        }
        .get-driver-info{
            border: 1px solid rgba(0,0,0,.2);
            border-radius: 10px;
            position: fixed;
            width: 50%;
            top: 25%;
            left: 25%;
            background-color: white;
            padding: 10px;
        }
        .confirm-join{
            border: 1px solid rgba(0,0,0,.2);
            border-radius: 10px;
            position: fixed;
            width: 50%;
            top: 25%;
            left: 25%;
            background-color: white;
            padding: 10px;
        }
        .card-comments{
            margin-bottom: 20px;
        }
        .comments-send{
            width: 15%;
            display: inline;
        }
        .comments-input{
            width: 70%;
        }
        .comments-img{
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
            padding: 0;
        }
        .comments-input-img{
            border-radius: 50%;
            width: 25px;
            height: 25px;
            object-fit: cover;
        }
        .prof-img{
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
        }
        .disableddiv {
        pointer-events: none;
        opacity: 0.5;
    }
    .acomment{
        display: inline; 
        width: auto;
    }
    .commentinitials{
        width: auto;
        font-size: 10px;
        color: #585c5e;
    }
        @media (max-width:770px){
            .driver-img{
                width: 100px;
                height: 100px;
                }
            .card-info h5{
                font-size: 20px;
            }
            .card-info h6{
                font-size: 18px;
            }
            .join-button{
                font-size: 9px;
                width: 60% !important;
                height: 30px;
            }
        }
        @media (max-width:530px){
            .passanger-img{
                width: 80px;
                height: 80px;
                }
            .driver-img{
                width: 80px;
                height: 80px;
                }
            .card-info h5{
                font-size: 15px;
            }
            .card-info h6{
                font-size: 11px;
            }
        }
        @media (max-width:490px){
            .passanger-img{
            width: 50px;
            height: 50px;
            }
            .driver-img{
                width: 50px;
                height: 50px;
                }
            .card-info h5{
                font-size: 14px;
            }
            .card-info h6{
                font-size: 11px;
            }
            .card-text{
                font-size: 12px;
            }
            .comments-img{
                width: 30px;
                height:30px;
            }
            .acomment{
                width: 60%;
            }
            .commentinitials{
                font-size: 8px;
            }
            .prof-img{
                width: 100px;
                height: 100px;
            }
            .info{
                font-size:10px;
            }
            .info h3{
                font-size: 20px;
            }
        }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light" id="navbar_top" data-bs-theme="light" style="box-shadow:0 2px 10px rgba(0,0,0,0.1);font-weight: 700; background-color: #e4a01a !important; color:black;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
            <img src="/images/schedole_logo.png" alt="Bootstrap" width="50">
            </a>

            <button class="navbar-toggler navbar-light bg-light" style="background-color: #e4a01a !important;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php 
                    if(isset($_SESSION['user']) && isset($_SESSION['user']['id']))
                    {
                ?>
                <a class="nav-link active" id="homenav" aria-current="page" href="/">Home</a>
                <?php 
                	if($_SESSION['user']['role'] == 'user')
                	{
                		?>
                			<a class="nav-link" href="/myavailability.php">My Availability</a>
                		<?php
                	}
                	else
                	{
                		?> 
                			<a class="nav-link" href="/shifts.php">Shifts</a>
                		<?php
                	}
                 ?>
                
                <a class="nav-link" href="/action.php?logout">Sign Out</a>
            <?php }else{ ?>
                <a class="nav-link" href="/login.php">Sign In</a>
                <a class="nav-link" href="">Sign Up</a>
            <?php } ?>
            </div>
            </div>
        </div>
    </nav>
    <div class="container row justify-content-center mx-auto mt-3">
    <script type="text/javascript">
        cururl = document.URL;
        cururl = cururl.replace("https://letscord.com/", "");
        $('.nav-link').each(function(i, obj)
        {
            if(cururl != "")
            {
                ahref = $(this).text().toLowerCase().replace(/\s/g, '');
                if(ahref == cururl)
                {
                    $("#homenav").removeClass("active");
                    $(this).addClass("active");
                }
            }
        });
    </script>

