<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "folder".
 *
 * @property int $id
 * @property string $name
 */
class Folder extends \yii\db\ActiveRecord
{
	const DEFAULT_PATH  ='../web/images/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function create(){
    	if ($this->save()) {
			mkdir(self::DEFAULT_PATH.$this->name, 0775, true);
			return true;
		}
	}

	public function renameFolder($newName){
		$filename = 'images/'.$this->name;
		if (rename($filename,'images/'.$newName)){
			return true;
		} else {
			return false;
		}
	}

	public function deleteFolder(){
		$filename = 'images/'.$this->name;
		if (file_exists($filename)) {
			if (rmdir($filename)){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
