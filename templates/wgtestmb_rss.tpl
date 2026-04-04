<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title><{$channel_title|escape:'html':'UTF-8'}></title>
    <link><{$channel_link|escape:'html':'UTF-8'}></link>
    <description><{$channel_desc|escape:'html':'UTF-8'}></description>
    <lastBuildDate><{$channel_lastbuild|escape:'html':'UTF-8'}></lastBuildDate>
    <docs>https://backend.userland.com/rss/</docs>
    <generator><{$channel_generator|escape:'html':'UTF-8'}></generator>
    <category><{$channel_category|escape:'html':'UTF-8'}></category>
    <managingEditor><{$channel_editor|escape:'html':'UTF-8'}></managingEditor>
    <webMaster><{$channel_webmaster|escape:'html':'UTF-8'}></webMaster>
    <language><{$channel_language|escape:'html':'UTF-8'}></language>
    <{if $image_url != ""}>
    <image>
      <title><{$channel_title|escape:'html':'UTF-8'}></title>
      <url><{$image_url|escape:'html':'UTF-8'}></url>
      <link><{$channel_link|escape:'html':'UTF-8'}></link>
      <width><{$image_width}></width>
      <height><{$image_height}></height>
    </image>
    <{/if}>
    <{foreach item=item from=$items}>
    <item>
      <title><{$item.title|escape:'html':'UTF-8'}></title>
      <link><{$item.link|escape:'html':'UTF-8'}></link>
      <description><{$item.description|escape:'html':'UTF-8'}></description>
      <pubDate><{$item.pubdate|escape:'html':'UTF-8'}></pubDate>
      <guid><{$item.guid|escape:'html':'UTF-8'}></guid>
    </item>
    <{/foreach}>
  </channel>
</rss>
