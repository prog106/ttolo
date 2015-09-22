    <div class="btn-group btn-group-lg btn-group-justified">
        <?
        foreach($menu as $row) {
        ?>
        <a class="btn btn-default" role="button" id="<?=$row;?>" onclick="viewTo('<?=$row;?>');"><?=$row;?></a>
        <?
        }
        ?>
    </div>
