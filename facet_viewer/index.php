<!DOCTYPE html>
<html>
    <head>
        <title>OAI Aggregation Tools &raquo; DC Facet Viewer</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script> 
    </head>

    <body>
        <div class="sectionwrap">
            <a href="../">&laquo; Home</a>
        </div>
        <h1>DC Facet Viewer</h1>
        <p>See the contents of Dublin Core fields in an incoming OAI feed according to frequency.</p>
        <div class="formwrap">
            <form method="get" action="">
                <?php if ((isset($_GET['base'])) && ($_GET['base'] !== '')) { ?>

                    <input disabled type="text" value="<?php echo $_GET['base']; ?>"/>
                    <input type="hidden" id="base" name="base" value="<?php echo $_GET['base']; ?>"/>
                    <?php

                    function getSets($rt) {
                        if ($rt !== '') {
                            $seturl = $_GET['base'] . "?verb=ListSets&resumptionToken=" . $rt;
                        } else {
                            $seturl = $_GET['base'] . "?verb=ListSets";
                        }
                        echo "<br/>SETURL: $seturl<br/>";
                        // create curl resource
                        $ch = curl_init();

                        // set url
                        curl_setopt($ch, CURLOPT_URL, $seturl);

                        //return the transfer as a string
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                        // $output contains the output string
                        $output = curl_exec($ch);

                        $output = str_replace("oai:", "", $output);

                        // close curl resource to free up system resources
                        curl_close($ch);

                        try {
                            $setxml = new SimpleXMLElement($output);
                            return $setxml;
                        } catch (Exception $e) {
                            
                        }
                    }

                    $setarray = array();

                    function processSets($setxml) {
                        global $setarray;
                        $setcount = count($setxml->ListSets->set);
                        for ($i = 0; $i < $setcount; $i++) {
                            $setarray[] = $setxml->ListSets->set[$i]->setSpec . "|" . $setxml->ListSets->set[$i]->setName . "|" . ($i + 1);
                        }


                        if (isset($setxml->ListSets->resumptionToken)) {
                            if ($setxml->ListSets->resumptionToken == '') {
                                // do nothing
                            } else {
                                $nextpass = getSets($setxml->ListSets->resumptionToken);
                                processSets($nextpass);
                            }
                        }
                    }
                    ?>

                    <select id="setname" name="set">
                        <?php
                        $setxml = getSets('');

                        processSets($setxml);

                        sort($setarray);

                        foreach ($setarray as $setpair) {
                            $setparts = explode("|", $setpair);
                            echo "<option value='" . $setpair . "'>" . $setparts[0] . " &#x2014; " . $setparts[1] . "</option>";
                        }
                        ?>
                    </select>

                    <select id="fieldname" name="field">
                        <option value="title">title</option>
                        <option value="coverage">coverage</option>
                        <option value="rights">rights</option>
                        <option value="language">language</option>
                        <option value="type">type</option>
                        <option value="contributor">contributor</option>
                        <option value="creator">creator</option>
                        <option value="date">date</option>
                        <option value="description">description</option>
                        <option value="format">format</option>
                        <option value="identifier">identifier</option>
                        <option value="publisher">publisher</option>
                        <option value="relation">relation</option>
                        <option value="source">source</option>
                        <option value="subject">subject</option>
                    </select>



                    <input type="submit"/>
                    <a class="clearbutton" href=".">&times;</a>


                <?php } else { ?>
                    <input id="base" name="base" type="text" placeholder="OAI Base URL"/>
                    <input type="submit" value="Get Sets"/>
                <?php } ?>

        </div>


        <?php
        if ((isset($_GET['base'])) && (isset($_GET['set']))) {
            $base = $_GET['base'];
            $set = $_GET['set'];
            $mp = "oai_dc";
            $setparts = explode("|", $set);
            $setspec = $setparts[0];
            $setname = $setparts[1];
            if (($base !== '') && ($set !== '')) {
                $thisfeed = $base . "?verb=ListRecords&set=" . $setspec . "&metadataPrefix=" . $mp;
            }
        }

        if (isset($thisfeed)) {

            if ($thisfeed != '') {

                echo "<div class='feedwrap'>";
                echo "<b>$setname</b><br/><a target='_blank' href='$thisfeed'>$thisfeed</a>";
                echo "</div>";

                echo "<div id='result'>";
                ?>

                <table id="resulttable">
                    <thead>
                        <tr>
                            <th>Field Value</th><th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $valuearray = array();

                        function transformToTable($feedURL, $field) {

                            global $valuearray;
                            global $base;
                            // create curl resource
                            $ch = curl_init();

                            // set url
                            curl_setopt($ch, CURLOPT_URL, $feedURL);

                            //return the transfer as a string
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                            // $output contains the output string
                            $pageoutput = curl_exec($ch);

                            // close curl resource to free up system resources
                            curl_close($ch);

                            /* try {
                              $pagexml = new SimpleXMLElement($pageoutput);
                              return $pagexml;
                              } catch (Exception $e) {
                              }
                             * 
                             */

                            $pagexml = new SimpleXMLElement($pageoutput);

                            if (isset($pagexml->ListRecords->record)) {
                                foreach ($pagexml->ListRecords->record as $record) {
                                    //echo $pagexml->asXML();
                                    $oai_dc = $record->metadata->children('http://www.openarchives.org/OAI/2.0/oai_dc/');
                                    $dc = $oai_dc->children('http://purl.org/dc/elements/1.1/');
                                    $valueparts = explode(";", $dc->{$field});
                                    foreach ($valueparts as $value) {
                                        $value = trim($value);
                                        if ($value != '') {
                                            $valuearray[$value][] = $value;
                                        }
                                    }
                                }
                            }

                            if (isset($pagexml->ListRecords->resumptionToken)) {
                                $feedURL = $base . "?verb=ListRecords&resumptionToken=" . $pagexml->ListRecords->resumptionToken;
                                transformToTable($feedURL, $field);
                            }
                        }

                        if (isset($_GET['field']) && $_GET['field'] != '') {

                            $facet = htmlspecialchars($_GET['field']);
                            transformToTable($thisfeed, $facet);


                            if (isset($pagexml->ListRecords->resumptionToken)) {
                                $feedURL = $base . "?verb=ListRecords&resumptionToken=" . $pagexml->ListRecords->resumptionToken;
                                transformToTable($feedURL, $facet);
                            }
                        } else {
                            echo "<tr><td colspan='2'>No facet field provided!</td></tr>";
                        }

                        $countarray = array();
                        foreach ($valuearray as $key => $value) {
                            $countarray[] = array('value' => $key, 'count' => count($valuearray[$key]));
                        }


                        foreach ($countarray as $countval) {
                            echo "<tr><td>" . $countval['value'] . "</td><td>" . $countval['count'] . "</td></tr>";
                        }
                        ?>


                    </tbody>
                </table>

        <?php
        echo "</div>";
    }
} else {
// do nothing
}
?>
<?php include('../inc/byline.php');?>
        <script type="text/javascript">
            $(document).ready(function() {
                var vars = [], hash;
                var q = document.URL.split('?')[1];
                if (q !== undefined) {
                    q = q.split('&');
                    for (var i = 0; i < q.length; i++) {
                        hash = q[i].split('=');
                        vars.push(hash[1]);
                        vars[hash[0]] = hash[1];
                    }
                }
                var setreplace = vars['set'].replace(/\+/g, '%20');
                var setvalue = decodeURIComponent(setreplace);
                var fieldreplace = vars['field'].replace(/\+/g, '%20');
                var fieldvalue = decodeURIComponent(fieldreplace);
                $('#setname option[value="' + setvalue + '"]').attr("selected", "selected");
                $('#fieldname option[value="' + fieldvalue + '"]').attr("selected", "selected");
                $("table").tablesorter({sortList: [[1, 1], [0, 0]]});
            });
        </script>
    </body>
</html>