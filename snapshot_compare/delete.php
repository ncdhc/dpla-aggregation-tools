<?php
        require('config.php');
        if (isset($_GET['snapshot']) ? $snapshot = $_GET['snapshot'] : $snapshot = '')
            ;
        if (isset($_GET['sure']) ? $sure = $_GET['sure'] : $sure = '')
            ;
        
        if($snapshot!=='') {
            
        if($sure=='yes') {
            $todelete = "snapshots/".$snapshot.".txt";
            unlink($todelete);
            header("Location:index.php");
        } else {
            
        ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DPLA Snapshot Comparison Tool: Delete Snapshot</title>

        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <link rel="stylesheet" href="css/bootstrap-sandstone.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            body {
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .container-fluid {
                max-width: 1400px;
                margin: 0 auto;
            }

            table h4 {
                margin-top: 0;
                margin-bottom: 0;
            }
        </style>
    </head>
    <body>
        <?php
        require('config.php');
        if (isset($_GET['snapshot']) ? $snapshot = $_GET['snapshot'] : $snapshot = '')
            ;
        if (isset($_GET['sure']) ? $sure = $_GET['sure'] : $sure = '')
            ;
        ?>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">


                    <h2>Delete Snapshot</h2>


                    <p>This action will delete the snapshot recorded on <?php echo date('Y-m-d',$snapshot) ?> at <?php echo date('g:i:sA', $snapshot);?>. Are you sure?</p>

                    <p><a href="delete.php?snapshot=<?php echo $snapshot;?>&sure=yes" class="btn btn-danger">Yes, Delete Snapshot</a> <a href="index.php" class="btn btn-default">Cancel</a>


                    </div>

                </div>
               
        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
</html>
        <?php } 
        } else {
            echo "Snapshot not found.";
        }
?>
