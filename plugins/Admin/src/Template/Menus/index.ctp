<div class="bjui-pageHeader">
    <div class="datagrid-toolbar">
        <div class="btn-group" role="group">
            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Menus', 'action' => 'add']);?>" class="btn btn-green" data-toggle="dialog" data-width="600" data-height="450" data-target="roles" data-mask="true" data-icon="plus">添加菜单</a>
        </div>
    </div>
</div>

<div class="bjui-pageContent tableContent">
    <table class="table table-bordered table-hover table-striped table-top" data-width="100%" data-layout-h="0" data-nowrap="true" data-selected-multi="true">
        <thead>
        <tr>
            <th align="center">序号</th>
            <th>菜单名称</th>
            <th>链接</th>
            <th align="center">级别</th>
            <th>图标</th>
            <th>标识</th>
            <th align="center">排序</th>
            <th align="center">状态</th>
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
                    <td>
                        <?php
                            $line = '';
                            if ($item->level > 1) {
                                for($j = 1; $j <= ($item->level-1); $j++){
                                    $line .= "&nbsp;&nbsp;&nbsp;|---&nbsp;";
                                }
                            }
                            echo $line . $item->name;
                        ?>
                    </td>
                    <td><?php echo $item->target;?></td>
                    <td align="center"><?php echo $item->level;?></td>
                    <td><?php echo $item->icon;?></td>
                    <td><?php echo $item->reload;?></td>
                    <td align="center"><?php echo $item->sort;?></td>
                    <td align="center">
                            <span class="label label-<?php echo $colorData[$item->isshow];?>">
                            <?php echo $stateData[$item->isshow];?>
                            </span>
                    </td>
                    <td>
                        <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Menus', 'action' => 'edit', $item->id]);?>" class="btn btn-blue" data-toggle="dialog" data-width="600" data-height="480" data-id="dialog-mask" data-mask="true">编辑</a>&nbsp;
                        <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Menus', 'action' => 'delete', $item->id]);?>" class="btn btn-red" data-toggle="doajax" data-confirm-msg="确定要删除该行信息吗">删除</a>&nbsp;
                        <?php
                            if ($item->level != 3) {
                                ?>
                                <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Menus', 'action' => 'add', $item->id]);?>" class="btn btn-green" data-toggle="dialog" data-width="600" data-height="450" data-id="dialog-mask" data-mask="true">添加子菜单</a>
                                <?php
                            }
                        ?>
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