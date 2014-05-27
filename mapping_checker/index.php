<!DOCTYPE html>
<html>
    <head>
        <title>OAI Aggregation Tools &raquo; DC Mapping Checker</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>

    <body id="mappingchecker">
        <div class="sectionwrap">
            <a href="../">&laquo; Home</a>
        </div>
        <h1>DC Mapping Checker</h1>
        <p>Check incoming oai_dc feeds for correct Dublin Core mappings.</p>
        <div id="formwrap">
            <form method="get" action="">
                <?php if ((isset($_GET['base'])) && ($_GET['base'] !== '')) { ?>
                   
                    <input disabled type="text" value="<?php echo $_GET['base']; ?>"/>
                    <input type="hidden" id="base" name="base" value="<?php echo $_GET['base'];?>"/>
          <?php
                    
                    function getSets($rt) {
                        if($rt!==''){
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
    
                      
                        if(isset($setxml->ListSets->resumptionToken)){
                            if($setxml->ListSets->resumptionToken==''){
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
                            
                            print_r($setarray);
                            sort($setarray);
    
                            foreach ($setarray as $setpair) {
                                $setparts = explode("|",$setpair);
                                echo "<option value='" . $setpair . "'>" . $setparts[0] ." &#x2014; ". $setparts[1] . "</option>";
                            }
                            ?>
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
            $setparts = explode("|", $set);
            $setspec = $setparts[0];
            $setname = $setparts[1];
            
            if (isset($_GET['rt'])){
            $rt = $_GET['rt'];
            if ($rt!==''){
                $thisfeed = $base . "?verb=ListRecords&resumptionToken=" . $rt;
            } else { }
            } else {

            if (($base !== '') && ($set !== '')) {
                $thisfeed = $base . "?verb=ListRecords&set=" . $setspec . "&metadataPrefix=oai_dc";
            } }
        }

        if (isset($thisfeed)) {

            if ($thisfeed != '') {
                 
                            // create curl resource
                $ch = curl_init();

                // set url
                curl_setopt($ch, CURLOPT_URL, $thisfeed);

                //return the transfer as a string
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                // $output contains the output string
                $pageoutput = curl_exec($ch);

                // close curl resource to free up system resources
                curl_close($ch);

                try {
                    $pagexml = new SimpleXMLElement($pageoutput);
                } catch (Exception $e) {
                    
                }
                
                 if (isset($pagexml->ListRecords->resumptionToken)) {
                    $thisrt = $pagexml->ListRecords->resumptionToken;
                 }
                
                
               
                $xml = new DOMDocument;
                if (@$xml->load($thisfeed) === false) {
                    echo "<p>Please enter a valid feed URL.</p>";
                } else {
                    $xsl = new DOMDocument;
                    $xsl->load('xsl/extract_dc.xsl');
                    $proc = new XSLTProcessor;
                    $proc->importStylesheet($xsl);


                    $result = trim($proc->transformToXML($xml));


                    echo "<div class='feedwrap'>";
                    echo "<b>$setname</b><br/><a target='_blank' href='$thisfeed'>$thisfeed</a>";
                    if (isset($thisrt)) { 
                        if($thisrt!=''){
                        echo " <b><a style='margin-left: 30px;' href='?base=$base&set=$set&rt=$thisrt'>Next Page &rarr;</a></b>";
                    }}
                    echo "</div>";
                     echo "<div id='result'>";
                    echo $result;
                    echo "</div>";
                }
            } else {
                // do nothing
        }
        }
            ?>

        <?php include('../inc/byline.php');?>
        <script type="text/javascript">
            $(document).ready(function(){
                var vars = [], hash;
                var q = document.URL.split('?')[1];
                if(q !== undefined){
                    q = q.split('&');
                    for(var i = 0; i < q.length; i++){
                        hash = q[i].split('=');
                        vars.push(hash[1]);
                        vars[hash[0]] = hash[1];
                    }
                }
               var setreplace = vars['set'].replace(/\+/g,'%20');
               var setvalue = decodeURIComponent(setreplace);
               $('#setname option[value="'+setvalue+'"]').attr("selected","selected");
            });
        </script>
</body>
</html>