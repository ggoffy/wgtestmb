<!-- Header -->
<{include file='db:wgtestmb_admin_header.tpl' }>

<h3><{$articles_result|default:false}></h3>
<{if $articles_count|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class='center'><{$smarty.const._AM_WGTESTMB_BROKEN_TABLE}></th>
                <th class='center'><{$smarty.const._AM_WGTESTMB_BROKEN_MAIN}></th>
                <th class='center width5'><{$smarty.const._AM_WGTESTMB_FORM_ACTION}></th>
            </tr>
        </thead>
        <tbody>
            <{foreach item=article from=$articles_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$article.table|default:false}></td>
                <td class='center'><{$article.main|default:false}></td>
                <td class='center width5'>
                    <a href='articles.php?op=edit&amp;<{$article.key|default:false}>=<{$article.keyval|default:false}>' title='<{$smarty.const._EDIT}>'><img src="<{xoModuleIcons16 'edit.png'}>" alt='articles' ></a>
                    <a href='articles.php?op=delete&amp;<{$article.key|default:false}>=<{$article.keyval|default:false}>' title='<{$smarty.const._DELETE}>'><img src="<{xoModuleIcons16 'delete.png'}>" alt='articles' ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
    </table>
    <div class='clear'>&nbsp;</div>
    <{if $pagenav_articles|default:''}>
        <div class='xo-pagenav floatright'><{$pagenav_articles}></div>
        <div class='clear spacer'></div>
    <{/if}>
<{else}>
    <{if $nodataArticles|default:''}>
        <div>
            <{$nodataArticles|default:false}><img src="<{xoModuleIcons32 'button_ok.png'}>" alt='articles' >
        </div>
        <div class='clear spacer'></div>
        <br>
        <br>
    <{/if}>
<{/if}>
<br>
<br>
<br>
<h3><{$testfields_result|default:false}></h3>
<{if $testfields_count|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class='center'><{$smarty.const._AM_WGTESTMB_BROKEN_TABLE}></th>
                <th class='center'><{$smarty.const._AM_WGTESTMB_BROKEN_MAIN}></th>
                <th class='center width5'><{$smarty.const._AM_WGTESTMB_FORM_ACTION}></th>
            </tr>
        </thead>
        <tbody>
            <{foreach item=testfield from=$testfields_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$testfield.table|default:false}></td>
                <td class='center'><{$testfield.main|default:false}></td>
                <td class='center width5'>
                    <a href='testfields.php?op=edit&amp;<{$testfield.key|default:false}>=<{$testfield.keyval|default:false}>' title='<{$smarty.const._EDIT}>'><img src="<{xoModuleIcons16 'edit.png'}>" alt='testfields' ></a>
                    <a href='testfields.php?op=delete&amp;<{$testfield.key|default:false}>=<{$testfield.keyval|default:false}>' title='<{$smarty.const._DELETE}>'><img src="<{xoModuleIcons16 'delete.png'}>" alt='testfields' ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
    </table>
    <div class='clear'>&nbsp;</div>
    <{if $pagenav_testfields|default:''}>
        <div class='xo-pagenav floatright'><{$pagenav_testfields}></div>
        <div class='clear spacer'></div>
    <{/if}>
<{else}>
    <{if $nodataTestfields|default:''}>
        <div>
            <{$nodataTestfields|default:false}><img src="<{xoModuleIcons32 'button_ok.png'}>" alt='testfields' >
        </div>
        <div class='clear spacer'></div>
        <br>
        <br>
    <{/if}>
<{/if}>
<br>
<br>
<br>
<{if $error|default:''}>
    <div class='errorMsg'>
<strong><{$error|default:false}></strong>    </div>
<{/if}>

<!-- Footer -->
<{include file='db:wgtestmb_admin_footer.tpl' }>
