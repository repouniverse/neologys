<?php
?>

<div>
      <div style="width: 300px;">
              <div >
                <table >
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Area(m2)</th>
                   
                    <th>Participacion</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                   $area=0;
                       $parti=0;
                       
                    // var_dump($areas['aareas'],$areas['aareas'][0]['nombre']);die();
                   foreach($areas['aareas'] as $registroArea) { 
                       $area+=$registroArea['area']+0;
                       $parti+=$registroArea['participacion']+0;
                      
                    echo"<tr>\n";
                     echo"<td>\n";
                     echo $registroArea['nombre'];
                      echo"</td>\n";
                    echo"<td>\n";
                    echo round($registroArea['area']+0,3);
                    echo"</td>\n";
                     echo"<td>\n";
                    echo 100*round($registroArea['participacion']+0,9);
                    echo"</td>\n";
                   echo"</tr>\n";
                     } ?>
                  <tr >
                    <td style="font-weight: bold;">Total:</td>
                    <td style="font-weight: bold;">
                     
                    <?=round($area,3)?>
                    </td>
                    <td style="font-weight: bold;">
                    <?=100*round($parti,8)?>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
    
</div>