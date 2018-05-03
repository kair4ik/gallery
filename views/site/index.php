<?php

/* @var $this yii\web\View */

use app\models\Image;
use yii\web\View;

$this->title = 'My Yii Application';


$imgName = Image::getLastImage();
$urlImg = Image::getLastImageUrl($imgName);
?>

<style>

</style>
<div class="site-index">

    <div class="jumbotron">
		<div id="folder">
			<?php
				$url = \yii\helpers\Url::to(['/site/upload']);
				echo \yii\helpers\Html::a("Галерея", $url,['style'=>'font-size:30px']);
			?>
		</div>

    </div>

</div>

<?php
$script = <<<JS

	imageUrl = 'images/catty.jpg';
	$('#folder').css('background-image','url("$urlImg")');

JS;
$this->registerJs($script, View::POS_END);
?>
