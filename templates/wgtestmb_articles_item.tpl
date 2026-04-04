<i id='artId_<{$article.id|default:false}>'></i>
<div class='panel-heading'>
    <h3 class='panel-title'><{$article.cat|default:''|escape:'html'}></h3>
    <h3 class='panel-title'><{$article.title|default:''|escape:'html'}></h3>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$article.descr_short|default:''|escape:'html'}></span>
    <span class='col-sm-9 justify'><img src="<{$wgtestmb_upload_url|default:''|escape:'htmlattr'}>/images/articles/<{$article.img|default:''|escape:'htmlattr'}>" alt='articles' ></span>
</div>
<div class='panel-footer'>
    <span class='block-pie justify'><{$smarty.const._MA_WGTESTMB_ARTICLE_FILE}>: <{$article.file|default:''|escape:'html'}></span>
    <span class='block-pie justify'><{$smarty.const._MA_WGTESTMB_ARTICLE_CREATED}>: <{$article.created_text|default:''|escape:'html'}></span>
    <span class='block-pie justify'><{$smarty.const._MA_WGTESTMB_ARTICLE_SUBMITTER}>: <{$article.submitter_text|default:''|escape:'html'}></span>
    <div class='col-sm-12 right'>
        <{if $showItem|default:false}>
            <a class='btn btn-success right' href='articles.php?op=list&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>#artId_<{$article.id|default:false}>' title='<{$smarty.const._MA_WGTESTMB_ARTICLES_LIST}>'><{$smarty.const._MA_WGTESTMB_ARTICLES_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='articles.php?op=show&amp;art_id=<{$article.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGTESTMB_DETAILS}>'><{$smarty.const._MA_WGTESTMB_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:false}>
            <a class='btn btn-primary right' href='articles.php?op=edit&amp;art_id=<{$article.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='articles.php?op=clone&amp;art_id_source=<{$article.id|default:false}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='articles.php?op=delete&amp;art_id=<{$article.id|default:false}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
        <a class='btn btn-warning right' href='articles.php?op=broken&amp;art_id=<{$article.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGTESTMB_BROKEN}>'><{$smarty.const._MA_WGTESTMB_BROKEN}></a>
    </div>
</div>
<{if $rating|default:false}>
    <{include file='db:wgtestmb_rate.tpl' item=$article}>
<{/if}>
