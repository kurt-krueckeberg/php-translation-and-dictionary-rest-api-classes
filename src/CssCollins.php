<?php
declare(strict_types=1);
namespace LanguageTools;

class CssCollins {

static private string $css = <<<EOS
*{word-wrap:break-word;margin:0;padding:0;border:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;-ms-box-sizing:border-box;-o-box-sizing:border-box;box-sizing:border-box;font-weight:inherit;font-family:inherit;font-size:inherit}
body{color:#000;background:white;font:16px/1.6em 'Open Sans',serif;line-height:1.6em}[lang="ko"]:not(html),[lang="ko"]:not(html) *,[lang="ja"]:not(html),[lang="ja"]:not(html) *,[lang="hi"]:not(html),[lang="hi"]:not(html) *{font-family:auto}
.small_text{padding-top:.3em;display:block;font-size:.8em;padding-right:2px}.small_text>a{border-bottom:dashed 1px rgba(0,0,0,.6)!important}
h1 {
  font-size:1.3em;line-height:1.4em
}
h2 {
 font-size:1.2em
}
.h1 {
 font-size:38px
}
.h2 {
 font-size:28px
}
.h3 {
 font-family:"Open Sans";font-size:22px
}
ol,ul{list-style-type:none}.selectorOpernerBig:checked ~ label[for="default"]{display:none}
.title_container{position:relative}.title_frequency_container{position:absolute;right:0}.cB{padding:15px;background:#fff;margin-bottom:20px;-webkit-column-break-inside:avoid;page-break-inside:avoid;break-inside:avoid}
.dc .entry_title{font-weight:bold;color:#c12d30;padding:0 15px;line-height:2em;font-size:18px}.dc .entry_title.transex{color:#000}.dc a{color:inherit;text-decoration:none;border-bottom:dashed 1px rgba(0,0,0,.6)}
.dc h1.entry_title{font-size:20px;letter-spacing:.1px}.dc .h2_entry .lbl.type-misc{font-size:18px;text-decoration:none;letter-spacing:normal}.page .cobuild .hom{display:block;padding-left:1.5em;padding-bottom:1em}
h2.h2_entry{font-size:38px;font-weight:bold}.cB h2.h2_sentences{font-size:1.6em;font-weight:bold;margin:1em 0}h2.h2_entry .orth{display:block}.grammar .color{color:#b71533}.grammar .bold{display:inline;font-weight:bold}
.gramGrp>.pos,.gramGrp.pos{text-transform:uppercase;font-weight:bold;color:#c12d30;font-size:16px}.he .grammar .ul{margin-top:5px;list-style-type:none;padding-left:15px}.he .grammar .p{display:block;margin-top:5px;margin-bottom:5px}
.grammar .ul.cll1>.li:before{content:"??? "}.grammar .ul.cll1 .li,.grammar .ul.cll2 .li,.grammar .ol.cll4 .li{margin-left:.8em;text-indent:-5px}.cdet .synonymBlock,.cdet .containerBlock,.cdet .cB-sos .linksTool{margin-left:1.5em}
.cdet .headerThes .entry_title+div a{margin-bottom:1em;display:inline-block;font-style:normal;color:#c12d30}.cdet div.form.titleTypeSubContainer{display:block;font-weight:bold}.cdet .titleTypeSubContainer .titleType{color:#c12d30}
.page .dictionary span.sensenum{margin-left:-1.3em;font-weight:bold;font-size:1.1em;display:inline-block;min-width:1em;margin-right:2px}.headwordSense{color:#c12d30;font-weight:bold;display:inline-block}
.headerSensePos{font-size:.9em;font-style:italic}.page .thesbase span.sensenum:after{content:".";display:inline;margin-left:-.2em}.entry_container{color:inherit;display:block;background:#fff;box-shadow:0 0 3px rgba(0,0,0,0.2);text-decoration:none;margin-bottom:20px;padding:20px}
.pB-g .entry_container>ul>li>a{font-weight:bold}.pB a{text-decoration:none;color:inherit;border:0}.pB-t{font-size:1.5em;font-weight:bold;line-height:1.2em;margin-bottom:10px}.logP{display:none}footer a{text-decoration:none;color:inherit;cursor:pointer}
footer{background-color:#000;color:white;padding:20px}body.quiz_homepage .main-content,body.definition .main-content,body.translator .main-content,body.homepage .main-content{padding:0;margin:0 auto}body.quiz_homepage .padding-pub,body.definition .padding-pub,body.translator .padding-pub,body.homepage .padding-pub{display:block}
body.quiz_homepage header.sticky ~ main{padding-top:144px}.quiz_page{background:#007db3;color:white;width:100%;text-align:center;padding:20px}h1.entry_title.exercise-title.quiz{text-align:center;line-height:2em;margin-bottom:1em}
.quiz_content,.quiz_breadcrumb{width:70%;margin:auto;text-align:left}.quiz_content .title_category{color:black;border:0;text-decoration:none;font-weight:bold;display:flex;align-items:baseline;margin-bottom:.3em}
.quiz_content .desc_category{margin-left:37px;margin-bottom:12px;color:black;font-family:"Open Sans",sans-serif}.quiz_content ul li{margin-left:1em;padding:10px 0;border-bottom:2px dotted black}
.quiz_breadcrumb a{color:black}#L1,#L2,.moreDefL1,.moreDefL2,#L2:checked~.translation_boxes .labelMoreL2,#L1:checked~.translation_boxes .labelMoreL1,#L2~.translation_boxes .labelLessL2,#L1~.translation_boxes .labelLessL1{display:none}
#L1:checked~.translation_boxes .moreDefL1,#L2:checked~.translation_boxes .moreDefL2,#L2:checked~.translation_boxes .labelLessL2,#L1:checked~.translation_boxes .labelLessL1{display:block}.hang .num{display:inline-block;width:25px}
.dD_d_l.special{display:none}.menuBarOpened .majorlinksblock{visibility:hidden;opacity:0}.majorlinksblock{opacity:1}.majorlinksblock.opacity0{opacity:0}.padding-pub .dD_d_l{width:calc(100% - 30px);padding-left:calc(165px - -1em);margin:auto}
body.translator header.sticky ~ main{padding-top:104px}.seoBox_ad{max-width:310px;max-height:250px;overflow:hidden}.seoBox.pB{min-height:0}.seoBox.pB .pB-d,.seoBox.pB .pB-rM{text-align:justify}.seoBox.pB .pB-t{margin-bottom:20px;text-align:center;padding:0 20px;font-size:1.5em}
.seoBox.pB.number-2 .pB-d ul{list-style-type:disc;padding-inline-start:25px;padding-left:25px;text-align:left}.seoBox.pB .pB-c{display:block}.scientificVocabulary{padding-top:1em}.dc .scientificVocabulary>a{border-bottom:0}
.scientificVocabulary>.text{font-variant-caps:small-caps;font-weight:bold;color:#c12d30;font-size:1.2em;text-align:right}.sense_list_item .orth>.pron,.h2_entry+div>.pron,.sentences .translation{display:inline;font-weight:bold}
.sentences .example{margin-top:1em;padding-bottom:.5em;border-bottom:1px solid rgb(0 0 0 / 16%)}.translation_list .translation,.mini_h2 .pron{font-family:arial}
@media screen and (max-width:761px){.cdet .headerThes .entry_title+div{padding-left:15px}
.dc .cB{padding-top:0;padding-left:15px}div.menuDd .w-c{width:100%}body.quiz_homepage .dD_d_l.special,div.major-links-container:not(.special),.dD_d_l:not(.special){display:none}.menuDd[data-name="school"] .dD_d_l:not(.special),.dD_d_l.special{display:flex}
.menuMobile{display:block}.header-top.header-top{flex-direction:row}.header-complete-top.header-complete-top{flex-direction:column}.header-top>label.menuPanelOpenButton,.header-top>label.menuPanelCloseButton{margin-right:.5em}
.major-links-container{padding-left:1em}body:not(.headerMinimized) header.sticky ~ .padding-pub .menuDd.menuDd{top:138px}body:not(.headerMinimized) header.sticky ~ .padding-pub .menuDd.menuDd[data-name="school"]{top:155px}
.padding-pub .dD_d_l{padding-left:.3em}}
@media screen and (min-width:1240px){body.quiz_homepage .search-desktop,body.definition .search-desktop,body.translator .search-desktop,body.homepage .search-desktop{width:700px;margin:0 auto;margin-left:1em}
body.quiz_homepage .main-content,body.definition .main-content,body.translator .main-content,body.homepage .main-content{width:calc(100% - 50px - 50px);max-width:1580px}.padding-pub .dD_d_l{width:calc(100% - 100px);padding-left:calc(165px - -1em);max-width:1580px;margin:auto}
.scientificVocabulary>.text{float:right}} 
body.quiz_homepage header .main-content,body.definition header .main-content,body.translator header .main-content,body.homepage header .main-content{background-position:calc(100% - 34px) calc(10px);background-repeat:no-repeat;background-size:200px;display:block;padding-top:1px}
.context-language-WOTY .header-top>label{align-self:auto}.context-language-SCRABBLE .major-links-container{padding-left:150px}.major-links-container .icon-Carrousel-Bullet-Full{opacity:0;display:inline-block;font-size:5px}
.major-links .icon-Carrousel-Bullet-Full{opacity:1}body.homepage .home_logo_link{display:inline-block}body.homepage .home_logo{width:100%;max-width:165px}body.definition .search-desktop{width:900px}header.sticky{background:#100d08}header.sticky>.main-content>*{align-self:center}.sticky>.main-content{min-height:4.2em}.sticky,.sticky>.main-content{display:flex}
.sticky .searchButtOpenForm{color:white;transform:translateY(0);transition:all .5s;height:32px;width:32px}body:not(.headerMinimized) header.sticky{position:fixed;top:0;left:0;right:0;z-index:9999}.header-complete-top{display:flex;flex-direction:row;flex-wrap:nowrap}.major-links>span{border-bottom:1px solid white}.major-links-container>div.major-links{order:0}.dD_d_l>div:first-child{padding-left:.5em}
.header-complete-top .major-links-container{overflow:hidden;flex-wrap:wrap}.header-complete-top .major-links-container.sub{margin-top:.5em;margin-left:1em}.header-complete-top .major-links-container.sub .major-links[data-name='english']{background-color:#c32c30}
.header-complete-top .major-links-container.sub .major-links{background-color:#717273;border-radius:5px;border-bottom:0;border-bottom-left-radius:0;border-bottom-right-radius:0;margin-right:-1px;z-index:25;margin-bottom:-5px}
.major-links-container.sub .major-links>span{border:0}.dD_d_l>div:first-child:before,.header-complete-top .major-links-container.sub>div.major-links:before{border:0}.dD_d_l>div:before,.header-complete-top .major-links-container.sub>div:before{content:"";border-right:1px solid;position:absolute;height:50%;left:0;top:.5em}
.major-links-container.sub>div.major-links+div:before{border-right:0}.menuDd{text-align:center}.dD_d_l>div,.major-links-container>div{order:2}.major-links-container>div.none{display:none}.major-links-container>div.top{order:1}
.major-links-container>div.bottom{order:3}div.majorBoxMenu>div{box-sizing:border-box;padding:.3em 1.2em}.icon1-5x{font-size:1.5em;vertical-align:text-top}div.majorBoxMenu.sub3.sub3{background-color:#717273}
div.majorBoxMenu{position:absolute;z-index:10000;box-sizing:border-box;display:none;box-shadow:3px 5px 6px -3px rgba(255,255,255,.4);border:1px solid rgba(255,255,255,.4);white-space:nowrap;padding:15px}
div.majorBoxMenu a{color:white;text-decoration:none}#containerMenu a:hover{text-decoration:underline}div.majorBoxMenu.visible{display:block}.dD_d_l{display:flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-start}
.dD_d_l:not(.special){flex-wrap:nowrap;overflow:auto;white-space:nowrap}.dD_d_l>div,.header-complete-top .major-links-container>div{padding:0 1em;position:relative}.dD_d_l>.active>span{border-bottom:1px solid}
.major-links-container,.header-top{display:flex;color:white}.header-top{flex-direction:column}.quiz_homepage .major-links-container,.translator .major-links-container{line-height:2em;height:2em}.major-links-container{line-height:2em;font-size:22px;height:2em}
.subnonevisible>.sublvl3{display:none}.subvisible>.sublvl3{display:block;white-space:nowrap;padding:0 .8em;text-align:left}.subvisible.leftPos>.sublvl3{left:0;right:auto}.sublvl3 .active a{text-decoration:underline}
.sublvl3{position:absolute;background-color:#717273;right:0;box-shadow:3px 5px 6px -3px rgba(0,0,0,.4);z-index:3}.header-top>label{margin:12px 0 8px 0;width:32px;height:32px;cursor:pointer}.header-top .img-reseaux{position:absolute;transform:translateY(-500%)}
.header-top .img-reseaux.school{transform:none}.header-top .img-reseaux.school>.fb,.header-top .img-reseaux.school>.twit{display:none}.header-top .img-reseaux a{text-decoration:none;border:0;color:inherit}
.header-top .img-reseaux .twit,.header-top .img-reseaux .inst{margin-right:9px}.img-reseaux .login{display:inline-flex}.img_user{border-radius:50%;border:1px solid #b1b1b1;width:40px;height:40px;position:relative;overflow:hidden}
img.img_user.school{width:35px;height:35px;margin-top:3px}.logo-reseaux_img.login.desktopOnly>.inst{font-size:35px;margin-right:.3em;position:initial}.login .icon-user{font-size:35px}.login a.logOut-In{display:block;font-size:inherit}
.login .text-login{font-size:20px;font-family:"Zilla Slab";align-self:center;margin-left:10px;white-space:nowrap;line-height:20px;display:inline-block}.login .text-login>div{max-width:240px;overflow:hidden;text-overflow:ellipsis}
.login .text-login a{opacity:.8}.login .text-login a:hover{opacity:1}.logo-reseaux_img.login{padding-top:1em;margin-right:1.5em;margin-left:1.5em}.major-links-container a{color:white;text-decoration:none}
.home_logo_link{height:64px;overflow:hidden;align-self:center}.home_logo_link.school.school{height:64px;padding-top:10px;margin:10px 0}.header-top .home_logo{max-width:165px;width:100%;vertical-align:middle}
.padding-pub{display:none}#searchPanelButton:checked ~ .padding-pub{display:block}main{padding-top:226px}.translator main{padding-top:104px}main.content-main{padding-top:0}.header-top.header-top.header-top .logo-reseaux_img{font-size:27px;width:40px}

@media screen and (max-width:761px){.home_logo_link.school.school{margin:0}.sticky .searchButtOpenForm{position:absolute;right:0}.main-content{position:relative}.desktopOnly,span.desktopOnly.desktopOnly.desktopOnly,a.desktopOnly.desktopOnly.desktopOnly{position:absolute;right:10px}
.translator_inputContainer .desktopOnly{display:none}.header-top.header-top.header-top .logo-reseaux_img{position:relative;top:10px;font-size:25px;width:20px}.logo-reseaux_img.login{padding-top:.5em;margin:0}
a.desktopOnly.icon-instagram.logo-reseaux_img.inst{margin-right:1em}}input#menuPanelInputOpen,
input#searchPanelButton,
input.hide_input,
#menuPanelInputOpen ~ header .main-content .menuPanelCloseButton,
#menuPanelInputOpen:checked ~ header .main-content .menuPanelOpenButton {
display:none;
}
#menuPanelInputOpen:checked ~ header .main-content .menuPanelCloseButton {
display:block;
}
#menuPanelInputOpen:checked ~ header.sticky .major-links-container,
#menuPanelInputOpen:checked ~ header.sticky .main-content > form.search-form.search-desktop,
#menuPanelInputOpen:checked ~ header.sticky .searchButtOpenForm{
transform: translateY(-500%);
}
.menuPanelOpenButton {
color:white;
}
.menuPanel {
width:100%;
background:#100d08;
color:white;
position:absolute;
top:105px;
z-index:9999;
display:flex;
line-height:2;
padding:35px;
transform:translateX(-100%);
box-shadow:0 10px 10px rgba(0, 0, 0, .1);
font-family:"Zilla Slab";
}
body:not(.headerMinimized) header.sticky + .menuPanel {
position:fixed;
}
#menuPanelInputOpen:checked ~ .menuPanel {
transform:translateX(0);
}
#menuPanelInputOpen:checked ~ header .main-content {
background-position:115% 10px;
}
#menuPanelInputOpen:checked ~ header .img-reseaux {
transform:none;
}
.menuPanel a {
text-decoration:none;
border:none;
color:white;
}
.menuPanel_first_container {
flex:2;
}
.menuPanel_firstCol {
width:45%;
margin:auto;
padding-left:20px;
border-left:1px solid white;
}
.first_links {
display:block;
}
.first_links,
.second_links {
opacity:.8;
transition:opacity .2s;
cursor:pointer;
}
.first_links:before,
.second_links:before {
content:"";
display:inline-block;
margin-right:15px;
opacity:0;
transition:opacity .2s;
}
.first_links:before{
background:white;
border-radius:50%;
width:7px;
height:7px;
}
.second_links:before {
width:0px;
height:0px;
border:solid;
border-width: 7px 0 7px 7px;
border-color: transparent transparent transparent white;
}
input[data-css="DICTIONARY"]:checked ~ .menuPanel_first_container label[for="DICTIONARY"],
input[data-css="DICTIONARY"]:checked ~ .menuPanel_first_container label[for="DICTIONARY"]:before
{
opacity:1;
}
input[data-css="GRAMMAR"]:checked ~ .menuPanel_first_container label[for="GRAMMAR"],
input[data-css="GRAMMAR"]:checked ~ .menuPanel_first_container label[for="GRAMMAR"]:before
{
opacity:1;
}
input[data-css="CONJUGATION"]:checked ~ .menuPanel_first_container label[for="CONJUGATION"],
input[data-css="CONJUGATION"]:checked ~ .menuPanel_first_container label[for="CONJUGATION"]:before
{
opacity:1;
}
input[data-css="BLOG"]:checked ~ .menuPanel_first_container label[for="BLOG"],
input[data-css="BLOG"]:checked ~ .menuPanel_first_container label[for="BLOG"]:before
{
opacity:1;
}
input[data-css="SCRABBLE"]:checked ~ .menuPanel_first_container label[for="SCRABBLE"],
input[data-css="SCRABBLE"]:checked ~ .menuPanel_first_container label[for="SCRABBLE"]:before
{
opacity:1;
}
input[data-css="THESAURUS"]:checked ~ .menuPanel_first_container label[for="THESAURUS"],
input[data-css="THESAURUS"]:checked ~ .menuPanel_first_container label[for="THESAURUS"]:before
{
opacity:1;
}
input[data-css="MORE_DICTIONARY"]:checked ~ .menuPanel_first_container label[for="MORE_DICTIONARY"],
input[data-css="MORE_DICTIONARY"]:checked ~ .menuPanel_first_container label[for="MORE_DICTIONARY"]:before
{
opacity:1;
}
input[data-css="MORE_COLLINS"]:checked ~ .menuPanel_first_container label[for="MORE_COLLINS"],
input[data-css="MORE_COLLINS"]:checked ~ .menuPanel_first_container label[for="MORE_COLLINS"]:before
{
opacity:1;
}
.menuPanel_second_container {
flex:3;
}
.menuPanel_secondCol {
display:none;
width:100%;
height:100%;
margin-left:10px;
padding-left:20px;
border-left:2px dotted white;
flex-direction:column;
flex-wrap: wrap;
}
input[data-css="DICTIONARY"]:checked ~ .menuPanel_second_container .DICTIONARY {
display:flex;
}
input[data-css="GRAMMAR"]:checked ~ .menuPanel_second_container .GRAMMAR {
display:flex;
}
input[data-css="CONJUGATION"]:checked ~ .menuPanel_second_container .CONJUGATION {
display:flex;
}
input[data-css="BLOG"]:checked ~ .menuPanel_second_container .BLOG {
display:flex;
}
input[data-css="SCRABBLE"]:checked ~ .menuPanel_second_container .SCRABBLE {
display:flex;
}
input[data-css="THESAURUS"]:checked ~ .menuPanel_second_container .THESAURUS {
display:flex;
}
input[data-css="MORE_DICTIONARY"]:checked ~ .menuPanel_second_container .MORE_DICTIONARY {
display:flex;
}
input[data-css="MORE_COLLINS"]:checked ~ .menuPanel_second_container .MORE_COLLINS {
display:flex;
}
#h-btn{display:none}#ring-links-carousel{white-space:nowrap}label[for="hook-button"],.btn-s-h .icon-eye-plus,.btn-s-h .icon-eye-minus{display:none}a.h.hC{display:inline-block;min-width:250px;max-width:300px;width:300px;margin:0 3px;position:relative;overflow:hidden;border:none!important;height:206px}
a.h:hover img{transform:scale(1.15)}a.h .hook-img{width:100%;transform:scale(1.07);transition:all .2s;height:auto}.hook-label{padding:0 10px 80px;position:absolute;top:0;left:0;display:flex;flex-direction:column;color:white;text-align:center;font-size:1.5em;white-space:normal;width:100%;height:100%;justify-content:space-between}
.hook-label .top_text{font-size:.8em;margin-top:auto}.hook-label .sub_text{font-size:1.3em;font-weight:bold;height:1.3em}.hook-label .sub_text.wordlist{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-size:.9em}
.carousel-arrow{width:65px;height:65px;background:#1c4b8b;cursor:pointer;transition:opacity .1s;border-radius:50%;text-align:center;box-shadow:0 0 20px rgba(50,50,50,.3);opacity:.7;position:absolute}.carousel-arrow i{font-size:2.3em;color:white;line-height:65px}
.cB.cB-hook .cB-h{padding:10px 0 0}.carousel-arrow:hover{opacity:1}.he .grammar .cB-hook h2{text-decoration:none;line-height:1.1em}@keyframes animateOpacity{0%{opacity:1}50%{opacity:.7}100%{opacity:1}
}.rootStyle{overflow:hidden;position:relative}.containerStyle{white-space:nowrap;font-size:0}
@media screen and (max-width:761px){.hooksTransitions .containerStyle{overflow-x:scroll}}.arrowStyle{top:50%;transform:translateY(-50%)}
.itemStyle{display:inline-block;font-size:1rem}button.search-submit{background:white;border:0}.search-desktop{font-size:22px;height:47px;display:flex;background:#fff;margin-left:0}.search-desktop>div:first-child{flex-grow:1;width:0;transition:300ms}
.search-desktop input,.search-desktop button{padding:.3em;vertical-align:middle;line-height:1.5em}.sticky .major-links-container,.search-desktop{position:relative;text-align:left;vertical-align:middle;transform:translateY(0)}
.sticky .major-links-container{overflow:hidden}.sticky .major-links-container{max-width:690px}.search-desktop{width:610px}.search-desktop .search-input-container{overflow:hidden;vertical-align:middle;display:flex;align-items:center;width:-moz-available;width:-webkit-fill-available}
.search-desktop i{line-height:.6em;vertical-align:middle}.search-desktop i.icon-search{font-size:1.5em}.search-desktop .search-input{width:100%;height:47px;outline:0;border:0;margin-left:5px}.search-desktop .search-input::-ms-clear{display:none}
.search-desktop .search-input ~ button.clear-search-input[type="reset"]{height:47px;line-height:47px;border:0;background:url(/external/images/cross_icon.svg?version=4.0.259) no-repeat center;background-size:70%;min-width:25px;padding:0}
.search-desktop .search-input:not(:valid) ~ .clear-search-input{display:none}.autoc-results{display:none;background:#fff;width:100%;width:-moz-available;width:-webkit-fill-available;width:fill;min-width:250px;position:absolute;box-shadow:0 0 40px rgba(0,0,0,0.1);z-index:2147483647;-webkit-transform:translate3d(0,0,20px);-webkit-transform-style:preserve-3d}
.autoc-results:not(:empty){padding:15px}.autoc-results li{display:block;padding:.2em 1em;list-style:none;cursor:pointer}li.autoc-result.coll{font-weight:normal;font-style:italic;color:#4e5358}.autoc-results li:hover,.autoc-results li.current{background:#ddd;color:inherit;text-decoration:none}
form.search-form.search-form.search-form{z-index:9998;margin-top:5px}.school form.search-form.search-form.search-form{margin-top:20px}form>div{position:relative}form .containerSpecialChar{display:none;position:absolute;right:0;background:white;padding:3px;box-shadow:0 0 10px rgba(0,0,0,.2)}
.icon-keyboard.keyboard-specialChar{display:none;height:47px;line-height:47px;cursor:pointer;margin-left:10px}.specialChar{background:white;display:inline-block;min-width:30px;height:30px;text-align:center;line-height:30px;margin-right:5px;box-shadow:0 0 10px rgba(0,0,0,.2);cursor:pointer}
.specialChar:last-child{margin-right:0}.specialChar:hover{background:#c8c8c8}div[data-label]{display:none}.backsite{display:none}.waylf{display:flex;flex-direction:column;justify-content:space-between;background-color:#c12d30;width:100%;height:auto;padding:20px 0}.waylf>div{margin:20px}.waylf .categories{display:flex;justify-content:center}
.waylf .title{display:flex;justify-content:center;color:white;margin:0 40px;text-align:center}.waylf .categories>a{background-color:white;color:#c12d30;text-decoration:none;line-height:50px;height:50px;margin:10px 20px;text-align:center;width:300px}strong,b{font-weight:bold}.onlyMobile,#input-title_panel,#blocHide_input{display:none}body.translator .search-desktop{width:900px}#keyboards span{cursor:pointer;display:inline-block;margin-right:5px}#button_copy{text-decoration:none}
#translate .select_input{justify-content:space-around;margin-bottom:20px}#translate .spinner{display:block;position:absolute;right:7px;bottom:13px}#translate .spinner .trad-button-action{padding:0 8px;display:block;cursor:pointer;font-size:16px;height:34px;line-height:34px}
form.translating .spinner{background-image:url("https://www.collinsdictionary.com/external/images/spinner.gif?version=4.0.259");background-repeat:no-repeat;background-size:auto 100%;background-position:center}
form.translating .spinner .trad-button-action{visibility:hidden}.input_buttons{position:absolute;bottom:13px;left:10px;display:flex}.translation_buttons{position:absolute;right:0;bottom:6px}.translation_buttons a,.input_buttons a{vertical-align:middle;margin:auto 10px auto 0}
.columns-block{margin-bottom:10px}.translator_inputContainer{display:flex;width:100%}.block_translator,.secondBlock>div{flex:1}#translate .inputContainer,#translate .containerOut{height:150px;resize:vertical;overflow:hidden;background:#fff;position:relative;background:rgba(238,238,238,.68);color:black}
#translate .inputContainer .textarea{height:calc(100% - 34px - 12px)}#translate .outputContainer .textarea{height:calc(100% - 34px)}.bottom_right{position:absolute;bottom:13px;right:5px;display:flex;flex-direction:row-reverse}
#translate .translateCounter{color:rgba(0,0,0,.7);font-size:.6em;height:12px;line-height:12px;text-align:center;position:relative;border:1px solid rgb(0,0,0,.1)}.counterBar{position:absolute;width:0;height:100%;background:#98ff98;transition:.3s ease}
#translateCounterText{position:absolute;width:100%;height:100%;color:black;font-weight:bold}#input-text,#output-text{padding:5px;height:100%;overflow:hidden;overflow-y:auto;border:0;outline:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
#input-text{color:rgba(0,0,0,0.75);display:block;width:100%;resize:none}.boxCounter{position:absolute;width:100%;bottom:0}#output-text{padding-bottom:55px}#output-text a{text-decoration:none;color:inherit}
#output-text a:hover{text-decoration:underline}#output-text>div:after{content:"\A";white-space:pre}#translate .containerOut{position:relative;background:#cbddec}.redCounter{color:red;font-weight:bold}
.languageDetected{font-size:.9em;font-style:italic;color:#828282}.definitionRow{display:inline-block;width:100%}.definitionRow a{color:inherit;text-decoration:none;word-break:break-all}.definitionRow .blocDefinition a:hover{color:inherit}
.definitionRow h2{text-align:center;font-size:1.5em;margin:15px 0;font-family:"Zilla Slab"}.definitionRow h2:after,.definitionRow h2:before{content:"";display:inline-block;background:white;width:10px;height:10px;vertical-align:middle;margin:0 10px;border-radius:50%}
.title_panel{height:50px;line-height:50px;text-align:center}.title_panel:after,.title_panel:before{content:"";display:inline-block;width:0;height:0;border-bottom:8px solid white;border-top:0 solid transparent;border-right:8px solid transparent;border-left:8px solid transparent;margin:0 20px}
.definitionRow.slide .title_panel:after,.definitionRow.slide .title_panel:before{border-bottom:0 solid transparent;border-top:8px solid white;border-right:8px solid transparent;border-left:8px solid transparent}
.definitionWord{overflow:hidden;overflow-y:auto;margin:0 auto}.definitionWord li{list-style:none}.definitionWord .blocDefinition{padding:15px 15px;border:1px solid #cbddec;border-radius:10px;margin-bottom:.5em;background:rgba(203,221,236,.2)}
.click_to_dropdown{display:block;padding:20px 0;text-align:center;font-family:"Zilla Slab";font-size:1.5em;cursor:pointer}.click_to_dropdown.less{border-top:3px dotted white}#blocHide_input:checked+.click_to_dropdown.more,.click_to_dropdown.less,.blocHide_dropdown{display:none}
#blocHide_input:checked ~ .blocHide_dropdown,#blocHide_input:checked ~ .click_to_dropdown.less{display:block}span.currentWord{font-size:25px;margin-bottom:.3em;font-family:"Zilla Slab";display:block}
span.currentWord>*{align-self:center;height:100%}span.currentWord .firstSnd{margin-left:5px}span.currentWord .firstSnd a{display:inline-block;height:100%}span.def-bullet{display:inline-block;background:white;width:5px;height:5px;margin-right:5px;vertical-align:middle;border-radius:50%}
.placeholder-output{color:#787878}.keyboardPositioning{display:none;-webkit-user-select:none}.containerKeyboard{margin:0;position:absolute}.keyboardPositioning .icon-keyboard{display:none}.keyboardPositioningLabel .icon-keyboard{cursor:pointer;font-size:1em;vertical-align:middle;color:inherit;background:black;color:white;padding:8px;width:34px;height:34px;border-radius:50%;display:inline-block}
.keyboardPositioning ul{display:inline-block}.keyboardPositioning li{font-size:15px;padding:0;line-height:1;list-style:none;font-weight:bold;border-radius:2px;background-color:rgba(0,0,0,.52);padding:3px 4px 4px 8px;display:none}
.keyboardPositioning li span{border:1px solid rgba(255,255,255,.53);width:27px;text-align:center;border-radius:2px;padding:5px;background-color:#e8e8e8}.inputContainer .icon-times{font-size:1.7em;position:absolute;top:5px;right:22px;cursor:pointer;display:none}
@-webkit-keyframes seeMe{0%{opacity:.4}50%{opacity:1}100%{opacity:.4}}@keyframes seeMe{0%{opacity:.4}50%{opacity:1}100%{opacity:.4}}.definitionWord .hwd_sound,.definitionWord .void{margin-left:5px;margin-right:5px}
.translation_wrapper #button_copy{font-size:1em;color:white;background:black;padding:8px;border-radius:50%;width:34px;display:inline-block;height:34px}.microphone{font-size:34px;cursor:pointer;display:block;position:relative;width:34px;height:34px}
.speech{font-size:1.5em;animation:seeMe 2s infinite}.speech.icon-volume-up{background:black;color:white;padding:5px;border-radius:50%;width:34px;height:34px;display:inline-block}.speedRateButton{font-weight:bold;text-decoration:underline;color:inherit;cursor:pointer}
.speedRateBoxOutput,.speedRateBoxInput{position:absolute;border:1px solid rgba(0,0,0,0.2);background-color:rgba(0,0,0,0.68);border-radius:3px;color:#f3f3f3;font-weight:bold}.speedRateBoxOutput li,.speedRateBoxInput li{padding:0 2.5em 0 .5em}
.speedRateBoxOutput li[data-selected=true],.speedRateBoxOutput li[data-selected=true]:hover,.speedRateBoxInput li[data-selected=true],.speedRateBoxInput li[data-selected=true]:hover{color:#4787ee}.speedRateBoxOutput li:hover,.speedRateBoxInput li:hover{background-color:rgba(243,243,243,0.6);color:black;cursor:pointer}
.link-sponsors{clear:both;width:80%;margin:0 auto;padding:30px 0}.link-android,.link-apple,.link-poweredBy{background-size:contain;background-repeat:no-repeat;display:inline-block;margin:5px 10px;padding-left:30px}
.link-poweredBy{padding-left:0;padding-right:110px;text-decoration:none;background-position:right center;background-size:100px}body.translator #ad_topslot{margin:0 auto}body.translator #ad_mpuslot_a{margin-bottom:20px}
.speech-layout{display:none;position:fixed;top:0;bottom:0;right:0;left:0;background:rgba(0,0,0,.6);z-index:999}.speech-modal{display:none;position:fixed;text-align:center;padding:10px;border-radius:10px;top:50%;right:50%;transform:translate(50%,-50%);background:white;z-index:1000}
h1.h1Translator{color:#005cad;font-weight:bold;margin-bottom:.2em}.textTranslator{font-size:.9em;margin-bottom:.7em}.counterBox{position:absolute;width:100%;bottom:0}.blockBottomOut{margin:.5em 0;margin-bottom:2em}
.blocDefinition.page{border:1px solid black;border-radius:3px;padding:.4em .8em;margin-top:.4em;margin-bottom:.7em;margin-right:.2em;margin-left:.2em}.goTo{font-size:.8em;padding:0 15px}.blockpos .tr,.exaCnt .tr{font-weight:bold}
.blockpos>.pos{font-style:italic}.blockpos,.exaCnt{margin-bottom:.5em}.currentdef .translatorTitle{display:inline-block;line-height:2em;margin-right:7px;font-weight:bold;color:#005cad;font-size:larger}
.currentdef .hwd_sound{margin-bottom:0;display:inline-block;border-bottom:0;vertical-align:sub}.exaCnt .credits{display:block;white-space:nowrap;width:300px;text-overflow:ellipsis;overflow:hidden;font-size:smaller}
.translator .exaCnt .credits{width:170px}.exaCnt .title{display:inline;font-style:italic;font-variant:small-caps}.exaCnt .year{font-style:italic}a.thes{font-weight:bold}span.syn{display:inline-block}span.syn+span.syn:before{display:inline;content:", "}
span.pos+span.syn,span.pos+span.xr{margin-left:8px}.ex-info i{color:red;font-size:19px;vertical-align:text-top;border-bottom:0}.ex-info{font-style:italic;font-size:.8em;margin-top:.5em}.gotolink{color:#005cad;font-weight:bold;text-align:right}
label.labelLessL2,label.labelLessL1,label.labelMoreL2,label.labelMoreL1{text-align:center;font-weight:bold;font-size:large;color:#c12d30;border:1px solid;margin-top:.4em;margin-bottom:.7em;margin-right:.2em;margin-left:.2em;border-radius:3px;cursor:pointer}
.currentdef>div div.blockpos:nth-last-child(2)>*:last-child:after,.currentdef>div>div>div.exaCnt:nth-last-child(1)>*:last-child:after{display:inline;content:" [...]";font-weight:bold}.carousel.jsActive{position:relative}.carousel.jsActive>*{position:absolute;display:flex}.carousel{overflow:hidden;min-height:400px;margin-bottom:10px}.carousel>*{position:inherit;width:100%;left:100%;height:100%;min-width:300px;display:flex}
.carousel:not(.alone)>*{padding-bottom:50px}.carousel>*>*{flex:1;min-width:0;width:25%;margin:0 .65em;max-width:100%}.carousel>*>.pB:first-child,.carousel[data-multi="4"]>*>.pB:nth-child(5n),.carousel[data-multi="3"]>*>.pB:nth-child(4n),.carousel[data-multi="2"]>*>.pB:nth-child(3n){margin-left:0}
.carousel>*>.pB:last-child,.carousel[data-multi="4"]>*>.pB:nth-child(4n),.carousel[data-multi="3"]>*>.pB:nth-child(3n),.carousel[data-multi="2"]>*>.pB:nth-child(2n){margin-right:0}
.carousel:not([data-multi])>*>.pB{margin:0}.carousel:not([data-multi])>*>*{width:auto}.container_seoBox{display:flex;margin-bottom:1em}.container_seoBox>.carousel{flex:1;min-height:250px}.container_seoBox>.carousel>*{min-width:0}
.bulletBox.bulletBox{bottom:0;left:0;height:50px;display:block;text-align:center}.bullet.bullet{border:2px solid black;display:inline-block;border-radius:50%;width:13px;min-width:0;height:13px;margin:18.5px 3px;cursor:pointer}
.bullet.selected{background:black;cursor:auto}div.rightArrow .path1:before,div.leftArrow .path1:before{color:rgba(0,0,0,0.4);transition:color .3s}div.rightArrow:hover .path1:before,div.leftArrow:hover .path1:before{color:#000}
.leftArrow,.rightArrow{width:auto;left:0;min-width:auto;min-height:auto;height:auto;padding:0;top:1em;cursor:pointer}.rightArrow{left:auto;right:0}.leftArrow>*,.rightArrow>*{font-size:2.5em;position:absolute;left:0;top:0;margin:0}
.leftArrow>.path2{margin-left:1em}.rightArrow>.path1{margin-left:-1em}.h2.carousel-title{line-height:1;margin-bottom:20px}
@media screen and (max-width:599px){.carousel>*>*{margin:0}}
@media screen and (max-width:420px){.carousel-title{font-size:25px}
}.selectorOpernerBig{display:none}.cB.register_social>h2{line-height:inherit}.cB .benefits h2{line-height:inherit}.menuDd{background:#717273;color:#fff;text-align:center}.padding-pub .menuDd[data-name='english']{background:#c32c30}body:not(.headerMinimized) header.sticky ~ .padding-pub .menuDd{position:fixed;top:152px;right:0;left:0;z-index:9998;overflow:auto;white-space:nowrap}
body:not(.headerMinimized) header.sticky ~ .padding-pub .menuDd[data-name='school']{top:85px}body header.sticky ~ main{padding-top:192px}body.quiz_homepage header.sticky ~ .padding-pub .menuDd{top:104px}
.menuDd .w-c{width:700px;display:inline-block}.menuDd .w-c.IE{margin-bottom:-6px}.menuDd .m_l{display:inline-block;color:inherit;padding:.5em 0;text-decoration:none}.menuDd .dD_d_l .dD_h_l{display:flex;flex:auto}
.menuDd .dD_d_l .dD_h_l .language-switch,.menuDd .dD_d_l .h_l.more{cursor:pointer}.menuDd .dD_d_l .h_l{flex:auto}.menuDd .dD_d_l .h_l.more i{opacity:0}.menuDd .dD_m_l{display:none;padding-top:20px;padding-bottom:20px;z-index:9997;position:absolute;background:#717273;width:100%;left:0;box-shadow:0 3px 10px rgba(1,1,1,.1)}
.menuDd .dD_m_l .m_l_row{border-top:#fff solid 1px;width:700px;margin:0 auto;display:flex}.menuDd .dD_m_l .m_l_row:last-child{border-bottom:#fff solid 1px}.menuDd .dD_m_l .m_l_row .m_l{width:50%}#moreLinkDropdown{display:none}
#moreLinkDropdown:checked ~ .dD_m_l{display:block}#moreLinkDropdown:checked ~ .dD_d_l .h_l.more i{opacity:1}.pB.pB-quiz{background:#007db3;color:white;height:100%}.pB-quiz .pB-c{padding:10px;height:100%}.pB-quiz .pB-t{margin-top:10px;text-align:center;margin-bottom:0;font-size:26px;font-weight:400}.pB-quiz .pB-d{position:relative}
.pB-quiz .pB-t .exercise-title{font-family:"Zilla Slab";text-transform:capitalize}.pB-quiz .pB-t .exercise-title p{margin-bottom:15px;display:none}.pB-quiz .pB-t .exercise-title.inExercise p.exercise,.pB-quiz .pB-t .exercise-title.inReview p.review{display:block}
.pB-quiz .pB-d .exercise-title span:not(.or),.pB-quiz .pB-d .exercise-mc .exercise-choices a .wordboost,.pB-quiz .pB-t .progression p{font-weight:bold}.pB-quiz .pB-t .progression>*{margin:0;display:inline-block;font-size:16px}
.pB-quiz .pB-t .progression .results{font-size:1em}.pB-quiz .pB-d .exercise-header{text-align:center;margin-bottom:10px}.pB-quiz .pB-d .exercise-title{margin:0;padding:0;font-size:23px}.pB-quiz .pB-d .exercise-title p{margin:0}
.pB-quiz .pB-d .exercise-rubric{margin:15px 0;font-size:1.3em}.pB-quiz .pB-d .exercise-question{margin-bottom:10px;vertical-align:top;white-space:normal;width:100%}.pB-quiz .pB-d .exercise-question>*{margin:0 auto;max-width:930px}
.pB-quiz .pB-d .exercise-question.inReview{margin-top:35px;padding-bottom:35px;border-bottom:2px dotted rgba(255,255,255,.8)}.pB-quiz .pB-d .exercise-question.inReview:last-child{border:0}.pB-quiz .finalResult .finalText{white-space:normal}
.pB-quiz .pB-d .exercise-mc .exercise-choices{width:100%}.pB-quiz .pB-d .exercise-mc .exercise-choices a{background:white;color:#007db3;padding:10px;margin-bottom:10px;width:100%;display:block}.pB-quiz .pB-d .exercise-gapfill-drag-bag{margin-bottom:10px}
.exercise-gap-item,.exercise-gap-drag{display:inline-block;vertical-align:middle}.exercise-gap-item{background:white;color:#007db3;padding:5px 8px;cursor:pointer;margin-right:4px}.exercise-gap-drag{background:rgba(255,255,255,.7);padding:0;width:10em;border:2px dotted rgba(255,255,255,1);height:44px}
.exercise-gapfill-drag>span{vertical-align:middle}.pB-rM button{background:white;color:#007db3;text-decoration:none;text-transform:uppercase;font-weight:normal;margin-left:10px}.pB-rM button.exercise-replay,.pB-rM button.exercise-show,.pB-rM button.exercise-correct,.pB-rM button.exercise-check{display:none}
.pB-rM button.exercise-replay.inline,.pB-rM button.exercise-show.inline{display:inline-block}.pB-quiz .pB-d .exercise-mc .exercise-choices .exercise-choice.error,.exercise-gap-item.error{background:#c12d30;color:white}
.pB-quiz .pB-d .exercise-mc .exercise-choices .exercise-choice.correct,.exercise-gap-item.correct{background:#108605;color:white}.container{overflow:hidden;white-space:nowrap}.container>*{display:inline-block}
.finalResult{text-align:center;width:100%}.pB-quiz.quiz-review{overflow-y:auto}.pB-quiz.quiz-review .quizBlock{height:auto}.pB-quiz.quiz-review .container{overflow:visible}[class*="res_cell"]{float:left;display:block;width:100%}.res_cell_left{width:160px;text-align:right;min-height:1px}.res_cell_center{width:calc(100% - 300px)}
@media screen and (max-width:948px){body.translator .res_cell_center{width:calc(100%)}
}.res_cell_center_content{padding:0 10px}.res_cell_right{width:300px}.res_cell_2_3{width:66%}.res_cell_2_3_content{padding:0 20px 0 0}.res_cell_1_3{width:34%}main,.main-content{margin:0 auto;width:980px}
.clear:before,.clear:after{content:" ";display:block;height:0;overflow:hidden}.clear:after{clear:both}
@media screen and (min-width:932px){main{min-height:628px}}main>div#main_content{width:calc(100% - 300px);float:left}
.mpuslot_b-container{min-width:320px;text-align:center;padding:0}.navigation{position:relative;z-index:9996;width:100%;background-color:#fff}.navigation:before{content:"\a0";position:absolute;width:100%;height:100%;top:0;background-color:inherit}
.navigation a.tab,.navigation span.tab>a,.he .grammar a.previous,.he .grammar a.next{font-size:.9em;display:inline-block;line-height:26px;padding:4px 8px;background-color:#c6cfdb;margin:6px 2px 10px 2px;border:0;border-radius:2px}
a.page.next,a.page.prev{min-width:24px}.navigation .expo{position:relative;top:-4px;font-size:.8em;margin-left:2px}.navigation[data-position="fixed"]{position:fixed}.navigation a.nav:hover{background-color:#b71533;color:white}
.navigation .tab .ref:active,.navigation a.tab.current,.navigation span.tab.current>a,.he .grammar a.previous,.he .grammar a.next{background-color:#b71533;color:white;position:relative}.navigation .tabsNavigation{overflow:hidden;white-space:nowrap;position:relative;word-wrap:normal}
.navigation .tabsNavigation i{font-size:.85em}.navigation .tab.current::before{content:'';display:inline-block;position:absolute;left:50%;left:1.2em;bottom:-5px;width:0;height:0;border-style:solid;border-width:0 5px 5px 5px;border-color:transparent transparent #b71533 transparent;transform:rotate(180deg);-webkit-transform:rotate(180deg);-moz-transform:rotate(180deg);-ms-transform:rotate(180deg)}
.navigation a.nav{background:#cdd4de;position:absolute;top:0;font-size:20px;overflow:hidden;display:inline-block;color:#4d4e51;margin-left:0;margin-right:0;padding-left:15px;padding-right:15px}.navigation .left{left:0}
.navigation .right{right:0}.navigation .tab a{border-bottom:0}.cdet .tab span+span{display:inline-block;padding-left:.3em}.cdet .tab a{display:inline-block}a.share-button.share-button,a.pron-sound-button.pron-sound-button{text-decoration:none;border:0;font-size:2.4em;clear:both;width:38px;height:38px;position:relative}a.pron-sound-button.pron-sound-button{color:white;background-color:black;text-align:center;border-radius:50%;padding-left:5px}
a.share-button.share-button span{position:absolute;left:0;width:38px;height:38px;top:0}a.share-button.share-button span:before{width:38px;height:38px;display:inline-block;margin-left:0}.share-overlay,.popup-overlay,.pron-sound-overlay{position:fixed;top:0;bottom:0;left:0;right:0;background:rgba(0,0,0,0.7);transition:opacity 500ms;visibility:hidden;opacity:0;z-index:99999}
.popup-overlay-on,.share-overlay-on,.pron-sound-overlay-on{visibility:visible;opacity:1}.pron-sound-overlay{text-align:center}.popup-popup,.share-popup,.pron-sound-popup{margin:200px auto;padding:20px;background:#fff;border-radius:5px;position:relative;width:160px}
.pron-sound-popup{width:auto;display:inline-block}#popup-frequency>.popup-popup{width:210px;white-space:nowrap}.popup-popup{width:50%}.popup-popup .popup-close-frequency,.popup-popup .popup-close,.share-popup .share-close,.pron-sound-close{position:absolute;top:10px;right:10px;font-size:2.5em;line-height:.5em;text-decoration:none;color:black;border:none!important}
.pron-sound-popup .pron-sound-content,.share-popup .share-content,.popup-popup .popup-content{max-height:30%;overflow:auto}.share-popup .socialButtons{display:block;float:none;position:initial;margin:0;text-align:center}
.share-popup .socialButtons>a{display:inline-block;margin:10px}.popup-popup .popup-title,.share-popup .share-title,.pron-sound-popup .pron-sound-title{font-size:1.2em;font-weight:bold}.pron-sound-popup .pron-sound-title{margin-bottom:1em;padding-right:1.5em;text-align:left}

@media screen and (max-width:761px){.popup-popup{width:90%;margin:200px auto}}.pB-g .entry_container ul,.pB-g{overflow:hidden}.pB-g .entry_container{box-shadow:none;background-color:white;overflow-y:auto;max-height:400px}.pB.tocB[data-dictcode="grammar-usage"]{max-height:800px;overflow:auto}
.pB.tocB .entry_container{padding:20px 0}.pB.tocB .entry_container ul{line-height:155%}.pB.tocB .pB-t{padding:0 20px}.pB.tocB a{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;padding:0 20px}
.pB.tocB a.current{background:#b71533;color:white}.pB.tocB .tB{font-weight:bold;font-size:1.8em;width:20px;text-align:center;float:left;padding:0;color:inherit}.homepage .pB.tocB li.current>ul,.pB.tocB ul ul{display:none}
.pB.tocB ul ul a{padding:0 20px 0 40px}.pB.tocB ul ul ul a{padding:0 20px 0 60px}.homepage .pB.tocB ul ul,.pB.tocB li.current>ul{display:block}.homepage .pB.tocB li.current>a>.tB:before,.pB.tocB li>a>.tB:before{content:"+";color:#b71533}
.homepage .pB.tocB li>a>.tB:before,.pB.tocB li.current>a>.tB:before{content:"???"}.pB.tocB a.current>.tB:before{color:white}.homepage .pB.tocB .entry_container>ul{overflow:hidden;overflow-y:auto;max-height:calc(380px - 1.2em - 10px)}
.homepage .pB-g .entry_container{max-height:none}#miniTranslate .submit button,#miniTranslate .submit input,.trad-button-action{background:black;color:white;text-transform:uppercase}.select_input{border-top:1px solid black;border-bottom:1px solid black;display:flex;align-items:center}
.select_input a{display:flex;justify-content:center;font-size:1.5em;vertical-align:middle;border:0;background:0;width:20%;color:black}.textarea textarea,.select_input select{background:0;border:0;text-decoration:none}
.grecaptcha-badge{visibility:hidden}.recaptcha-text{font-size:.8em;font-family:"Open sans",sans-serif;line-height:1.5;margin-top:1em;margin-bottom:1em}.recaptcha-text>div:first-child{margin-bottom:5px}
.inputContainer a,.outputContainer a{border-bottom:0}#translate{padding:0 1em}.video-wrapper{position:relative;overflow:hidden;cursor:pointer;max-width:640px;height:360px}iframe.youtube-video{height:320px}iframe.youtube-video,.youtube-video img{width:100%}.youtube-video .play-button{width:90px;height:60px;background-color:#333;box-shadow:0 0 30px rgba(0,0,0,.6);opacity:.8;border-radius:15px;transition:background-color .15s}
.youtube-video:hover .play-button{background-color:#f00}.youtube-video .play-button:before{content:"";border-style:solid;border-width:15px 0 15px 26px;border-color:transparent transparent transparent #fff}
.youtube-video img,.youtube-video .play-button{cursor:pointer}.video-wrapper img,.youtube-video .play-button,.youtube-video .play-button:before{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)} 

@media screen and (max-width:320px){
.amp-container.mpuslot{margin:15px 0 15px -26px}.thesbase .amp-container.mpuslot{margin:15px 0}.cB-e .amp-container.mpuslot{margin:15px 0 15px -4px}.mpuslot_b-container,.parallax-container.mpuslot_b-container,.cB.biling .mpuslot_b-container,.cB-e .mpuslot_b-container,.cB .thesbase .sense .mpuslot_b-container{margin:0 0 0 -15px}
.cB .cobuild .hom .sense .mpuslot_b-container{margin:0 0 0 -63px}.cB .american .sense .mpuslot_b-container,.cB .biling .sense .mpuslot_b-container,.cB .ced .sense .mpuslot_b-container,.cB .cobuild .sense.inline .mpuslot_b-container{margin:0 0 0 -39px}}

@media screen and (min-width:321px) and (max-width:761px){
.mpuslot_b-container{margin:0 0 0 -24px}.cdet .mpuslot_b-container{margin:0}.cB-e .mpuslot_b-container{margin:0 0 0 -14px}}

@media screen and (max-width:761px){
header{padding:10px 1em}header .main-content .header-top .img-reseaux{position:absolute}header .header-top .home_logo{max-width:150px;margin:6px 0}header .home_logo_link.woty .home_logo{max-width:78px}
body.definition .search-desktop{width:100%}.logo-reseaux_img>.text-login{display:none}body.homepage header .main-content{padding:0;background-position:100% 10px;background-size:40px 40px}.container_seoBox{display:inline;max-height:none}body #searchPanelButton ~ main{padding-top:180px}body.quiz_homepage #searchPanelButton ~ main{padding-top:137px}main>div#main_content{width:100%}[class*="res_cell"]{clear:both;width:100%;margin:0 0 10px 0}
.res_cell_center_content,.res_cell_2_3_content{padding:0}.res_hos{display:none}.dc .cobuild-logo.res_hos{display:none}main,.main-content{width:100%}.page .type-ant.columns3,.page .cB-sos .columns3{-webkit-column-count:1;-moz-column-count:1;column-count:1}
.dc .entry_title{padding-left:15px}body.translator .topslot_container,.topslot_container{height:0}.translator #stickyslot_container{display:inline-block}.mpuslot_b{width:320px;margin:0 auto}body.abt01v3 .mpuslot_b-container,body.abt01v4 .mpuslot_b-container{margin-left:-10px}
.columns .columns_item{display:block;width:auto;padding-right:0;min-height:0}.page .Corpus_Examples_EN .content,.wotd-txt-block{padding:10px}.carousel-arrow{width:35px;height:35px}.carousel-arrow i{line-height:35px;font-size:1.2em}#h-btn:checked+.cB.cB-hook>label{animation:none;border-radius:0 0 0 100px;transform:translateY(0px)}#h-btn:checked+.cB.cB-hook{transform:translateY(0px);box-shadow:0 -4px 20px rgba(150,150,150,.2)}
.cB.cB-hook>.cB-h{background:0;margin-bottom:0}.cB.cB-hook .cB-h h2{font-size:18px;padding-left:5px}.cB.cB-hook .cB-h .h2{font-size:1.1em;line-height:1.5em;margin-bottom:0}a.h.hC{min-width:150px;width:150px;vertical-align:top;height:90px}
.hook-label{font-size:.9em;padding:0 4px 31px 4px}.search-input{line-height:1.7em}#searchPanelButton:checked+.sticky .main-content{flex-direction:column}#searchPanelButton:checked+.sticky .main-content>*{align-self:auto}.sticky .major-links-container{display:none}
body.definition form.search-form.search-desktop,body.homepage form.search-form.search-desktop{flex:1;width:100%;margin:3px 0}body.definition.opensearch form.search-form.search-desktop,body.homepage.opensearch form.search-form.search-desktop{margin:0;position:fixed;left:0;top:0;height:100%}
.opensearch .search-desktop .search-input-container{border-bottom:1px solid #e0e0e0}.opensearch .autoc-results{box-shadow:none;border-top:1px solid #e0e0e0}.opensearch .search-desktop .search-input ~ button.clear-search-input[type="reset"]{margin-right:.8em}
.opensearch .backsite{border:0;margin:0 .8em;transform:scaleX(-1);background:transparent;display:inline-block;width:30px}.navigation .tabsNavigation{overflow-x:auto}.waylf .categories{flex-direction:column}.waylf .categories>a{width:auto}.waylf .categories div{width:auto;min-width:180px}.waylf .tittle{width:auto;min-width:180px}.onlyMobile.onlyMobile,.blocHide_dropdown{display:block}.definitionWord>h2,.click_to_dropdown{display:none}.translator_inputContainer{flex-direction:column}.select_input label{max-width:40%}.select_input select{width:100%}
form#translate{margin:0}form#translate .inputContainer{height:35vh}form#translate .spinner .trad-button-action{margin:10px 0}div.definitionRow.openWbW{height:100%;z-index:9999}div.link-sponsors{width:95%}
.recaptcha-text>div:first-child{margin-bottom:10px}body.translator .search-desktop{width:100%}body.translator #searchPanelButton ~ main{padding-top:136px} .menuPanel{height:calc(100% - 64px);position:fixed;padding:10px}body.context-language-SCRABBLE .menuPanel{top:95px}header+nav.menuPanel{top:70px}.menuPanel_first_container,.menuPanel_second_container{flex:1}
.menuPanel_second_container{display:none}input[name="choices"]:checked ~ .menuPanel_second_container{display:block}.menuPanel_firstCol,.menuPanel_secondCol{width:auto;margin:0;padding:0}
.menuPanel_secondCol{padding-left:20px;flex-wrap:nowrap;overflow-y:auto;overscroll-behavior:contain;-ms-scroll-chaining:none}.menuPanel_firstCol{height:100%;padding-left:15px;padding-right:10px;border:0;overflow-y:auto;overscroll-behavior:contain;-ms-scroll-chaining:none}
.first_links:before{margin-right:5px;position:absolute;left:-15px;top:9px}.first_links.img-reseaux{opacity:1}.first_links.img-reseaux:before{opacity:0}.second_links:before{display:none}.first_links,.second_links{line-height:1.5;margin-bottom:30px;position:relative}
.img-reseaux .logo-reseaux_img{vertical-align:middle;display:inline-block;margin-right:10px;width:29px;height:29px;font-size:29px}.img-reseaux .logo-reseaux_img.login{margin-right:0}header .searchButtOpenForm{transform:translateX(0);transition:transform .2s}
#menuPanelInputOpen:checked ~ header .searchButtOpenForm{transform:translateX(200%)}}

@media screen and (min-width:762px){
header .header-top .home_logo_link{width:165px;display:block;height:52px}header .header-top .home_logo_link.scrabble{width:250px;height:65px}.header-top .img-reseaux{min-height:25px;display:flex;padding-bottom:8px}
.header-top .img-reseaux .fb{margin-right:9px}.header-top .img-reseaux>a,.header-top .img-reseaux>a *{display:block}.header-top .img-reseaux>a *{display:inline-block;position:absolute;top:0}.header-top .img-reseaux>.login{position:absolute;top:0;right:-45px}header .header-top .home_logo_link.woty{width:160px;height:107px}body.homepage .scrabble .home_logo{max-width:250px;height:auto} .first_links:hover:before,.first_links:hover,.second_links:hover,.second_links:hover:before{opacity:1}header.sticky+.menuPanel{top:67px}}

@media screen and (min-width:762px) and (max-width:948px){
.sticky div.major-links-container{padding-left:.1em}.sticky .major-links-container a{font-size:.7em}.sticky .major-links .icon-Carrousel-Bullet-Full,.sticky .major-links-container .icon-Carrousel-Bullet-Full{margin:0 3px}
body.definition .search-desktop{width:480px;margin:0 auto;margin-left:1em}.topslot_container{height:90px;margin:10px auto;display:flex;align-items:center;overflow:hidden}main>div#main_content{width:100%}.res_hot{display:none}.res_cell_center_content{padding-left:0}main,.main-content{width:calc(100% - 15px - 15px)}
.columns .columns_item{width:100%}body.homepage header .main-content{background-position:calc(100% - 5px) calc(5px);background-size:25%}#searchPanelButton:checked+.sticky .main-content>form.search-form.search-desktop,.search-desktop{overflow:initial;width:510px}}

@media screen and (min-width:762px) and (max-width:1239px){
.menuPanel_firstCol{width:50%}.menuPanel_second_container{flex:2}}

@media screen and (min-width:949px) and (max-width:1239px){
.sticky .major-links-container a{font-size:.9em}.sticky .major-links-container .icon-Carrousel-Bullet-Full{margin:0 5px}.topslot_container{height:90px;margin:10px auto;display:flex;align-items:center;overflow:hidden}.res_hod{display:none}main>div#main_content{width:calc(100% - 160px)}body.translator #main_content{min-height:650px}
.res_cell_left,#ad_leftslot_a{width:160px;overflow:hidden}main,.main-content{width:calc(100% - 15px - 15px)}.columns .columns_item{width:100%}body.homepage body.context-CHINESE header>div{background-size:280px}}

@media screen and (min-width:1240px){
.sticky .major-links-container{overflow:hidden;width:auto;margin-left:0;max-width:none}.topslot_container{height:90px;margin:10px auto;display:flex;align-items:center;overflow:hidden}.res_hoh{display:none}main>div#main_content{width:calc(100% - 300px)}.res_cell_left,#ad_leftslot_a{width:300px}
main,.main-content{width:calc(100% - 30px - 30px);max-width:1480px}.columns2{-webkit-column-count:2;-moz-column-count:2;column-count:2}.columns2>*{-webkit-column-break-inside:avoid;page-break-inside:avoid;break-inside:avoid;display:table}body.homepage.context-CHINESE header>div{background-size:280px}#searchPanelButton:checked+.sticky .main-content>form.search-form.search-desktop,.search-desktop{overflow:visible;width:850px;margin-left:2em}}

@media screen and (min-width:1596px){
.columns .columns_item{width:33%}}
@font-face{font-family:'icomoon';src:url('/external/fonts/icomoon.eot?1pqdoj&version=4.0.259');src:url('/external/fonts/icomoon.eot?1pqdoj#iefix&version=4.0.259') format('embedded-opentype'),url('/external/fonts/icomoon.ttf?1pqdoj&version=4.0.259') format('truetype'),url('/external/fonts/icomoon.woff?1pqdoj&version=4.0.259') format('woff'),url('/external/fonts/icomoon.svg?1pqdoj#icomoon&version=4.0.259') format('svg');font-weight:normal;font-style:normal;font-display:swap}
[class^="icon-"],[class*=" icon-"]{font-family:'icomoon';speak:none;font-style:normal;font-weight:normal;font-variant:normal;text-transform:none;line-height:1;display:inline-block;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
.icon-instagram:before{content:"\e958"}.icon-Footer-Facebook .path1:before{content:"\e924";color:#fff}.icon-Footer-Facebook .path2:before{content:"\e925";margin-left:-1em;color:#000}
.icon-Footer-Twitter .path1:before{content:"\e926";color:#fff}.icon-Footer-Twitter .path2:before{content:"\e938";margin-left:-1em;color:#000}.icon-Next .path1:before{content:"\e939";color:#000}
.icon-Next .path2:before{content:"\e93a";margin-left:-1em;color:#fff}.icon-Prev .path1:before{content:"\e93b";color:#000}.icon-Prev .path2:before{content:"\e93c";margin-left:-1em;color:#fff}
.icon-Share .path1:before{content:"\e93d";color:#000}.icon-Share .path2:before{content:"\e93e";margin-left:-1em;color:#fff}.icon-Share .path3:before{content:"\e93f";margin-left:-1em;color:#fff}
.icon-Share .path4:before{content:"\e940";margin-left:-1em;color:#fff}.icon-Share .path5:before{content:"\e941";margin-left:-1em;color:#fff}.icon-Share .path6:before{content:"\e942";margin-left:-1em;color:#fff}
.icon-Star-Empty:before{content:"\e943"}.icon-Star-Full:before{content:"\e944"}.icon-Translator-Keyboard .path1:before{content:"\e945";color:#000}
.icon-Translator-Keyboard .path2:before{content:"\e946";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path3:before{content:"\e947";margin-left:-1em;color:#fff}
.icon-Translator-Keyboard .path4:before{content:"\e948";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path5:before{content:"\e949";margin-left:-1em;color:#fff}
.icon-Translator-Keyboard .path6:before{content:"\e94a";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path7:before{content:"\e94b";margin-left:-1em;color:#fff}
.icon-Translator-Keyboard .path8:before{content:"\e94c";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path9:before{content:"\e94d";margin-left:-1em;color:#fff}
.icon-Translator-Keyboard .path10:before{content:"\e94e";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path11:before{content:"\e94f";margin-left:-1em;color:#fff}
.icon-Translator-Keyboard .path12:before{content:"\e950";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path13:before{content:"\e951";margin-left:-1em;color:#fff}
.icon-Translator-Keyboard .path14:before{content:"\e952";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path15:before{content:"\e953";margin-left:-1em;color:#fff}
.icon-Translator-Keyboard .path16:before{content:"\e954";margin-left:-1em;color:#fff}.icon-Translator-Keyboard .path17:before{content:"\e956";margin-left:-1em;color:#fff}
.icon-Translator-Microphone .path1:before{content:"\e910";color:#000}.icon-Translator-Microphone .path2:before{content:"\e913";margin-left:-1em;color:#fff}
.icon-Translator-Microphone .path3:before{content:"\e914";margin-left:-1em;color:none}.icon-Translator-Microphone .path4:before{content:"\e922";margin-left:-1em;color:none}
.icon-Translator-Microphone .path5:before{content:"\e923";margin-left:-1em;color:#fff}.icon-fiber_new:before{content:"\e05e"}.icon-trending_down:before{content:"\e8e3"}
.icon-trending_flat:before{content:"\e8e4"}.icon-trending_up:before{content:"\e8e5"}.icon-chat:before{content:"\e900"}
.icon-community:before{content:"\e902"}.icon-read:before{content:"\e903"}.icon-chevron-down:before{content:"\e904"}
.icon-chevron-up:before{content:"\e905"}.icon-chevron-thin-left:before{content:"\e906"}.icon-chevron-thin-right:before{content:"\e907"}
.icon-warning:before{content:"\e908"}.icon-copy:before{content:"\e909"}.icon-exchange:before{content:"\e90a"}.icon-search:before{content:"\e90b"}
.icon-bars:before{content:"\e90c"}.icon-Carrousel-Bullet-Empty:before{content:"\e90d"}.icon-Carrousel-Bullet-Full:before{content:"\e90e"}
.icon-uniE90E:before{content:"\e90f"}.icon-uniE90F:before{content:"\e911"}.icon-uniE911:before{content:"\e912"}.icon-uniE912:before{content:"\e915"}
.icon-uniE915:before{content:"\e916"}.icon-uniE916:before{content:"\e918"}.icon-uniE917:before{content:"\e917"}.icon-uniE918:before{content:"\e919"}
.icon-uniE919:before{content:"\e91a"}.icon-uniE91A:before{content:"\e91b"}.icon-uniE91B:before{content:"\e91c"}.icon-uniE91C:before{content:"\e930"}
.icon-uniE91D:before{content:"\e91d"}.icon-uniE91E:before{content:"\e91e"}.icon-Star-Empty1:before{content:"\e91f"}
.icon-books:before{content:"\e920"}.icon-Star-Full1:before{content:"\e921"}.icon-uniE927:before{content:"\e927"}.icon-uniE928:before{content:"\e928"}
.icon-uniE929:before{content:"\e929"}.icon-uniE92A:before{content:"\e92a"}.icon-uniE92B:before{content:"\e92b"}.icon-uniE92C:before{content:"\e92c"}
.icon-uniE92D:before{content:"\e92d"}.icon-uniE92E:before{content:"\e92e"}.icon-uniE92F:before{content:"\e92f"}.icon-uniE930:before{content:"\e957"}
.icon-uniE931:before{content:"\e931"}.icon-uniE932:before{content:"\e932"}.icon-uniE933:before{content:"\e933"}
.icon-uniE934:before{content:"\e934"}.icon-uniE935:before{content:"\e935"}.icon-uniE936:before{content:"\e936"}
.icon-uniE937:before{content:"\e937"}.icon-keyboard:before{content:"\e955"}.icon-sphere:before{content:"\e9c9"}
.icon-eye-plus:before{content:"\e9cf"}.icon-eye-minus:before{content:"\e9d0"}.icon-share2:before{content:"\ea82"}
.icon-user:before{content:"\f007"}.icon-times:before{content:"\f00d"}.icon-volume-up:before{content:"\f028"}.icon-twitter-square:before{content:"\f081"}
.icon-twitter:before{content:"\f099"}.icon-facebook:before{content:"\f09a"}.icon-caret-down:before{content:"\f0d7"}
.icon-caret-up:before{content:"\f0d8"}.icon-caret-left:before{content:"\f0d9"}.icon-caret-right:before{content:"\f0da"}
.icon-sort:before{content:"\f0dc"}.icon-copyright:before{content:"\f1f9"}.icon-facebook-official:before{content:"\f230"}
.icon-bar-graph:before{content:"\e901"}.icon-arrow-up-right2:before{content:"\ea3b"}.icon-arrow-right2:before{content:"\ea3c"}
.icon-arrow-down-right2:before{content:"\ea3d"}.icon-checkmark:before{content:"\ea10"}.icon-headphones:before{content:"\e959"}
.icon-2x{font-size:2em;height:32px;width:32px}.icon-fw{display:inline-block;text-align:center;width:1.55em}@font-face{font-family:'Open Sans';font-style:normal;font-weight:400;font-display:swap;src:local('Open Sans Regular'),local('OpenSans-Regular'),url(https://fonts.gstatic.com/s/opensans/v17/mem8YaGs126MiZpBA-UFVZ0b.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
@font-face{font-family:'Zilla Slab';font-style:normal;font-weight:400;font-display:swap;src:local('Zilla Slab'),local('ZillaSlab-Regular'),url(https://fonts.gstatic.com/s/zillaslab/v5/dFa6ZfeM_74wlPZtksIFajo6_Q.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
@font-face{font-family:'Zilla Slab';font-style:normal;font-weight:700;font-display:swap;src:local('Zilla Slab Bold'),local('ZillaSlab-Bold'),url(https://fonts.gstatic.com/s/zillaslab/v5/dFa5ZfeM_74wlPZtksIFYoEf6HOpWw.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
article,aside,details,figcaption,figure,footer,header,hgroup,main,nav,section,summary{display:block}html{overflow-y:scroll}body.noScroll{position:fixed;right:0;left:0}a{color:#1c4b8b}.p,p{margin-bottom:1em}
span.p.heading{display:block;margin-top:1em;font-weight:bold;margin-bottom:.5em}b{font-weight:bold}.padLeft{padding-left:20px}.textCenter{text-align:center}q{quotes:none}input,button,select{font-size:inherit;color:inherit;padding:.5em;border:solid 1px #c3c3c3}
label:not(.inline){display:block}button{cursor:pointer}.center{display:table;margin:0 auto}.bold{font-weight:700}.h1,.h2{font-family:"Zilla Slab";line-height:normal}.mb0{margin-bottom:0}
.mb20{margin-bottom:20px}.icon-Carrousel-Bullet-Full{font-size:8px;vertical-align:middle;margin:0 6px}.cB h2,.cB .h2{margin-bottom:.5em;line-height:.8em}.opensearch #stickyslot_container{z-index:1}#ad_topslot{margin:auto}
.res_cell_right #ad_rightslot,.res_cell_right #ad_rightslot2{margin-top:10px;margin-bottom:10px;max-width:300px}.ac_leftslot_a{min-height:600px}.leftslot_b_container{width:300px}.rightslot_container{width:300px}
#ad_btmslot_a{margin-bottom:10px;text-align:center}.btmslot_a-container{margin-top:10px;width:100%}body.definition #ad_btmslot_a,body.submission #ad_btmslot_a{margin:0 auto 20px auto}.contentslot,.mpuslot_b{margin-top:20px;text-align:center}

@media only screen and (min-width:1503px){.contentslot{display:inline;max-height:90px;max-width:728px}}.lazy-background{background:rgba(0,0,0,0)}.lazy.lazy.lazy{width:auto}.slideDown{height:0;overflow:hidden;transition-property:height}
.slideUp{overflow:hidden}.cssTransitions{transition:all .5s}.headerTransitions{transition:background-position,.5s}.hooksTransitions{transition:all .2s}.res_cell_center_content>.wnv{margin-top:50px}.res_cell_center_content>.navigation+.wnv{margin-top:0}.desktop,.t-p-i_amp-list,#t-p-i_checkbox{display:none}.f-b.contact-us.contact-us{display:flex;white-space:nowrap;flex-wrap:wrap}.f-b.contact-us>div{margin-right:2em}.related_links{margin:1em 0}.related_links>ul>li{margin-left:1.5em}
.related_links>ul>.first{margin-left:0;transition:all .2s ease-in;cursor:pointer}.related_links>ul>.first>a{margin-right:25px}.related_links>ul>.first>.icon-caret-down{transform:rotateX(180deg)}.related_links>ul>.first.closed>.icon-caret-down{transform:rotateX(0deg)}
.related_links>ul>.closed ~ li{display:none}.f-b{margin-top:40px}.f-b.top{margin-top:15px}.f-b .title{font-size:25px;font-family:"Zilla Slab"}.logo-reseaux_img{font-size:20px;white-space:nowrap}
.logo-reseaux_img a{color:white;text-decoration:none}a.logOut-In{font-size:small}.logo-reseaux_img.collins{background-size:contain;float:right}.t-p-i_icon{color:white;font-size:30px;vertical-align:text-bottom;margin-right:5px;vertical-align:sub}
.t-p-i_title{display:inline-block;margin-bottom:10px}.t-p-i_select{display:block;text-decoration:none;background-color:#000;border:solid white 1px;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:0;width:100%}
.t-p-i_select_c{margin-left:40px;width:120px;position:relative}.t-p-i_select_c:after{content:"";width:0;height:0;position:absolute;pointer-events:none;border-left:5px solid transparent;border-right:5px solid transparent;top:50%;transform:translateY(-50%);right:.75em;border-top:8px solid white;opacity:.9}
.t-p-i_select option{padding:5px}.t-p-i_select:focus,.t-p-i_select:hover,.t-p-i_select:active{outline:0}.t-p-i_amp{position:relative;margin-left:40px}.t-p-i_amp-list{width:150px}.t-p-i_amp-list a{padding:5px;display:inline-block;width:100%}
#t-p-i_checkbox:checked+.t-p-i_amp-list{display:block;position:absolute;left:0;max-height:200px;overflow-y:scroll;background:black;border:1px solid white;z-index:5}.t-p-i_amp-select{border:1px solid white;padding:5px;width:150px}
.bold{font-weight:bold}.law_links li{line-height:1.8}
.logP{background:rgba(221,226,237,.9);position:fixed;top:0;z-index:4;width:100%;height:100%}.logP .pC{position:relative;padding:20px;max-width:300px;min-height:200px;background-color:purple;color:white;font-weight:bold;top:200px;margin:auto}
.logP .pC div{margin-bottom:20px}.logP .pC a{color:white;text-decoration:underline}.bW{word-break:break-word}.bW h2{font-size:1.5em;margin-top:1em}.bW h1,.bW .bLtr{margin-bottom:1em}.bW .bL li a{display:inline-block;padding:5px}.bW .bLtr li{display:inline-block}.bW .bLtr li a{display:inline-block;background:#e5ebf3;padding:.5em .5em;margin:0 5px 5px 0;text-align:center;min-width:2.5em;text-decoration:none;font-weight:bold;transition:all 300ms ease-out;-webkit-transition:all 300ms ease-out}
.bW .bLtr li a:hover,.bW .bLtr li a.current{background:#bccade}.bW .bB{display:block;-webkit-column-break-inside:avoid;page-break-inside:avoid;break-inside:avoid}.bW .lbL{font-weight:bold;color:#1c4b8b}.log_w{padding-top:70px}.log_w .login_or_signup{width:49%;float:left}.log_w .sign_up{float:left;width:49%;margin-left:2%}.log_w .log_s{margin-top:4%}.log_w .log_s .disclaimer{margin-top:.5em;font-size:.8em;color:#888}
.log_w .log_s a{color:#3c77af;text-decoration:none;display:inline-block;padding:.5em}.log_w .log_s i{font-size:2.5em;vertical-align:text-bottom}.log_w .log_s .facebook i{color:#3e5a98}.log_w .log_s .twitter i{color:#3cf}.comment{white-space:nowrap;margin-bottom:1em}.comment .commentUser{display:inline-block;vertical-align:top;width:50px;height:50px;box-shadow:3px 3px 6px rgba(0,0,0,0.1);background-size:contain;background-repeat:no-repeat;background-position:center center;border:0}
.comment .commentRight{max-width:75%;white-space:normal;margin-left:20px;vertical-align:top;display:inline-block;position:relative;background:#e5ebf3;padding:5px 10px;border-radius:3px}.comment .commentRight::before{content:'';display:inline-block;position:absolute;left:-10px;top:0;margin-top:10px;width:0;height:0;border-style:solid;border-width:0 0 10px 10px;border-color:transparent transparent #e5ebf3 transparent}
.comment .commentDetails{opacity:.6;font-style:italic;font-size:.8em}.comment .commentReport{text-align:right;font-size:.8em}.comment textarea{border:1px solid #c5c5c5;margin-bottom:5px;width:98%;padding:5px 2px;max-width:100%;max-height:200px}
.comment label{display:inline-block}.suggested_word_wrapper h1.h2_entry{font-size:1.8em}.suggested_word_wrapper .columns-block .extra-link{margin-top:25px}.submit_new_word_wrapper .submit-form{padding:5px 25px 25px 0}.submit_new_word_wrapper .submit_new_word_main h1{padding-bottom:15px;margin-bottom:15px;border-bottom:1px dotted #c5c5c5;color:#194885}
.submit_new_word_wrapper .submit_new_word_footer{padding-top:10px;border-top:1px dotted #c5c5c5}.submit_new_word_wrapper .submit_new_word_form strong{font-weight:bold}.submit_new_word_wrapper .submit_new_word_main textarea{width:420px;height:60px;max-height:200px;line-height:120%}
.word_submitted_wrapper h1,.word_submitted_wrapper .recent_word_suggestions .recent_word_suggestions_search h2{padding-bottom:15px;margin-bottom:15px;font-size:1.9em;color:#194885}.word_submitted_wrapper .recent_word_suggestions .recent_word_suggestions_search{border-top:1px dotted #c5c5c5;border-bottom:1px dotted #c5c5c5;padding:15px 0}
.word_submitted_wrapper .recent_word_suggestions .submitted_word{overflow:hidden;padding-top:20px;padding-bottom:16px;border-bottom:1px dotted #c5c5c5}.word_submitted_wrapper .recent_word_suggestions .submitted_word .user_thumbnail{width:50px;height:50px;float:left;margin:0 10px 10px 0}
.word_submitted_wrapper .recent_word_suggestions .submitted_word .user_thumbnail img{width:100%;height:100%}.word_submitted_wrapper .recent_word_suggestions .submitted_word h3 a{font-size:1.2em;text-decoration:none}
.word_submitted_wrapper .recent_word_suggestions .submitted_word .submission_detail{margin-left:56px}.word_submitted_wrapper .recent_word_suggestions .submitted_word .submission_detail q{quotes:'"' '"'}
.word_submitted_wrapper .recent_word_suggestions .pagination .results_pagination{margin-top:16px;margin-bottom:16px}.word_submitted_wrapper .recent_word_suggestions .pagination .summary{display:inline}
.word_submitted_wrapper .your_suggestion h2{padding:30px 0;color:#505050;background:#f4f4f4;border:1px dotted #c5c5c5;border-width:1px 0;margin:12px 0;padding-left:12px;font-size:2.4em}.word_submitted_wrapper h3,.word_submitted_wrapper .your_suggestion h3{font-size:1.6em;color:#505050;padding:15px 0;margin:0}
.word_submitted_wrapper .your_suggestion p{padding-left:16px}.word_submitted_wrapper .your_suggestion .your_definition,.word_submitted_wrapper .your_suggestion .your_info{padding:15px 0;border-bottom:1px dotted #c5c5c5}
.recent_word_suggestions_search .button{background-color:#194480;color:white;padding:.5em 1em;border:0;text-decoration:none;display:inline-block}.word_submitted_wrapper .recent_word_suggestions_search .button i{vertical-align:-2px;margin-left:.5em}.vC.cB{padding-top:0}.vC a{text-decoration:none}.vC .headword_link{color:#c12d30;border-bottom:dashed 1px rgba(0,0,0,.6);line-height:3em}.vC h1{color:#b71533;margin-bottom:20px}.vC .type{min-height:60px}
.vC .type h2,.vC .conjugation h3{font-size:1.2em;font-weight:bold;color:#b71533}.view_more a{opacity:.7;text-decoration:none;margin-top:1em;display:block;font-size:.8em;color:#b71533}a.navcon{display:inline-block;background-color:#bbbaba;line-height:1.7em;font-size:1.1em;font-weight:bold;color:inherit;margin-right:4px;margin-bottom:.7em;padding:0 .7em}
.conjugation .vb{font-weight:bold}.conjugation .infl{display:block;padding:.1em .5em}.short_verb_table{display:flex;flex-wrap:nowrap;flex-direction:column}.short_verb_table h2{background-color:#bbbaba;line-height:2.2em;font-size:1.2em;font-weight:bold;color:#b71533;padding-left:.5em}
.short_verb_table h2.h3_version{background-color:white;line-height:1.5em;padding-left:0}.conjugation{padding-top:.5em;padding-bottom:1em}.note{color:black;line-height:1.4em;font-style:normal;background-color:#e9eef4;margin:6px 0;padding:6px 4px 6px 18px;font-weight:normal;display:block}.pagination{text-align:center;margin:1em 0}.pagination a.page{text-decoration:none}.pagination .page{font-size:.9em;display:inline-block;line-height:26px;padding:4px 8px;background-color:#c6cfdb;margin:6px 2px 10px 2px;border:0;border-radius:2px}
.pagination span.page,.pagination p,.pagination p a{background-color:#b71533;color:white;position:relative}.related{-webkit-column-break-inside:avoid;page-break-inside:avoid;break-inside:avoid}.r-t{font-weight:bold;text-decoration:none;border-bottom:1px dotted}.r-d{font-style:italic}.menuMobile .sublvl3{position:relative;box-shadow:none}.menuMobile .menuDd{text-align:left}.menuMobile .major-links-container.sub{line-height:1;height:auto}.menuMobile .major-links-container.sub,.menuMobile .major-links-container.special,.menuMobile .dD_d_l{display:block}
.menuMobile .menuDd .m_l{padding:1em 0}.menuMobile .dD_d_l>div:before,.menuMobile .major-links-container.sub>div:before,.subnonevisible>.sublvl2,.menuBarOpened .subnonevisible>.major-links-container.sub{display:none}
.menuMobile .sublvl2{background-color:#717273}.menuMobile .major-links-container{padding-left:1em}.menuMobile{background-color:#717273;position:absolute;width:100%;top:-100%;overflow:hidden;overflow-y:auto;z-index:20000;padding-top:1em}
.menuMobile a{font-size:medium}.dD_d_l>.special>div{padding:0 .5em;position:relative}.special.major-links-container:before{content:none}.special.major-links-container.sub{overflow:hidden;flex-wrap:wrap;margin-left:0}
.special.major-links-container.sub{line-height:2em}.dD_d_l.special{flex-wrap:nowrap}.dD_d_l.special>.icon-caret-down{order:5;padding:0 1em;align-self:center}.menuBarOpened .menuBar{display:block}.menuBar{display:none}
.menuMobile .subvisible>.icon-caret-down,.menuMobile .subnonevisible>.icon-caret-down{position:absolute;right:1em;top:0}.special.dD_d_l.changedir>.icon-caret-down,.subvisible>.icon-caret-down,.subnonevisible>.icon-caret-down{transition:all .2s ease-in;cursor:pointer}
.dD_d_l.changedir>.icon-caret-down,.subvisible>.icon-caret-down{transform:rotateX(180deg)}.menuMobile .major-links-container>div{position:relative;padding:.3em 0;padding-bottom:.6em}.menuMobile .major-links>span>a,.menuMobile .active>span>a{color:#f3b323}
.menuMobile .major-links .major-links-container,.menuMobile .sublvl2>.dD_d_l{padding-top:.6em}.menuMobile .major-links-container>div,.menuBarOpened .menuMobile>.major-links-container>div,.menuMobile .sublvl2 .dD_d_l>div{border-bottom:1px solid rgba(255,255,255,.53)}
.menuMobile .sublvl2 .dD_d_l>div:last-child,.menuMobile .major-links>span,.menuMobile .active>span,.menuBarOpened .menuMobile>.major-links-container>div:last-child,.menuMobile .major-links-container>div:last-child,.menuMobile>.major-links-container>div{border-bottom:0}
.menuMobile .subnonevisible,.menuMobile .subvisible{line-height:1}.menuMobile .dD_d_l>div{margin-left:1.5em;padding:0}.menu-mobile-display,.icon-caret-down,.major-links-container a{cursor:pointer} 
.page .cit.type-example .title.credits,.credits{display:block;white-space:nowrap;width:300px;text-overflow:ellipsis;overflow:hidden;font-variant:small-caps}#credit-info .credits{white-space:normal;width:auto;text-overflow:unset;overflow:auto}
.page .credits .url{display:inline}#credit-info .credits *{display:inline;padding-right:4px}.page .or{font-weight:normal;font-style:italic}.form.type-phrasalverb{display:block}.form.type-drv{font-size:17px}
.dc .rend-b{color:#c12d30}.cB-e .cit{font-size:17px}.cB-e .cit,.cit.type-example,.dc .translation .example{font-style:italic}.cB-e .cit,.lbl,.colloc,.dc .translation .example,.gramGrp>.pos,.gramGrp.pos,.h2_entry,.h2_sentences,.entry_title{font-family:'Zilla Slab'}
.dc .def{margin-bottom:.5em;line-height:1.5em}.entry_title>.h2_entry{font-size:38px;font-weight:bold;color:#000;letter-spacing:1px}.dc .cB .entry_title{padding:0}.form .orth+.dictname,.form .orth+.lbl.type-misc{position:relative;top:-14px}
.dc .h2_entry .dictname{font-size:18px;text-decoration:none;letter-spacing:normal}.dc .cB-h{padding-bottom:5px}.dc .title_container+*{clear:both;overflow:hidden}.dc .expandable-list{padding:.1em}.dc .cB{padding-top:0;border-bottom:2px dotted #c12d30;padding-bottom:1em}
.dc .cB>.cB:last-child{border:0;padding-bottom:0}.dc .cB-th{margin-top:20px}.dc .cB-h .h2_entry{margin-bottom:0;line-height:1em;letter-spacing:1px}.dc .grammar .cB-h .h2_entry{margin-bottom:.5em}.dc .cB-v .entryVideo{width:100%;max-width:640px;height:320px}
.dc .h2_entry{margin-bottom:.5em}.dc .cB-hook-amp h2.h2_entry{font-size:1.8em}.dc .cB-e h2.h2_entry,.dc .cB-s .h2_entry{display:inline-block}.dc ol li,.dc .thesaurus_synonyms,.dc .link-right.verbtable{margin-bottom:1em}
.dc .h3_entry{font-size:1.3em;margin:.5em 0}.dc .sense_list .scbold{display:block;font-style:italic;font-family:"Times New Roman",Times,serif;border-bottom:1px dotted #c5c5c5}.dc strong,.dc .cB-s .firstSyn,.dc .cB-n-w .current,.dc .cit-type-example .orth,.dc .mini_h2 .orth,.dc .thesaurus_synonyms .synonym:first-of-type,.dc .cB-t .phr{font-weight:bold}
.dc .mini_h2{clear:both}.exBox{font-style:italic;font-family:'Zilla Slab'}.dc .exBox{margin-bottom:1em;position:relative}.dc .exBox .ex_report{right:0;position:absolute;font-size:.8em;top:3px;display:block;width:15px;height:18px;background:url(https://www.collinsdictionary.com/external/images/flag.png?version=4.0.259);background-size:contain;background-repeat:no-repeat}
.dc .dcCorpEx{position:relative}.dc .hom ol ol{list-style-type:lower-alpha}.dc #synonyms_content:first-of-type{border:0}.dc #synonyms_content{border-top:1px dotted #c5c5c5;padding-top:12px}.dc .lbl.type-register,.dc .lbl.misc,.dc .colloc,.dc #synonyms_content .thesaurus_synonyms .lbl,.dc #synonyms_content .thesaurus_synonyms .misc{font-style:italic}
.dc .lbl.type-curric{font-variant:small-caps}.dc .lbl.type-syntax{font-size:.8em;color:#666}.dc ol{list-style-position:outside;list-style-type:decimal;margin-left:2em}.dc ol.single,.dc ol ol.single{list-style-type:none}
.dc .cB-s .extra-link{display:inline-block;margin-left:1em}.dc .thesaurus_synonyms .firstSyn{font-weight:bold;display:inline-block;border:1px solid;border-image:initial;padding:5px 11px 2px;margin:0 5px 0 0}
.dc .thesaurus_synonyms .firstSyn>a{text-decoration:none}.dc .link-right.verbtable,.dc .cB-e .button,.dc .cB-rel-t .button{background:#e5ebf3;padding:2px 10px;border:0;text-decoration:none;display:inline-block;font-weight:bold;font-size:.9em;margin-top:10px}
.dc .cB-e div.button,.dc .cB-rel-t div.button{cursor:pointer}.dc .extra-link{color:#c12d30}.dc .translation .def{font-weight:bold;font-size:inherit}.dc .translation .example{color:#757575;margin-bottom:1em}
.dc .translation_list{margin:1em 0}.dc .translation_list .gramGrp{text-transform:lowercase}.dc .translation_list .translation{display:inherit}.hwd_sound{font-size:16pt;display:inline-block;padding-left:3px;height:22px}
.dc .audio_play_button{color:#ec2615;vertical-align:middle;-webkit-transition:transform .2s,text-shadow .2s;transition:transform .2s,text-shadow .2s;border:0;width:23px;height:22px;display:inline-block}
.dc .h2_entry .homnum{background-color:#1c4b8b;color:#fff;font-size:12px;font-weight:bold;padding:2px 5px;vertical-align:super;display:none}.page .dictionary .sense.re>.cit.type-translation.quote{color:#000;font-size:inherit}
.dc .dictionary .quote{color:#000;font-style:italic}.dc .dictionary .cit.type-translation.quote,.dc .dictionary .cit.type-translation .quote{font-weight:bold;font-style:normal}.page .dictionary .emph{color:#c12d30}
.dc .sup{vertical-align:super;font-size:smaller}.dc .cB:after,.dc .dictionary .content:after{content:'';clear:both;display:table}.dc .cit.type-quotation .quote,.dc .cB-q .quote,.dc .cB-e .quote,.dc .cB-th .quote{display:block;margin-top:1em}
.dc .cit.type-quotation .author,.vC.cB .author,.cB-q .author,.dc .cB-e .author,.dc .vC.cB .author,.dc .cB-th .author{font-weight:bold;font-style:italic;font-variant:small-caps}.dc .cit.type-quotation .title,.vC.cB .title,.dc .cB-q .title,.dc .cB-e .title,.dc .cB-th .title{display:inline;font-style:italic;font-variant:small-caps}
.vC.cB .dictExas+.corpusExas{margin-top:4em}.dc .cit.type-quotation .year,.vC.cB .year,.dc .cB-q .year,.dc .cB-e .year,.dc .cB-th .year{font-style:italic}.vC.cB .author,.vC.cB .year{display:inline}.dc .cB-sos div.type-syn_of_syn_head .orth{color:#1683be}
.dc .h2_entry .pos{font-size:20px}.dc .example-info i{color:red;font-size:21px;vertical-align:text-top;border-bottom:0}.dc .example-info{font-style:italic;font-size:.9em;margin-top:.5em}.pronIPASymbol.pronIPASymbol{border:0;vertical-align:middle;margin-bottom:-3px;display:inline-block;margin-left:5px}
.examples a,.dc a{color:inherit;text-decoration:none;border-bottom:dashed 1px rgba(0,0,0,.6)}.dc a.extra-link{border-bottom:dashed 1px rgba(218,97,99,.6)}.conjugation .title,.conjugation .vb{font-weight:bold}
.conjugation .infl{display:block;padding:.1em .5em}.short_verb_table{display:flex;flex-wrap:wrap}.conjugation{display:block;min-width:320px;padding-bottom:1em}.conjugation .title{font-size:1.1em;line-height:2}
.cB-e .cit.hide,input#showMore_btn,input#showMore_collo_btn,input#showMore_btn:checked+label,input#showMore_collo_btn:checked ~ label[for='showMore_collo_btn'],input#showMore_collo_btn+.block_collolist>.assetlink:nth-child(n+11){display:none}
input#showMore_collo_btn:checked+.block_collolist>.assetlink{display:block}input#showMore_btn:checked ~ .cit.hide{display:inline}.titleExType{font-weight:bold;color:#c12d30;font-size:.9em;margin-top:2em}
.titleExType~.listExBlock{margin-left:1em}.dictlink[data-xrentry] .cB>*,.biling[data-xrentry] .cB>*,.biling[data-xrentry].cB>*{margin-left:2em}.dictlink[data-xrparent] .cB,.biling[data-xrparent] .cB,.biling[data-xrparent].cB{border-bottom:2px dotted #bbb}
.dictlink[data-xrentry] .cB>.specialchar,.biling[data-xrentry] .cB>.specialchar,.biling[data-xrentry].cB>.specialchar{position:absolute;margin-left:0;margin-top:.1em;font-size:xx-large}.page .biling .content br,.page .type-grammarLinks .content br{display:block}
.type-grammarLinks{border-top:2px dotted rgba(0,0,0,0.41);padding-top:1em}.type-grammarLinks>.grammarBox{background:rgba(222,222,222,0.32);margin-bottom:.5em;padding:1em;font-weight:bold;text-decoration:none;border:0}
.type-grammarLinks>.grammarBox>a{display:block;padding-top:1.2em;font-weight:bold;text-decoration:none;border:0;padding-left:.5em}.type-grammarLinks>.grammarBox>.title{color:#c12d30;display:block;padding-left:.5em;padding-bottom:.5em}
.type-grammarLinks>.grammarBox>.content{padding-left:.5em;display:block;font-weight:normal}.dicTitle{text-transform:uppercase;font-size:1.1em;padding-bottom:.6em;display:inline-block}.type-exa_sound .icon-volume-up:before{background:url(https://www.collinsdictionary.com/external/images/tts_icon.png?version=4.0.259)center center;width:20px;height:20px;display:inline-block;content:" "}
.decl{margin:2em 0 2em 0}span.table{display:block;margin-top:.5em;overflow:auto}.decl .tr>.td:first-child,.decl .tr>.th{font-weight:bold}.decl span.tr{display:table-row}.decl span.td,.decl span.th{display:table-cell;border:1px solid;border-top:0;border-bottom:0;padding:.5em;font-size:.9em}
.decl span.td+span.td,.decl span.th+span.th{border-left:none}.decl.table>.tr:nth-child(odd),.decl span.table>.tr:nth-child(odd){background:#ececec}.decl.table>.tr:nth-child(even),.decl span.table>.tr:nth-child(even){background:#FFF}
.decl span.p.heading{font-weight:bold}.decl>.p{display:block}.decl .p.heading{display:block;margin-bottom:.5em}.decl.table>.tr:first-child>*,.decl .table>.tr:first-child>*{border-top:1px solid}.decl.table>.tr:last-child>*,.decl .table>.tr:last-child>*{border-bottom:1px solid}
.hl{color:#de3030}div[data-full]{margin:0 .5em 0 20px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.7em;min-height:1.7em}.cB-h.entry_title{font-weight:bold;color:#c12d30;padding:0 15px;line-height:2em;font-size:18px}
.pB.fulltext{overflow-y:auto;min-height:auto;max-height:400px;margin-bottom:1em}.icon-chevron-down.full{color:#b71533;transform:rotate(-90deg);display:inline-block;height:15px;width:20px}[class*='context-dataset-grammar-pron-guide'] img{max-width:100%;height:auto}
.diagramContainer{overflow:hidden;overflow-x:auto}.blockDiagram{position:relative;font-size:.7em;font-weight:bold;width:600px}.blockDiagram>.diagramLink{position:absolute;line-height:1.2em;background-color:white;border-bottom:0}
.blockDiagram>a.diagramLink{text-decoration:underline}.blockDiagram>.diagramLink.translated{color:orange}.biling .gramGrp .pos,.biling .gramGrp .posp,.biling .gramGrp.pos,.biling .gramGrp.posp{text-transform:uppercase;font-weight:bold;color:#000;font-family:'Zilla Slab'}.biling .hom{margin-top:.5em}
.dictionary.biling .form.type-phrasalverb .orth,.dictionary.biling .form.type-phrasalverb.orth{font-weight:bold;font-size:1.1em;margin-left:-1.3em}.dictionary.biling .re.type-phrasalverb{margin-top:.5em}.dc .cobuild-logo{width:150px;height:20px;background:url(/external/images/cobuild-logo.png?version=4.0.259) center no-repeat;background-size:contain;text-decoration:none;border:0;margin-top:5px;display:block;margin-bottom:1.5em}
.dc .cobuild-logo.partner{width:200px;background-repeat:no-repeat;background-position:50%;margin-right:.5em;margin-top:20px;float:right;margin-bottom:0}.dc .cobuild-logo.idiom{width:200px;margin-right:.5em;margin-top:10px}
.beta{background-repeat:no-repeat;background-position:50%;background-size:75%;width:80px;display:inline-block}.logo_information{background-repeat:no-repeat;background-position:50%;background-size:75%;width:25px;height:25px;vertical-align:middle;display:inline-block}
.dc .definitions .thes{margin-top:.8em;display:inline-block}.dc .definitions div.thes{display:block}.h2_entry .link_logo_information{border:0}.dc .cB-c .explore-collocation{display:block;margin-top:5px;margin-bottom:15px}.dc .wl.h2_entry{padding-left:15px}.thesbase .cB-h>.h2_entry.titleTypeContainer{margin-top:.9em}.dc .thesbase .key{color:#1683be}.cdet .titleTypeContainer .titleType{text-transform:uppercase;font-weight:bold;color:#c12d30}
.cdet .ref:active>.pos{color:white}.dc .gotodict{float:right;line-height:3.9em}.context-english-thesaurus .quote{display:block;margin-top:10px}.context-english-thesaurus .scbold br{display:none}.context-english-thesaurus .dc .sense_list .scbold{border-bottom:0}
.context-english-thesaurus .scbold{display:block;font-style:italic;font-family:"Times New Roman",Times,serif;border-bottom:0;margin-top:15px;margin-bottom:5px;font-weight:bold}.dc .school .def{display:inline}.school .form.type-drv .orth,.school .form.type-phrasalverb .orth{font-weight:bold;font-size:1.1em}.school .fraction{display:inline-block;position:relative;vertical-align:middle;letter-spacing:.001em;text-align:center;padding-left:3px;padding-right:3px;font-size:.7em;line-height:1.1em}
.school .fraction>span{display:none;padding:0 .2em}.school .fraction>.denominator{border-top:thin solid black}.school .fraction>.numerator,.school .fraction>.denominator{display:block}.dictentry .definitions .hom .gramGrp+.form,.page .thesbase .cit.type-quotation,.cdet .sense.opened .iconContainer,.cdet .blockSyn .form.type-syn,.cdet .blockSyn .form.type-syn .titleTypeSubContainer,.cdet .cB-sos div.type-syn_of_syn_head,.selectorOpernerBig:checked+.sense.opened .cit.type-example,.selectorOpernerBig:checked+.sense.opened div>.form,.selectorOpernerBig:checked+.sense.opened div>.syns_container .form.type-syn,.openTootip:checked ~ .def,.he .grammar a.block,.page .cB-sos .syns_items,.page .thesbase .table,.page .thesbase .bibl,.page .thesbase .cit.type-proverb,.page .dictionary .type-syngrp,.page .dictionary .type-antgrp,.page .dictionary .note .scbold,.page .dictionary .hom_subsec,.page .dictionary .newline,.page .dictionary .re,.page .assetref,.page .infls,.page .description,.page .title,.page .url,.page .summary,.page .og{display:block}
label.openerBig,.page span.sensenum+.def,.page .biling .re.inline,.headerSense .linkDef,.page .dictionary .inline,.page .thesbase .synunit .cit,.page .thesbase .bibl .title,.page .dictionary .re .hom{display:inline}
.cdet .form .cit.type-example,.selectorOpernerBig:checked+.sense.opened .sep,.selectorOpernerBig:checked+.sense.opened .openerBig,.cdet .sense .sensehead .xr,.cdet .toggleExample,.cdet .iconContainer,.openTootip,.openTootip ~ .def .selectorOpernerBig:checked+.sense.sense.opened .cit .quote:before{display:none}
.page .copyright{color:#c12d30;font-size:small;margin-top:10px;font-style:italic}.page .dictname{font-size:.7em}.page .metadata{display:none}.page .assettype{font-weight:bold;color:blue}.page .dictentry,.page .colloList{margin-bottom:20px}
.page .assets_intro,.page .asset_intro{color:green;display:block;font-weight:bold;font-variant:small-caps}.page .cobuild .sense{margin-left:0;margin-bottom:0;margin-top:.25em}.page .dictionary .sense{display:block;margin-left:1.5em;margin-bottom:.5em;margin-top:.5em}
.page .dictionary .sense.inline{display:inline;margin-left:0;margin-bottom:.5em;margin-top:.5em}.page .cobuild br{display:none}.page .dictionary .subc,.page .dictionary .sense .lbl,.page .dictionary>.lbl.type-subj,.page .dictionary>.lbl.type-geo,.page .dictionary>.lbl.type-lang,.page .dictionary .hi.rend-r,.page .dictionary .colloc{font-style:italic;font-weight:normal}
.page .dictionary .gramGrp .subc .hi.rend-r,.page .dictionary .gramGrp .colloc .hi.rend-r,.page .dictionary .sense.xr .lbl,.page .dictionary .sense .xr .lbl{font-style:normal}.dc .blackbold,.page .dictionary .b.b,.page .dictionary .form.type-infl .orth,.page .dictionary .form.type-drv.orth,.page .dictionary .form.type-drv .orth,.page .dictionary .inflected_forms .orth,.page .dictionary .hi.rend-b,.page .dictionary .emph,.page .dictionary .xr>.orth{font-weight:bold}
.page .dictionary .form.type-inflected{display:none}.page .dictionary .hi.rend-sc{font-variant:small-caps}.page .dictionary .type-idm .hi.rend-sc{font-variant:none;color:#c12d30}.page .dictionary .hi.rend-u{text-decoration:underline;font-size:inherit}
.page .dictionary .sup,.page .dictionary .hi.rend-sup{vertical-align:super;font-size:smaller}.page .dictionary .sub,.page .dictionary .hi.rend-sub{vertical-align:sub;font-size:smaller}.page .dictionary .hi.rend-i{font-style:italic}
.page .dictionary .note{color:black;line-height:1.4em;font-style:normal;background-color:#e9eef4;margin:6px 0;padding:6px 4px 6px 18px;font-weight:normal;display:block}.page .dictionary .note.type-romanagari{font-size:13px;margin:1.5em 0}
.page .dictionary .r{font-style:normal}.page .dictionary .u{text-decoration:underline}.page .dictionary .block{display:block;margin-top:3px}.page .hin .block{display:block;margin-top:15px;margin-bottom:7.5px}
.page .dictionary .bolditalic{font-weight:bold;font-style:italic}.page span.bluebold{font-weight:bold}.page .biling span.bluebold{font-weight:normal}.page .dictionary .sensenum.bluebold{color:inherit}
.page .dictionary .sense>.cit.type-translation+.bluebold{color:#c12d30}.page .sense .cit.type-example .bluebold{font-style:normal}.page span.italics,.page span.ital{font-style:italic}.sense>.lbl+.type-translation{font-size:22px;font-weight:bold}
.page span.bold,.page .dictionary .cit.type-translation .pos,.page .dictionary .var,.page .dictionary .form.type-alt{font-weight:bold}.dc a,.openerBig{cursor:pointer;color:inherit}.page .dictionary a:hover,.page .cB-sos a:hover{color:#d51f30}
.page .dictionary .power{float:right}.page .dictionary .power .i{font-size:inherit}.page .dictionary .definitions,.page .dictionary .derivs,.page .dictionary .etyms{margin-bottom:1em}.page .dictionary .inflected_forms{display:block;padding-bottom:1.25em}
.page .dictionary .scbold{font-weight:bold;text-transform:uppercase;font-size:.8em}.page .dictionary .pron .ptr{color:red}.page .dictionary .list,.page .dictionary .relwordgrp{display:block;margin-left:20px}
.page .dictionary .listitem,.page .dictionary .relwordunit{display:list-item}.page .asset.Corpus_Examples_EN .quote{font-style:italic}.page .cit.type-example .content{background-color:white;margin-bottom:20px;padding:20px}
.page .cit.type-example .author{font-weight:bold;font-style:italic}.page .cit.type-example .title{display:inline;font-variant:small-caps;font-style:italic}.page .cit.type-example .ref.type-def,.page .cit.type-example .hi.rend-b{text-decoration:none;color:inherit}
.page .biling .lbl{font-style:italic;color:#000;font-variant:initial;font-weight:initial}.page .biling .lbl.type-subj{font-variant:small-caps}.page .biling .lbl.type-tm{font-style:normal}.page .biling .lbl.type-tm_hw{font-size:.78em}
.page .biling .lbl.type-infl span,.page .biling .lbl.type-infl{font-style:normal;font-weight:normal}.page .biling br{display:none}.page .biling .phrasals .re .orth{font-size:1.25em}.page .biling .sense .re{font-size:100%;margin-left:0}
.page .dictionary .sense.re{display:block;margin-left:1.5em}.page .hin .form.type-syn .orth,.page .hin .form.type-ant .orth,.page .hin .form.type-phr .orth{font-weight:normal;font-size:100%}.page .biling .re{display:block;margin-left:1.5em}
.page .thesbase .xr.type-theslink{display:inline-block;margin-left:20px}.page .thesbase .relwgrp{display:block;margin-left:1em}.page .thesbase .caption{display:block;font-weight:bold;margin-top:10px;font-size:larger}
.page .thesbase .tr{display:table-row}.page .thesbase .td{display:table-cell;padding:3px}.page .thesbase .th{display:table-cell;font-weight:bold}.page .thesbase .note{background-color:transparent;padding:0;margin-top:10px;overflow:hidden}
.page .thesbase .note .tr{display:block;margin-bottom:20px}.page .thesbase .tr .td:first-child,.page .thesbase .tr.td{background-color:#e9eef4;font-weight:bold;padding:5px 15px}.page .thesbase .note .td{padding:8px 15px;display:block}
.page .thesbase .note .th{display:none}.page .thesbase .link{text-decoration:underline;font-family:"Open Sans",sans-serif;background:#e5ebf3;padding:.3em .8em;margin:5px 0;display:inline-block}
.page .thesbase .sense{margin-bottom:2em}.page .thesbase .sensehead>.sensenum{float:none}.page .thesbase .scbold{background:#efefef;padding:.5em 22px;margin:2em 0 1em 0;font-weight:bold;font-size:80%;text-transform:uppercase;display:block}
.page .cB-sos div.type-syn_of_syn_head{display:inline-block}.page .cB-sos div.type-syn_of_syn_head .orth,.page .thesbase .key{font-weight:bold;margin-right:0;display:inline-block;margin-left:0;padding:.3em .3em;border:0;font-size:1.1em;padding-left:0;padding-bottom:0}
.page .thesbase .key{padding-right:0}.page .thesbase h2.first-sense{display:inline;font-size:inherit;margin-bottom:inherit}.thesbase ol.square{margin-left:1.6em}.page .thesbase .firstSyn{color:black;font-size:.9em}
.page .cB-sos .syns_head{margin-top:2.2em}.page .cB-sos .syns_example{line-height:2.5em}.page .type-ant.columns3,.page .cB-sos .columns3{-webkit-column-count:3;-moz-column-count:3;column-count:3}.page .dictionary.thesbase .lbl,.page .dictionary.thesbase .lbl span{font-style:italic}
.page .dictionary.thesbase .sensebody{display:block;margin:.5em 0 .5em 6px}.page .thesbase span.bold{font-weight:bold}.page .thesbase span.kerntouch{letter-spacing:-.18em}.page .thesbase span.kern60{letter-spacing:-.60em}
.page .thesbase span.manualdiacritic{vertical-align:25%;letter-spacing:-1em}.page .thesbase span.numerator{vertical-align:35%;font-size:smaller}.page .thesbase span.numerator_back{position:absolute;vertical-align:35%;letter-spacing:-1em;font-size:smaller}
.page .thesbase span.denominator{vertical-align:-35%;font-size:smaller}.page .thesbase span.italics{font-weight:normal;font-style:italic;color:black}.page .thesbase span.homnum{font-weight:bold;color:#fff;vertical-align:super;font-size:50%}
.page .thesbase span.sensenum{font-weight:bold;display:inline-block;min-width:1em;margin-right:2px}.cdet .toc-group a{color:#1683be;border-bottom:dashed 1px #1683be}.cdet .toc{text-align:left;padding:0 1em;margin-top:1em}
.cdet .toc-group .pos{font-style:italic}.cdet .toc-group .orth{color:#1683be}.page .thesbase span.QA{font-style:italic;color:red;font-size:90%}.page .thesbase hr{width:50%;text-align:left;border:3px inset #777;height:6px;margin:10px auto 5px 0}
.page .thesbase .cit.type-quotation>.quote,.page .thesbase .cit.type-proverb>.quote,.page .thesbase .cit.type-quotation>.bibl{display:block;margin-left:1em;padding-left:0}.page .thesbase .cit.type-quotation>.bibl{margin-left:2em}
.page .thesbase .cit.type-quotation>.quote{margin-top:0}.page .thesbase div .xr{display:block;margin-left:1em}.page .punctuation{font-weight:normal;font-style:normal;color:black}.page .dictionary .sense>.sense{margin-left:0;margin-bottom:.5em;margin-top:.5em}
.page .dictionary .sense>.cit.type-translation .quote *{font-size:initial}.page .dictionary .sense.cit.type-translation:not(.type-example)>.quote,.page .dictionary .sense:not(.type-example)>.cit.type-translation.quote,.page .dictionary .sense:not(.type-example)>.cit.type-translation .quote{font-style:normal;color:#c12d30;font-size:20px}
.page .dictionary .sense>.cit.type-translation.gloss .quote{font-style:italic;font-size:16px}.page .lbl,.page .colloc{font-size:18px}.cdet .dc .cB-h{padding-left:15px}.cdet .toggleExample{position:absolute;right:0;top:-1em;padding:.2em;padding-right:1em;background-color:rgba(164,189,212,.53)}
.cdet .blockSyn{margin-bottom:.5em;position:relative}.cdet div[data-type-block] .sense .sensenum{margin-left:0}.cdet .page .dictionary .sense,.cdet .sense.moreSyn{margin-left:0;margin-bottom:.5em;padding-bottom:.5em;position:relative}
.cdet .h1Word{color:#e9573f}.cdet .dictionary.thesbase .sensebody,.cdet div[data-type-block] .sense .sensebody{margin:0;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;padding-right:1.9em;padding-left:1.9em;line-height:1.5em;font-size:.9em}
.cdet .cB-sos div[data-type-block] .sense .def,.cdet .cB-sos div[data-type-block] .sense .syns_example{margin:0;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;line-height:1.5em;font-size:.9em;padding-right:0;padding-left:0}
.cdet .sensehead>.sensenum{min-width:1.9em;display:inline-block;text-align:center;font-size:.9em;color:#4d4e51}.cdet .dictionary .sense.opened,.cdet div[data-type-block] .sense.opened{margin-left:0;margin-bottom:1em;padding-bottom:.5em;cursor:auto;position:relative}
.cdet .dictionary.thesbase .sense.opened .sensebody,.cdet div[data-type-block] .sense.opened .sensebody{overflow:auto;text-overflow:inherit;white-space:inherit}.cdet .iconContainer{position:absolute;right:0}
.cdet .syns_container{padding-left:0}.cdet .cB-sos .sense.moreSyn{margin-bottom:1.5em}.cdet .dc .hom .def{margin:0;display:inline-block}.cdet .dc .syn_of_syns .def,.cdet .type-ant .orth,.cdet .syns_container .form.type-syn .orth{font-size:.97em;display:inline}
.cdet .dictionary .content,.cdet .form.type-def,.cdet .form.type-syn{position:relative}.cdet .titleTypeContainer{font-size:.9em}body.context-language-THESAURUS{background-color:white}.cdet .sense .form *[class*="type"]{font-size:.9em}
.cdet .titleTypeSubContainer{margin-top:.5em;font-weight:bold;font-size:.9em}.cdet .form.type-syn .orth{margin-left:3px}.cdet .form.type-def,.cdet .cB-sos .form.type-syn,.cdet .sense.moreAnt .type-ant div,.cdet .form.type-syn .titleTypeSubContainer,.cdet .form.type-ant .titleTypeSubContainer,.cdet .form.type-ant,.cdet .blockAnt,.cdet .blockAnt div{display:inline-block}
.entry.dictionary.thesbase.cB.cB-th-b{position:relative}.cdet .form.type-def .titleTypeSubContainer:after,.cdet .form.type-syn .titleTypeSubContainer:after,.cdet .form.type-ant .titleTypeSubContainer:after{content:":";display:inline;margin-right:.3em;color:#c12d30}
.cdet .sep{margin-right:.2em}.cdet .titleTypeSubContainer .titleType{display:inline;padding:0}.blockAnt .type-ant>div:before{content:", ";display:inline}.cdet .blockAnt .type-ant>div:first-child:before{content:"";display:inline}
.cdet .type-ant{padding-left:0;margin-left:0;margin-top:.5em}.cdet .cB-com{background-color:white;margin-bottom:20px;padding:20px;position:relative}.cdet .cB-com,.cdet .dictionary .content,.cdet .cB-sos{border-left:none;box-shadow:none}
.cdet .re.type-phr .xr{margin-left:0;padding-left:.85em;margin-bottom:.3em;display:block}.cdet div[data-type-block] .sense.opened .sensebody{overflow:auto;white-space:normal}.cdet .cB-sos .syns_head{margin-top:0}
.cdet .cit.type-quotation>.bibl{font-size:.85em}.cdet .cit.type-quotation{margin-left:0;margin-bottom:.3em;padding-bottom:.3em}.cdet .re.type-phr>.titleTypeContainer,.cdet .cit.type-quotation>.titleTypeContainer{margin-bottom:1em}
.cdet .cit.type-quotation>.quote{line-height:1.3em;margin-bottom:.3em}.cdet .cit.type-quotation .title,.cdet .cit.type-quotation .author{font-size:inherit}.cdet span.sensenum{margin-left:0}.cdet .dictionary .quote{color:#4d4e51;display:block}
.cdet .headerSense .sensenum{margin-left:-20px}.selectorOpernerBig+.shadow_layer{position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(128,128,128,0.78);z-index:2}.selectorOpernerBig:checked+.sense.opened:before{content:"";display:block;position:fixed;top:0;z-index:1;background-color:white;width:70%;left:15%}
.selectorOpernerBig:checked+.sense.sense.opened{position:fixed;top:0;left:15%;height:100%;width:70%;background-color:white;z-index:10003;margin:0;padding:1em;overflow-y:auto}.selectorOpernerBig ~ label.menuPanelCloseButton{position:fixed;display:block;top:0;border-bottom:0;z-index:10004;right:calc(15% - -10px);padding-top:5px}
.selectorOpernerBig ~ label.menuPanelCloseButton:before{cursor:pointer}.he .grammar .page{display:block;border:solid 1px;font-family:arial,helvetica,sans-serif;margin-bottom:20px;padding:15px;padding-bottom:40px}
.he .grammar a.previous{float:left}.he .grammar a.next{float:right}.he .grammar a.previous i,.he .grammar a.next i{font-size:1.3em;vertical-align:middle;display:inline-block}.he .grammar a.previous i{padding-right:8px}
.he .grammar a.next i{padding-left:8px}.he .grammar .exmplblk ul{padding-left:0}.he .grammar .exmplblk{padding:.5em}.he .grammar .exmplgrp ul{padding-left:20px;padding-bottom:10px}.he .grammar .intro.suppressed{display:none}
.he .grammar h2{font-size:16pt;line-height:2em;text-decoration:underline}.he .grammar h3{font-size:14pt}.he .grammar h4{font-size:12pt;font-weight:bold;margin-bottom:1em}.he .grammar u{text-decoration:underline}
.he .grammar .lemma{font-weight:bold}.he .grammar .caption{font-weight:bold;margin-top:1.5em}.he .grammar .group{display:block;margin-top:2em;margin-bottom:2em}.he .grammar .exmpl{font-weight:normal;font-style:italic}
.he .grammar .i,.he .grammar .post{font-style:italic}.he .grammar .posp{font-weight:bold;font-style:normal}.he .grammar .pattern{font-family:sans-serif}.he .grammar ul.arrow{list-style-type:square}.he .grammar ul.star{list-style-type:disc}
.he .grammar ul.alpha{list-style-type:lower-alpha}.he .grammar ol{margin-top:5px;list-style-type:decimal}.he .grammar .li.exmpl{font-style:italic}.he .grammar .lemmalist .li{margin-top:10px}.he .grammar .lemmalist{border-color:#ccc;border-style:solid;border-width:1px;margin:4px;margin-top:2em;padding:1em;-webkit-column-count:4;-moz-column-count:4;column-count:4}
.he .grammar div.greyborder2{border-color:#ccc;border-style:solid;border-width:1px;margin:4px;-webkit-column-count:4;-moz-column-count:4;column-count:4}.he .grammar th,.he .grammar td{border-color:#000;border-style:solid;border-width:1px;padding:.5em 1.4em}
.he .grammar th{background-color:#ddd;font-weight:bold;font-size:.9em}.he .grammar table{border-collapse:collapse;border-color:#000;border-style:solid;border-width:1px;margin-top:1.5em;margin-bottom:1em}
.linksTool+.linksTool{margin-top:.5em}.linksTool{margin:1.5em 1em 1.5em 1em;font-style:italic;font-size:.9em}.cdet .linksTool{margin:.5em 0 0 3px;text-decoration:underline}.he .grammar i.icon-chevron-thin-right{display:inline-block;font-weight:bold;width:2em;text-align:center;font-size:.6em}
.he .grammar .group a:before,.he .grammar .section a:before,.he .grammar .posGr a:before,.he .grammar .subpattern a:before,.he .grammar .pattern a:before,.he .grammar .chapter a:before{display:block;content:""}
.he .grammar .breadcrumb{margin-bottom:2em}.synonymBlock{border:1px solid transparent}.synonymBlock:after{content:"";display:block;clear:both}.grammar .italic{display:inline;font-style:italic}
.grammar .bolditalic{display:inline;font-weight:bold;font-style:italic}.grammar .roman{font-style:normal}.grammar .color1{color:#b71533;font-style:normal}.grammar .chaptitle{font-size:x-large;font-weight:bold;color:#b71533}
.grammar .parttitle{font-size:xx-large;font-weight:bold;color:#b71533}.grammar .head1{font-weight:bold}.grammar .head{font-size:medium;font-weight:bold;color:#b71533;margin-top:2em}.grammar .p{font-size:medium;font-style:normal;text-indent:0}
.grammar .ind{font-size:medium;font-weight:normal;font-style:normal;text-indent:0;margin-top:.3em;margin-bottom:.3em;margin-left:.8em;text-indent:-0.8em}.grammar .ul.cll0{padding-left:0;list-style-type:disc}
.grammar .ul.cll0 .li{margin-left:1em}.grammar .ul.cll1{padding-left:0;list-style-type:none}.grammar .ul.cll2a,.grammar .ul.cll2{list-style-type:none;margin-top:1em;margin-bottom:1em}.grammar .ul.cll2a{padding-left:.75em}
.grammar .ul.cll2a .li{margin-left:0;text-indent:-0.8em}.grammar .ul.cll3{padding-left:1.2em;color:#b71533}.grammar .ul.cll3>.li>span{color:black}.grammar .ol.cll4{list-style-type:none;margin-top:1em;margin-bottom:1em;padding-left:1.5em}
.grammar span.label{width:.8em;display:inline-block;color:#b71533;font-weight:bold}.grammar span.label1{width:.8em;display:inline-block}.grammar .block{font-size:.83em;font-style:italic;font-weight:normal;text-align:justify;text-indent:0;margin:.3em 1.3em}
.grammar div.box{border:1px solid #0058a9;margin-top:2em;margin-bottom:2em;padding:0 2.5em;background-color:#e1e4ee;border-radius:15px}.grammar .toc{margin-top:.25em;margin-bottom:.25em}.grammar .center{text-align:center}
.grammar .right{text-align:right}.grammar .small{font-size:78%}.grammar td{vertical-align:top}.he .grammar .links{margin-top:30px}.he .grammar .quote{margin-left:3em;margin-bottom:1em}.he .grammar .mini{font-size:.7em}
.context-dataset-grammar-el-en-sp .he .grammar .ul,.context-dataset-elt-grammar .he .grammar .ul{list-style-type:circle;margin-top:2em;padding-left:1em;margin-bottom:1.5em}.he .grammar .intro .ul{list-style-type:disc}
.grammar .intro{background-color:#e1e4ee;padding:1em;display:block}.grammar td.filet_b,.grammar td.filet_t,.grammar td.filet_l,.grammar td.filet_r{border-right:1px solid black}.grammar .tab1{margin-left:5em}
.grammar .strike{text-decoration:line-through}.navigation .tab.current .ref>.pos{color:white}.cdet .ref>.pos{font-style:italic;font-size:.9em;color:#777772}
@media screen and (min-width:321px){.cdet .page .dictionary .sense,.cdet .sense.moreSyn,.cdet .dictionary .hom,.cdet .dictionary .syn_of_syns{overflow:hidden}
}
@media screen and (max-width:761px){.cdet .navigation .nav{display:none}.cdet .more{margin:10px auto 10px auto;width:50%}.selectorOpernerBig:checked+.sense.sense.opened:before,.selectorOpernerBig:checked+.sense.sense.opened{width:100%;left:0}
.selectorOpernerBig ~ label.menuPanelCloseButton{right:0}.he .grammar th,.he .grammar td{padding:.5em .5em}.he .grammar table{border-style:none;display:block;overflow:auto;white-space:nowrap}}.pB.image{min-height:300px;text-align:center;background:0;border:0;display:inline-block}.pB.image .pB-c{height:100%;padding:4px}.pB.image .pB-d img{height:100%;max-width:100%;width:auto;vertical-align:middle}
.pB.image .pB-rM{color:#c12d30;text-transform:inherit;font-style:italic;font-size:.8em;padding:0 5px}.usageEntry .hom{margin-top:20px}.usageEntry .copyright{color:#c12d30;font-size:small;margin-top:10px;font-style:italic}.usageEntry .rend-u{text-decoration:underline}.usageEntry .rend-strike{text-decoration:line-through}
.usageEntry .title{font-weight:bold}.usageEntry .title_container .h2_entry{text-decoration:none}.usageEntry .h2_entry .orth{display:inline-block}.usageEntry .h2_entry .orth.type-main{text-decoration:underline}
.usageEntry .icon-warning{color:red;font-size:21px;vertical-align:text-top;border-bottom:0}.usageEntry .type-note .ul{list-style:disc;padding:10px 25px}.dc .word-frequency-img{margin-left:.5em}.dc .word-frequency-img,.dc .frenquency-title .label{display:inline-block;margin-top:1.5em}.dc .word-frequency-icon{display:inline-block;height:38px;width:38px;background-color:black;border-radius:50%;text-align:center;line-height:64px;cursor:pointer}
.icon-bar-graph{color:white;font-size:1.5em;padding-bottom:0;vertical-align:super}.dc .word-frequency-container .level{border:1px solid rgba(0,0,0,0.5);border-radius:50%;display:inline-block;background-color:#f2928e}
.dc .word-frequency-container .level.roundRed{background-color:#c12d30}.dc .word-frequency-container .level1{width:14px;height:14px}.dc .word-frequency-container .level2{width:15px;height:15px}.dc .word-frequency-container .level3{width:16px;height:16px}
.dc .word-frequency-container .level4{width:17px;height:17px}.dc .word-frequency-container .level5{width:18px;height:18px}.dc .word-frequency-container .round{width:100%;height:100%}.dc #exReport{display:none;position:absolute;width:260px;right:10px;bottom:auto;margin:10px 0;padding:10px 15px;z-index:1;background:#fff;border:1px solid #c5c5c5;box-shadow:0 0 15px rgba(0,0,0,.18);font-size:13px}
.dc #exReport.under:before{top:-10px;border-width:0 10px 10px 10px;border-color:transparent transparent #c5c5c5 transparent}.exBox.dcex>.credits>.url{cursor:text;color:inherit}.exBox.dcex{margin-bottom:1.5em;padding-right:1.7em;font-size:17px}
.ex-info+.exBox.dcex{margin-top:1.5em}.dc #exReport .title{font-variant:none}.dc .exReportForm input{margin:.7em 0 .7em 1em}.dc .exReportForm{border-top:solid 1px #c5c5c5;padding:5px 0}.dc .exReportForm #reason-option-other{vertical-align:middle;margin-right:5px;height:14px}
.dc .exReportForm input[type="text"]{padding:8px;border:solid 1px}.dc .exReportForm label{margin-left:.2em}.dc .exReportForm .exText{overflow:hidden}.dc .exReportBtn{margin-top:5px}
.dc .exBtn{cursor:pointer}.dc #exReport .message.error{color:red}.hover_display{display:none}cite{position:relative}.title.wikipedia{display:inline-block}.title.wikipedia:hover+.hover_display,.hover_display:hover{display:inline-block;position:absolute;top:20px;width:260px;left:10px;background:white;z-index:2;border:1px solid #afafaf;padding:3px 6px}.socialButtons{float:right;margin-left:10px;position:relative;z-index:2;display:none}.socialButtons a{margin-bottom:5px;color:#fff!important;text-decoration:none;font-size:18px;width:35px;height:35px;line-height:35px;text-align:center;display:block;border:none!important;border-radius:50%;box-shadow:1px 1px 2px rgba(0,0,0,.2);transition:box-shadow .2s}
.socialButtons a:hover{box-shadow:2px 2px 5px rgba(0,0,0,.2)}.socialButtons .socialButtons-facebook{background:#3c599f}.socialButtons .socialButtons-twitter{background:#3aaae1}.socialButtons .socialButtons-comments{background:#7caf20}.lightboxLink{cursor:pointer}.lightboxOverlay{background:rgba(0,0,0,0.8);position:fixed;top:0;left:0;width:100%;height:100%;z-index:10000;padding:20px;display:flex;align-items:center;justify-content:center;text-align:center}
.lightboxContainer{display:inline-block;position:relative;padding-bottom:30px}.lightboxImage{min-height:200px;min-width:200px;vertical-align:middle;border:solid 5px #fff;border-radius:3px;background:#fff}
.lightboxClose{position:absolute;right:0;bottom:0;color:#fff;font-size:2em}.lightboxCopyright{position:absolute;bottom:0;color:#fff;left:0} 
.pB.wotdB.lazy-visible .pB-i{background-image:url(/external/images/word-cloud.jpg?version=4.0.259)}.pB.wotdB{background:#c12d30;color:white}.pB.wotdB .date{font-size:16px;font-weight:normal}
.pB.wotdB .h2{font-weight:400;font-size:28px}.pB.wotdB .h1{font-size:38px}.pB.wotdB a{color:white}.pB.scrabble-box .pB-c:before{content:'';display:inline-block;position:absolute;left:50%;margin-left:-10px;bottom:0;width:0;height:0;border-style:solid;border-width:0 10px 10px;border-color:transparent transparent #fff}
.pB.scrabble-box{background-color:#007080;text-align:center;color:#fff;border:0;font-family:"Zilla Slab"}.pB.scrabble-box .pB-t{height:30%;margin:0 20px 10px}.pB.scrabble-box .pB-d{font-weight:400;font-size:30px;line-height:1}
.pB.scrabble-box .pB-t div{display:inline-block;height:100%;width:100%;background-size:contain;background-position:center;background-repeat:no-repeat}.pB.scrabble-box .scrabbleScore{font-weight:700}.pB.trW{background:#eee;font-family:"Zilla Slab"}.pB.trW a{text-decoration:none}.pB.trW[data-type='trends'] a{margin-left:.5em;color:#000}.pB.trW i{vertical-align:sub}
.pB.trW .pB-c{padding:10px 0 20px}.pB.trW .pB-t{font-weight:400;margin:20px 0;text-align:center}.pB.trW .pB-d{font-family:"Open Sans",sans-serif}.pB.trW .pB-d li{margin-bottom:5px;font-size:1.15em}
.pB.trW .pB-d li a{display:flex;width:100%;padding-left:20%}.pB.trW .pB-d li a span.twPercentVariation{min-width:30%}.pB.trW .pB-d li a span.twWord{max-width:50%;margin-left:10px}.pB.trW .pB-d li:last-child{margin-bottom:20px}
.pB.trW .pB-d li.twDict{text-align:center;margin-top:1.5em;margin-left:0;font-size:inherit;font-family:"Zilla Slab",serif}.pB.trW .pB-d li.twDict:first-child{margin-top:0;margin-bottom:20px}
.pB.trW .green{color:#02680d}.pB.trW .red{color:#d80a0a}.pB.def-dict{text-decoration:none;box-shadow:0 0 3px rgba(0,0,0,.2);background:#e5ebf3;color:#194885;margin-bottom:20px}.pB.nW{text-decoration:none;background:#e5ebf3;color:#c12d30;margin-top:20px}.pB.nW .entry_title{font-family:'Zilla Slab';font-weight:bold;color:#c12d30;padding:0 15px;line-height:2em;font-size:18px}
.pB.nW .h2_entry{letter-spacing:1px;color:black}.pB.nW .pB-d{padding-top:10px}.pB.nW a.nearbyLink{border-bottom:dashed 1px rgba(0,0,0,.6);line-height:1.7em}.pB.nW .current{color:black}.pB{color:inherit;display:block;background:#fff;text-decoration:none;min-height:400px;display:flex;flex-direction:column}.pB a{border:0}.pB-default{display:block}.pB-c{flex:1 0 auto;position:relative;display:flex;flex-direction:column;padding:10px 20px}
.pB-i{height:190px;background-size:cover;background-position:center center;display:block;width:100%}.pB-d{overflow:hidden;flex:1 1 auto;margin-bottom:.5em}.pB-rM{text-transform:uppercase;text-align:right;min-height:20px;line-height:20px;font-weight:bold}
.pB-rM time{display:block;text-align:left;text-transform:uppercase;font-weight:bold;color:#383637;font-size:10pt;margin:10px 0}span.pB-rM{white-space:nowrap}.tmpDiv .pB{display:block}.learning-video{display:flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-start}
.learning-video>.pB-default{width:30%;margin:10px}.seoBox_ad{max-width:310px;max-height:250px;overflow:hidden}.seoBox.pB{min-height:0}.seoBox.pB .pB-d,.seoBox.pB .pB-rM{text-align:justify}.seoBox.pB .pB-t{margin-bottom:20px;text-align:center;padding:0 20px;font-size:1.5em}
.seoBox.pB.number-2 .pB-d ul{list-style-type:disc;padding-inline-start:25px;padding-left:25px;text-align:left}.seoBox.pB .pB-c{display:block}.pB.newsletter{text-decoration:none;box-shadow:0 0 3px rgba(0,0,0,.2);background:#214464;color:white}.pB.newsletter .pB-d{margin:1.5em 3em}.pB.newsletter>.pB-c{text-align:center}.pB.newsletter .buttonnews{display:inline-block;margin:2em 1em;color:grey;background-color:white;border-radius:3px}
.pB.newsletter .buttonnews>a{border-radius:3px;border:1px solid;padding:.5em;background-color:white;margin:2px;display:inline-block}.pB.wordlehelper{text-decoration:none;box-shadow:0 0 3px rgba(0,0,0,.2);background:#0069b3;color:white}.pB.wordlehelper .pB-d{margin:1.5em 3em}.pB.wordlehelper>.pB-c{text-align:center}.pB.wordlehelper .buttonnews{display:inline-block;margin:2em 1em;color:grey;background-color:white;border-radius:3px}
.pB.wordlehelper .buttonnews>a{border-radius:3px;border:1px solid;padding:.5em;background-color:white;margin:2px;display:inline-block}.pB.minitranslator{background:#eee;font-family:"Zilla Slab"}.pB.minitranslator .pB-t{height:70px;line-height:70px;text-align:center;font-weight:400}.pB-c #miniTranslate{height:100%}
#miniTranslate .inputContainer,#miniTranslate .translation_wrapper,#miniTranslate .textarea{height:100%}#miniTranslate .translation_wrapper{display:flex;flex-direction:column}#miniTranslate .inputContainer{flex:1;display:flex;flex-direction:column;clear:both}
#miniTranslate .select_input label{flex:1}#miniTranslate .select_input label select{width:100%}#miniTranslate .textarea{border:solid 1px black;flex-shrink:4}#miniTranslate .textarea textarea{height:100%;margin:0;padding:5px}
#miniTranslate .select_input,#miniTranslate .recaptcha-text,.recaptcha-text>div:first-child{margin-bottom:10px}#miniTranslate label.submit button{font-family:"Open Sans",sans-serif}
#miniTranslate .recaptcha-text a{text-decoration:underline}.pB.s-b{background:black;color:white}.pB.s-b .pB-t{line-height:1.3em;margin-bottom:0;font-family:'Zilla Slab';font-weight:400}.pB.s-b .pB-rM{padding-top:15px;display:flex}.pB.s-b .pB-rM a{flex:1}
.pB.s-b .pB-rM a:first-child{text-align:left;padding-right:3px}.pB.s-b .time{font-style:italic} 
EOS;
 static public function get_css() : string
 {
    return self::$css;
 }
}
