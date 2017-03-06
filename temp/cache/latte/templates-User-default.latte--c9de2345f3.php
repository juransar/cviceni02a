<?php
// source: C:\xampp\htdocs\cviceni02a\app\presenters/templates/User/default.latte

use Latte\Runtime as LR;

class Templatec9de2345f3 extends Latte\Runtime\Template
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
		if (isset($this->params['u'])) trigger_error('Variable $u overwritten in foreach on line 17');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<h1>Uživatelé</h1>

<p><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Order:default")) ?>">Nákup</a> <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Statistic:default")) ?>">Statistika</a>  <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:default")) ?>">Menu</a></p>

<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("add")) ?>">Vytvoř</a>
<table border="1" width="100%">
    <tr>
        <th>Příjmení</th>
        <th>Jméno</th>
        <th>Registrace</th>
        <th>Je Admin?</th>
        <th colspan="2">Akce</th>

    </tr>
<?php
		$iterations = 0;
		foreach ($users as $u) {
?>
            <tr>
                <td><?php echo LR\Filters::escapeHtmlText($u['surname']) /* line 19 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($u['firstname']) /* line 20 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($u['registered']) /* line 21 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($u['is_admin']) /* line 22 */ ?></td>
                <td><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("edit", ['id' => $u['id']])) ?>">Edituj</a></td>
                <td><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("delete", ['id' => $u['id']])) ?>">Odeber</a></td>
            </tr>
<?php
			$iterations++;
		}
?>
    </div>
</table><?php
	}

}
