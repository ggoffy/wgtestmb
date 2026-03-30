<ol class='breadcrumb'>
    <li class='breadcrumb-item'><a href='<{xoAppUrl 'index.php'}>' title='home'><i class="glyphicon glyphicon-home fa fa-home"></i></a></li>
    <{foreach item=itm from=$xoBreadcrumbs name=bcloop}>
    <li class='breadcrumb-item'>
        <{if $itm.link|default:''}>
            <a href='<{$itm.link|default:""|escape:"htmlattr"}>' title='<{$itm.title|default:""|escape:"htmlattr"}>'><{$itm.title|default:""|escape:"html"}></a>
        <{else}>
            <{$itm.title|default:""|escape:"html"}>
        <{/if}>
    </li>
    <{/foreach}>
</ol>
