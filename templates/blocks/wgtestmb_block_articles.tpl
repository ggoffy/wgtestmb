<table class='table table-responsive table-<{$table_type|default:false}>'>
    <thead>
        <tr class='head'>
            <th>&nbsp;</th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_ART_CAT}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_ART_TITLE}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_ART_DESCR}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_ART_IMG}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_ART_FILE}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_ART_CREATED}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_ART_SUBMITTER}></th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <{if $block|count > 0}>
    <tbody>
        <{foreach item=article from=$block}>
        <tr class='<{cycle values="odd, even"}>'>
            <td class='center'><{$article.id|default:false}></td>
            <td class='center'><{$article.cat_text|default:false}></td>
            <td class='center'><{$article.title|default:''|escape:'html'}></td>
            <td class='center'><{$article.descr_short|default:''|escape:'html'}></td>
            <td class='center'><img src="<{$wgtestmb_upload_url|default:false}>/images/articles/<{$article.img|default:false}>" alt="articles" ></td>
            <td class='center'><{$article.file|default:''|escape:'html'}></td>
            <td class='center'><{$article.created_text|default:false}></td>
            <td class='center'><{$article.submitter_text|default:false}></td>
            <td class='center'><a href='<{$wgtestmb_url|default:false}>/articles.php?op=show&amp;art_id=<{$article.id|default:false}>' title='<{$smarty.const._MB_WGTESTMB_ARTICLE_GOTO|escape:"htmlattr"}>'><{$smarty.const._MB_WGTESTMB_ARTICLE_GOTO|escape:"htmlattr"}></a></td>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
    <tfoot><tr><td>&nbsp;</td></tr></tfoot>
</table>
