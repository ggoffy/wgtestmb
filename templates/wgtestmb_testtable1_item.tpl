<i id='tt1Id_<{$testtable1.id|default:false}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$testtable1.name|default:false}></span>
    <span class='col-sm-9 justify'><{$testtable1.date_text|default:false}></span>
    <span class='col-sm-9 justify'><{$testtable1.comments|default:false}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:false}>
            <a class='btn btn-success right' href='testtable1.php?op=list&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>#tt1Id_<{$testtable1.id|default:false}>' title='<{$smarty.const._MA_WGTESTMB_TESTTABLE1_LIST}>'><{$smarty.const._MA_WGTESTMB_TESTTABLE1_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='testtable1.php?op=show&amp;tt1_id=<{$testtable1.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGTESTMB_DETAILS}>'><{$smarty.const._MA_WGTESTMB_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:false}>
            <a class='btn btn-primary right' href='testtable1.php?op=edit&amp;tt1_id=<{$testtable1.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='testtable1.php?op=clone&amp;tt1_id_source=<{$testtable1.id|default:false}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='testtable1.php?op=delete&amp;tt1_id=<{$testtable1.id|default:false}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
