<div class="bjui-pageContent tableContent">
    <table class="table table-bordered table-hover table-striped table-top" data-width="100%">
        <thead>
        <tr>
            <th width="20%" align="center">序号</th>
            <th width="40%">栏目名称</th>
            <th width="20%">栏目类型</th>
            <th width="20%" align="center">操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td align="center">1</td>
            <td>顶级栏目</td>
            <td></td>
            <td align="center">
                <a href="javascript:;" data-toggle="lookupback" data-args="{id:'0', name:'顶级栏目', level:'0'}" class="btn btn-blue" title="选择本项" data-icon="check">选择</a>
            </td>
        </tr>
        <?php
        $i=2;
        if (!empty($data)) {
            foreach ($data as $item) {
                ?>
                <tr>
                    <td align="center"><?php echo $i;?></td>
                    <td>
                        <?php
                        $line = '';
                        if ($item->level > 1) {
                            for($j = 1; $j <= ($item->level-1); $j++){
                                $line .= "&nbsp;&nbsp;|---&nbsp;";
                            }
                        }
                        echo $line . $item->name;
                        ?>
                    </td>
                    <td><?php echo $typeData[$item->type];?></td>
                    <td align="center">
                        <a href="javascript:;" data-toggle="lookupback" data-args="{id:'<?php echo $item->id;?>', name:'<?php echo $item->name;?>', level:'<?php echo $item->level;?>'}" class="btn btn-blue" title="选择本项" data-icon="check">选择</a>
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