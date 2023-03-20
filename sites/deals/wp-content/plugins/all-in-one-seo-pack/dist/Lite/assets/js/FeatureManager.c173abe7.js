import"./WpTable.ee9185a7.js";import"./default-i18n.3a91e0e5.js";import"./constants.0d8c074c.js";import{n as i}from"./_plugin-vue2_normalizer.61652a7c.js";import"./index.ec9852b3.js";import"./SaveChanges.e40a9083.js";import{c as o,a as n,m as l}from"./vuex.esm.8fdeb4b6.js";import{c}from"./news-sitemap.1ec2e03a.js";import{C as u}from"./index.3c70e00e.js";import{C as d,S as h,a as m,b as p}from"./SitemapsPro.09482d20.js";import{C as _}from"./Index.6dd703b2.js";import{C as g}from"./Index.235069bb.js";import{G as f,a as v}from"./Row.830f6397.js";import{S as y}from"./Caret.19b10233.js";import{a as $,S as b}from"./ImageSeo.47aac051.js";import"./helpers.de7566d0.js";import"./attachments.6af710f9.js";import"./cleanForSlug.51ef7354.js";import"./isArrayLikeObject.9b4b678d.js";import"./html.14f2a8b9.js";import"./client.e62d6c37.js";import"./_commonjsHelpers.f84db168.js";import"./translations.c394afe3.js";import"./portal-vue.esm.98f2e05b.js";import"./params.597cd0f5.js";import"./Url.c71d5763.js";import"./Tooltip.68a8a92b.js";const A={computed:{yourLicenseIsText(){let a=this.$t.__("You have not yet added a license key.",this.$td);return this.$aioseo.license.isExpired&&(a=this.$t.__("Your license has expired.",this.$td)),this.$aioseo.license.isDisabled&&(a=this.$t.__("Your license has been disabled.",this.$td)),this.$aioseo.license.isInvalid&&(a=this.$t.__("Your license key is invalid.",this.$td)),a}}},k={};var w=function(){var e=this,t=e._self._c;return t("svg",{staticClass:"aioseo-code",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"}},[t("path",{attrs:{d:"M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z",fill:"currentColor"}})])},C=[],S=i(k,w,C,!1,null,null,null,null);const x=S.exports;const F={components:{CoreAlert:u,CoreFeatureCard:d,CoreModal:_,Cta:g,GridColumn:f,GridRow:v,SvgClose:y,SvgCode:x,SvgImageSeo:$,SvgLinkAssistant:h,SvgLocalBusiness:b,SvgRedirect:m,SvgSitemapsPro:p},mixins:[A],data(){return{ctaImg:c,showNetworkModal:!1,maybeActivate:!1,maybeDeactivate:!1,search:null,loading:{activateAll:!1,deactivateAll:!1},strings:{videoNewsSitemaps:this.$t.__("Video and News Sitemaps",this.$td),imageSeoOptimization:this.$t.__("Image SEO Optimization",this.$td),localBusinessSeo:this.$t.__("Local Business SEO",this.$td),advancedWooCommerce:this.$t.__("Advanced WooCommerce",this.$td),customTaxonomies:this.$t.__("SEO for Categories, Tags and Custom Taxonomies",this.$td),andMore:this.$t.__("And many more...",this.$td),activateAllFeatures:this.$t.__("Activate All Features",this.$td),deactivateAllFeatures:this.$t.__("Deactivate All Features",this.$td),searchForFeatures:this.$t.__("Search for Features...",this.$td),ctaHeaderText:this.$t.sprintf(this.$t.__("Upgrade %1$s to Pro and Unlock all Features!",this.$td),"AIOSEO"),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock All Features",this.$td),aValidLicenseIsRequired:this.$t.__("A valid license key is required in order to use our addons.",this.$td),enterLicenseKey:this.$t.__("Enter License Key",this.$td),purchaseLicense:this.$t.__("Purchase License",this.$td),areYouSureNetworkChange:this.$t.__("This is a network-wide change.",this.$td),yesProcessNetworkChange:this.$t.__("Yes, process this network change",this.$td),noChangedMind:this.$t.__("No, I changed my mind",this.$td)},descriptions:{aioseoImageSeo:{description:"<p>"+this.$t.__("Globally control the Title attribute and Alt text for images in your content. These attributes are essential for both accessibility and SEO.",this.$td)+"</p>",version:0},aioseoVideoSitemap:{description:"<p>"+this.$t.__("The Video Sitemap works in much the same way as the XML Sitemap module, it generates an XML Sitemap specifically for video content on your site. Search engines use this information to display rich snippet information in search results.",this.$td)+"</p>",version:0},aioseoNewsSitemap:{description:"<p>"+this.$t.__("Our Google News Sitemap lets you control which content you submit to Google News and only contains articles that were published in the last 48 hours. In order to submit a News Sitemap to Google, you must have added your site to Google’s Publisher Center and had it approved.",this.$td)+"</p>",version:0},aioseoLocalBusiness:{description:"<p>"+this.$t.__("Local Business schema markup enables you to tell Google about your business, including your business name, address and phone number, opening hours and price range. This information may be displayed as a Knowledge Graph card or business carousel.",this.$td)+"</p>",version:0}}}},computed:{...o(["isUnlicensed"]),...n(["addons"]),upgradeToday(){return this.$t.sprintf(this.$t.__("%1$s %2$s comes with many additional features to help take your site's SEO to the next level!",this.$td),"AIOSEO","Pro")},getAddons(){return this.addons.filter(a=>!this.search||a.name.toLowerCase().includes(this.search.toLowerCase()))},networkChangeMessage(){return this.activated?this.$t.__("Are you sure you want to deactivate these addons across the network?",this.$td):this.$t.__("Are you sure you want to activate these addons across the network?",this.$td)}},methods:{...l(["installPlugins","deactivatePlugins"]),closeNetworkModal(a=!1){if(this.showNetworkModal=!1,a){const e=this.maybeActivate?"actuallyActivateAllFeatures":"actuallyDeactivateAllFeatures";this.maybeActivate=!1,this.maybeDeactivate=!1,this[e]()}},getIconComponent(a){return a.startsWith("svg-")?a:"img"},getIconSrc(a,e){return typeof a=="string"&&a.startsWith("svg-")?null:typeof a=="string"?`data:image/svg+xml;base64,${a}`:e},getAddonDescription(a){const e=a.sku.replace(/-./g,t=>t.toUpperCase()[1]);return this.descriptions[e]&&this.descriptions[e].description&&a.descriptionVersion<=this.descriptions[e].version?this.descriptions[e].description:a.description},activateAllFeatures(){if(!this.$isPro||!this.$aioseo.license.isActive)return window.open(this.$links.utmUrl(this.$aioseo.data.isNetworkAdmin?"network-activate-all-features":"activate-all-features"));if(this.$aioseo.data.isNetworkAdmin){this.showNetworkModal=!0,this.maybeActivate=!0;return}this.actuallyActivateAllFeatures()},actuallyActivateAllFeatures(){this.loading.activateAll=!0;const a=this.addons.filter(e=>!e.requiresUpgrade).map(e=>({plugin:e.basename}));this.installPlugins(a).then(e=>{const t=Object.keys(e.body.completed).map(s=>e.body.completed[s]);this.$refs.addons.forEach(s=>{t.includes(s.feature.basename)&&(s.activated=!0)}),this.loading.activateAll=!1})},deactivateAllFeatures(){if(this.$aioseo.data.isNetworkAdmin){this.showNetworkModal=!0,this.maybeDeactivate=!0;return}this.actuallyDeactivateAllFeatures()},actuallyDeactivateAllFeatures(){this.loading.deactivateAll=!0;const a=this.addons.filter(e=>!e.requiresUpgrade).filter(e=>e.installed).map(e=>({plugin:e.basename}));this.deactivatePlugins(a).then(e=>{const t=Object.keys(e.body.completed).map(s=>e.body.completed[s]);this.$refs.addons.forEach(s=>{t.includes(s.feature.basename)&&(s.activated=!1)}),this.loading.deactivateAll=!1})}}};var L=function(){var e=this,t=e._self._c;return t("div",{staticClass:"aioseo-feature-manager"},[t("div",{staticClass:"aioseo-feature-manager-header"},[e.getAddons.filter(s=>s.canActivate===!0).length>0?t("div",{staticClass:"buttons"},[t("div",{staticClass:"button-content"},[t("base-button",{attrs:{size:"medium",type:"blue",loading:e.loading.activateAll},on:{click:e.activateAllFeatures}},[e._v(e._s(e.strings.activateAllFeatures))]),e.isUnlicensed?e._e():t("base-button",{attrs:{size:"medium",type:"gray",loading:e.loading.deactivateAll},on:{click:e.deactivateAllFeatures}},[e._v(e._s(e.strings.deactivateAllFeatures))])],1)]):e._e(),t("div",{staticClass:"search"},[t("base-input",{attrs:{size:"medium",placeholder:e.strings.searchForFeatures,"prepend-icon":"search"},model:{value:e.search,callback:function(s){e.search=s},expression:"search"}})],1)]),t("div",{staticClass:"aioseo-feature-manager-addons"},[e.$isPro&&e.isUnlicensed?t("core-alert",{attrs:{type:"red"}},[t("strong",[e._v(e._s(e.yourLicenseIsText))]),e._v(" "+e._s(e.strings.aValidLicenseIsRequired)+" "),t("div",{staticClass:"buttons"},[t("base-button",{attrs:{type:"blue",size:"small",tag:"a",href:e.$aioseo.data.isNetworkAdmin?e.$aioseo.urls.aio.networkSettings:e.$aioseo.urls.aio.settings}},[e._v(" "+e._s(e.strings.enterLicenseKey)+" ")]),t("base-button",{attrs:{type:"green",size:"small",tag:"a",target:"_blank",href:e.$links.getUpsellUrl("feature-manager-upgrade","no-license-key","pricing")}},[e._v(" "+e._s(e.strings.purchaseLicense)+" ")])],1)]):e._e(),t("grid-row",e._l(e.getAddons,function(s,r){return t("grid-column",{key:r,attrs:{sm:"6",lg:"4"}},[t("core-feature-card",{ref:"addons",refInFor:!0,attrs:{"can-activate":s.canActivate,"can-manage":e.$allowed(s.capability),feature:s},scopedSlots:e._u([{key:"title",fn:function(){return[t(e.getIconComponent(s.icon),{tag:"component",attrs:{src:e.getIconSrc(s.icon,s.image)}}),e._v(" "+e._s(s.name)+" ")]},proxy:!0},{key:"description",fn:function(){return[t("div",{domProps:{innerHTML:e._s(e.getAddonDescription(s))}})]},proxy:!0}],null,!0)})],1)}),1)],1),e.isUnlicensed?t("cta",{staticClass:"feature-manager-upsell",attrs:{type:2,"button-text":e.strings.ctaButtonText,floating:!1,"cta-link":e.$links.utmUrl("feature-manager","main-cta"),"learn-more-link":e.$links.getUpsellUrl("feature-manager","main-cta","home"),"feature-list":e.$constants.UPSELL_FEATURE_LIST},scopedSlots:e._u([{key:"header-text",fn:function(){return[t("span",{staticClass:"large"},[e._v(e._s(e.strings.ctaHeaderText))])]},proxy:!0},{key:"description",fn:function(){return[e._v(" "+e._s(e.upgradeToday)+" ")]},proxy:!0},{key:"featured-image",fn:function(){return[t("img",{attrs:{alt:"Purchase AIOSEO Today!",src:e.$getAssetUrl(e.ctaImg)}})]},proxy:!0}],null,!1,1960250908)}):e._e(),e.showNetworkModal?t("core-modal",{attrs:{"no-header":""},on:{close:function(s){return e.closeNetworkModal(!1)}},scopedSlots:e._u([{key:"body",fn:function(){return[t("div",{staticClass:"aioseo-modal-body"},[t("button",{staticClass:"close",on:{click:function(s){return s.stopPropagation(),e.closeNetworkModal(!1)}}},[t("svg-close",{on:{click:function(s){return s.stopPropagation(),e.closeNetworkModal(!1)}}})],1),t("h3",[e._v(e._s(e.strings.areYouSureNetworkChange))]),t("div",{staticClass:"reset-description"},[e._v(" "+e._s(e.networkChangeMessage)+" ")]),t("base-button",{attrs:{type:"blue",size:"medium"},on:{click:function(s){return e.closeNetworkModal(!0)}}},[e._v(" "+e._s(e.strings.yesProcessNetworkChange)+" ")]),t("base-button",{attrs:{type:"gray",size:"medium"},on:{click:function(s){return e.closeNetworkModal(!1)}}},[e._v(" "+e._s(e.strings.noChangedMind)+" ")])],1)]},proxy:!0}],null,!1,1587611151)}):e._e()],1)},N=[],M=i(F,L,N,!1,null,null,null,null);const re=M.exports;export{re as default};
