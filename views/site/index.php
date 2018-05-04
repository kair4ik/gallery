<?php

/* @var $this yii\web\View */

use app\models\Image;
use yii\web\View;

$this->title = 'My Yii Application';
$urlImg = "ggg";
//$imgName = Image::getLastImage();
//$urlImg = Image::getLastImageUrl($imgName);
?>

<style>

</style>
<div class="site-index">

    <div class="jumbotron">
		<?php
		$folders = \app\models\Folder::find()->all();
		foreach ($folders as $folder){
			echo "<div class=\"folder\" id=\"folder".$folder->id."\">";
				$url = \yii\helpers\Url::to(['/site/upload', 'folder' => $folder->name]);
				echo \yii\helpers\Html::a("Перейти в папку ".$folder->name, $url,['class'=>'link','id'=>'folderName'.$folder->id]);
				echo "<br><button onclick='renameFolder(".$folder->id.")'>Редактировать</button>";
				echo "<br><button onclick='deleteFolder(".$folder->id.")'>Удалить</button>";
			echo "</div>";
		}
		?>
    </div>
	<br>
	<button id="newFolder" onclick="newFolder()">Создать папку</button>
</div>


<?php
$script = <<<JS
	setFonImages();
JS;
$this->registerJs($script, View::POS_END);
?>
