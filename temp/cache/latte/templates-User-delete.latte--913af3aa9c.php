<?php
// source: C:\xampp\htdocs\cviceni02a\app\presenters/templates/User/delete.latte

use Latte\Runtime as LR;

class Template913af3aa9c extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?><h1>Odebraní nákupu <?php echo LR\Filters::escapeHtmlText($name) /* line 1 */ ?></h1>
<p>
<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("default")) ?>">Zpět</a>
</p>

<?php
		/* line 6 */ $_tmp = $this->global->uiControl->getComponent("deleteForm");
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
