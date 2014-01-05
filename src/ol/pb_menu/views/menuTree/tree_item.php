<?php
/**
 * @package pb_menu\views
 */
?>
<div class="button-toolbar">
    <div class="row">
        <div class="col-lg-6">
            <i class="icon-move"></i>&nbsp;<span><a data-toggle="tooltip" title="Dieses Item hat die ID <?= $model->id?>" class="label label-info"><i class="glyphicon glyphicon-exclamation-sign"></i></a><?php echo isset($model->config->icon)?$model->name.' '.$model->config->icon->html:$model->name  ?></span>
        </div>
        <div class="col-lg-6">
            <?php if($model->level>1): ?>
                <?php echo BSHtml::buttonGroup(array(
                        array(
                            'label'=>'',
                            'icon' => BSHtml::GLYPHICON_PLUS_SIGN,
                            'url'=>'#',
                            'data-toggle' => 'tooltip',
                            'title'=>"append new Item",
                            'class' => 'appendToList',
                            'data-id' => $model->id,
                            'color' => BSHtml::BUTTON_COLOR_INFO
                        ),
                        array(
                            'label'=>'',
                            'icon' => BSHtml::GLYPHICON_PENCIL,
                            'url'=>'#',
                            'data-toggle' => 'tooltip',
                            'title'=>"Edit",
                            'class' => 'editListItem',
                            'data-id' => $model->id,
                            'color' => BSHtml::BUTTON_COLOR_SUCCESS

                        ),
                        array(
                            'own' => BSHtml::linkButton(
                                '',
                                array(
                                    'url' => Yii::app()->createUrl('/menu/menuTree/deleteList',array('id' => $model->id)),
                                    'icon' => BSHtml::GLYPHICON_TRASH,
                                    'confirm' => 'Beachten Sie das Sie alle Unterzweige dieser Liste mitlöschen!',
                                    'data-toggle' => 'tooltip',
                                    'title'=>"remove this Item",
                                    'class' => 'removeFromList',
                                    'data-id' => $model->id,
                                    'color' => BSHtml::BUTTON_COLOR_DANGER,
                                    'size' => BSHtml::BUTTON_SIZE_MINI
                                )
                            )

                        ),
                    )
                    ,array('size' => BSHtml::BUTTON_SIZE_MINI)); ?>
            <?php else: ?>
                <?php echo BSHtml::buttonGroup(array(
                        array(
                            'label'=>'',
                            'icon' => BSHtml::GLYPHICON_PLUS_SIGN,
                            'url'=>'#',
                            'data-toggle' => 'tooltip',
                            'title'=>"append new Item",
                            'class' => 'appendToList btn-'.BSHtml::BUTTON_COLOR_SUCCESS,
                            'data-id' => $model->id
                        )
                    ),
                    array(
                        'size' => BSHtml::BUTTON_SIZE_MINI,
                        'pull' => BSHtml::PULL_RIGHT
                    )
                );?>
            <?php endif ?>
        </div>
    </div>
</div>