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
            [['title', 'name', 'description'], 'string', 'max' => 50],
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
        ];
    }

	public function upload() {
		if ($this->validate()) {
			$this->file->saveAs("images/{$this->file->baseName}.{$this->file->extension}");
			$name = $this->file->baseName.".".$this->file->extension;
			$this->file = "";
			return $name;
		} else {
			return false;
		}
	}
}
