<?php

namespace common\behaviors;
use yii\web\UploadedFile;
use nemmo\attachments\behaviors\FileBehavior as Fileb;
use nemmo\attachments\models\File;
use common\helpers\FileHelper;
use yii;

/*
 * Esta clase se extiende de la clase original 
 * nemmo\attachments\behaviors\FileBehavior
 * Le ahorrara mucho trabajo al momento de trabajar
 * con archivos adjuntos, en especial sin son imagenes
 * 
 */

class FileBehavior extends Fileb {
    /*
     * Retorna un array de modelos 
     * con la info de archivos adjuntos filtrados por la extension
     * que  usted desea
     */
CONST FIRE_METHOD='triggerUpload';
    public function getFilesByExtension($ext = null) {
        if (is_null($ext))
            throw new \yii\base\Exception(Yii::t('base_errors', 'The extension parameter is null'));
        if (substr($ext, 0, 1) == '.') {
            $ext = substr($ext, 1);
        }
        $fileQuery = $this->queryBase->andWhere(['type' => $ext]);
        $fileQuery->orderBy(['id' => SORT_ASC]);

        return $fileQuery->all();
    }

    /* Devuelve un modelo
     * representando a la primera image
     * si no tiene adjuntos imagenes 
     * devuelve NULL
     * 
     */

    public function getFirstImage() {

        return (count($this->getImages()) > 0) ? $this->getImages()[0] : null;
    }

    /*
     * Retorna un array de modelos 
     * con la info de archivos adjuntos 
     * Solo imagenes
     */

    public function getImages() {
        $exts = FileHelper::extImages();
        $fileQuery = $this->queryBase->andWhere(['in', 'type', $exts]);
        $fileQuery->orderBy(['id' => SORT_ASC]);

        return $fileQuery->all();
    }

    /*
     * Devuelve el objecto activeQuery
     * listo para ser usado 
     */

    public function getQueryBase() {
        return File::find()
                        ->where([
                            'itemId' => $this->owner->id,
                            'model' => $this->owner->getShortNameClass()
        ]);
    }

    /*
     * Devuelve la ruta de la imagen 
     * la primera imagen
     * Si no hay imagenes adjuntas 
     * devuelve una imagen anonima a traves de la funcion FileHelper::UrlEmptyImage()
     */

    public function getPathFirstImage() {
        if (is_null($this->getFirstImage()) or $this->owner->isNewRecord) {
            return FileHelper::UrlEmptyImage();
        } else {
            return $this->firstImage->getUrl();
        }
    }

    /*
     * Devuelve la cantidad de imagenes adjuntas
     */

    public function getCountImages() {
        $exts = FileHelper::extImages();
        return $this->queryBase->andWhere(['in', 'type', $exts])->count();
    }

    public function deleteAllAttachments() {
        $contador = 0;
        foreach ($this->getQueryBase()->all() as $registro) {
            $this->deleteFile($registro->id);
            $contador++;
        }
        return $contador;
    }

    /*
     * Esta funcion devuelve los UrLS de las 
     * imagenes de los archivos adjuntos 
     */

    public function getUrlFiles() {
        $urlImages = [];
        $registros = $this->files;
        foreach ($registros as $fila) {
            $urlImages[] = $fila->getUrl();
        }
        unset($registros);
        return $urlImages;
    }

    /*
     * Esta funcion devuelve el
     * Urldel primer adjunto
     * Sea cuakl sea imagen o archivo
     */

    public function getUrlFirstFile() {
        //return $this->files[0]->path;
        return($this->urlFiles === []) ?
                FileHelper::UrlEmptyFile() :
                $this->urlFiles[0];
    }

    public function countFiles() {
        //return $this->files[0]->path;
        return(count($this->files));
    }

    /*
     * Borra un archivo adjunto, solo le pasa el id
     * del registro
     */

    public function deleteFile($id) {
        $this->getModule()->detachFile($id);
    }

    public function sendFileMail() {
        return Yii::$app
                        ->mailer
                        ->compose(
                                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                        ->setTo($this->email)
                        ->setSubject(yii::t('base_verbs', 'Request password reset') . '  ' . Yii::$app->name)
                        ->send();
    }

    /*
     * Adjunta un archivo de sde otroa ruta 
     * no necesariamente del cuador de dialogo
     * 
     */

    public function attachFromPath($path) {
        $cad = $path . "<br>";
        $files = [];
        if (is_file($path)) {
            $files[] = $path;
            $cad .= "Es file <br>";
        } elseif (is_dir($path)) {
            $cad .= "Es directorio <br>";
            foreach (FileHelper::findFiles($path) as $file) {
                $files[] = $file;
            }
        } else {
            yii::error('NO es file es direcrtorio', __METHOD__);
        }

        if (!empty($files)) {
            foreach ($files as $file) {
                $newPathFile = $this->getModule()->getUserDirPath() . basename($file);
                if (!copy($file, $newPathFile)) {
                    throw new \Exception(\Yii::t('base_errors', 'File upload failed.'));
                }
                if (!$this->getModule()->attachFile($newPathFile, $this->owner)) {
                    throw new \Exception(\Yii::t('base_errors', 'File upload failed.'));
                } else {
                    yii::error('Attach Exitoso ' . $newPathFile . '---' . $file, __METHOD__);
                }
            }
        }
        return $cad;
    }
    
    
 /*Sobre escribe al metodo del la clase original */
    public function saveUploads($event)
    {
        $files = UploadedFile::getInstancesByName('UploadForm[file]');

        if (!empty($files)) {
            foreach ($files as $file) {
                //echo get_class($file); die();
                //echo (is_dir($this->getModule()->getUserDirPath()))?"si":"no"; die();
                if (!$file->saveAs($this->getModule()->getUserDirPath() . $file->name)) {
                    throw new \Exception(\Yii::t('base_errors', 'File upload failed.'));
                }
            }
        }

        $userTempDir = $this->getModule()->getUserDirPath();
        foreach (FileHelper::findFiles($userTempDir) as $file) {
            if (!$this->getModule()->attachFile($file, $this->owner)) {
                throw new \Exception(\Yii::t('base_errors', 'File upload failed.'));
            }
        }
        rmdir($userTempDir);
        if($this->owner->hasMethod(self::FIRE_METHOD)){
            $this->{self::FIRE_METHOD}();
        }
    }
    
}
