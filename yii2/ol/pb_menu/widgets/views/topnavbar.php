<div id="sidr-left" class="sidr left">
    <?php $this->widget('zii.widgets.CMenu',array(
        'id' => $this->navId,
        'htmlOptions' => array(
            'class'=> 'sidr'
        ),
        'items'=>$model,
    ));
    ?>
</div>
