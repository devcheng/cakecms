<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'index']);?>" method="post">
        <input type="hidden" name="pageSize" value="<?php echo $numPerPage ?>">
        <input type="hidden" name="pageCurrent" value="1">
        <div class="bjui-searchBar">
            <label>栏目：</label>
            <select name="arctype_id" id="j_custom_column" data-toggle="selectpicker">
                <option value="">请选择</option>
                <?php
                    if (!empty($arctypeData)) {
                        foreach ($arctypeData as $item) {
                            ?>
                            <option value="<?php echo $item->id;?>" <?php if(isset($arctype_id) && $arctype_id == $item->id){echo 'selected';}?> >
                                <?php
                                $line = '';
                                if ($item->level > 1) {
                                    for ($i = 1; $i <= ($item->level-1); $i++){
                                        $line .= "&nbsp;&nbsp;&nbsp;|---";
                                    }
                                }
                                echo $line . $item->name;
                                ?>
                            </option>
                            <?php
                        }
                    }
                ?>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;
            <label>标题：</label>
            <input type="text" value="<?php if (isset($title)) {echo $title;}?>" name="title" class="form-control" size="20">&nbsp;&nbsp;&nbsp;&nbsp;
            <label>发布日期：</label>
            <input type="text" value="<?php if (isset($pubdate)) { echo $pubdate;}?>" name="pubdate" data-toggle="datepicker" class="form-control" size="12">&nbsp;&nbsp;&nbsp;&nbsp;
            <label>自定义属性：</label>
            <select name="diy" id="j_custom_diy" data-toggle="selectpicker" multiple>
                <?php
                    if (!empty($diyData)) {
                        foreach ($diyData as $key => $val) {
                            ?>
                            <option value="<?php echo $key;?>" <?php if(isset($diy) && ($diy == $key || (is_array($diy) &&in_array($key, $diy))) ){echo 'selected';}?> ><?php echo $val;?></option>
                            <?php
                        }
                    }
                ?>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn-default" data-icon="search">查询</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-orange" href="javascript:;" onclick="$(this).navtab('reloadForm', true);" data-icon="undo">清空查询</a>
        </div>
    </form>

    <div class="datagrid-toolbar">
        <div class="btn-group" role="group">
            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'add']);?>" class="btn btn-green" data-toggle="navtab" data-id="addarctiles" data-mask="true" data-icon="plus">添加文章</a>
        </div>
        <div class="btn-group" role="group">
            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'batchDel']);?>" class="btn btn-red" data-icon="remove" data-toggle="doajaxchecked" data-confirm-msg="确定要删除选中项吗？" data-idname="delids" data-group="ids">批量删除</a>
        </div>
    </div>
</div>

<div class="bjui-pageContent tableContent article-table">
    <table class="table table-bordered table-hover table-striped table-top" data-width="100%" data-layout-h="0" data-nowrap="true" data-selected-multi="true">
        <thead>
        <tr>
            <th width="50" align="center"><input type="checkbox" class="checkboxCtrl" data-group="ids" data-toggle="icheck"></th>
            <th align="center">ID</th>
            <th>标题</th>
            <th align="center">所属栏目</th>
            <th align="center">作者</th>
            <th align="center">点击</th>
            <th align="center">发布时间</th>
            <th align="center">发布者</th>
            <th align="center">状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; foreach ($data as $item) { ?>
            <tr >
                <td align="center"><input type="checkbox" name="ids" data-toggle="icheck" value="<?php echo $item->id;?>"></td>
                <td align="center"><?php echo $item->id;?></td>
                <td>
<!--                    --><?php
//                        if (!empty($item->image) && $this->Pic->url($item->image, '', true)) {
//                            ?>
<!--                            <img  class="article-img" src="--><?php //echo $this->Pic->url($item->image);?><!--">-->
<!--                            --><?php
//                        }
//                    ?>
                    <a class="article-title <?php if ($item->isred == 1) {echo 'isRed';} if ($item->isbold == 1) {echo ' isBold';}?>" href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'edit', $item->id]);?>" data-title="编辑文章" data-toggle="navtab" data-fresh="true" data-id="editcontent" data-mask="true">
                        <?php echo ($item->isshow == 2) ? '<del>' . $item->title .'</del>' : $item->title;?>
                    </a>
                    <?php
                        if ($item->ishot == 1) {
                            ?><span class="label label-default" title="热门">热门</span>&nbsp;<?php
                        }
                        if ($item->istop == 1) {
                            ?><span class="label label-default" title="置顶">置顶</span>&nbsp;<?php
                        }
                        if ($item->isindex == 1) {
                            ?><span class="label label-default" title="推荐">推荐</span>&nbsp;<?php
                        }
                        if (!empty($item->image) && $this->Pic->url($item->image, '', true)) {
                            ?><span class="label label-default" title="图片"><span class="glyphicon glyphicon-picture"></span></span><?php
                        }
                    ?>
                </td>
                <td align="center"><?php echo $item->arctype->name;?></td>
                <td align="center"><?php echo $item->author;?></td>
                <td align="center"><?php echo $item->click;?></td>
                <td align="center"><?php echo date('Y-m-d H:i:s', strtotime($item->pubdate));?></td>
                <td align="center"><?php echo $item->user->username;?></td>
                <td align="center">
                    <span class="label label-<?php echo $colorData[$item->isshow];?>">
                        <?php echo $stateData[$item->isshow];?>
                    </span>
                </td>
                <td>
                    <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'edit', $item->id]);?>" class="btn btn-blue" data-toggle="navtab" data-fresh="true" data-id="editcontent" data-mask="true" data-title="编辑文章">编辑</a>&nbsp;
                    <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'preview', $item->id]);?>" class="btn btn-info kong" data-toggle="dialog" data-width="500" data-height="750" data-mask="true" data-title="预览">预览</a>&nbsp;
                    <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'delete', $item->id]);?>" class="btn btn-red" data-toggle="doajax" data-confirm-msg="确定要删除该行信息吗">删除</a>
                </td>
            </tr>
            <?php $i++; } ?>
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