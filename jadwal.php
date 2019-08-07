<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" >
    <title>Belajar PHP</title>
  </head>
  <body>
    <?php
    $dom = new DomDocument();
  //  $internalErrors = libxml_use_internal_errors(true);
    $test = $_POST['name'];
    // echo strpos($test,"<tbody>");
    // echo strpos($test, "</tbody>");

    $html = substr($test,strpos($test,"<tbody>"),strpos($test,"</tbody")-strpos($test,"<tbody>"));
  //  $test = substr($test, )

  //  echo $html;
    $dom->loadHTML($html);
  //  var_dump($dom);
    function fixAmps(&$html, $offset){
         $positionAmp = strpos($html, '&', $offset);
         $positionSemiColumn = strpos($html, ';', $positionAmp+1);

         $string = substr($html, $positionAmp, $positionSemiColumn-$positionAmp+1);

         if ($positionAmp !== false) { // If an '&' can be found.
             if ($positionSemiColumn === false) { // If no ';' can be found.
                 $html = substr_replace($html, '&amp;', $positionAmp, 1); // Replace straight away.
             } else if (preg_match('/&(#[0-9]+|[A-Z|a-z|0-9]+);/', $string) === 0) { // If a standard escape cannot be found.
                 $html = substr_replace($html, '&amp;', $positionAmp, 1); // This mean we need to escapa the '&' sign.
                 fixAmps($html, $positionAmp+5); // Recursive call from the new position.
             } else {
                 fixAmps($html, $positionAmp+1); // Recursive call from the new position.
             }
         }
    }
  //  libxml_use_internal_errors($internalErrors);
    $xpath = new DOMXpath($dom);
    $days = array();
    $times = array();
    $rooms = array();
    $heading=parseToArray($xpath);
    $content=parseToArray2($xpath);
    foreach ($content as $key) {
      if(strpos($key, 'Ruang') !== false){
        $hari = substr($key,0,strpos($key, ","));
        $waktu = substr($key,strpos($key,",")+2,11);
        $ruang = substr($key,strpos($key,"Ruang"), strlen($key)-strpos($key,"Ruang"));
        array_push($rooms,$ruang);
        array_push($days,$hari);
        array_push($times,$waktu);
      }
    }
    // var_dump($rooms);
    // var_dump($times);
    // var_dump($days);
    // var_dump($heading);
    ////var_dump($content);

    function parseToArray($xpath)
    {
      $xpathquery="//td/b";
      $elements = $xpath->query($xpathquery);

      if (!is_null($elements)) {
        $resultarray=array();
        foreach ($elements as $element) {
            $nodes = $element->childNodes;
            foreach ($nodes as $node) {
              $resultarray[] = $node->nodeValue;
            }
        }
        return $resultarray;
      }
    }
    function parseToArray2($xpath)
    {
      $xpathquery="//td[@nowrap]";
      $elements = $xpath->query($xpathquery);

      if (!is_null($elements)) {
        $resultarray=array();
        foreach ($elements as $element) {
            $nodes = $element->childNodes;
            foreach ($nodes as $node) {
              $resultarray[] = $node->nodeValue;
            }
        }
        return $resultarray;
      }
    }
    //  $internalErrors = libxml_use_internal_errors(false);
    ?>

      <table style="width:100%">
        <tr>
          <th>Hari</th>
          <th>Matkul</th>
          <th>Waktu</th>
          <th>Ruang</th>
        </tr>

        <tr>
          <?php
            for ($i=0; $i < sizeof($heading); $i++) {
              echo "<th>";
              echo $days[$i];
              echo "</th>";
              echo "<th>";
              echo $heading[$i];
              echo "</th>";
              echo "<th>";
              echo $times[$i];
              echo "</th>";
              echo "<th>";
              echo $rooms[$i];
              echo "</th>";
              echo "</tr>";
            }

           ?>

      </table>



  </body>



</html>
