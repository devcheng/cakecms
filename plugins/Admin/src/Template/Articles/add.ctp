<script type="text/javascript">
    function pic_upload_add_article(file, data) {
        var json = $.parseJSON(data);

        $(this).bjuiajax('ajaxDone', json);
        if (json[BJUI.keys.statusCode] == BJUI.statusCode.ok) {
            $('#j_input_article_pic').val(json.filename).trigger('validate');
            $('#j_article_pic').html('<img id="pic-add-artile" src="<?php echo $this->request->base;?>/'+ json.filename +'" />');
            $('.delpic').show();
        }
    }

    //跳转链接
    $('input[name="ishref"]').on('ifChanged', function(e) {
        var checked = $(this).is(':checked'), val = $(this).val();
        if (checked) {
            $("#input-href-article").attr("data-rule", "required;url");
            $("#input-href-article").removeAttr("disabled");
            $('#href-article').show();
        } else {
            $("#input-href-article").attr("disabled", "disabled");
            $('#href-article').hide();
        }
    });

    //删除图片
    $('.delpic').click(function() {
        $('#j_input_article_pic').val("");
        $('#j_article_pic').html('<img id="pic-add-artile" src="holder.js/200x200?text=文章图片&theme=sky&size=11" />');
        $('.delpic').hide();
        Holder.run({
            images: document.getElementById('pic-add-artile')
        });
    });
</script>
<script src="<?php echo $this->request->base;?>/assets/holder/holder.js"></script>
<div class="bjui-pageContent tablecomm">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'add']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td class="colspan-left">
                    <label class="control-label x85">标题：</label>
                    <input type="text" name="title" value="" size="65" class="form-control input-nm" data-rule="required">
                    <span style="color:#ff0000;">*</span>
                </td>
                <td rowspan="8" style="vertical-align: middle; text-align: center">
                    <div style="display: inline-block; vertical-align: middle;">
                        <i class="iconfont delpic pic-none">&#xe600;</i>
                        <span id="j_article_pic">
                            <img id="pic-add-artile" src="holder.js/200x200?text=文章图片&theme=sky&size=11">
                        </span>
                        <div id="j_custom_pic_up" data-toggle="upload" data-uploader="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Upload', 'action' => 'fileupload']);?>"
                             data-file-size-limit="1024000000"
                             data-file-type-exts="*.jpg;*.png;*.gif;*.mpg"
                             data-multi="true"
                             data-auto="true"
                             data-on-upload-success="pic_upload_add_article"
                             data-icon="cloud-upload"></div>
                        <input type="hidden" name="image" value="" id="j_input_article_pic">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">自定义属性：</label>
                    <input type="checkbox" name="ishot" id="j_custom_ishot" data-toggle="icheck" value="1" data-label="热门">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="istop" id="j_custom_istop" data-toggle="icheck" value="1" data-label="置顶">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="isindex" id="j_custom_isindex" data-toggle="icheck" value="1" data-label="推荐">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="isbold" id="j_custom_isbold" data-toggle="icheck" value="1" data-label="加粗">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="isred" id="j_custom_isred" data-toggle="icheck" value="1" data-label="标红">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="ishref" id="j_custom_ishref" data-toggle="icheck" value="1" data-label="链接">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="isshow" id="j_custom_isshow" data-toggle="icheck" value="2" data-label="隐藏">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="autoimage" id="j_custom_autoimage" data-toggle="icheck" value="1" data-label="提取内容第一张图片为文章图片">
                </td>
            </tr>
            <tr id="href-article" style="display: none;">
                <td>
                    <label for="name" class="control-label x85">链接地址：</label>
                    <input type="text" name="href" value="" placeholder="http://" id="input-href-article" size="65" class="form-control input-nm">
                    <span style="color:#ff0000;">*</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">短标题：</label>
                    <input type="text" name="shorttitle" value="" size="25" class="form-control input-nm">
                    <span class="distance"></span>
                    <label class="control-label x85">发布时间：</label>
                    <input type="text" name="pubdate" value="<?php echo date('Y-m-d H:i:s');?>" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss" size="25" class="form-control input-nm">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">栏目：</label>
                    <select name="arctype_id" id="j_custom_arctype" data-toggle="selectpicker" data-width="250" data-rule="required">
                        <option value="">请选择</option>
                        <?php
                        if (!empty($arctypeData)) {
                            foreach($arctypeData as $item) {
                                ?>
                                <option value="<?php echo $item->id;?>" <?php if($item->leaf == 1){echo 'disabled';}?> >
                                    <?php
                                        $line = '';
                                        if($item->level > 1) {
                                            for($i = 1; $i <= ($item->level-1); $i++){
                                                $line .= "&nbsp;&nbsp;&nbsp;|---";
                                            }
                                        }
                                        echo $line . $item->name;
                                    ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <span class="distance"></span>
                    <label class="control-label x85">浏览次数：</label>
                    <input type="text" name="click" value="0" size="25" data-rule="digits" class="form-control input-nm">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">作者：</label>
                    <input type="text" name="author" value="" size="25" class="form-control input-nm">
                    <span class="distance"></span>
                    <label class="control-label x85">文章来源：</label>
                    <input type="text" name="source" value="" size="25" class="form-control input-nm">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">关键词：</label>
                    <input type="text" name="keywords" size="65" class="form-control input-nm">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">摘要：</label>
                    <textarea name="description" cols="65" class="form-control" data-toggle="autoheight"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">标签：</label>
                    <input type="text" name="tag" size="65" class="form-control input-nm">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="content" data-toggle="kindeditor" style="width: 100%; min-height: 450px;"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close btn-no">关闭</button></li>
        <li><button type="submit" class="btn-blue">保存</button></li>
    </ul>
</div>