<?PHP 
use frontend\modules\acad\Module as m;
use yii\helpers\Html;
$this->registerCssFile("@web/css/documentos.css");
?>





<body>
    <div class="centrar"><?=Html::img('@web/img/logo-usmp.svg',['width'=>230,"height"=>100])?></div>
    <br>
    <div class="titsil centrar">
        SÍLABO
   
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
            <td width="40%">1.7 Prerrequisito(s):</td><td width="2px">:</td><td width="58%">POR DEFINIR</td>  
        </tr> 
        <tr >
            <td width="40%">Docentes:</td><td width="2px">:</td><td width="58%"><?=ucwords(mb_strtolower($model->concatNames(),'UTF-8'))?></td>  
        </tr> 
    </table>    
    
    <br>
    


    <div class="pt4 titsil">
        II. SUMILLA <br>
        <div class="justificacion"><?=$model->sumilla?></div>
        <div class="sp1"></div>
        <DIV class="justificacion">Desarrolla las siguientes unidades de aprendizaje:</DIV>
        <ul>
           <?php foreach($model->syllabusUnidades as $unidad){  ?>
            <li><?=$unidad->descripcion?></li>            
           <?php  } ?>
        </ul>
    </div>

    <hr class="linea-sil">
    <div class="pt2 titsil">
        III. COMPETENCIA Y SUS COMPONENTES COMPRENDIDOS EN LA ASIGNATURA

        <?php foreach($model->syllabusCompetencias as $competencia) { ?>
             
           <div class="subtitsil"><?=$competencia->item_bloque.' '.$competencia->bloque?></div>
           <div class="justificacion"><?=$competencia->contenido_bloque?></div>
            <br>
         <?php }  ?>
        
       
    </div>

    <hr class="linea-sil">
    <div class="pt2 titsil">
        IV. PROGRAMACIÓN DE CONTENIDOS

        <div class="pt2">
            <table id="tabla-sil" class="texto-tabla">
                <tbody>
                    <tr>
                        <td class="bg-tabletit" colspan="9">UNIDAD I: Los Géneros del Periodismo y sus Diferencias</td>
                    </tr>
                    <tr class="bg-subtabletit">
                        <td colspan="9">CAPACIDAD: Identifica las diferencias entre información, interpretación y
                            opinión.</td>
                    </tr>
                    <tr>
                        <th colspan="2" width="10%">Semana</th>
                        <th width="20%">Contenidos Conceptuales</th>
                        <th width="25%" colspan="2">Contenidos Procedimentales</th>
                        <th width="25%" colspan="2">Actividad de aprendizaje</th>
                        <th width="10%">Horas de cumpl.</th>
                        <th width="10%">Horas de Trab. Indep.</th>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class="centrar">
                            1
                        </td>
                        <td>
                            <p>Normas generales del sílabo.</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexionan sobre la importancia del cumplimiento de las normas y tareas del curso.</p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea: Discusión del sílabo y apertura de debate entre los
                                alumnos.</p>
                        </td>
                        <td class="centrar">
                            2T
                        </td>
                        <td rowspan="2" class="centrar">
                            1.5
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>La noticia y las diferencias entre los distintos g&eacute;neros.</p>
                        </td>
                        <td colspan="2">
                            <p>Analizan contenidos que se publican en los diarios.</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: Leen e identifican la estructura</p>
                            <p>de los g&eacute;neros periodísticos.</p>
                        </td>
                        <td class="centrar">
                           4P
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class="centrar">
                            2
                        </td>
                        <td>
                            <p>El concepto de opinión. La Argumentación</p>
                            <p>Los juicios de valor y los juicios de hecho. Las valoraciones.</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexionan sobre la persuasión y el convencimiento en el discurso periodístico.
                            </p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea: Discusión sobre el contenido de los diarios.</p>
                        </td>
                        <td class="centrar">
                            2T
                        </td>
                        <td rowspan="2" class="centrar">
                            1.5
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Identificación y clasificación de los argumentos:</p>
                        </td>
                        <td colspan="2">
                            <p>Analizan e identifican lo argumentos con los que se</p>
                            <p>construyen los textos de opinión.</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: Lectura en clase con textos</p>
                            <p>de opinión e identificación sobre su estructura.</p>
                        </td>
                        <td class="centrar">
                            4P
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="centrar">
                            3
                        </td>
                        <td>
                            <p>El mapa de ideas, creación y desarrollo.</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexiona sobre la generación de ideas y</p>
                            <p>&aacute;ngulos informativos a partir de un hecho central.</p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea: An&aacute;lisis de la</p>
                            <p>estructura de argumentos a partir de una editorial.</p>
                        </td>
                        <td class="centrar">
                           2T
                        </td>
                        <td class="centrar">
                           1.5
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>
                            <p>Ejemplos pr&aacute;cticos sobre la elaboración de un mapa de ideas.</p>
                        </td>
                        <td colspan="2">
                            <p>Reconoce las etapas a seguir para la elaboración de un mapa de ideas</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: Desarrollar un tema de actualidad siguiendo las pautas del mapa de ideas.</p>
                        </td>
                        <td class="centrar">
                            4P
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class="centrar">
                            4
                        </td>
                        <td>
                            <p>La exposición y la argumentación</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexiona sobre el juicio lógico y la expresión del pensamiento (juicio de valor).
                            </p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea:</p>
                            <p>Desarrolla un Trabajo pr&aacute;ctico sobre la elaboración de mapa de ideas.</p>
                        </td>
                        <td class="centrar">
                            2T
                        </td>
                        <td rowspan="2" class="centrar">
                            1.5
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Control de lectura</p>
                        </td>
                        <td colspan="2">
                            <p>Analiza el contenido de los textos</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: &ldquo;Nuestro Periodismo&rdquo;,</p>
                            <p>&ldquo;&iquest;Reflejan los media la realidad del mundo?&rdquo; y &ldquo;&iquest;Cómo nos
                                venden la moto?&rdquo;. (Pr&aacute;cticas calificadas)</p>
                        </td>
                        <td class="centrar">
                            4P
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="bg-pie">
                            <strong>Bibliografía de consulta:</strong>
                            <span>
                                <ul>
                                    <li>GONZÁLEZ REYNA, S. (1991). Periodismo de Opinión y Discurso. México: Trillas.</li>
                                    <li>NATIVIDAD, A. (1999). Periodismo de opinión: claves de la retórica periodística. Madrid: Síntesis.</li>
                                </ul>    
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pt2">
            <table id="tabla-sil" class="texto-tabla">
                <tbody>
                    <tr>
                        <td class="bg-tabletit" colspan="9">UNIDAD I: Los Géneros del Periodismo y sus Diferencias</td>
                    </tr>
                    <tr class="bg-subtabletit">
                        <td colspan="9">CAPACIDAD: Identifica las diferencias entre información, interpretación y
                            opinión.</td>
                    </tr>
                    <tr>
                        <th colspan="2" width="10%">Semana</th>
                        <th width="20%">Contenidos Conceptuales</th>
                        <th width="25%" colspan="2">Contenidos Procedimentales</th>
                        <th width="25%" colspan="2">Actividad de aprendizaje</th>
                        <th width="10%">Horas de cumpl.</th>
                        <th width="10%">Horas de Trab. Indep.</th>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class="centrar">
                            1
                        </td>
                        <td>
                            <p>Normas generales del sílabo.</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexionan sobre la importancia del cumplimiento de las normas y tareas del curso.</p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea: Discusión del sílabo y apertura de debate entre los
                                alumnos.</p>
                        </td>
                        <td class="centrar">
                            2T
                        </td>
                        <td rowspan="2" class="centrar">
                            1.5
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>La noticia y las diferencias entre los distintos g&eacute;neros.</p>
                        </td>
                        <td colspan="2">
                            <p>Analizan contenidos que se publican en los diarios.</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: Leen e identifican la estructura</p>
                            <p>de los g&eacute;neros periodísticos.</p>
                        </td>
                        <td class="centrar">
                           4P
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class="centrar">
                            2
                        </td>
                        <td>
                            <p>El concepto de opinión. La Argumentación</p>
                            <p>Los juicios de valor y los juicios de hecho. Las valoraciones.</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexionan sobre la persuasión y el convencimiento en el discurso periodístico.
                            </p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea: Discusión sobre el contenido de los diarios.</p>
                        </td>
                        <td class="centrar">
                            2T
                        </td>
                        <td rowspan="2" class="centrar">
                            1.5
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Identificación y clasificación de los argumentos:</p>
                        </td>
                        <td colspan="2">
                            <p>Analizan e identifican lo argumentos con los que se</p>
                            <p>construyen los textos de opinión.</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: Lectura en clase con textos</p>
                            <p>de opinión e identificación sobre su estructura.</p>
                        </td>
                        <td class="centrar">
                            4P
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="centrar">
                            3
                        </td>
                        <td>
                            <p>El mapa de ideas, creación y desarrollo.</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexiona sobre la generación de ideas y</p>
                            <p>&aacute;ngulos informativos a partir de un hecho central.</p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea: An&aacute;lisis de la</p>
                            <p>estructura de argumentos a partir de una editorial.</p>
                        </td>
                        <td class="centrar">
                           2T
                        </td>
                        <td class="centrar">
                           1.5
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>
                            <p>Ejemplos pr&aacute;cticos sobre la elaboración de un mapa de ideas.</p>
                        </td>
                        <td colspan="2">
                            <p>Reconoce las etapas a seguir para la elaboración de un mapa de ideas</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: Desarrollar un tema de actualidad siguiendo las pautas del mapa de ideas.</p>
                        </td>
                        <td class="centrar">
                            4P
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class="centrar">
                            4
                        </td>
                        <td>
                            <p>La exposición y la argumentación</p>
                        </td>
                        <td colspan="2">
                            <p>Reflexiona sobre el juicio lógico y la expresión del pensamiento (juicio de valor).
                            </p>
                        </td>
                        <td colspan="2">
                            <p>Sesión en línea:</p>
                            <p>Desarrolla un Trabajo pr&aacute;ctico sobre la elaboración de mapa de ideas.</p>
                        </td>
                        <td class="centrar">
                            2T
                        </td>
                        <td rowspan="2" class="centrar">
                            1.5
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Control de lectura</p>
                        </td>
                        <td colspan="2">
                            <p>Analiza el contenido de los textos</p>
                        </td>
                        <td colspan="2">
                            <p>Tarea: &ldquo;Nuestro Periodismo&rdquo;,</p>
                            <p>&ldquo;&iquest;Reflejan los media la realidad del mundo?&rdquo; y &ldquo;&iquest;Cómo nos
                                venden la moto?&rdquo;. (Pr&aacute;cticas calificadas)</p>
                        </td>
                        <td class="centrar">
                            4P
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" class="bg-pie">
                            <strong>Bibliografía de consulta:</strong>
                            <span>
                                <ul>
                                    <li>GONZÁLEZ REYNA, S. (1991). Periodismo de Opinión y Discurso. México: Trillas.</li>
                                    <li>NATIVIDAD, A. (1999). Periodismo de opinión: claves de la retórica periodística. Madrid: Síntesis.</li>
                                </ul>    
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        
    </div>



    <hr class="linea-sil">
    <div class="pt2 titsil">
        V. ESTRATEGIAS METODOLÓGICAS
        <span>
            Se emplearán las estrategias de atención, adquisición y evaluación. Asimismo, se desarrollarán diversos ejercicios con el propósito de que el alumno aprenda a argumentar.
        </span>
        <div class="sp1"></div>
        <span>Entre las técnicas de aprendizaje que se aplicarán:</span>
        <ul>
            <li>Técnicas de elaboración: elaboraciones conceptuales.</li>
            <li>Técnicas de organización: uso de mapas conceptuales y uso de estructuras textuales. </li>
            <li>Técnicas de recuperación: búsqueda directa.</li>
        </ul>
        <span>
            <p>
                Para la revisión del lenguaje que se utilizan en medios, los alumnos prestarán atención sostenida a distintos diarios peruanos con el objetivo de valorar la noticia y seleccionar errores.
            </p>
            <p>
                Con el objetivo de retención de conocimiento en la parte de redacción y ortografía, los alumnos corregirán textos donde se aplicará el uso de tildación, tildes diacríticas, uso de mayúsculas, minúsculas, siglas, números, entre otros.
            </p>
            <p>
                El trabajo final será grupal y consiste en elaborar un proyecto de periódico con la misma rigurosidad de cualquier publicación impresa. Los alumnos presentarán periódicamente avances de sus notas periodísticas para su posterior revisión y evaluación.
            </p>
        </span>
    </div>


    <hr class="linea-sil">
    <div class="pt2 titsil">
        VI. RECURSOS DIDÁCTICOS
        <div class="sp1"></div>
            <ul>
                <li>Libros digitales</li>
                <li>Portafolio</li>
                <li>Clases en línea</li>
                <li>Foros</li>
                <li>Chats</li>
                <li>Correo</li>
                <li>Video tutoriales</li>
                <li>Wikis</li>
                <li>Blog</li>
                <li>E-books</li>
                <li>Videos explicativos</li>
                <li>Organizadores visuales</li>
                <li>Presentaciones multimedia, entre otros.</li>
            </ul>
    </div>

    <hr class="linea-sil">
    <div class="pt2 titsil">
        VII. EVALUACIÓN DEL APRENDIZAJE
        <div class="sp1"></div>
        <ul>
            <li>Es permanente e integral en función de los objetivos planteados.</li>
            <li>Se realizarán 2 prácticas calificadas y 3 controles de lectura (uno opcional). Así como evaluaciones orales constantes a criterio del docente a cargo del curso.</li>
            <li>Se realizarán 02 exámenes escritos (Parcial y Final) durante el semestre, según programa.</li>
            <li>La calificación es vigesimal (de cero a veinte)</li>
            <li>La nota mínima aprobatoria será Once (11)</li>
        </ul>
        <span class="nota-sil">
            El promedio para la nota final es el resultado de la siguiente fórmula: <br>
            (Promedio de Evaluaciones + Examen Parcial + Examen Final) / 3 = NOTA FINAL
        </span>
    </div>


    <hr class="linea-sil">
    <div class="pt2 titsil">
        VIII. FUENTES DE INFORMACIÓN
        <div class="sp1"></div>
        <div class="subtitsil">Fuentes Bibliográficas</div>
        <ul>
            <li>ARISTÓTELES. (1999) “Retórica”: Madrid. Centro De Estudios Constitucionales.</li>
            <li>BASTENIER, M. (2001). El Blanco Móvil: Curso De Periodismo. Madrid: El País.</li>
            <li> CANTAVELLA, Serrano, (2015). Redacción para Periodistas: Opinar Y Argumentar. Madrid: Universitas.</li>
            <li>FERNÁNDEZ, Cavia, Huertas, Roig  (2009). Redacción En Relaciones Públicas. Pearson Educación S.A.</li>
            <li>GARCÍA MÁRQUEZ, G. (1989): El General En Su Laberinto. Bogotá, Editorial Oveja Negra.</li>
            <li>GARCÍA, V. (2011). Manual De Géneros Periodísticos. Ecoe Ediciones. Bogotá.</li>
            <li>GONZÁLEZ REYNA, S. (1991). Periodismo de Opinión y Discurso. México: Trillas.</li>
            <li>LÓPEZ HIDALGO  (2009), Antonio: Géneros Periodísticos  Complementarios. México, Alfaomega.</li>
            <li>MARTÍNEZ ALBERTOS, JL (2007): Curso General de Redacción Periodística. Madrid, Edición revisada Paraninfo.</li>
            <li>NATIVIDAD, A. (1999). Periodismo de opinión: claves de la retórica periodística.</li>
            <li>PEÑA DE OLIVERA, F (2009). Teoría del periodismo. México, Alfaomega.</li>
            <li> SANTAMARIA, L y CASALS, MJ: (2000) La Opinión Periodística. Argumentos y géneros para la persuasión. Madrid, Editorial Fragua.</li>
            <li>SERRA, A.; RITACCO, E. (2004): Curso de Periodismo Escrito. Buenos Aires. Editorial Atlántida.</li>
            <li>VÁSQUEZ, A (2000): Conflicto entre intimidad y libertad de Información. Lima, Ediciones U. de San Martín de Porres. </li>
            <li>WESTON, A. (2011). Las claves de la argumentación. Barcelona: Ariel.</li>      
        </ul>
        <div class="sp1"></div>
        <div class="subtitsil">Fuentes Bibliográficas</div>
        <ul>
            <li>CHOMSKY, Noam; RAMONET, Ignacio. ¿Cómo nos venden la moto? en <a href="#" class="link-sil">https://kmarx.files.wordpress.com/2013/11/cc3b3mo-nos-venden-la-moto- chomsky_ramonet.pdf</a></li>
            <li>FALLACI, Oriana. La rabia y el orgullo. En <a href="#" class="link-sil">http://elmundosalud.elmundo.es/especiales/2001/09/internacional/ataqueusa/oriana.pdf</a></li>
            <li>RAMONET, Ignacio. La Tiranía de la Comunicación. En <a href="#" class="link-sil">https://cotayorosebud.files.wordpress.com/2015/04/ramonetignacio- latiraniadelascomunicaciones- 090908165335-phpapp02-1.pdf</a></li>
            <li>MONTANER, Alberto. Las raíces torcidas de América Latina. En <a href="#" class="link-sil">http://www.hacer.org/pdf/Montaner16.pdf</a></li>
     
        </ul>
    </div>


</body>

