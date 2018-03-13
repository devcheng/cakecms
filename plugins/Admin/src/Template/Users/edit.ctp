<div class="bjui-pageContent tablecomm">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Users', 'action' => 'edit', $data->id]);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <input type="hidden" name="id" value="<?php echo $data->id;?>">
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td>
                    <label class="control-label x85">用&nbsp;&nbsp;户&nbsp;&nbsp;名：</label>
                    <input type="text" name="username" value="<?php echo $data->username;?>" autocomplete="off" size="35" class="form-control input-nm" data-rule="required">
                    <span style="color:#ff0000;">*</span>
                </td>
            </tr>
            <tr>
                <td >
                    <label class="control-label x85">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
                    <input type="text" onfocus="this.type='password'" name="password" value="" autocomplete="off" size="35" class="form-control input-nm">
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
                    <label for="name" class="control-label x85">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label>
                    <select name="state" data-toggle="selectpicker" data-width="350">
                        <?php
                        foreach($stateData as $key => $val) {
                            ?>
                            <option value="<?php echo $key;?>" <?php if($data->state == $key){echo "selected";}?>><?php echo $val;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="name" class="control-label x85">管理员组：</label>
                    <select name="role_id" data-toggle="selectpicker" data-width="350">
                        <?php
                        foreach($roleData as $item) {
                            ?>
                            <option value="<?php echo $item->id;?>" <?php if($data->role_id == $item->id){echo "selected";}?>><?php echo $item->name;?></option>
                            <?php
                        }
                        ?>
                    </select>
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