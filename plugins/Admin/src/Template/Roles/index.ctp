<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'index']);?>" method="post">
        <input type="hidden" name="pageSize" value="<?php echo $numPerPage ?>">
        <input type="hidden" name="pageCurrent" value="1">
    </form>
    <div class="datagrid-toolbar">
        <div class="btn-group" role="group">
            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'add']);?>" class="btn btn-green" data-toggle="dialog" data-width="600" data-height="350" data-target="roles" data-mask="true" data-icon="plus">添加管理员组</a>
        </div>
    </div>
</div>

<div class="bjui-pageContent tableContent">
    <table class="table table-bordered table-hover table-striped table-top" data-width="100%" data-layout-h="0" data-nowrap="true" data-selected-multi="true">
        <thead>
        <tr>
            <th align="center">序号</th>
            <th> 组名称</th>
            <th align="center">排序</th>
            <th align="center">创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        if(!empty($data)) {
            foreach($data as $item) {
                ?>
                <tr >
                    <td align="center"><?php echo $i;?></td>
                    <td> <?php echo $item->name;?></td>
                    <td align="center"><?php echo $item->sort;?></td>
                    <td align="center"><?php echo date('Y-m-d H:i:s', strtotime($item->created));?></td>
                    <td>
                        <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'edit', $item->id]);?>" class="btn btn-blue" data-toggle="dialog" data-width="600" data-height="350" data-id="dialog-mask" data-mask="true">编辑</a>&nbsp;
                        <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'delete', $item->id]);?>" class="btn btn-red" data-toggle="doajax" data-confirm-msg="确定要删除该行信息吗">删除</a>&nbsp;
                        <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'manage', $item->id]);?>" class="btn btn-orange" data-toggle="dialog" data-width="600" data-height="600" data-id="dialog-mask" data-mask="true">权限管理</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </tbody>
    </table>
</div>
<div class="bjui-pageFooter">
    <div class="pages">
        <span>每页&nbsp;</span>
        <div class="selectPagesize">
            <select data-toggle="selectpicker" data-toggle-change="changepagesize">
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
        </div>
        <span>&nbsp;条，共 <?php echo str_replace(',', '', $this->Paginator->counter('{{count}}'));?> 条</span>
    </div>
    <div class="pagination-box" data-toggle="pagination"
         data-total="<?php echo str_replace(',', '', $this->Paginator->counter('{{count}}'));?>"
         data-page-size="<?php echo $numPerPage; ?>"
         data-page-current="1">
    </div>
</div>