<i id='tfId_<{$testfield.id|default:false}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$testfield.text|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.textarea_short|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.dhtml_short|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.checkbox|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.yesno_text|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.selectbox|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.user_text|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.color|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><img src="<{$xoops_icons32_url|default:''|escape:'htmlattr'}>/<{$testfield.imagelist|default:''|escape:'htmlattr'}>" alt='testfields' ></span>
    <span class='col-sm-9 justify'><{$testfield.urlfile|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><img src="<{$wgtestmb_upload_url|default:''|escape:'htmlattr'}>/images/testfields/<{$testfield.uplimage|default:''|escape:'htmlattr'}>" alt='testfields' ></span>
    <span class='col-sm-9 justify'><{$testfield.uplfile|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.textdateselect_text|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.selectfile|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.country_list|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.radio|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.status_text|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.datetime_text|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.combobox|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><{$testfield.ratings|default:''|escape:'html'}></span>
</div>
<div class='panel-footer'>
    <span class='block-pie justify'><{$smarty.const._MA_WGTESTMB_TESTFIELD_COMMENTS}>: <{$testfield.comments|default:''|escape:'html'}></span>
    <span class='block-pie justify'><{$smarty.const._MA_WGTESTMB_TESTFIELD_IP}>: <{$testfield.ip|default:''|escape:'html'}></span>
    <span class='block-pie justify'><{$smarty.const._MA_WGTESTMB_TESTFIELD_READS}>: <{$testfield.reads|default:''|escape:'html'}></span>
    <div class='col-sm-12 right'>
        <{if $showItem|default:false}>
            <a class='btn btn-success right' href='testfields.php?op=list&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>#tfId_<{$testfield.id|default:false}>' title='<{$smarty.const._MA_WGTESTMB_TESTFIELDS_LIST}>'><{$smarty.const._MA_WGTESTMB_TESTFIELDS_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='testfields.php?op=show&amp;tf_id=<{$testfield.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGTESTMB_DETAILS}>'><{$smarty.const._MA_WGTESTMB_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:false}>
            <a class='btn btn-primary right' href='testfields.php?op=edit&amp;tf_id=<{$testfield.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='testfields.php?op=clone&amp;tf_id_source=<{$testfield.id|default:false}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='testfields.php?op=delete&amp;tf_id=<{$testfield.id|default:false}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
        <a class='btn btn-warning right' href='testfields.php?op=broken&amp;tf_id=<{$testfield.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGTESTMB_BROKEN}>'><{$smarty.const._MA_WGTESTMB_BROKEN}></a>
    </div>
</div>
<{if $rating|default:false}>
    <{include file='db:wgtestmb_rate.tpl' item=$testfield}>
<{/if}>
