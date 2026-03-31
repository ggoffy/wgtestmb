<table class='table table-responsive table-<{$table_type|default:false}>'>
    <thead>
        <tr class='head'>
            <th>&nbsp;</th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_TT1_NAME}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_TT1_DATE}></th>
            <th class='center'><{$smarty.const._MB_WGTESTMB_TT1_COMMENTS}></th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <{if $block|count > 0}>
    <tbody>
        <{foreach item=testtable1 from=$block}>
        <tr class='<{cycle values="odd, even"}>'>
            <td class='center'><{$testtable1.id|default:false}></td>
            <td class='center'><{$testtable1.name|default:''|escape:'html'}></td>
            <td class='center'><{$testtable1.date_text|default:false}></td>
            <td class='center'><{$testtable1.comments|default:''|escape:'html'}></td>
            <td class='center'><a href='<{$wgtestmb_url|default:false}>/testtable1.php?op=show&amp;tt1_id=<{$testtable1.id|default:false}>' title='<{$smarty.const._MB_WGTESTMB_TESTTABLE1_GOTO|escape:"htmlattr"}>'><{$smarty.const._MB_WGTESTMB_TESTTABLE1_GOTO|escape:"htmlattr"}></a></td>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
    <tfoot><tr><td>&nbsp;</td></tr></tfoot>
</table>
