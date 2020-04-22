<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright        Copyright (c) baserCMS Users Community
 * @link            https://basercms.net baserCMS Project
 * @package            Baser.View
 * @since            baserCMS v 0.1.0
 * @license            https://basercms.net/license/index.html
 */

/**
 * [ADMIN] ユーザーグループ一覧　行
 */
?>


<tr>
	<td class="bca-table-listup__tbody-td"><?php echo $userGroup->id ?></td>
	<td class="bca-table-listup__tbody-td"><?php $this->BcBaser->link($userGroup->name, ['action' => 'edit', $userGroup->id], ['escape' => true]) ?>
		<?php if ($userGroup->users): ?><br>
			<?php foreach($userGroup->users as $user): ?>
				<span class="tag"><?php $this->BcBaser->link($this->BcBaser->getUserName($user), ['controller' => 'users', 'action' => 'edit', $user->id, ['escape' => true]]) ?></span>
			<?php endforeach ?>
		<?php endif ?>
	</td>
	<td class="bca-table-listup__tbody-td"><?php echo h($userGroup->title) ?></td>
	<?php echo $this->BcListTable->dispatchShowRow($userGroup) ?>
	<td class="bca-table-listup__tbody-td"><?php echo $this->BcTime->format($userGroup->created, 'YYYY-MM-dd') ?><br/>
		<?php echo $this->BcTime->format($userGroup->modified, 'YYYY-MM-dd') ?></td>
	<td class="bca-table-listup__tbody-td">
		<?php if ($userGroup->name != 'admins'): ?>
			<?php $this->BcBaser->link('', ['controller' => 'permissions', 'action' => 'index', $userGroup->id], ['title' => __d('baser', '制限'), 'class' => 'bca-btn-icon', 'data-bca-btn-type' => 'permission', 'data-bca-btn-size' => 'lg']) ?>
		<?php endif ?>
		<?php $this->BcBaser->link('', ['action' => 'edit', $userGroup->id], ['title' => __d('baser', '編集'), 'class' => 'bca-btn-icon', 'data-bca-btn-type' => 'edit', 'data-bca-btn-size' => 'lg']) ?>
		<?php $this->BcBaser->link('', ['action' => 'ajax_copy', $userGroup->id], ['title' => __d('baser', 'コピー'), 'class' => 'btn-copy bca-btn-icon', 'data-bca-btn-type' => 'copy', 'data-bca-btn-size' => 'lg']) ?>
		<?php if ($userGroup->name != 'admins'): ?>
			<?php $this->BcBaser->link('', ['action' => 'ajax_delete', $userGroup->id], ['title' => __d('baser', '削除'), 'class' => 'btn-delete bca-btn-icon', 'data-bca-btn-type' => 'delete', 'data-bca-btn-size' => 'lg']) ?>
		<?php endif ?>
	</td>
</tr>
