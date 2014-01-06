<?php
/**
 * @package pb_menu\views
 */
?>
<div class="taskTree">
    <?php
    $level=0;
    echo CHtml::openTag('ol',array('class' => 'sortable'));
    //CVarDumper::dump($tasks,100,true);
    foreach($tasks as $n=>$task)
    {

        if($task->level==$level){
            echo CHtml::closeTag('li');
        }else if($task->level>$level ){
            if($task->level != 1)
                echo CHtml::openTag('ol');
        }else {
            echo CHtml::closeTag('li');

            for($i=$level-$task->level;$i;$i--)
            {
                echo CHtml::closeTag('ol');
                echo CHtml::closeTag('li');
            }
        }

        echo CHtml::openTag('li',array('class' => $task->level>1?'sub_item':'','id' => 'list_'.$task->id));
        //echo CHtml::encode($task->name.$task->level.' root:'.$task->isRoot().' leaf:'.$task->isLeaf());
        $this->renderPartial('tree_item',array('model' => $task));
        $level=$task->level;
    }

    for($i=$level;$i;$i--)
    {
        echo CHtml::closeTag('li');
        if($task->level != 1)
            echo CHtml::closeTag('ol');
    }
    echo CHtml::closeTag('ol');
    ?>
</div>