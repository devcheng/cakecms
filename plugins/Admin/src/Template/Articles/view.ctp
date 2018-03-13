<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Arctypes'), ['controller' => 'Arctypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Arctype'), ['controller' => 'Arctypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articles view large-9 medium-8 columns content">
    <h3><?= h($article->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Arctype') ?></th>
            <td><?= $article->has('arctype') ? $this->Html->link($article->arctype->name, ['controller' => 'Arctypes', 'action' => 'view', $article->arctype->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($article->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shorttitle') ?></th>
            <td><?= h($article->shorttitle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= h($article->color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Desc') ?></th>
            <td><?= h($article->desc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Keywords') ?></th>
            <td><?= h($article->keywords) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author') ?></th>
            <td><?= h($article->author) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source') ?></th>
            <td><?= h($article->source) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($article->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= h($article->tag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Href') ?></th>
            <td><?= h($article->href) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $article->has('user') ? $this->Html->link($article->user->id, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($article->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Autoimage') ?></th>
            <td><?= $this->Number->format($article->autoimage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Click') ?></th>
            <td><?= $this->Number->format($article->click) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isshow') ?></th>
            <td><?= $this->Number->format($article->isshow) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isbold') ?></th>
            <td><?= $this->Number->format($article->isbold) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Istop') ?></th>
            <td><?= $this->Number->format($article->istop) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ishot') ?></th>
            <td><?= $this->Number->format($article->ishot) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isindex') ?></th>
            <td><?= $this->Number->format($article->isindex) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ishref') ?></th>
            <td><?= $this->Number->format($article->ishref) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pubdate') ?></th>
            <td><?= h($article->pubdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($article->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($article->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($article->content)); ?>
    </div>
</div>
