<?php
// source: C:\xampp\htdocs\cviceni02a\app\presenters/templates/Statistic/default.latte

use Latte\Runtime as LR;

class Template030c70f29d extends Latte\Runtime\Template
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
		if (isset($this->params['s'])) trigger_error('Variable $s overwritten in foreach on line 15');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<h1>Statistiky</h1>

<p><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("User:default")) ?>">Uživatelé</a> <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Order:default")) ?>">Nákupy</a>  <a href="<?php
		echo LR\Filters::escapeHtmlAttr($this->global->uiPresenter->link("Homepage:default")) ?>">Menu</a></p>

<table border="1" width="100%">
    <tr>
        <th>Majitel</th>
        <th>Minimální cena nákupu</th>
        <th>Maximální cena nákupu</th>
        <th>Průměrná cena nákupu</th>
        <th>Celková cena všech nákupu</th>
    </tr>
<?php
		$iterations = 0;
		foreach ($statistics as $s) {
?>
            <tr>
                <td><?php echo LR\Filters::escapeHtmlText($s['name']) /* line 17 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['min']) /* line 18 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['max']) /* line 19 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['avg']) /* line 20 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($s['sum']) /* line 21 */ ?></td>
            </tr>
<?php
			$iterations++;
		}
?>
    </div>
</table><?php
	}

}
