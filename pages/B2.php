<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Soccer Land</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Soccer Land</a>
            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Input Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="I1.php">Add Player/Coach</a>
                                </li>
                                <li>
                                    <a href="I2.php">Add Team</a>
                                </li>
<!--                                 <li>
                                    <a href="I3.php">Add Review to Movie</a>
                                </li> -->
                                <li>
                                    <a href="I4.php">Add Player/Team Relation</a>
                                </li>
                                <li>
                                    <a href="I5.php">Add Coach/Team Relation</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-sunglasses fa-fw"></i> Browsing Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="B1.php">Show Player Information</a>
                                </li>
                                <li>
                                    <a href="B2.php">Show Team Information</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="S1.php"><i class="fa fa-search fa-fw"></i> Search</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Show Team Information</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
<?php 
    include 'db.php';
    $mid = $_GET["mid"];

    $midErr = "";
    $error = false;
    if (isset($_GET["submit"])) {
        if (!$mid) {
            $midErr = "<p class=\"text-danger\">* Please choose a movie</p>";
            $error = true;
        }
    }
 ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Show Team Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Team</label>
                                            <select class="form-control" name="mid">
                                            <option selected disabled>Choose here</option>
<?php 
    $rs = $db->query("select id, title, year from Movie order by title asc;");
    while($row = $rs->fetch_assoc()) 
    {
        $id = $row["id"];
        $title = $row["title"];
        $year = $row["year"];
        echo "<option value=\"".$id."\">".$title."(".$year.")</option>";
    }
 ?>
                                            </select>
                                            <span class="error"><?php echo $midErr;?></span>
                                        </div>
                                        <button type="submit" class="btn btn-default" name="submit">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
<?php 
    if (isset($_GET["submit"])) {
        if (!$error)
        {
            $part1 = "<div class=\"col-lg-12\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            Movie Information
                        </div>
                        <div class=\"panel-body\">
                            <div class=\"table-responsive\">
                                <table class=\"table\">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Director</th>
                                            <th>Genre</th>
                                            <th>Year</th>
                                            <th>Rating</th>
                                            <th>Company</th>
                                            <th>Average Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
            $part2 = "</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>";
            $query = "select * from Movie where id = ".$mid.";";
            $rs = $db->query($query);
            $row = $rs->fetch_assoc();
            $title = $row['title'];
            $year = $row['year'];
            $rating = $row['rating'];
            $company = $row['company'];
            $query = "select last, first from Director, MovieDirector where mid = ".$mid." and id = did";
            $rs = $db->query($query);
            $row = $rs->fetch_assoc();
            $director = $row['first']." ".$row['last'];
            if ($director == " ")
            {
                $director = "N/A";
            }
            $query = "select genre from MovieGenre where mid = ".$mid.";";
            $rs = $db->query($query);
            $row = $rs->fetch_assoc();
            $genre = $row['genre'];
            if (!$genre)
            {
                $genre = "N/A";
            }
            $query = "select avg(rating) from Review where mid = ".$mid.";";
            $rs = $db->query($query);
            $row = $rs->fetch_assoc();
            $avg = $row['avg(rating)'];
            if (!$avg)
            {
                $avg = "N/A";
            }

            echo $part1;
            echo "<tr><td>".$title."</td><td>".$director."</td><td>".$genre."</td><td>".$year."</td><td>".$rating."</td><td>".$company."</td><td>".$avg."</tr>";
            echo $part2;
        }
    }
 ?>
<?php 
    if (isset($_GET["submit"])) {
        if (!$error)
        {
            $part1 = "<div class=\"col-lg-12\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            Actor/Actress Information
                        </div>
                        <div class=\"panel-body\">
                            <div class=\"table-responsive\">
                                <table class=\"table\">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
            $part2 = "</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>";
            $query = "select id, last, first, role from Actor, MovieActor where mid = ".$mid." and id = aid order by last, first;";
            $rs = $db->query($query);

            echo $part1;
            $i = 1;
            while($row = $rs->fetch_assoc()) 
            {
                $id = $row['id'];
                $last = $row['last'];
                $first = $row['first'];
                $role = $row['role'];
                echo "<tr><td>".$i++."</td><td><a href=\"B1.php?aid=$id&submit=\">".$first." ".$last."</a></td><td>".$role."</td></tr>";
            }
            echo $part2;
        }
    }
 ?>
<?php 
    if (isset($_GET["submit"])) {
        if (!$error)
        {
            $part1 = "<div class=\"col-lg-4\">
                    <div class=\"panel panel-info\">
                        <div class=\"panel-heading\">";
            $part2 = " </div>
                                <div class=\"panel-body\">
                                    <p>";
            $part3 = "</p>
                                </div>
                                <div class=\"panel-footer\">
                                <p class=\"text-right\">";
            $part4 = "</p></div>
                            </div>
                        </div>";
            $query = "select name, time, comment from Review where mid = ".$mid.";";
            $rs = $db->query($query);

            while($row = $rs->fetch_assoc()) 
            {
                $name = $row['name'];
                $time = $row['time'];
                $comment = $row['comment'];
                echo $part1.$time.$part2.$comment.$part3."--".$name.$part4;
            }
            echo "<a class=\"btn btn-outline btn-primary btn-lg\" type=\"button\" href=\"I3.php\">Add Movie Review</a>";
        }
    }
 ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
