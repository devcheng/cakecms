<div class="bjui-pageContent tablecomm">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Users', 'action' => 'resetpasswd']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <input type="hidden" name="id" value="<?php echo $data->id;?>">
        <input type="hidden" name="username" value="<?php echo $data->username;?>">
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td >
                    <label class="control-label x85">原&nbsp;&nbsp;密&nbsp;&nbsp;码：</label>
                    <input type="text" onfocus="this.type='password'" name="password" autocomplete="off" size="25" class="form-control input-nm" data-rule="required;">
                    <span style="color:#ff0000;">*</span>
                </td>
            </tr>
            <tr>
                <td >
                    <label class="control-label x85">新&nbsp;&nbsp;密&nbsp;&nbsp;码：</label>
                    <input type="text" onfocus="this.type='password'" name="new" autocomplete="off" size="25" class="form-control input-nm" data-rule="新密码:required;password">
                    <span style="color:#ff0000;">*</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">确认密码：</label>
                    <input type="text" onfocus="this.type='password'" name="confirm" autocomplete="off" size="25" class="form-control input-nm" data-rule="required;match[new]">
                    <span style="color:#ff0000;">*</span>
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