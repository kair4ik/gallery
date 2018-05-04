<?php
/**
 * Created by PhpStorm.
 * User: kmuldash
 * Date: 03.05.2018
 * Time: 14:41
 */

/** @var \app\models\UploadImage $model */

use app\models\Image;
use yii\web\View;
use yii\widgets\ActiveForm;


//unlink($url);

$folder = $_GET['folder'];

echo "Папка $folder<br><br>";
?>
<input type="hidden" id="folder" value="<?=$folder?>">
<?php $form = ActiveForm::begin([
		'id'=>'main',
]) ?>
<?= $form->field($model, 'file')->fileInput(['id'=>'image']) ?>
<?php ActiveForm::end() ?>

	<br>

	<div class="images">
		<?php
		$images = Image::find()->where(['folder'=>$folder])->all();
		if (count($images) == 0) {
			echo "Изображений не найдено";
		}
		foreach ($images as $image) {
			?>
		<div class="myimg">
			<img src="images/<?= "$folder/".$image->name ?>" alt="" width="200px" height="200px"> <br>
			<?php
			echo "Имя <p id='imgName' data-id='$image->id'>" . $image->title . "</p>";
			echo "Описание: <p id='imgDesc' data-id='$image->id'>" . $image->description . "</p>
			<a href='#' data-id='$image->id' id='deleteimg' >Удалить</a><br>
			</div>";
		} ?>
	</div>

<?php
$script = <<<JS


		

JS;
$this->registerJs($script, View::POS_END);
?>

