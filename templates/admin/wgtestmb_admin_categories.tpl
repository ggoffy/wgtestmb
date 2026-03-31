<!-- Header -->
<{include file='db:wgtestmb_admin_header.tpl' }>

<{if $categories_list|default:''}>
    <table class='outer'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_WGTESTMB_CATEGORY_ID}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_CATEGORY_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_CATEGORY_LOGO}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_CATEGORY_CREATED}></th>
                <th class="center"><{$smarty.const._AM_WGTESTMB_CATEGORY_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._AM_WGTESTMB_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $categories_count|default:''}>
        <tbody>
            <{foreach item=category from=$categories_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$category.id|default:false}></td>
                <td class='center'><{$category.name|default:''|escape:'html'}></td>
                <td class='center'><img src="<{$wgtestmb_upload_url|default:false}>/images/categories/<{$category.logo|default:false}>" alt="categories" style="max-width:100px" ></td>
                <td class='center'><{$category.created_text|default:false}></td>
                <td class='center'><{$category.submitter_text|default:false}></td>
                <td class="center  width5">
                    <a href="categories.php?op=edit&amp;cat_id=<{$category.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> categories" ></a>
                    <a href="categories.php?op=clone&amp;cat_id_source=<{$category.id|default:false}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> categories" ></a>
                    <a href="categories.php?op=delete&amp;cat_id=<{$category.id|default:false}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> categories" ></a>
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
