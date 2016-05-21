<?php
$tmp = array(
    'input' => '',
    'debug' => false,
    'logErrors' => false,
    'escapeTags' => false,
    'cfgAllowTagParams' => '{"a":["title","href"],"img":{"0":"src","alt":"#text","1":"title","align":["right","left","center"],"width":"#int","height":"#int","hspace":"#int","vspace":"#int"}}',
    'cfgAllowTags' => 'p,a,img,i,b,u,em,strong,nobr,li,ol,ul,sup,abbr,pre,acronym,h1,h2,h3,h4,h5,h6,cut,br,code,table,tr,th,td,video,hr',
    'cfgSetAutoBrMode' => true,
    'cfgSetAutoLinkMode' => true,
    'cfgSetAutoReplace' => '[["+/-","(c)","(с)","(r)","(C)","(С)","(R)"],["±","©","©","®","©","©","®"]]',
    'cfgSetAutoPregReplace' =>  '[["\/<video>(http|https):\\\\\/\\\\\/(?:www\\\\.|)youtube\\\\.com\\\\\/watch\\\\?v=([a-zA-Z0-9_\\\\-]+)(&.+)?<\\\\\/video>\/Ui","\/<video>(http|https):\\\\\/\\\\\/(?:www\\\\.|)youtu\\\\.be\\\\\/([a-zA-Z0-9_\\\\-]+)(&.+)?<\\\\\/video>\/Ui"],["<iframe width=\"700\" height=\"394\" src=\"$1:\/\/www.youtube.com\/embed\/$2\" frameborder=\"0\" allowfullscreen><\/iframe>","<iframe width=\"700\" height=\"394\" src=\"$1:\/\/www.youtube.com\/embed\/$2\" frameborder=\"0\" allowfullscreen><\/iframe>"]]',
    'cfgSetTagChilds' =>  '[["ul",["li"],false,true],["ol",["li"],false,true],["table",["tr"],false,true],["tr",["td","th"],false,true]]',
    'cfgSetTagCutWithContent' =>  'script,object,iframe,style',
    'cfgSetTagNoAutoBr' => 'ul,ol,object,table,tr',
    'cfgSetTagParamDefault' => '[["a","rel",null,true]]',
    'cfgSetTagParamsRequired' => '{"img":["src"],"a":["href"]}',
    'cfgSetTagNoTypography' => 'pre,code,video',
    'cfgSetTagPreformatted' => 'pre,code',
    'cfgSetTagBlockType' => '["h4","h5","h6","ol","ul","blockquote","pre","code","video"]',
    'cfgSetTagShort' => 'br,img,hr,cut',
    'cfgSetTagIsEmpty' => '',
    'cfgSetXHTMLMode' => false
);
return $tmp;