<!-- Header -->
<{include file='db:wgtestmb_admin_header.tpl' }>

<{if $testtable1_list|default:''}>
    <table class='outer'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTTABLE1_ID}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTTABLE1_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTTABLE1_DATE}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTTABLE1_STATUS}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTTABLE1_COMMENTS}></th>
                <th class="center width5"><{$smarty.const._AM_WGTESTMB_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $testtable1_count|default:''}>
        <tbody>
            <{foreach item=testtable1 from=$testtable1_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$testtable1.id|default:false}></td>
                <td class='center'><{$testtable1.name|default:false}></td>
                <td class='center'><{$testtable1.date_text|default:false}></td>
                <td class='center'><img src="<{$modPathIcon16}>status<{$testtable1.status|default:false}>.png" alt="<{$testtable1.status_text|default:false}>" title="<{$testtable1.status_text|default:false}>" ></td>
                <td class='center'><{$testtable1.comments|default:false}></td>
                <td class="center  width5">
                    <a href="testtable1.php?op=edit&amp;tt1_id=<{$testtable1.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> testtable1" ></a>
                    <a href="testtable1.php?op=clone&amp;tt1_id_source=<{$testtable1.id|default:false}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> testtable1" ></a>
                    <a href="testtable1.php?op=delete&amp;tt1_id=<{$testtable1.id|default:false}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> testtable1" ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:wgtestmb_admin_footer.tpl' }>
