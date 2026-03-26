<{include file='db:wgtestmb_header.tpl' }>

<{if $testtable1Count|default:0 > 0}>
<div class='table-responsive'>
    <table class='table table-<{$table_type|default:false}>'>
        <thead>
            <tr class='head'>
                <th colspan='<{$divideby|default:false}>'><{$smarty.const._MA_WGTESTMB_TESTTABLE1_TITLE}></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <{foreach item=testtable1 from=$testtable1_list name=testtable1}>
                <td>
                    <div class='panel panel-<{$panel_type|default:false}>'>
                        <{include file='db:wgtestmb_testtable1_item.tpl' testtable1=$testtable1}>
                    </div>
                </td>
                <{if $smarty.foreach.testtable1.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
                <{/foreach}>
            </tr>
        </tbody>
        <tfoot><tr><td>&nbsp;</td></tr></tfoot>
    </table>
</div>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <{$error|default:false}>
<{/if}>

<{include file='db:wgtestmb_footer.tpl' }>
