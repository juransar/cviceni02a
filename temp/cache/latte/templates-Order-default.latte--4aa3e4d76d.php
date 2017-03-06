<?php
// source: C:\xampp\htdocs\cviceni02a\app\presenters/templates/Order/default.latte

use Latte\Runtime as LR;

class Template4aa3e4d76d extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['o'])) trigger_error('Variable $o overwritten in foreach on line 18');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<h1>Nákupy</h1>

<p><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("User:default")) ?>">Uživatelé</a> <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Statistic:default")) ?>">Statistiky</a> <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:default")) ?>">Menu</a></p>

<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("add")) ?>">Vytvoř</a>
<table border="1" width="100%">
    <tr>
        <th>Majitel</th>
        <th>Jméno</th>
        <th>Množství</th>
        <th>Cena za jednotku</th>
        <th>Cena</th>
        <th colspan="2">Akce</th>

    </tr>
<?php
		$iterations = 0;
		foreach ($orders as $o) {
?>
            <tr>
                <td><?php echo LR\Filters::escapeHtmlText($o->user->surname) /* line 20 */ ?> <?php echo LR\Filters::escapeHtmlText($o->user->firstname) /* line 20 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($o->name) /* line 21 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($o->quantity) /* line 22 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($o->price) /* line 23 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($o->price*$o->quantity) /* line 24 */ ?></td>
                <td><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("edit", ['id' => $o['id']])) ?>">Edituj</a></td>
                <td><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("delete", ['id' => $o['id']])) ?>">Odeber</a></td>
            </tr>
<?php
			$iterations++;
		}
?>
    </div>
</table><?php
	}

}
