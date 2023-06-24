import{a as p}from"./vuex.esm-bundler.8589b2dd.js";import{R as a}from"./WpTable.4d19dc46.js";import"./default-i18n.ab92175e.js";import"./constants.7044c894.js";import{_ as r,o,c as i,h as s,w as u,r as _,k as d}from"./_plugin-vue_export-helper.2d9794a3.js";import"./index.02a5ed9a.js";import{R as l}from"./RequiresActivation.8f6cc30b.js";import"./SaveChanges.bc66cd69.js";import{C as f}from"./Index.02941e99.js";import h from"./Redirects.d2ce6837.js";import"./helpers.de7566d0.js";import"./RequiresUpdate.52f5acf2.js";import"./postContent.bb42e0a8.js";import"./Caret.42a820e0.js";import"./cleanForSlug.62b08993.js";import"./isArrayLikeObject.c492f682.js";import"./html.14f2a8b9.js";import"./Index.1fd8fc42.js";import"./_commonjsHelpers.f84db168.js";import"./RequiresActivation.a9217819.js";/* empty css             */import"./params.597cd0f5.js";import"./Header.33faf032.js";import"./LicenseKeyBar.89175103.js";import"./LogoGear.55b490aa.js";import"./AnimatedNumber.1ae76b8e.js";import"./Logo.81e1a7f3.js";import"./index.fd0fcee8.js";import"./Support.7b58db1c.js";import"./Tabs.eb56046b.js";import"./TruSeoScore.76897846.js";import"./Information.a08d0ef0.js";import"./Slide.cd756e61.js";import"./Date.47e384e5.js";import"./Exclamation.9b2c9d16.js";import"./Url.c71d5763.js";import"./Gear.b05c5b07.js";import"./Redirects.159db128.js";import"./Index.be02a9b3.js";import"./JsonValues.870a4901.js";import"./strings.225838ed.js";import"./isString.d3a213af.js";import"./ProBadge.bcf74c08.js";import"./External.e98f124d.js";import"./Checkbox.b4e8b6fc.js";import"./Checkmark.c5326878.js";import"./Row.5e452de4.js";import"./Tooltip.ae0bcccb.js";import"./Plus.303de95b.js";import"./Blur.a27209d0.js";import"./Card.24f1a534.js";import"./Table.1a0736e7.js";import"./Index.a5b2ee90.js";import"./RequiredPlans.661fcd2c.js";const g={};function x(t,e){return o(),i("div")}const $=r(g,[["render",x]]),v={};function b(t,e){return o(),i("div")}const y=r(v,[["render",b]]),R={};function w(t,e){return o(),i("div")}const A=r(R,[["render",w]]),B={};function C(t,e){return o(),i("div")}const S=r(B,[["render",C]]),k={};function E(t,e){return o(),i("div")}const L=r(k,[["render",E]]);const T={components:{CoreMain:f,FullSiteRedirect:$,ImportExport:y,Logs:A,Logs404:S,Redirects:h,Settings:L},mixins:[l,a],data(){return{strings:{pageName:this.$t.__("Redirects",this.$td)}}},computed:{...p("redirects",["options"]),showSaveButton(){return this.$route.name!=="redirects"&&this.$route.name!=="groups"&&this.$route.name!=="logs-404"&&this.$route.name!=="logs"&&this.$route.name!=="import-export"},excludeTabs(){const t=this.$addons.isActive("aioseo-redirects")?this.getExcludedUpdateTabs("aioseo-redirects"):this.getExcludedActivationTabs("aioseo-redirects");return this.options.logs.log404.enabled||t.push("logs-404"),(!this.options.logs.redirects.enabled||this.options.main.method==="server")&&t.push("logs"),t}}};function M(t,e,U,q,c,n){const m=_("core-main");return o(),s(m,{"page-name":c.strings.pageName,"show-save-button":n.showSaveButton,"exclude-tabs":n.excludeTabs},{default:u(()=>[(o(),s(d(t.$route.name)))]),_:1},8,["page-name","show-save-button","exclude-tabs"])}const Nt=r(T,[["render",M]]);export{Nt as default};
