<?php
/**
 * Created by PhpStorm.
 * User: kmuldash
 * Date: 03.05.2018
 * Time: 14:39
 */

namespace app\models;


use yii\base\Model;

class UploadImage extends Model{

	public $image;

	public function rules(){
		return[
			[['image'], 'file', 'extensions' => 'png, jpg'],
		];
	}

//	public function upload(){
//		if($this->validate()){
//			$this->image->saveAs("images/{$this->image->baseName}.{$this->image->extension}");
//		}else{
//			return false;
//		}
//	}

}