<?php
use yii\helpers\Html;
use yii\helpers\Json;
use frontend\widgets\cropimage\MrSectionWidgetAsset;

MrSectionWidgetAsset::register($this);
$removeBtn = !empty($template_image) ? '' : 'hidden';
$emptyBlock = empty($template_image) ? '' : 'hidden';
?>
    <div class="mr-section-base <?= $class_block ?>" style="width: <?= $plugin_options['width'] + 4 ?>px; ">

        <div class="mr-upload-block mr-tmp-clear-block hidden">
            <i class="fa fa-photo fa-5x" style="margin-top:<?= $plugin_options['height'] / 3 ?>px;"></i>
            <h2>Нажмите на поле, чтобы загрузить изображение</h2>
        </div>

        <div class="mr-section" id="<?= $plugin_options['section'] ?>" data-role="upload_image"
             style="width: <?= $plugin_options['width'] + 4 ?>px; height: <?= $plugin_options['height'] + 3 ?>px;  ">
            <?php if ($template_image): ?>
                <?= $template_image ?>
            <?php endif; ?>
            <div class="mr-upload-block <?= $emptyBlock ?>">
                <i class="fa fa-photo fa-5x" style="margin-top:<?= $plugin_options['height'] / 3 ?>px;"></i>
                <h2>Нажмите на поле, чтобы загрузить изображение</h2>
            </div>
            <span class="glyphicon glyphicon-remove mr-remove <?= $removeBtn ?>"></span>
        </div>
        
        <div class="mr-control-panel">
            <div class="btn-group">
                <?php $buttons = [
                    ['class'=>'rotate-left', 'icon'=>'rotate-left', 'title'=>'Повернуть влево'],
                    ['class'=>'zoom-out', 'icon'=>'zoom-out', 'title'=>'Отдалить'],
                    ['class'=>'fit', 'icon'=>'resize-small', 'title'=>'По размеру окна'],
                    ['class'=>'zoom-in', 'icon'=>'zoom-in', 'title'=>'Приблизить'],
                    ['class'=>'rotate-right', 'icon'=>'rotate-right', 'title'=>'Повернуть вправо'],
                ];?>
                <?php foreach ($buttons as $b) {
                    echo Html::button('<span class="glyphicon glyphicon-'.$b['icon'].'"></span>', ['class'=>'btn btn-primary mr-'.$b['class'], 'title'=>$b['title']]);
                }?>   

            </div>
            <button class='btn btn-success mr-upload-btn-section pull-right' title='Выбрать файл' type='button'>
                <span class="glyphicon glyphicon-upload"></span>
            </button>
        </div>
        <?= $form->field($model, $attribute, ['template'=>'{input}'])->fileInput($options); ?>
        
        <?=Html::activeHiddenInput($model, $attribute_x) ?>
        <?=Html::activeHiddenInput($model, $attribute_y) ?>
        <?=Html::activeHiddenInput($model, $attribute_width) ?>
        <?=Html::activeHiddenInput($model, $attribute_height) ?>
        <?=Html::activeHiddenInput($model, $attribute_scale) ?>
        <?=Html::activeHiddenInput($model, $attribute_angle) ?>
    </div>

<?php
$plugin_options['section'] = '#' . $plugin_options['section'];
$plugin_options['id_input_file'] = '#' . $plugin_options['id_input_file'];
$options = Json::encode($plugin_options, true);
$section = $plugin_options['section'];

$this->registerJs("
    mr_section_init($options);
");
?>