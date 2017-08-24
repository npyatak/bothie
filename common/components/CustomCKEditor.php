<?php
namespace common\components;

use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;

Class CustomCKEditor extends CKEditor {

    public function init()
    {
        if (array_key_exists('preset', $this->editorOptions)) {
            if($this->editorOptions['preset'] == 'tiny'){
                $this->presetTiny();
            }
            unset($this->editorOptions['preset']);
        }
        parent::init();
    }

    private function presetTiny(){
        $options['height'] = 150;

        $options['toolbarGroups'] = [
            ['name' => 'undo'],
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
            ['name' => 'colors'],
            ['name' => 'paragraph', 'groups' => ['templates', 'list', 'indent', 'align']],
            //['name' => 'links', 'groups' => ['links', 'insert']],
        ];
        $options['removeButtons'] = 'Subscript,Superscript,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Image,About';
        $options['removePlugins'] = 'elementspath';
        $options['resize_enabled'] = false;

        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }
}