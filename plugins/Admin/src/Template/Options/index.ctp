<script type="text/javascript">
    function pic_upload_logo(file, data) {
        var json = $.parseJSON(data);

        $(this).bjuiajax('ajaxDone', json);
        if (json[BJUI.keys.statusCode] == BJUI.statusCode.ok) {
            $('#j_logo_pic').val(json.filename).trigger('validate');
            $('#logo_pic').html('<img id="logo-pic" src="<?php echo $this->request->base;?>/'+ json.filename +'" />');
            $('.delpic').show();
        }
    }

    //删除图片
    $('.delpic').click(function() {
        $('#j_logo_pic').val("");
        $('#logo_pic').html('<img id="logo-pic" data-src="holder.js/150x150?text=系统Logo \n 建议图片高度50px&theme=sky&size=11" />');
        $('.delpic').hide();
        Holder.run({
            images: document.getElementById('logo-pic')
        });
    });
</script>
<script src="<?php echo $this->request->base;?>/assets/holder/holder.js"></script>
<div class="bjui-pageContent tablecomm tabnoboder">
    <ul class="nav nav-tabs" role="tablist">
        <li <?php if (empty($type) || $type == 'system') {echo 'class="active"';}?> ><a href="#system" role="tab" data-toggle="tab">系统设置</a></li>
        <li <?php if ($type == 'site') {echo 'class="active"';}?> ><a href="#site" role="tab" data-toggle="tab">站点设置</a></li>
        <li <?php if ($type == 'other') {echo 'class="active"';}?> ><a href="#other" role="tab" data-toggle="tab">其他设置</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade <?php if (empty($type) || $type == 'system') {echo 'active in';}?>" id="system">
            <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Options', 'action' => 'index', 'system']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
                <table class="table table-condensed">
                    <tbody>
                    <tr>
                        <td class="colspan-left">
                            <label class="control-label x100 text-right">系统名称：</label>
                            <input type="text" name="systemname" value="<?php if (isset($data['systemname'])) {echo $data['systemname'];}?>" size="55" class="form-control input-nm" >
                        </td>
                        <td rowspan="4" style="vertical-align: middle;">
                            <div style="display: inline-block; vertical-align: middle;">
                                <i class="fa fa-times-circle delpic <?php if (!(!empty($data['systemlogo']) && $this->Pic->url($data['systemlogo'], '', true))) {echo 'pic-none';}?>" aria-hidden="true"></i>
                                <span id="logo_pic">
                                    <img id="logo-pic" src="<?php echo $this->Pic->url($data['systemlogo'], 'holder.js/150x150?text=系统Logo \n 建议图片高度50px&theme=sky&size=11');?>">
                                </span>
                                <div class="btn-upload" id="j_custom_pic_up" data-toggle="upload" data-uploader="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Upload', 'action' => 'fileupload']);?>"
                                     data-file-size-limit="1024000000"
                                     data-file-type-exts="*.jpg;*.png;*.gif;*.mpg"
                                     data-multi="true"
                                     data-auto="true"
                                     data-on-upload-success="pic_upload_logo"
                                     data-icon="cloud-upload"></div>
                                <input type="hidden" name="systemlogo" value="<?php if (isset($data['systemlogo'])) {echo $data['systemlogo'];}?>" id="j_logo_pic">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">&nbsp;</label>
                            <input type="radio" name="systemnamehide" id="j_custom_hide1" data-toggle="icheck" value="2" data-rule="checked" <?php if (isset($data['systemnamehide']) && $data['systemnamehide'] == 2) {echo 'checked';}?> data-label="&nbsp;显示系统名称">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="systemnamehide" id="j_custom_hide2" data-toggle="icheck" value="1" <?php if (!isset($data['systemnamehide']) || $data['systemnamehide'] == 1) {echo 'checked';}?> data-label="&nbsp;不显示系统名称">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">登录名称：</label>
                            <input type="text" name="systemlogin" value="<?php if (isset($data['systemlogin'])) {echo $data['systemlogin'];}?>" size="55" class="form-control input-nm" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">起始年份：</label>
                            <input type="text" name="systemyear" value="<?php if (isset($data['systemyear'])) {echo $data['systemyear'];}?>" size="55" class="form-control input-nm">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">底部信息：</label>
                            <input type="text" name="systemfoot" value="<?php if (isset($data['systemfoot'])) {echo $data['systemfoot'];}?>" size="55" class="form-control input-nm" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-save">保存</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="tab-pane fade <?php if ($type == 'site') {echo 'active in';}?>" id="site">
            <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Options', 'action' => 'index', 'site']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
                <table class="table table-condensed">
                    <tbody>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">站点名称：</label>
                            <input type="text" name="sitename" value="<?php if (isset($data['sitename'])) {echo $data['sitename'];}?>" size="55" class="form-control input-nm" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">站点副名称：</label>
                            <input type="text" name="sitefuname" value="<?php if (isset($data['sitefuname'])) {echo $data['sitefuname'];}?>" size="55" class="form-control input-nm" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">站点描述：</label>
                            <textarea name="sitedesc" cols="55" rows="5"><?php if (isset($data['sitedesc'])) {echo $data['sitedesc'];}?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">关键词：</label>
                            <input type="text" name="sitekeywords" value="<?php if (isset($data['sitekeywords'])) {echo $data['sitekeywords'];}?>" size="55" class="form-control input-nm" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">版权信息：</label>
                            <input type="text" name="sitecopyright" value="<?php if (isset($data['sitecopyright'])) {echo $data['sitecopyright'];}?>" size="55" class="form-control input-nm" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">备案编号：</label>
                            <input type="text" name="siteicpsn" value="<?php if (isset($data['siteicpsn'])) {echo $data['siteicpsn'];}?>" size="55" class="form-control input-nm" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">统计代码：</label>
                            <textarea name="sitestatistics" cols="55" rows="5"><?php if (isset($data['sitestatistics'])) {echo $data['sitestatistics'];}?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-save">保存</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="tab-pane fade <?php if ($type == 'other') {echo 'active in';}?>" id="other">
            <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Options', 'action' => 'index', 'other']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
                <table class="table table-condensed">
                    <tbody>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">百度地图：</label>
                            <input type="text" name="baidu" value="<?php if (isset($data['baidu'])) {echo $data['baidu'];}?>" size="55" class="form-control input-nm" >&nbsp;
                            <span>说明：百度地图API Key</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">云片短信：</label>
                            <input type="text" name="yunpian" value="<?php if (isset($data['yunpian'])) {echo $data['yunpian'];}?>" size="55" class="form-control input-nm" >&nbsp;
                            <span>说明：云片短信API Key</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x100 text-right">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-save">保存</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>