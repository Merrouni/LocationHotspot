<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
    <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8"/>
    <title><?php echo isset($title_for_layout)?$title_for_layout:'Internet Hotspots'; ?></title>

    <link rel="stylesheet" href="../../root/css/bootstrap.css" type="text/css"/>
    <style>
        body {
            padding-top: 50px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="../../root/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Internet Hotspots</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <?php echo $content_for_layout; ?>
        </div>
    </body>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="../../root/js/bootstrap.min.js"></script>
</html>