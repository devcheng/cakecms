<div class="bjui-pageContent tablecomm">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Users', 'action' => 'myinfo']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <input type="hidden" name="id" value="<?php echo $data->id;?>">
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td>
                    <label class="control-label x85">用&nbsp;&nbsp;户&nbsp;&nbsp;名：</label>
                    <input type="text" name="username" readonly value="<?php echo $data->username;?>" size="35" class="form-control input-nm">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</label>
                    <input type="text" name="nickname" value="<?php echo $data->nickname;?>" size="35" class="form-control input-nm" >
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;padding-bottom: 10px;">
                    <label class="control-label x85">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</label>
                    <input type="radio" name="sex" id="j_custom_sex1" data-toggle="icheck" value="1" data-rule="checked" <?php if($data->sex == 1){echo "checked";}?> data-label="&nbsp;男">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="sex" id="j_custom_sex2" data-toggle="icheck" value="2" <?php if($data->sex == 2){echo "checked";}?> data-label="&nbsp;女">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">联系方式：</label>
                    <input type="text" name="telphone" value="<?php echo $data->telphone;?>" size="35" class="form-control input-nm" >
                </td>
            </tr>
            <tr>
                <td >
                    <label class="control-label x85">电子邮件：</label>
                    <input type="text" name="email" value="<?php echo $data->email;?>" size="35" class="form-control input-nm" data-rule="email">
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