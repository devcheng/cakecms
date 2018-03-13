<script type="text/javascript">
    //选择事件
    function S_NodeCheck(e, treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj(treeId);
        var nodes = zTree.getCheckedNodes(true);
        var ids = '';

        for (var i = 0; i < nodes.length; i++) {
            ids   += ','+ nodes[i].id;
        }
        if (ids.length > 0) {
            ids = ids.substr(1);
        }
        $('#menus').val(ids);
    }

    //单击事件
    function S_NodeClick(event, treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj(treeId)

        zTree.checkNode(treeNode, !treeNode.checked, true, true)

        event.preventDefault()
    }
</script>
<div class="bjui-pageContent">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'manage', $id]);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <input type="hidden" name="menus" id="menus" value="<?php echo $haveMenuStr;?>">
        <ul id="j_select_tree1" class="ztree" data-toggle="ztree"
            data-check-enable="true"
            data-on-check="S_NodeCheck"
            data-on-click="S_NodeClick"
            data-expand-all="true" >
            <?php
                foreach ($menu as $item) {
                    ?>
                    <li data-id="<?php echo $item->id;?>" data-pid="<?php echo $item->parent_id;?>" <?php if(in_array($item->id, $haveMenus)){echo 'data-checked="true"';}?> ><?php echo $item->name;?></li>
                    <?php
                }
            ?>
        </ul>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close btn-no">关闭</button></li>
        <li><button type="submit" class="btn-blue">保存</button></li>
    </ul>
</div>