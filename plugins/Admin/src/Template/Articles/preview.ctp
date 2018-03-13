<style>
    .preview-title {
        word-break: break-all;
        font-size: 24px;
        line-height: 1.5;
        margin-bottom: 10px;
    }
    .preview-info {
        font-size: 14px;
        line-height: 22px;
        color: #666;
        margin-bottom: 10px;
    }
    .preview img {
        max-width: 100%;
        height: auto;
    }
</style>
<div class="bjui-pageContent preview">
    <div class="preview-title"><?php echo $data->title;?></div>
    <div class="preview-info">
        <?php
            echo date('Y-m-d H:i:s', strtotime($data->pubdate)) . '&nbsp;&nbsp;&nbsp;&nbsp;' . $data->arctype->name;
        ?>
    </div>
    <hr>
    <?php echo $data->content;?>
</div>