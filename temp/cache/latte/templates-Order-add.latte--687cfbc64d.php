<?php
// source: C:\xampp\htdocs\cviceni02a\app\presenters/templates/Order/add.latte

use Latte\Runtime as LR;

class Template687cfbc64d extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<h1>Vložení Nákupu</h1>
<p>
<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("default")) ?>">Zpět</a>
</p>

<?php
		/* line 6 */ $_tmp = $this->global->uiControl->getComponent("addForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
