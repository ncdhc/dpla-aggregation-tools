<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DPLA Snapshot Comparison Tool</title>

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
        
        $snapshots = array();
        $timeids = array();
        foreach(glob('snapshots/*.txt') as $filename) {
            $timeid = str_replace('.txt','',str_replace('snapshots/','',$filename));
            $data = file_get_contents($filename);
            $timeids[] = $timeid;
            $snapshots[] = array('timeid'=>$timeid,'data'=>json_decode($data));
            
        }
        
        $collections = array();
        $contributors = array();
        foreach($snapshots as $snapshot) {
            $thistimeid = $snapshot['timeid'];
            foreach($snapshot['data']->facets->{'sourceResource.collection.title'}->terms as $collterm) {
                $collections[$collterm->term][$thistimeid] = $collterm->count;
            }
            foreach($snapshot['data']->facets->dataProvider->terms as $contribterm ){
                $contributors[$contribterm->term][$thistimeid] = $contribterm->count;
            }
        }
       
        
        ?>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">


                    <div class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">DPLA Snapshot Comparison Tool</a>
                        </div>
                          <div class="navbar-collapse collapse navbar-responsive-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="record.php"><span class="glyphicon glyphicon-plus"></span> Record New Snapshot</a></li>
                        </ul>
                          </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#">By Collection</a></li>
                        <li><a href="#">By Contributor</a></li>
                    </ul>
                    <hr>

                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Collection</th>
                                
                                <?php foreach($timeids as $snaptime) {
                                    echo '<th>'.date('Y-m-d g:i:sA',$snaptime).' <a href="delete.php?snapshot='.$snaptime.'"><span class="glyphicon glyphicon-remove"></span></a></th>';
                                } ?>
                    
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach($collections as $collname=>$counts) {
                                echo "<tr>";
                                echo "<td>".$collname."</td>";
                                foreach($counts as $count) {
                                    echo "<td>".$count."</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                       
                            <tr>
                                <td><h4>Images of North Carolina<br><span class="small">North Carolina Digital Heritage Center</span></h4></td>
                                <td>1200</td>
                                <td>1200</td>
                            </tr>
                            <tr class="danger">
                                <td><h4>Broadsides & Ephemera<br><span class="small">Duke University</span></h4></td>
                                <td>495</td>
                                <td>475</td>
                            </tr>
                            <tr class="success">
                                <td><h4>The Thomas E. Watson Papers Collection<br><span class="small">Documenting the American South</span></h4></td>
                                <td>5,938</td>
                                <td>5,962</td>
                            </tr>
                        </tbody>
                    </table> 
                    <hr>
                    
                    <p class="small text-muted">
                        Provider ID: <?php echo $provider_id;?><br>
                        API Key: <?php echo $dpla_api_key;?>
                    </p>
                    

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