<?php

namespace frontend\modules\report\models;
use frontend\modules\report\Module as ModuleReporte;
use common\models\masters\Sociedades;
use common\models\masters\Centros;
use common\models\masters\Documentos;
use common\models\masters\Monedas;
use frontend\modules\report\behaviors\FileBehavior;
use Yii;
use common\helpers\h;
use frontend\modules\report\models\baseReporte;
use  yii\web\ServerErrorHttpException;
class Reporte extends baseReporte
{
    /**
     * {@inheritdoc}
     */
     public $booleanFields=['tienelogo','tienepie','comercial','tienecabecera'];
    public $imagen;
    public $hardFields=['codocu','modelo'];
    public $routesSplit=[];//array para almacenar las rutas de los archivos picados 
    //public $type='pdf';
    public static function tableName()
    {
        return '{{%reportes}}';
    }

    public function behaviors()
{
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		],
               
		
	];
}
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['role'], 'safe'],
            [['xgeneral', 'ygeneral', 'xlogo', 'ylogo', 'x_grilla', 'y_grilla', 'registrosporpagina', 'xresumen', 'yresumen'], 'integer'],
            [['codocu','role', 'codcen', 'modelo', 'nombrereporte', 'campofiltro', 'tamanopapel'], 'required'],
            [['detalle'], 'string'],
            [['codocu'], 'string', 'max' => 3],
            [['registrosporpagina'], 'integer', 'min' => 1],
            [['codcen'], 'string', 'max' => 5],
            [['modelo', 'nombrereporte'], 'string', 'max' => 60],
            [['campofiltro'], 'string', 'max' => 40],
            [['tamanopapel'], 'string', 'max' => 20],
            [['tienepie', 'tienelogo', 'comercial', 'tienecabecera'], 'string', 'max' => 1],
            [['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
            [['codocu'], 'exist', 'skipOnError' => true, 'targetClass' => Documentos::className(), 'targetAttribute' => ['codocu' => 'codocu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'xgeneral' => Yii::t('base.names', 'Xgeneral'),
            'ygeneral' => Yii::t('base.names', 'Ygeneral'),
            'xlogo' => Yii::t('base.names', 'Xlogo'),
            'ylogo' => Yii::t('base.names', 'Ylogo'),
            'codocu' => Yii::t('base.names', 'Codocu'),
            'codcen' => Yii::t('base.names', 'Codcen'),
            'modelo' => Yii::t('base.names', 'Modelo'),
            'nombrereporte' => Yii::t('base.names', 'Nombrereporte'),
            'detalle' => Yii::t('base.names', 'Detalle'),
            'campofiltro' => Yii::t('base.names', 'Campofiltro'),
            'tamanopapel' => Yii::t('base.names', 'Tamanopapel'),
            'x_grilla' => Yii::t('base.names', 'X Grilla'),
            'y_grilla' => Yii::t('base.names', 'Y Grilla'),
            'registrosporpagina' => Yii::t('base.names', 'Registrosporpagina'),
            'tienepie' => Yii::t('base.names', 'Tienepie'),
            'tienelogo' => Yii::t('base.names', 'Tienelogo'),
            'xresumen' => Yii::t('base.names', 'Xresumen'),
            'yresumen' => Yii::t('base.names', 'Yresumen'),
            'comercial' => Yii::t('base.names', 'Comercial'),
            'tienecabecera' => Yii::t('base.names', 'Tienecabecera'),
        ];
    }

    
    public function init(){
        parent::init();
        //if(empty($this->registrosporpagina))
           // throw new \yii\base\Exception(Yii::t('report.messages', 'The module \'registrosporpagina\'  property is empty'));
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportedetalle()
    {
        return $this->hasMany(Reportedetalle::className(), ['hidreporte' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentro()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documentos::className(), ['codocu' => 'codocu']);
    }

    /**
     * {@inheritdoc}
     * @return ReporteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReporteQuery(get_called_class());
    }
    
    /*
     * Cheka si ya tine un registr hijo copn nombe decampo nameField
     */
    public function existsChildField($nameField){
        return (count(Reportedetalle::find()->where(
                ['hidreporte'=>$this->id,
                    'nombre_campo'=>$nameField]
                                    )->asArray()->all())>0)?true:false; 
        
    }
    
    
    /*
     * Hace l acbecera del reporte*
     */
    public function putCabecera($id,$idfiltro,$campofiltro=null){        
        /* $hijos= registros que deen pintarse en la cabcera del reporte   */
             $hijosCabecera=$this->getReportedetalle()->where(['and', "esdetalle='0'", ['or', "visiblelabel='1'", "visiblecampo='1'"]])->all();
		//var_dump($hijosCabecera);die();
             $HTML_cabecera="";
               //var_dump($idfiltro,$campofiltro);die();
             $modelin=$this->modelToRepor($idfiltro,$campofiltro);
             //var_dump($modelin);die();
     foreach( $hijosCabecera as $record) {
          // var_dump($this->modelToRepor($idfiltro));die();
		 $HTML_cabecera.=$record->putStyleField($record->nombre_campo,$modelin->{$record->nombre_campo}); 
               }
           unset($modeloToReport);unset($hijosCabecera);unset($clase);
         return $HTML_cabecera;
      }
         
   
      /*
     * Hace cabeera del pdf siempre que sea pdf *
     */
    public function putHeaderReport($id,$idfiltro){
       return  "Date : ".date('Y-m-d H:i:s');
        
      }
      
    
    public function modelToRepor($idfiltro,$campofiltro=null){
      $clase=trim($this->modelo); 
     // echo $campofiltro; die();
      if(is_null($campofiltro)){
        // VAR_DUMP($clase,(new $clase())->getTableSchema()->primaryKey);DIE();
          //echo $clase::find()->where([$model->getTableSchema()->primaryKey()=>$idfiltro])->createCommand()->getRawSql();die();
          $modelo= $clase::find()->where([$this->campofiltro=>$idfiltro])->one();  
      }else{
        // echo $clase::find()->where([$campofiltro=>$idfiltro])->createCommand()->getRawSql();die(); 
          $modelo= $clase::find()->where([$campofiltro=>$idfiltro])->one();  
      }
        
      if(is_null($modelo)){
           throw new \yii\base\Exception(Yii::t('report.messages', 'No se encontró ningun registro para este filtro'));
      }else{
          return $modelo;
      }
      
    }
    /*
     * Devuel una ruta competa para
     * grabar un archivo en disco 
     */
    public function pathToStoreFile(){
       return  $this->dirFile().DIRECTORY_SEPARATOR.$this->nameReportFile();
    }
    /*
     * Genera nombre de archivo para el reporte
     */
    private function nameReportFile(){
        $name= str_replace(' ','_',$this->nombrereporte).'_'.
                $this->id.'_'.h::userId().'_'.uniqid().'.'.$this->type;
        return $name;
    }
    
    public function sendReportFromMail($fromuser=true){
        h::mailer()->compose()
    ->setFrom('from@domain.com')
    ->setTo('to@domain.com')
    ->setSubject('Asunto del mensaje')
    ->setTextBody('Contenido en texto plano')
    ->setHtmlBody('<b>Contenido HTML</b>')
    ->send();
    }
    
  /*
   * Funcion que renderiza el detalle del reporte 
   * Coouna tabla , desde un grid
   */
    public function makeColumns($idfiltro){
        //$modelo=$this->modelToRepor($idfiltro);
        $hijosDetalle=$this->
                getReportedetalle()->
                //where(['and', "esdetalle='1'", "visiblecampo='1'"])->
                where(["esdetalle"=>'1'])->andWhere(["visiblecampo"=>'1'])->
                orderBy('orden ASC')->asArray()->all();
       /* echo  $hijosDetalle=$this->
                getReportedetalle()->
                //where(['and', "esdetalle='1'", "visiblecampo='1'"])->
                where(["esdetalle"=>'1'])->andWhere(["visiblecampo"=>'1'])->createCommand()->getRawSql();die();*/
       // var_dump($hijosDetalle);die();
        yii::error('hijos -------');
        yii::error($hijosDetalle);
        $columns=[];
        foreach($hijosDetalle as $fila){
            $elementos=[
                'attribute'=>$fila['nombre_campo'],
                'label'=>$fila['aliascampo'],
               'format'=>(($fila['esnumerico']=='1') && !is_null($fila['nombre_campo']))?['decimal',3]:'raw',
                'contentOptions'=>['width'=>
              $this->sizePercentCampo($fila['nombre_campo']).'%',
                    'style'=>($fila['esnumerico']=='1')?'text-align:right;':'text-align:left;'],
              
                ];
            if($fila['totalizable']=='1'){
                $elementos=array_merge($elementos,['footerOptions' => ['align'=>'right','style'=>'font-size:14px;']]);
               if($fila['esnumerico']=='1'){
                 $elementos=array_merge($elementos,['footer' => '<div style="font-weight:bold; text-align:right !important;">'.round($this->dataProvider($idfiltro)->query->sum($fila['nombre_campo']),2).'</div>']);
                   } else{
                       //var_dump($fila['monto'],Monedas::Simbolo($fila['codmon']));die();
                    $elementos=array_merge($elementos,['footer' =>'Total: ' ]);
               }
              
               
            }
             $columns[]=$elementos;
          
          
        }
        yii::error('CLUMNAS -------');
        yii::error($columns);
        return $columns;
        
    }
    
    
    private function lenghtTotalCampos(){
        return $this->getReportedetalle()->
                where(['and', "esdetalle='1'", "visiblecampo='1'"])->
                sum('longitudcampo');
    }
    
    private function sizePercentCampo($nameField){
       $total= $this->lenghtTotalCampos();
       $ancho=$this->childByNameField($nameField)->longitudcampo;
       return round(100*$ancho/$total);
       
    }
    /*
     * Devuelve un active record filtrado por nombre del campo
     */
    private function childByNameField($nameField){
       return $this->getReportedetalle()->where(['and', "esdetalle='1'", "visiblecampo='1'"])
             ->andWhere(['nombre_campo'=>$nameField])->one();
    }
    /*
     * Devuelve el numero total de registros del
     * reporte
     */
    public function numeroregistros($idfiltro){
        $model= $this->modelo;
        return $model::find()->where([$this->campofiltro => $idfiltro])->count();
    }
    
    /*DEVUELVE EL NUMERO DE PAGIONAS */
    
    public function numeroPaginas($idfiltro){
        try{
            $paginas= ceil($this->numeroregistros($idfiltro)/($this->registrosporpagina+0));
        } catch (Exception $ex) {
            throw new \yii\base\Exception(Yii::t('report.messages', 'The  \'registrosporpagina\'  property is empty'));
  
        }
        return $paginas;
    }
    
    
    public function dataProvider($idfiltro){
       $model= $this->modelo;
       //var_dump($this->campofiltro,$idfiltro);die();
        $query = $model::find()->where([$this->campofiltro => $idfiltro]);
                $provider = new \yii\data\ActiveDataProvider([
                        'query' => $query,
                       'sort'=>false,
                            'pagination' => [
                                        'pageSize' => $this->registrosporpagina,
                                      // 'linkOptions'=>['visible'=>false]
                                            ],
                               /* 'sort' => [
                                        'defaultOrder' => [
                                            
                                                            ]
                                            ],*/
                                                ]);
                return $provider;
                  }
     public function beforeSave($insert) {
       
        if($insert){
            $this->type='pdf';
            //$this->prefijo=$this->codfac;
           //$this->resolveCodocu();
           // $this->numero=$this->correlativo('numero');
        }
        
        return parent::beforeSave($insert);
       
    }
    
    public function reportFacultad(){
        return 'hil';
    }
    //Esta funcion genera las rutas para 
    //almacenra los archivo pdfs picados ,sehun el nuemro de particiones
    public function generatePaths($partitions){
        for ($i = 1; $i <= $partitions; $i++) {
            $this->routesSplit[]=$this->pathToStoreFile();
        } 
    }
    
    public function creaReporte($id, $idfiltro){
       Yii::$app->controller->layout='blank';
      $pageContents=$this->McontentReport($id, $idfiltro);
      //echo $pageContents[0];die();
      return $this->MprepareFormat($pageContents);
     
    }
     private function McontentReport($id, $idfiltro){
       //$model=$this->findModel($id); 
        
       $logo=(!$this->tienelogo)?$this->MputLogo($id, $idfiltro):''; 
       $cabecera=$this->putCabecera($id,$idfiltro,$this->campofiltro);
      $contenidoSinGrilla=$logo.$cabecera; 
      $npaginas=$this->numeroPaginas($idfiltro);
      $contenido="";
      $dataProvider=$this->dataProvider($idfiltro);
      $pageContents=[]; //aray con las paginas cotneido un elemento potr pagina
      for($i = 1; $i <= $npaginas; $i++){
         $dataProvider->pagination->page = $i-1; //Set page 1
          $dataProvider->refresh(); //Refresh models
         $pageContents[]=trim(Yii::$app->controller->render('reporte',[
             'modelo'=>$this,             
             'dataProvider'=>$dataProvider,
             'contenidoSinGrilla'=>$contenidoSinGrilla,
             'columnas'=>$this->makeColumns($idfiltro),             
                 ]).$this->MpageBreak());
              }
     return $pageContents;   
  }
  
   private function MputLogo($id, $idfiltro){               
        return Yii::$app->controller->renderpartial('logo',
				array(
			'modelosociedad' =>Sociedades::find()->one(),
                         'model'=>$this/*->modelToRepor($idfiltro)*/,
			'idreporte'=>$id,
					//'xlogo'=>$xlogo,
					//'ylogo'=>$ylogo,
					//'rutalogo'=>$rutalogo,
				),TRUE,	true);
        
    }
  
  private function MpageBreak(){
      return "<div class=\"pagebreak\"> </div>";
  }
  
  private function MprepareFormat($contenido){
      if($this->type=='pdf'){  
            $mpdf=ModuleReporte::getPdf();
             $paginas=count($contenido);
            //echo $contenido[0];die();
                foreach($contenido as $index=>$pagina){
                                $mpdf->WriteHTML($pagina);
                                if($index < $paginas-1)
                                            $mpdf->AddPage();
                                        }
                    
                       $ruta=$this->pathToStoreFile();
                        $mpdf->output($ruta, \Mpdf\Output\Destination::FILE);  
                        return $ruta;  
                    
                      
      }elseif($this->type=='html'){
          $cadenaHtml='';
          foreach($contenido as $index=>$pagina){
              $cadenaHtml.=$pagina;
          }
          return $cadenaHtml;
      }elseif($this->type=='file'){
                $pdf=ModuleReporte::getPdf();
                    $pdf->methods=[ 
                                'SetHeader'=>[($this->tienecabecera)?$header:''], 
                                'SetFooter'=>[($this->tienepie)?'{PAGENO}':''],
                                ];
        foreach($contenido as $index=>$pagina){
                        $pdf->WriteHTML($pagina);
                        if($index < $paginas-1)
                                 $pdf->AddPage();
                                    }
       return $pdf->output($this->pathToStoreFile(), \Mpdf\Output\Destination::FILE);
        
      }
      
        }
}