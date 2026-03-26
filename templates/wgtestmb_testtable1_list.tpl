<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$testtable1.name|default:false}></span>
    <span class='col-sm-9 justify'><{$testtable1.date_text|default:false}></span>
    <span class='col-sm-9 justify'><{$testtable1.comments|default:false}></span>
</div>
<div class='panel-foot'>
    <span class='col-sm-12'><a class='btn btn-primary' href='testtable1.php?op=show&amp;tt1_id=<{$testtable1.id|default:false}>' title='<{$smarty.const._MA_WGTESTMB_DETAILS}>'><{$smarty.const._MA_WGTESTMB_DETAILS}></a></span>
</div>
