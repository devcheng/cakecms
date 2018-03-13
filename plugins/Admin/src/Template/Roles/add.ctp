<div class="bjui-pageContent">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'add']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <table class="table table-condensed table-hover">
            <tbody>
            <tr>
                <td>
                    <label for="name" class="control-label x85">组&nbsp;&nbsp;名&nbsp;称：</label>
                    <input type="text" name="name" value="" size="35" class="form-control input-nm" data-rule="required">
                    <span style="color:#ff0000;">*</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="name" class="control-label x85">排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序：</label>
                    <input type="text" name="sort" class="form-control input-nm" value="0" size="35" data-toggle="spinner" data-min="0" data-max="100" data-step="1" data-rule="integer">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="name" class="control-label x85">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</label>
                    <textarea name="note" cols="50" rows="6" size="35"></textarea>
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