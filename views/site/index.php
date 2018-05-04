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
			echo "<div id=\"folder".$folder->id."\">";
			$url = \yii\helpers\Url::to(['/site/upload', 'folder' => $folder->name]);
				echo \yii\helpers\Html::a($folder->name, $url,['class'=>'link']);
			echo "</div>";
		}
		?>
    </div>
	<br>
	<button id="newFolder" onclick="newFolder()">Создать папку</button>
</div>


<!--<div id="folder">-->
<!--	<a class="link" href="/projects/gallery/web/index.php?r=site/upload&folder=fff">fff</a>-->
<!--</div>-->

<?php
$script = <<<JS
	var arr = ["Яблоко", "Апельсин", "Груша"];
	
	arr.forEach(function(item, i, arr) {
	  alert( i + ": " + item + " (массив:" + arr + ")" );
	});
	
	

	
JS;
$this->registerJs($script, View::POS_END);
?>
