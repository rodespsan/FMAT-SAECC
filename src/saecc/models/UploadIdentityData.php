<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\validators\FileValidator;
use Yii;

class UploadIdentityData extends Model
{
    /**
     * @var UploadedFile
     */
    public $csvFile;

    public function rules()
    {
        return [
            [['csvFile'], 'file', 'skipOnEmpty' => false, 'checkExtensionByMimeType' => false, 'extensions' => 'csv', 'maxSize' => (new FileValidator)->getSizeLimit()],
        ];
    }
	
	public function attributeLabels()
    {
        return [
            'csvFile' => Yii::t('app', 'Sube el Archivo CSV que contiene a los alumnos por dar de alta: '),
		];
	}
		
	
	/*
	 * @var $line Array contains two items
	 */
	private function convert_to_ASCII($line) 
	{
		for ($i=0; $i < 2; $i++) {
			$line[$i] = mb_convert_encoding($line[$i], 'ASCII');
			$line[$i] = str_replace( "?", "", $line[$i]);
		}
		
		return $line;	
	}
    
    public function upload()
    {
		if ($this->validate()) {	
			$isValidFormat = true;			
			$isValidEncoding = true;
			
			if (($handle = fopen($this->csvFile->tempName, "r")) !== FALSE) {	
				if (($firstLine = fgetcsv($handle)) !== FALSE) { 
					if (count($firstLine) >= 2) {
						if (mb_detect_encoding($firstLine[0]) !== 'ASCII') {
							$isValidEncoding = false;
							$firstLine = $this->convert_to_ASCII($firstLine);
						}	
					} else {
						$isValidFormat = false;
					}
					
					if ($isValidFormat) {
						if (( $firstLine[0] !== 'client_id') || ($firstLine[1] !=='full_name') || ($firstLine[2] !=='client_type_id') || ($firstLine[3] !=='discipline_id') || ($firstLine[4] !=='active') ){	
							$isValidFormat = false;
						}
					}	
				}
				
				if ($isValidFormat){
					$success = true;
					$row = 1;
					
					while (($data = fgetcsv($handle)) !== FALSE) {
						if (!$isValidEncoding)
							$data = $this->convert_to_ASCII($data);
							$row++;
							$model = new Client();
							$model->client_id = $data[0];
							$model->full_name = $data[1];
							$model->client_type_id = $data[2];
							$model->discipline_id = $data[3];
							$model->active = $data[4];
						
						if(!$model->save()){							
							$idClient = Client::find()->where(['client_id'=>$model->client_id])->exists();
							$typeClient = ClientType::find()->where(['id'=>$model->client_type_id])->exists();
							$idDiscipline = Discipline::find()->where(['id'=>$model->discipline_id])->exists();
							$activo = Client::find()->where(['active'=>$model->active])->exists();
							
							if($idClient == true){
									Yii::$app->session->addFlash("error-upload", "Error en línea: [".$row."] ----- El cliente con id: [".$model->client_id."] ya se encuentra registrado.");
							}else{
								if($typeClient == false || $idDiscipline == false || $activo == false){
									if($typeClient == false){
										$typeClient = "[client_type_id] No Válido. ";
									}else{
										$typeClient = "";
									}
									if($idDiscipline == false){
										$idDiscipline = "[discipline_id] No Válido. ";
									}else{
										$idDiscipline = "";
									}
									if($activo == false){
										$activo = "[active] No Válido.";
									}else{
										$activo = "";
									}
									
									Yii::$app->session->addFlash("error-upload", "Error en línea: [".$row."] ----- ".$typeClient."".$idDiscipline."".$activo."");
								}														
							}
						}	
					};
					
					if (!feof($handle)) {
						$success = false;
						Yii::$app->session->setFlash('error', Yii::t('app','Unexpected error.'));
					}
					
				} else {
					Yii::$app->session->setFlash('error', 
						Yii::t('app','El formato del archivo No es válido. El formato válido es: ') . 
						"<div class=\"panel panel-default\">
							<div class=\"panel-body\">
								<p>client_id,full_name,client_type_id,discipline_id,active</p>
								<p>98341245,Pedro Salazar Dos,1,5,1</p>								
							</div>
						</div>"
					);
				}	
				
				fclose($handle);
			}
			
			return ($isValidFormat && $success);
        } else {
            return false;
        }
    }
}
?>