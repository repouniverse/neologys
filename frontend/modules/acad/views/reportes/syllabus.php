<?PHP 
use frontend\modules\acad\Module as m;
use yii\helpers\Html;
$this->registerCssFile("@web/css/documentos.css");
?>





<body>
    <div class="centrar"><?=Html::img('@web/img/logo-usmp.svg',['width'=>230,"height"=>100])?></div>
    <br>
    <div class="titsil centrar">
        SILABO
   
        <br>
        <span>Sílabo adaptado en el marco de la emergencia sanitaria por el COVID-19</span>
    </div>
    <div class="titsil centrar">
        <?=$model->curso->descripcion ?>
        <br>
        <span>Asignatura no presencial</span>
    </div>

    <div class="pt4 titsil">
        I. DATOS GENERALES
       
    </div>

    
    <table cellspacing="0" border="2px" class="row-encabezado"  > 
        <tr  >
            <td width="40%">1.1 Unidad Académica</td><td width="2px">:</td><td width="58%"><?=$model->plan->carrera->nombre?></td>  
        </tr> 
        <tr style="margin: 10px;">
            <td width="40%">1.2 Semestre Académico:</td><td width="2px">:</td><td width="58%"><?=$model->plan->plan->codperiodo?></td>  
        </tr> 
        <tr >
            <td width="40%">1.3 Código de asignatura:</td><td width="2px">:</td><td width="58%"><?=$model->plan->codcursocorto?></td>  
        </tr> 
        <tr >
            <td width="40%">1.4 Ciclo:</td><td width="2px">:</td><td width="58%"><?=m::cicleInLetters($model->plan->ciclo)?></td>  
        </tr> 
        <tr >
            <td width="40%">1.5 Créditos:</td><td width="2px">:</td><td width="58%"><?=$model->plan->creditos?></td>  
        </tr> 
        <tr >
            <td width="40%">1.6 Horas semanales total</td><td width="2px">:</td><td width="58%"><?=$model->plan->hoursForWeek()?></td>  
        </tr> 
        
        
        
        <tr >
            <td width="40%"> - 1.6.1 Horas de teoría y práctica:</td><td width="2px">:</td><td width="58%">HT <?=$model->plan->hteoria?> - HP <?=$model->plan->hpractica?></td>  
        </tr> 
        <tr >
            <td width="40%"> - 1.6.2 Horas de trabajo independiente:</td><td width="2px">:</td><td width="58%"><?php echo $model->n_horasindep?></td>  
        </tr>   
        <tr >
            <td width="40%">1.7 Requisito(s):</td><td width="2px">:</td><td width="58%"><?=$model->concatPreRequisites()?></td>  
        </tr> 
        <tr >
            <td width="40%">Docentes:</td><td width="2px">:</td><td width="58%"><?=ucwords(mb_strtolower($model->concatNames(),'UTF-8'))?></td>  
        </tr> 
    </table>    
    
    <br>
    


    <div class="pt4 titsil">
        II. SUMILLA <br>
     </div>
        <div class="justificacion"><?=$model->sumilla?></div>
        <div class="sp1"></div>
        <DIV class="justificacion">Desarrolla las siguientes unidades de aprendizaje:</DIV>
        <ul>
           <?php foreach($model->syllabusUnidades as $unidad){  ?>
            <li><?=$unidad->descripcion?></li>            
           <?php  } ?>
        </ul>
   

    <hr class="linea-sil">
    <div class="pt2 titsil">
        III. COMPETENCIA Y SUS COMPONENTES COMPRENDIDOS EN LA ASIGNATURA
    </div>
        <?php foreach($model->syllabusCompetencias as $competencia) { ?>
             
           <div class="subtitsil"><?=$competencia->item_bloque.' '.$competencia->bloque?></div>
           <div class="justificacion"><?=$competencia->contenido_bloque?></div>
            <br>
         <?php }  ?>
        
       
    

    <hr class="linea-sil">
    <div class="pt2 titsil">
        IV. PROGRAMACIÓN DE CONTENIDOS

        
        <div class="pt2">
            <table id="tabla-sil" class="texto-tabla">
                <tbody>
                     <?php foreach($model->syllabusUnidades as $unidad){  ?>
                    <tr>
                        <td class="bg-tabletit" colspan="6"><?=$unidad->descripcion?></td>
                    </tr>
                    <tr class="bg-subtabletit">
                        <td colspan="6"><?=$unidad->capacidad?></td>
                    </tr>
                    <tr>
                        <th width="10%">Semana</th>
                        <th width="20%">Contenidos Conceptuales</th>
                        <th width="25%" >Contenidos Procedimentales</th>
                        <th width="25%" >Actividad de aprendizaje</th>
                        <th width="10%">Horas de cumpl.</th>
                        <th width="10%">Horas de Trab. Indep.</th>
                    </tr>
                    
                    <?php foreach( $model->acadContenidoSyllabus as $contenido ){   ?>
                    
                    <tr>
                        <td  class="centrar" >
                            <?=$contenido->n_semana?>
                        </td>
                        <td>
                            <p><?=$contenido->bloque1?></p>
                        </td>
                        <td >
                            <p><?=$contenido->bloque2?></p>
                        </td>
                        <td >
                             <p><?=$contenido->bloque3?></p>
                        </td>
                        <td class="centrar">
                            <?=$contenido->n_horas_cumplimiento?>
                        </td>
                        <td  class="centrar">
                             <?=$contenido->n_horas_trabajo_indep?>
                        </td>
                    </tr>
                   <?php  ?>
                    <?php  }  ?>
                   <?php  }  ?>
                </tbody>
            </table>
        </div>        
        
    </div>



    <hr class="linea-sil">
    <div class="pt2 titsil">
        V. ESTRATEGIAS METODOLÓGICAS
    </div>
        
        
        <div class="justificacion">
           <?=$model->estrat_metod?>
        </div>
       


    <hr class="linea-sil">
    <div class="pt2 titsil">
        VI. RECURSOS DIDÁCTICOS
    </div>
        <div class="justificacion">
             <?=$model->recursos_didac?>
    </div>

    <hr class="linea-sil">
    <div class="pt2 titsil">
        VII. EVALUACIÓN DEL APRENDIZAJE
    </div>
        <div class="justificacion"><?=$model->reserva1?> </div>
        
   


    <hr class="linea-sil">
    <div class="pt2 titsil">
        VIII. FUENTES DE INFORMACIÓN
    </DIV>
        <div class="justificacion"><?=$model->fuentes_info?></div>
        
    


</body>

