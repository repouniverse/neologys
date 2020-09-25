<?php
?>

<div>
      <div style="width: 600px;">
              <div >
                <table >
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Documento</th>
                   
                    <th>Calificación</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                    foreach($propietarios as $propietario) { 
                    echo"<tr>\n";
                     echo"<td>\n";
                     echo $propietario['nombre'];
                      echo"</td>\n";
                    echo"<td>\n";
                    echo  $propietario['dni'];
                    echo"</td>\n";
                     echo"<td>\n";
                    echo ($propietario['tipo']=='P')?'PROPIETARIO':'RESIDENTE TRANSITORIO';
                    echo"</td>\n";
                   echo"</tr>\n";
                     } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
    
</div>