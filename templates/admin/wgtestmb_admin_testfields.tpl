<!-- Header -->
<{include file='db:wgtestmb_admin_header.tpl' }>

<{if $testfields_list|default:''}>
    <table class='outer'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_ID}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_TEXT}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_TEXTAREA}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_DHTML}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_CHECKBOX}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_YESNO}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_SELECTBOX}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_USER}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_COLOR}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_IMAGELIST}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_URLFILE}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_UPLIMAGE}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_UPLFILE}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_TEXTDATESELECT}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_SELECTFILE}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_PASSWORD}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_COUNTRY_LIST}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_LANGUAGE}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_RADIO}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_STATUS}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_DATETIME}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_COMBOBOX}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_COMMENTS}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_RATINGS}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_VOTES}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_UUID}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_IP}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_TESTFIELD_READS}></th>
                <th class="center width5"><{$smarty.const._AM_WGTESTMB_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $testfields_count|default:''}>
        <tbody>
            <{foreach item=testfield from=$testfields_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$testfield.id|default:false}></td>
                <td class='center'><{$testfield.text|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.textarea_short|default:false}></td>
                <td class='center'><{$testfield.dhtml_short|default:false}></td>
                <td class='center'><img src="<{xoModuleIcons16}><{$testfield.checkbox|default:false}>.png" alt="testfields" ></td>
                <td class='center'><{$testfield.yesno_text|default:false}></td>
                <td class='center'><{$testfield.selectbox|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.user_text|default:false}></td>
                <td class='center'><span style='background-color:<{$testfield.color|default:false}>;'>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td class='center'><img src="<{xoModuleIcons32}><{$testfield.imagelist|default:false}>" alt="testfields" ></td>
                <td class='center'><{$testfield.urlfile|default:''|escape:'html'}></td>
                <td class='center'><img src="<{$wgtestmb_upload_url|default:false}>/images/testfields/<{$testfield.uplimage|default:false}>" alt="testfields" style="max-width:100px" ></td>
                <td class='center'><{$testfield.uplfile|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.textdateselect_text|default:false}></td>
                <td class='center'><{$testfield.selectfile|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.password|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.country_list|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.language|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.radio|default:''|escape:'html'}></td>
                <td class='center'><img src="<{$modPathIcon16}>status<{$testfield.status|default:false}>.png" alt="<{$testfield.status_text|default:false}>" title="<{$testfield.status_text|default:false}>" ></td>
                <td class='center'><{$testfield.datetime_text|default:false}></td>
                <td class='center'><{$testfield.combobox|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.comments|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.ratings|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.votes|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.uuid|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.ip|default:''|escape:'html'}></td>
                <td class='center'><{$testfield.reads|default:''|escape:'html'}></td>
                <td class="center  width5">
                    <a href="testfields.php?op=edit&amp;tf_id=<{$testfield.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> testfields" ></a>
                    <a href="testfields.php?op=clone&amp;tf_id_source=<{$testfield.id|default:false}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> testfields" ></a>
                    <a href="testfields.php?op=delete&amp;tf_id=<{$testfield.id|default:false}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> testfields" ></a>
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
