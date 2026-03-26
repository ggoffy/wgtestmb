<{include file='db:wgtestmb_header.tpl' }>

<!-- Start index list -->
<table>
    <thead>
        <tr class='center'>
            <th><{$smarty.const._MA_WGTESTMB_TITLE}>  -  <{$smarty.const._MA_WGTESTMB_DESC}></th>
        </tr>
    </thead>
    <tbody>
        <tr class='center'>
            <td class='bold pad5'>
                <ul class='menu text-center'>
                    <li><a href='<{$wgtestmb_url}>'><{$smarty.const._MA_WGTESTMB_INDEX}></a></li>
                    <li><a href='<{$wgtestmb_url}>/testtable1.php'><{$smarty.const._MA_WGTESTMB_TESTTABLE1}></a></li>
                </ul>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr class='center'>
            <td class='bold pad5'>
                <{if $adv|default:''}><{$adv|default:false}><{/if}>
            </td>
        </tr>
    </tfoot>
</table>
<!-- End index list -->

<div class='wgtestmb-linetitle'><{$smarty.const._MA_WGTESTMB_INDEX_LATEST_LIST}></div>
<{if $testtable1Count|default:0 > 0}>
    <!-- Start show new testtable1 in index -->
    <table class='table table-<{$table_type|default:''}>'>
        <tr>
            <!-- Start new link loop -->
            <{foreach item=testtable1 from=$testtable1_list name=testtable1}>
                <td class='col_width<{$numb_col}> top center'>
                    <{include file='db:wgtestmb_testtable1_list.tpl' testtable1=$testtable1}>
                </td>
                <{if $smarty.foreach.testtable1.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
            <{/foreach}>
            <!-- End new link loop -->
        </tr>
    </table>
<{/if}>
<{include file='db:wgtestmb_footer.tpl' }>
