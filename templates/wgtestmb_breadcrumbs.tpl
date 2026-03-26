<ol class='breadcrumb'>
    <li class='breadcrumb-item'><a href='<{xoAppUrl 'index.php'}>' title='home'><i class="glyphicon glyphicon-home fa fa-home"></i></a></li>
    <{foreach item=itm from=$xoBreadcrumbs name=bcloop}>
    <li class='breadcrumb-item'>
        <{if $itm.link|default:''}>
            <a href='<{$itm.link|default:false}>' title='<{$itm.title|default:false}>'><{$itm.title|default:false}></a>
        <{else}>
            <{$itm.title|default:false}>
        <{/if}>
    </li>
    <{/foreach}>
</ol>
