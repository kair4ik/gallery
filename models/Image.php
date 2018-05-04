<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $description
 * @property string $folder
 */
class Image extends \yii\db\ActiveRecord
{
	public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'name', 'description', 'folder'], 'string', 'max' => 50],
			[['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'name' => 'Name',
            'description' => 'Description',
            'folder' => 'Folder',
        ];
    }

	public function upload() {
		if ($this->validate()) {
			$this->file->saveAs("images/{$this->folder}/{$this->file->baseName}.{$this->file->extension}");
			$name = $this->file->baseName.".".$this->file->extension;
			$this->file = "";
			return $name;
		} else {
			return false;
		}
	}

	public static function getLastImage($folder){
    	$img = self::find()->where(['folder'=>$folder])->orderBy('id DESC')->one();
    	if (isset($img)){
			return $img->name;
		} else {
    		return false;
		}
	}

	public static function getLastImageUrl($imgName){
		return 'images/'.$imgName;
	}

	public function deleteFile(){
		$filename = 'images/'.$this->name;
		if (file_exists($filename)) {
			unlink($filename);
			return true;
		} else {
			return false;
		}
	}
}
