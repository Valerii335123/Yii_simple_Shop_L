<?php

namespace app\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "tovar_picture".
 *
 * @property int $id
 * @property int|null $id_tovar
 * @property string|null $source
 */
class TovarPicture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tovar_picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tovar'], 'integer'],
            // [['source'], 'string', 'max' => 255],
            [['source'], 'file',  'extensions' => 'png, jpg'],
              // [['source'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tovar' => 'Id Tovar',
            'source' => 'Source',
        ];
    }



    public function uploadFile(UploadedFile $file)
      {
          $this->source = $file;

         if($this->validate())
         {
           $filename = $this->generateFilename();

           $this->source->saveAs($this->getFolder() . $filename);

           return $filename;
         }

      }

      private function getFolder()
   {
       return Yii::getAlias('@web') . 'uploads/';
   }


   private function generateFilename()
   {
       return strtolower(md5(uniqid($this->source->baseName)) . '.' . $this->source->extension);
   }


}
