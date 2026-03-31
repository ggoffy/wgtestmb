<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title><{$channel_title|escape:'html':'UTF-8'}></title>
    <link><{$channel_link|escape:'html':'UTF-8'}></link>
    <description><{$channel_desc|escape:'html':'UTF-8'}></description>
    <lastBuildDate><{$channel_lastbuild}></lastBuildDate>
    <docs>https://backend.userland.com/rss/</docs>
    <generator><{$channel_generator}></generator>
    <category><{$channel_category}></category>
    <managingEditor><{$channel_editor}></managingEditor>
    <webMaster><{$channel_webmaster}></webMaster>
    <language><{$channel_language}></language>
    <{if $image_url != ""}>
    <image>
      <title><{$channel_title|escape:'html':'UTF-8'}></title>
      <url><{$image_url}></url>
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
      <pubDate><{$item.pubdate}></pubDate>
      <guid><{$item.guid}></guid>
    </item>
    <{/foreach}>
  </channel>
</rss>
