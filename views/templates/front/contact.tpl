{extends file='page.tpl'}
{block name="content"}
<ul>
	<li>Number Of product</li>:<li></li><li>{$nb_product}</li>
</ul>
<ul>
	{foreach from=$categories item=cat}
		<li>{$cat['name']}</li>
	{/foreach}
</ul>
<ul>
	<li>{$manufacturer['name']}</li>
</ul>
<ul>
	<li>{$shop_name}</li>
</ul>
{/block}