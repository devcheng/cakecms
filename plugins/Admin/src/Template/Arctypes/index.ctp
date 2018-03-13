<div class="bjui-pageHeader">
    <div class="datagrid-toolbar">
        <div class="btn-group" role="group">
            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Arctypes', 'action' => 'add']);?>" class="btn btn-green" data-toggle="dialog" data-width="760" data-height="580" data-target="roles" data-mask="true" data-icon="plus">添加栏目</a>
        </div>
    </div>
</div>

<div class="bjui-pageContent tableContent">
    <table class="table table-bordered table-hover table-striped table-top" data-width="100%" data-layout-h="0" data-nowrap="true" data-selected-multi="true">
        <thead>
        <tr>
            <th align="center">序号</th>
            <th>栏目名称</th>
            <th>栏目别名</th>
            <th align="center">级别</th>
            <th align="center">栏目类型</th>
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
                        <td><?php echo $item->asname;?></td>
                        <td align="center"><?php echo $item->level;?></td>
                        <td align="center"><?php echo $typeData[$item->type];?></td>
                        <td align="center"><?php echo $item->sort;?></td>
                        <td align="center">
                            <span class="label label-<?php echo $colorData[$item->isshow];?>">
                            <?php echo $stateData[$item->isshow];?>
                            </span>
                        </td>
                        <td>
                            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Arctypes', 'action' => 'edit', $item->id]);?>" class="btn btn-blue" data-toggle="dialog" data-width="760" data-height="620" data-id="dialog-mask" data-mask="true">编辑</a>&nbsp;
                            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Arctypes', 'action' => 'add', $item->id]);?>" class="btn btn-green" data-toggle="dialog" data-width="760" data-height="580" data-id="dialog-mask" data-mask="true">添加子栏目</a>&nbsp;
                            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Arctypes', 'action' => 'delete', $item->id]);?>" class="btn btn-red" data-toggle="doajax" data-confirm-msg="确定要删除该行信息吗">删除</a>&nbsp;
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