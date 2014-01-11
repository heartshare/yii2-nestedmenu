<?php foreach($model->attributes() as $attr) : ?>
<!--    <ul class='list-inline'>-->
<!--        <li>-->
<!--            <span class='label label-info'>-->
<!--                --><?php //echo $attr ?>
            <!--</span> :-->
<!--        </li>-->
<!--        <li>-->
<!--            <code>-->
<!--                --><?php //echo $model->$attr ?>
            <!--</code>-->
<!--        </li>-->
<!--    </ul>-->
<?php endforeach; ?>
<dl class='dl-horizontal'>
    <?php foreach($model->config->attributes() as $attr) : ?>
        <?php if($attr !== 'id') : ?>
            <dt>
                <span class='label'><?= $attr ?></span> :
            </dt>
            <dd>
                <code><?= $model->config->$attr ?></code>
            </dd>
        <?php endif; ?>
    <?php endforeach; ?>
</dl>
<dl class='dl-horizontal'>
    <?php foreach($model->profile->attributes() as $attr) : ?>
        <?php if( $attr !== 'id' && $attr !== 'tree_id') : ?>
            <dt>
                <span class='label'><?= $attr ?></span> :
            </dt>
            <dd>
                <code><?= $model->profile->$attr ?></code>
            </dd>
        <?php endif; ?>
    <?php endforeach; ?>
</dl>
