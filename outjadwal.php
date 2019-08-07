<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" >
    <title>Belajar PHP</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="style.css" rel="stylesheet">
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



    $matkul = array();
    while(strpos($html,"<b>")){
      $tmp = substr($html, strpos($html,"<b>")+3, strpos($html,"</b>")-strpos($html,"<b>")-3);
      $html =  str_substract("<b>",$html);
      $html = str_substract("</b>",$html);
    // echo $html;
    //  echo $tmp;
      //echo "<br>";
      array_push($matkul,$tmp);
    }

    $ruang = array();
    $jadwal = array();

    while(strpos($html,"<td nowrap>"))
      {
      $html = str_substract("<td nowrap>",$html);
      $cek = substr($html, strpos($html, "<td nowrap>")+11,strlen($html));
      $cek = substr($cek, 0, strpos($cek,"</td>"));
      $html = str_substract("<td nowrap>",$html);
      $cekRuang = substr($cek, strpos($cek,"Ruang"), strlen($cek)-strpos($cek,"Ruang"));
      $tmpCekRuang = " ".$cekRuang;
      $cekJadwal = str_substract($tmpCekRuang,$cek);

      $cekRuang = str_substract("Ruang ",$cekRuang);
      array_push($ruang,$cekRuang);
      array_push($jadwal,$cekJadwal);
    }

      $kelas = array();
    //  echo $html;
    while(strpos($html,"<br/>")){
      $html = str_substract("</td>",$html);
      $html = str_substract("</td>",$html);
    //  $html = str_substract("<br/>",$html);
    //  echo strpos($html,"</td>");
      $tmp = substr($html, strpos($html,"<br/>")+5, strpos($html,"</td>")-strpos($html,"<br/>")-37);
//      echo $tmp."ok";
      $html = str_substract("</td>",$html);
      $html = str_substract("</td>",$html);
      $html = str_substract("</td>",$html);
      $html = str_substract("</td>",$html);
      $html = str_substract("</td>",$html);
      $html = str_substract("<br/>",$html);

      $tmp = str_substract("Kelas: ",$tmp);
      array_push($kelas, $tmp);
    }
  //  var_dump($kelas);


    function str_substract($remove,&$html){
      $strposisi = strpos($html,$remove);
      return substr($html, 0, $strposisi) . substr($html, $strposisi + strlen($remove));
    }

    ?>
    <?php

      for($i=0;$i<sizeof($ruang)-1;$i++){

        for($j=$i+1;$j<sizeof($ruang);$j++){
          if(strpos($jadwal[$i],"enin")){
            if(strpos($jadwal[$j],"enin")){
              if(strcmp($jadwal[$i],$jadwal[$j]) > 0){
                $tmp = $jadwal[$i];
                $jadwal[$i] = $jadwal[$j];
                $jadwal[$j] = $tmp;

                $tmp = $ruang[$i];
                $ruang[$i] = $ruang[$j];
                $ruang[$j] = $tmp;

                $tmp = $matkul[$i];
                $matkul[$i] = $matkul[$j];
                $matkul[$j] = $tmp;

                $tmp = $kelas[$i];
                $kelas[$i] = $kelas[$j];
                $kelas[$j] = $tmp;
              }
            }
          }else if(strpos($jadwal[$i],"elasa")){
            if(strpos($jadwal[$j],"enin")){
              $tmp = $jadwal[$i];
              $jadwal[$i] = $jadwal[$j];
              $jadwal[$j] = $tmp;

              $tmp = $ruang[$i];
              $ruang[$i] = $ruang[$j];
              $ruang[$j] = $tmp;

              $tmp = $matkul[$i];
              $matkul[$i] = $matkul[$j];
              $matkul[$j] = $tmp;

              $tmp = $kelas[$i];
              $kelas[$i] = $kelas[$j];
              $kelas[$j] = $tmp;
            }else if(strpos($jadwal[$j],"elasa")){
              if(strcmp($jadwal[$i],$jadwal[$j]) >0 ) {
                $tmp = $jadwal[$i];
                $jadwal[$i] = $jadwal[$j];
                $jadwal[$j] = $tmp;

                $tmp = $ruang[$i];
                $ruang[$i] = $ruang[$j];
                $ruang[$j] = $tmp;

                $tmp = $matkul[$i];
                $matkul[$i] = $matkul[$j];
                $matkul[$j] = $tmp;

                $tmp = $kelas[$i];
                $kelas[$i] = $kelas[$j];
                $kelas[$j] = $tmp;
              }
            }

          }else if(strpos($jadwal[$i],"abu")){
            if(strpos($jadwal[$j],"enin") || strpos($jadwal[$j],"elasa")){
              $tmp = $jadwal[$i];
              $jadwal[$i] = $jadwal[$j];
              $jadwal[$j] = $tmp;

              $tmp = $ruang[$i];
              $ruang[$i] = $ruang[$j];
              $ruang[$j] = $tmp;

              $tmp = $matkul[$i];
              $matkul[$i] = $matkul[$j];
              $matkul[$j] = $tmp;

              $tmp = $kelas[$i];
              $kelas[$i] = $kelas[$j];
              $kelas[$j] = $tmp;
            }else if(strpos($jadwal[$j],"abu")){
              if(strcmp($jadwal[$i],$jadwal[$j]) >0 ) {
                $tmp = $jadwal[$i];
                $jadwal[$i] = $jadwal[$j];
                $jadwal[$j] = $tmp;

                $tmp = $ruang[$i];
                $ruang[$i] = $ruang[$j];
                $ruang[$j] = $tmp;

                $tmp = $matkul[$i];
                $matkul[$i] = $matkul[$j];
                $matkul[$j] = $tmp;

                $tmp = $kelas[$i];
                $kelas[$i] = $kelas[$j];
                $kelas[$j] = $tmp;
              }
            }
          }else if(strpos($jadwal[$i],"amis")){
            if(strpos($jadwal[$j],"enin") || strpos($jadwal[$j],"elasa") || strpos($jadwal[$j],"abu")){
              $tmp = $jadwal[$i];
              $jadwal[$i] = $jadwal[$j];
              $jadwal[$j] = $tmp;

              $tmp = $ruang[$i];
              $ruang[$i] = $ruang[$j];
              $ruang[$j] = $tmp;

              $tmp = $matkul[$i];
              $matkul[$i] = $matkul[$j];
              $matkul[$j] = $tmp;

              $tmp = $kelas[$i];
              $kelas[$i] = $kelas[$j];
              $kelas[$j] = $tmp;

            }else if(strpos($jadwal[$j],"amis")){
              if(strcmp($jadwal[$i],$jadwal[$j]) >0 ) {
                $tmp = $jadwal[$i];
                $jadwal[$i] = $jadwal[$j];
                $jadwal[$j] = $tmp;

                $tmp = $ruang[$i];
                $ruang[$i] = $ruang[$j];
                $ruang[$j] = $tmp;

                $tmp = $matkul[$i];
                $matkul[$i] = $matkul[$j];
                $matkul[$j] = $tmp;

                $tmp = $kelas[$i];
                $kelas[$i] = $kelas[$j];
                $kelas[$j] = $tmp;
              }
            }
          }else if(strpos($jadwal[$i],"umat")){
            if(strpos($jadwal[$j],"enin") || strpos($jadwal[$j],"elasa") || strpos($jadwal[$j],"abu") || strpos($jadwal[$j],"amis")){
              $tmp = $jadwal[$i];
              $jadwal[$i] = $jadwal[$j];
              $jadwal[$j] = $tmp;

              $tmp = $ruang[$i];
              $ruang[$i] = $ruang[$j];
              $ruang[$j] = $tmp;

              $tmp = $matkul[$i];
              $matkul[$i] = $matkul[$j];
              $matkul[$j] = $tmp;

              $tmp = $kelas[$i];
              $kelas[$i] = $kelas[$j];
              $kelas[$j] = $tmp;

            }else if(strpos($jadwal[$j],"umat")){
              if(strcmp($jadwal[$i],$jadwal[$j]) >0 ) {
                $tmp = $jadwal[$i];
                $jadwal[$i] = $jadwal[$j];
                $jadwal[$j] = $tmp;

                $tmp = $ruang[$i];
                $ruang[$i] = $ruang[$j];
                $ruang[$j] = $tmp;

                $tmp = $matkul[$i];
                $matkul[$i] = $matkul[$j];
                $matkul[$j] = $tmp;

                $tmp = $kelas[$i];
                $kelas[$i] = $kelas[$j];
                $kelas[$j] = $tmp;
              }
            }
          }
        }
      }



     ?>

     <div class="container">


       <table border="1" class="table"style="width:100%">
         <thead>
        <tr >
          <th scope="col" style="text-align:center"><strong>Jadwal</strong></th>
          <th scope="col" style="text-align:center"><strong>Matkul</strong></th>
          <th scope="col" style="text-align:center"><strong>Ruang</strong></th>
          <th scope="col" style="text-align:center"><strong>Kelas</strong></th>
        </tr>
        </thead>
        <tbody>
        <tr>

          <?php
            for ($i=0; $i < sizeof($matkul); $i++) {
              echo "<th style=\"text-align:center\" >";
              echo $jadwal[$i];
              echo "</th>";
              echo "<th style=\"text-align:center\">";
              echo $matkul[$i];
              echo "</th>";
              echo "<th style=\"text-align:center\">";
              echo $ruang[$i];
              echo "</th>";
              echo "<th style=\"text-align:center\">";
              echo $kelas[$i];
              echo "</th>";
              echo "</tr>";
            }

           ?>
         </tbody>
       </table>
     </div>
  </body>



</html>
