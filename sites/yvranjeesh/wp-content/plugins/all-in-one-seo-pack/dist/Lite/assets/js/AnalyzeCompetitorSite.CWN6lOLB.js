import{n as x,a as I,u as L,C as v,m as R,e as w}from"./links.CKSg78-h.js";import"./default-i18n.BtxsUzQk.js";import{u as z,S as C}from"./SeoSiteScore.9LP7E1ph.js";import{y as l,o as m,c as p,D as c,m as h,l as b,q as k,x as D,a as i,t as a,H as N,E as y,d as g,F as B,L as M}from"./vue.esm-bundler.DzelZkHk.js";import{_ as A}from"./_plugin-vue_export-helper.BN1snXvA.js";import{s as P}from"./isArrayLikeObject.CkjpbQo7.js";import{C as V,a as F}from"./Score.BDjoJfW4.js";import{p as H}from"./popup.Dv7cb5WI.js";import{C as W}from"./Blur.B433XVqJ.js";import{C as T}from"./Card.C6Yzm1Gr.js";import{C as j}from"./SeoSiteAnalysisResults.DZSlcLAT.js";import{C as q}from"./Index.S3yt8Lmc.js";import{S as G}from"./Refresh.BTBdxJdv.js";import{S as J}from"./index.DX4OhBfI.js";import"./params.B3T1WKlC.js";import"./Tooltip.DcUmvaHX.js";import"./Caret.Cuasz9Up.js";import"./Slide.BfXXFx9A.js";import"./Tags.BcJqtOJO.js";import"./tags.BOsOOXAU.js";import"./postSlug.D1i5fFFO.js";import"./metabox.BW1QyeRU.js";import"./cleanForSlug.C_GG_Tvc.js";import"./toString.EVG10Qqs.js";import"./_baseTrim.BYZhh0MR.js";import"./_stringToArray.DnK4tKcY.js";import"./get.CmvQfcJ_.js";import"./GoogleSearchPreview.C5aCQaFX.js";import"./strings.gPxlDykU.js";import"./isString.Dmb68Xbt.js";import"./constants.DARe-ccJ.js";import"./Information.Dx9dnFtu.js";import"./Gear.CzHv0eD2.js";const Y={setup(){const{strings:e}=z();return{connectStore:x(),optionsStore:I(),rootStore:L(),strings:e}},components:{CoreBlur:W,CoreCard:T},mixins:[C],data(){return{score:0}},methods:{openPopup(e){H(e,this.connectWithAioseo,600,630,!0,["token"],this.completedCallback,()=>{})},completedCallback(e){return this.connectStore.saveConnectToken(e.token)}}},K={key:0,class:"aioseo-seo-site-score-cta"};function Q(e,o,s,r,t,n){const d=l("core-card");return m(),p("div",null,[c(d,{slug:"analyzeNewCompetitor","hide-header":"","no-slide":"",toggles:!1},{default:h(()=>[(m(),b(D(r.optionsStore.internalOptions.internal.siteAnalysis.connectToken?"div":"core-blur"),null,{default:h(()=>[k(e.$slots,"default")]),_:3})),r.optionsStore.internalOptions.internal.siteAnalysis.connectToken?g("",!0):(m(),p("div",K,[i("a",{href:"#",onClick:o[0]||(o[0]=N(S=>n.openPopup(r.rootStore.aioseo.urls.connect),["prevent"]))},a(e.connectWithAioseo),1),y(" "+a(r.strings.toAnalyzeCompetitorSite),1)]))]),_:3}),r.optionsStore.internalOptions.internal.siteAnalysis.connectToken?k(e.$slots,"competitor-results",{key:0}):g("",!0)])}const X=A(Y,[["render",Q]]),Z={setup(){const{strings:e}=z();return{analyzerStore:v(),composableStrings:e}},components:{CoreSiteScore:q,SvgRefresh:G},mixins:[C],props:{score:Number,loading:Boolean,site:{type:String,required:!0},summary:{type:Object,default(){return{}}},mobileSnapshot:String},data(){return{isAnalyzing:!1,strings:R(this.composableStrings,{criticalIssues:this.$t.__("Important Issues",this.$td),warnings:this.$t.__("Warnings",this.$td),recommendedImprovements:this.$t.__("Recommended Improvements",this.$td),goodResults:this.$t.__("Good Results",this.$td),completeSiteAuditChecklist:this.$t.__("Complete Site Audit Checklist",this.$td),refreshResults:this.$t.__("Refresh Results",this.$td),mobileSnapshot:this.$t.__("Mobile Snapshot",this.$td)})}},methods:{refresh(){this.isAnalyzing=!0,this.analyzerStore.runSiteAnalyzer({url:this.site,refresh:!0}).then(()=>this.isAnalyzing=!1)}}},ee={class:"aioseo-site-score-competitor"},te={class:"aioseo-seo-site-score-score"},se={class:"aioseo-seo-site-score-recommendations"},oe={class:"critical"},re={class:"round red"},ie={class:"recommended"},ne={class:"round blue"},ae={class:"good"},le={class:"round green"},ce={key:0,class:"mobile-snapshot"},me=["src"];function he(e,o,s,r,t,n){const d=l("core-site-score"),S=l("svg-refresh"),f=l("base-button");return m(),p("div",ee,[i("div",te,[c(d,{loading:t.isAnalyzing||s.loading,score:s.score,description:e.description},null,8,["loading","score","description"])]),i("div",se,[i("div",oe,[i("span",re,a(s.summary.critical||0),1),y(" "+a(t.strings.criticalIssues),1)]),i("div",ie,[i("span",ne,a(s.summary.recommended||0),1),y(" "+a(t.strings.recommendedImprovements),1)]),i("div",ae,[i("span",le,a(s.summary.good||0),1),y(" "+a(t.strings.goodResults),1)])]),c(f,{class:"refresh-results",type:"gray",size:"small",onClick:n.refresh,loading:t.isAnalyzing},{default:h(()=>[c(S),y(" "+a(t.strings.refreshResults),1)]),_:1},8,["onClick","loading"]),s.mobileSnapshot?(m(),p("div",ce,[i("div",null,a(t.strings.mobileSnapshot),1),i("img",{alt:"Mobile Snapshot",src:s.mobileSnapshot},null,8,me)])):g("",!0)])}const pe=A(Z,[["render",he]]),ue={setup(){const{strings:e}=z();return{analyzerStore:v(),settingsStore:w(),composableStrings:e}},components:{CoreAnalyze:V,CoreAnalyzeScore:F,CoreAnalyzeCompetitorSiteHeader:X,CoreCard:T,CoreSeoSiteAnalysisResults:j,CoreSiteScoreCompetitor:pe,SvgTrash:J},mixins:[C],data(){return{score:0,competitorUrl:null,isAnalyzing:!1,inputError:!1,competitorResults:{},analyzeTime:8,strings:R(this.composableStrings,{enterCompetitorUrl:this.$t.__("Enter Competitor URL",this.$td),performInDepthAnalysis:this.$t.__("Perform in-depth SEO Analysis of your competitor's website.",this.$td),analyze:this.$t.__("Analyze",this.$td),pleaseEnterValidUrl:this.$t.__("Please enter a valid URL.",this.$td)})}},watch:{"analyzerStore.analyzeError"(e){e&&(this.isAnalyzing=!1)}},computed:{getError(){switch(this.analyzerStore.analyzeError){case"invalid-url":return this.$t.__("The URL provided is invalid.",this.$td);case"missing-content":return this.$t.sprintf("%1$s %2$s",this.$t.__("We were unable to parse the content for this site.",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"seoAnalyzerIssues",!0));case"invalid-token":return this.$t.sprintf(this.$t.__("Your site is not connected. Please connect to %1$s, then try again.",this.$td),"AIOSEO")}return this.analyzerStore.analyzeError}},methods:{parseResults(e){return JSON.parse(e)},getSummary(e){return{recommended:this.analyzerStore.recommendedCount(e),critical:this.analyzerStore.criticalCount(e),good:this.analyzerStore.goodCount(e)}},startAnalyzing(e){if(this.inputError=!1,this.competitorUrl=e.replace("http://","https://"),this.competitorUrl.startsWith("https://")||(this.competitorUrl="https://"+this.competitorUrl),!P(this.competitorUrl)){this.inputError=!0;return}this.analyzerStore.analyzing=!0,this.analyzerStore.analyzeError=!1,this.analyzerStore.runSiteAnalyzer({url:this.competitorUrl}),this.isAnalyzing=!0,setTimeout(this.checkStatus,this.analyzeTime*1e3),this.closeAllCards()},checkStatus(){if(this.isAnalyzing=!1,this.analyzerStore.analyzing){this.$nextTick(()=>{this.isAnalyzing=!0,2>this.analyzeTime&&(this.analyzeTime=8),this.analyzeTime=this.analyzeTime/2,setTimeout(this.checkStatus,this.analyzeTime*1e3)});return}this.competitorUrl=null,this.competitorResults=this.analyzerStore.getCompetitorSiteAnalysisResults,this.toggleFirstCard(),this.$nextTick(()=>{const e=Object.keys(this.competitorResults),o=document.querySelector(".aioseo-header"),s=o.offsetHeight+o.offsetTop+30;this.$scrollTo("#aioseo-competitor-results"+this.hashCode(e[0]),{offset:-s})})},startDeleteSite(e){this.closeAllCards(),delete this.competitorResults[e],this.analyzerStore.deleteCompetitorSite(e).then(()=>{this.competitorResults=this.analyzerStore.getCompetitorSiteAnalysisResults})},closeAllCards(){Object.keys(this.competitorResults).forEach(o=>{this.settingsStore.closeCard("analyzeCompetitorSite"+o)})},toggleFirstCard(){const e=Object.keys(this.competitorResults);this.settingsStore.toggleCard({slug:"analyzeCompetitorSite"+e[0]})},hashCode(e){if(!e)return;let o=0,s,r;for(s=0;s<e.length;s++)r=e.charCodeAt(s),o=(o<<5)-o+r,o|=0;return o}},mounted(){this.analyzerStore.analyzeError=!1,this.competitorResults=this.analyzerStore.getCompetitorSiteAnalysisResults,this.toggleFirstCard()}},de={class:"aioseo-analyze-competitor-site"},_e={key:0,class:"aioseo-description aioseo-error"},ye=["innerHTML"],ge={class:"competitor-results-main"},Se={class:"competitor-results-body"};function fe(e,o,s,r,t,n){const d=l("core-analyze"),S=l("core-analyze-score"),f=l("svg-trash"),E=l("core-site-score-competitor"),$=l("core-seo-site-analysis-results"),U=l("core-card"),O=l("core-analyze-competitor-site-header");return m(),p("div",de,[c(O,null,{"competitor-results":h(()=>[(m(!0),p(B,null,M(t.competitorResults,(_,u)=>(m(),b(U,{key:u,id:"aioseo-competitor-results"+n.hashCode(u),slug:"analyzeCompetitorSite"+u,"save-toggle-status":!1},{header:h(()=>[c(S,{score:n.parseResults(_).score},null,8,["score"]),i("span",null,a(u),1),c(f,{onClick:ze=>n.startDeleteSite(u)},null,8,["onClick"])]),default:h(()=>[i("div",ge,[c(E,{site:u,score:n.parseResults(_).score,loading:r.analyzerStore.analyzing,summary:n.getSummary(n.parseResults(_).results),"mobile-snapshot":n.parseResults(_).results.advanced.mobileSnapshot},null,8,["site","score","loading","summary","mobile-snapshot"]),i("div",Se,[c($,{section:"all-items","all-results":n.parseResults(_).results,"show-google-preview":""},null,8,["all-results"])])])]),_:2},1032,["id","slug"]))),128))]),default:h(()=>[c(d,{header:t.strings.enterCompetitorUrl,description:t.strings.performInDepthAnalysis,inputError:t.inputError,isAnalyzing:t.isAnalyzing,analyzeTime:t.analyzeTime,placeholder:"https://competitorwebsite.com",onStartAnalyzing:n.startAnalyzing},{errors:h(()=>[t.inputError?(m(),p("div",_e,a(t.strings.pleaseEnterValidUrl),1)):g("",!0),r.analyzerStore.analyzer==="competitor-site"&&r.analyzerStore.analyzeError?(m(),p("div",{key:1,class:"analyze-errors aioseo-description aioseo-error",innerHTML:r.analyzerStore.analyzeError},null,8,ye)):g("",!0)]),_:1},8,["header","description","inputError","isAnalyzing","analyzeTime","onStartAnalyzing"])]),_:1})])}const et=A(ue,[["render",fe]]);export{et as default};
