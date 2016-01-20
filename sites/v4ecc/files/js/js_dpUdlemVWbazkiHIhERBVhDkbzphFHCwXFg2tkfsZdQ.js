/*! Picturefill - v3.0.1 - 2015-09-30
 * http://scottjehl.github.io/picturefill
 * Copyright (c) 2015 https://github.com/scottjehl/picturefill/blob/master/Authors.txt; Licensed MIT
 */
!function(a){var b=navigator.userAgent;a.HTMLPictureElement&&/ecko/.test(b)&&b.match(/rv\:(\d+)/)&&RegExp.$1<41&&addEventListener("resize",function(){var b,c=document.createElement("source"),d=function(a){var b,d,e=a.parentNode;"PICTURE"===e.nodeName.toUpperCase()?(b=c.cloneNode(),e.insertBefore(b,e.firstElementChild),setTimeout(function(){e.removeChild(b)})):(!a._pfLastSize||a.offsetWidth>a._pfLastSize)&&(a._pfLastSize=a.offsetWidth,d=a.sizes,a.sizes+=",100vw",setTimeout(function(){a.sizes=d}))},e=function(){var a,b=document.querySelectorAll("picture > img, img[srcset][sizes]");for(a=0;a<b.length;a++)d(b[a])},f=function(){clearTimeout(b),b=setTimeout(e,99)},g=a.matchMedia&&matchMedia("(orientation: landscape)"),h=function(){f(),g&&g.addListener&&g.addListener(f)};return c.srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==",/^[c|i]|d$/.test(document.readyState||"")?h():document.addEventListener("DOMContentLoaded",h),f}())}(window),function(a,b,c){"use strict";function d(a){return" "===a||"	"===a||"\n"===a||"\f"===a||"\r"===a}function e(b,c){var d=new a.Image;return d.onerror=function(){z[b]=!1,aa()},d.onload=function(){z[b]=1===d.width,aa()},d.src=c,"pending"}function f(){L=!1,O=a.devicePixelRatio,M={},N={},s.DPR=O||1,P.width=Math.max(a.innerWidth||0,y.clientWidth),P.height=Math.max(a.innerHeight||0,y.clientHeight),P.vw=P.width/100,P.vh=P.height/100,r=[P.height,P.width,O].join("-"),P.em=s.getEmValue(),P.rem=P.em}function g(a,b,c,d){var e,f,g,h;return"saveData"===A.algorithm?a>2.7?h=c+1:(f=b-c,e=Math.pow(a-.6,1.5),g=f*e,d&&(g+=.1*e),h=a+g):h=c>1?Math.sqrt(a*b):a,h>c}function h(a){var b,c=s.getSet(a),d=!1;"pending"!==c&&(d=r,c&&(b=s.setRes(c),s.applySetCandidate(b,a))),a[s.ns].evaled=d}function i(a,b){return a.res-b.res}function j(a,b,c){var d;return!c&&b&&(c=a[s.ns].sets,c=c&&c[c.length-1]),d=k(b,c),d&&(b=s.makeUrl(b),a[s.ns].curSrc=b,a[s.ns].curCan=d,d.res||_(d,d.set.sizes)),d}function k(a,b){var c,d,e;if(a&&b)for(e=s.parseSet(b),a=s.makeUrl(a),c=0;c<e.length;c++)if(a===s.makeUrl(e[c].url)){d=e[c];break}return d}function l(a,b){var c,d,e,f,g=a.getElementsByTagName("source");for(c=0,d=g.length;d>c;c++)e=g[c],e[s.ns]=!0,f=e.getAttribute("srcset"),f&&b.push({srcset:f,media:e.getAttribute("media"),type:e.getAttribute("type"),sizes:e.getAttribute("sizes")})}function m(a,b){function c(b){var c,d=b.exec(a.substring(m));return d?(c=d[0],m+=c.length,c):void 0}function e(){var a,c,d,e,f,i,j,k,l,m=!1,o={};for(e=0;e<h.length;e++)f=h[e],i=f[f.length-1],j=f.substring(0,f.length-1),k=parseInt(j,10),l=parseFloat(j),W.test(j)&&"w"===i?((a||c)&&(m=!0),0===k?m=!0:a=k):X.test(j)&&"x"===i?((a||c||d)&&(m=!0),0>l?m=!0:c=l):W.test(j)&&"h"===i?((d||c)&&(m=!0),0===k?m=!0:d=k):m=!0;m||(o.url=g,a&&(o.w=a),c&&(o.d=c),d&&(o.h=d),d||c||a||(o.d=1),1===o.d&&(b.has1x=!0),o.set=b,n.push(o))}function f(){for(c(S),i="",j="in descriptor";;){if(k=a.charAt(m),"in descriptor"===j)if(d(k))i&&(h.push(i),i="",j="after descriptor");else{if(","===k)return m+=1,i&&h.push(i),void e();if("("===k)i+=k,j="in parens";else{if(""===k)return i&&h.push(i),void e();i+=k}}else if("in parens"===j)if(")"===k)i+=k,j="in descriptor";else{if(""===k)return h.push(i),void e();i+=k}else if("after descriptor"===j)if(d(k));else{if(""===k)return void e();j="in descriptor",m-=1}m+=1}}for(var g,h,i,j,k,l=a.length,m=0,n=[];;){if(c(T),m>=l)return n;g=c(U),h=[],","===g.slice(-1)?(g=g.replace(V,""),e()):f()}}function n(a){function b(a){function b(){f&&(g.push(f),f="")}function c(){g[0]&&(h.push(g),g=[])}for(var e,f="",g=[],h=[],i=0,j=0,k=!1;;){if(e=a.charAt(j),""===e)return b(),c(),h;if(k){if("*"===e&&"/"===a[j+1]){k=!1,j+=2,b();continue}j+=1}else{if(d(e)){if(a.charAt(j-1)&&d(a.charAt(j-1))||!f){j+=1;continue}if(0===i){b(),j+=1;continue}e=" "}else if("("===e)i+=1;else if(")"===e)i-=1;else{if(","===e){b(),c(),j+=1;continue}if("/"===e&&"*"===a.charAt(j+1)){k=!0,j+=2;continue}}f+=e,j+=1}}}function c(a){return k.test(a)&&parseFloat(a)>=0?!0:l.test(a)?!0:"0"===a||"-0"===a||"+0"===a?!0:!1}var e,f,g,h,i,j,k=/^(?:[+-]?[0-9]+|[0-9]*\.[0-9]+)(?:[eE][+-]?[0-9]+)?(?:ch|cm|em|ex|in|mm|pc|pt|px|rem|vh|vmin|vmax|vw)$/i,l=/^calc\((?:[0-9a-z \.\+\-\*\/\(\)]+)\)$/i;for(f=b(a),g=f.length,e=0;g>e;e++)if(h=f[e],i=h[h.length-1],c(i)){if(j=i,h.pop(),0===h.length)return j;if(h=h.join(" "),s.matchesMedia(h))return j}return"100vw"}b.createElement("picture");var o,p,q,r,s={},t=function(){},u=b.createElement("img"),v=u.getAttribute,w=u.setAttribute,x=u.removeAttribute,y=b.documentElement,z={},A={algorithm:""},B="data-pfsrc",C=B+"set",D=navigator.userAgent,E=/rident/.test(D)||/ecko/.test(D)&&D.match(/rv\:(\d+)/)&&RegExp.$1>35,F="currentSrc",G=/\s+\+?\d+(e\d+)?w/,H=/(\([^)]+\))?\s*(.+)/,I=a.picturefillCFG,J="position:absolute;left:0;visibility:hidden;display:block;padding:0;border:none;font-size:1em;width:1em;overflow:hidden;clip:rect(0px, 0px, 0px, 0px)",K="font-size:100%!important;",L=!0,M={},N={},O=a.devicePixelRatio,P={px:1,"in":96},Q=b.createElement("a"),R=!1,S=/^[ \t\n\r\u000c]+/,T=/^[, \t\n\r\u000c]+/,U=/^[^ \t\n\r\u000c]+/,V=/[,]+$/,W=/^\d+$/,X=/^-?(?:[0-9]+|[0-9]*\.[0-9]+)(?:[eE][+-]?[0-9]+)?$/,Y=function(a,b,c,d){a.addEventListener?a.addEventListener(b,c,d||!1):a.attachEvent&&a.attachEvent("on"+b,c)},Z=function(a){var b={};return function(c){return c in b||(b[c]=a(c)),b[c]}},$=function(){var a=/^([\d\.]+)(em|vw|px)$/,b=function(){for(var a=arguments,b=0,c=a[0];++b in a;)c=c.replace(a[b],a[++b]);return c},c=Z(function(a){return"return "+b((a||"").toLowerCase(),/\band\b/g,"&&",/,/g,"||",/min-([a-z-\s]+):/g,"e.$1>=",/max-([a-z-\s]+):/g,"e.$1<=",/calc([^)]+)/g,"($1)",/(\d+[\.]*[\d]*)([a-z]+)/g,"($1 * e.$2)",/^(?!(e.[a-z]|[0-9\.&=|><\+\-\*\(\)\/])).*/gi,"")+";"});return function(b,d){var e;if(!(b in M))if(M[b]=!1,d&&(e=b.match(a)))M[b]=e[1]*P[e[2]];else try{M[b]=new Function("e",c(b))(P)}catch(f){}return M[b]}}(),_=function(a,b){return a.w?(a.cWidth=s.calcListLength(b||"100vw"),a.res=a.w/a.cWidth):a.res=a.d,a},aa=function(a){var c,d,e,f=a||{};if(f.elements&&1===f.elements.nodeType&&("IMG"===f.elements.nodeName.toUpperCase()?f.elements=[f.elements]:(f.context=f.elements,f.elements=null)),c=f.elements||s.qsa(f.context||b,f.reevaluate||f.reselect?s.sel:s.selShort),e=c.length){for(s.setupRun(f),R=!0,d=0;e>d;d++)s.fillImg(c[d],f);s.teardownRun(f)}};o=a.console&&console.warn?function(a){console.warn(a)}:t,F in u||(F="src"),z["image/jpeg"]=!0,z["image/gif"]=!0,z["image/png"]=!0,z["image/svg+xml"]=b.implementation.hasFeature("http://wwwindow.w3.org/TR/SVG11/feature#Image","1.1"),s.ns=("pf"+(new Date).getTime()).substr(0,9),s.supSrcset="srcset"in u,s.supSizes="sizes"in u,s.supPicture=!!a.HTMLPictureElement,s.supSrcset&&s.supPicture&&!s.supSizes&&!function(a){u.srcset="data:,a",a.src="data:,a",s.supSrcset=u.complete===a.complete,s.supPicture=s.supSrcset&&s.supPicture}(b.createElement("img")),s.selShort="picture>img,img[srcset]",s.sel=s.selShort,s.cfg=A,s.supSrcset&&(s.sel+=",img["+C+"]"),s.DPR=O||1,s.u=P,s.types=z,q=s.supSrcset&&!s.supSizes,s.setSize=t,s.makeUrl=Z(function(a){return Q.href=a,Q.href}),s.qsa=function(a,b){return a.querySelectorAll(b)},s.matchesMedia=function(){return a.matchMedia&&(matchMedia("(min-width: 0.1em)")||{}).matches?s.matchesMedia=function(a){return!a||matchMedia(a).matches}:s.matchesMedia=s.mMQ,s.matchesMedia.apply(this,arguments)},s.mMQ=function(a){return a?$(a):!0},s.calcLength=function(a){var b=$(a,!0)||!1;return 0>b&&(b=!1),b},s.supportsType=function(a){return a?z[a]:!0},s.parseSize=Z(function(a){var b=(a||"").match(H);return{media:b&&b[1],length:b&&b[2]}}),s.parseSet=function(a){return a.cands||(a.cands=m(a.srcset,a)),a.cands},s.getEmValue=function(){var a;if(!p&&(a=b.body)){var c=b.createElement("div"),d=y.style.cssText,e=a.style.cssText;c.style.cssText=J,y.style.cssText=K,a.style.cssText=K,a.appendChild(c),p=c.offsetWidth,a.removeChild(c),p=parseFloat(p,10),y.style.cssText=d,a.style.cssText=e}return p||16},s.calcListLength=function(a){if(!(a in N)||A.uT){var b=s.calcLength(n(a));N[a]=b?b:P.width}return N[a]},s.setRes=function(a){var b;if(a){b=s.parseSet(a);for(var c=0,d=b.length;d>c;c++)_(b[c],a.sizes)}return b},s.setRes.res=_,s.applySetCandidate=function(a,b){if(a.length){var c,d,e,f,h,k,l,m,n,o=b[s.ns],p=s.DPR;if(k=o.curSrc||b[F],l=o.curCan||j(b,k,a[0].set),l&&l.set===a[0].set&&(n=E&&!b.complete&&l.res-.1>p,n||(l.cached=!0,l.res>=p&&(h=l))),!h)for(a.sort(i),f=a.length,h=a[f-1],d=0;f>d;d++)if(c=a[d],c.res>=p){e=d-1,h=a[e]&&(n||k!==s.makeUrl(c.url))&&g(a[e].res,c.res,p,a[e].cached)?a[e]:c;break}h&&(m=s.makeUrl(h.url),o.curSrc=m,o.curCan=h,m!==k&&s.setSrc(b,h),s.setSize(b))}},s.setSrc=function(a,b){var c;a.src=b.url,"image/svg+xml"===b.set.type&&(c=a.style.width,a.style.width=a.offsetWidth+1+"px",a.offsetWidth+1&&(a.style.width=c))},s.getSet=function(a){var b,c,d,e=!1,f=a[s.ns].sets;for(b=0;b<f.length&&!e;b++)if(c=f[b],c.srcset&&s.matchesMedia(c.media)&&(d=s.supportsType(c.type))){"pending"===d&&(c=d),e=c;break}return e},s.parseSets=function(a,b,d){var e,f,g,h,i=b&&"PICTURE"===b.nodeName.toUpperCase(),j=a[s.ns];(j.src===c||d.src)&&(j.src=v.call(a,"src"),j.src?w.call(a,B,j.src):x.call(a,B)),(j.srcset===c||d.srcset||!s.supSrcset||a.srcset)&&(e=v.call(a,"srcset"),j.srcset=e,h=!0),j.sets=[],i&&(j.pic=!0,l(b,j.sets)),j.srcset?(f={srcset:j.srcset,sizes:v.call(a,"sizes")},j.sets.push(f),g=(q||j.src)&&G.test(j.srcset||""),g||!j.src||k(j.src,f)||f.has1x||(f.srcset+=", "+j.src,f.cands.push({url:j.src,d:1,set:f}))):j.src&&j.sets.push({srcset:j.src,sizes:null}),j.curCan=null,j.curSrc=c,j.supported=!(i||f&&!s.supSrcset||g),h&&s.supSrcset&&!j.supported&&(e?(w.call(a,C,e),a.srcset=""):x.call(a,C)),j.supported&&!j.srcset&&(!j.src&&a.src||a.src!==s.makeUrl(j.src))&&(null===j.src?a.removeAttribute("src"):a.src=j.src),j.parsed=!0},s.fillImg=function(a,b){var c,d=b.reselect||b.reevaluate;a[s.ns]||(a[s.ns]={}),c=a[s.ns],(d||c.evaled!==r)&&((!c.parsed||b.reevaluate)&&s.parseSets(a,a.parentNode,b),c.supported?c.evaled=r:h(a))},s.setupRun=function(){(!R||L||O!==a.devicePixelRatio)&&f()},s.supPicture?(aa=t,s.fillImg=t):!function(){var c,d=a.attachEvent?/d$|^c/:/d$|^c|^i/,e=function(){var a=b.readyState||"";f=setTimeout(e,"loading"===a?200:999),b.body&&(s.fillImgs(),c=c||d.test(a),c&&clearTimeout(f))},f=setTimeout(e,b.body?9:99),g=function(a,b){var c,d,e=function(){var f=new Date-d;b>f?c=setTimeout(e,b-f):(c=null,a())};return function(){d=new Date,c||(c=setTimeout(e,b))}},h=y.clientHeight,i=function(){L=Math.max(a.innerWidth||0,y.clientWidth)!==P.width||y.clientHeight!==h,h=y.clientHeight,L&&s.fillImgs()};Y(a,"resize",g(i,99)),Y(b,"readystatechange",e)}(),s.picturefill=aa,s.fillImgs=aa,s.teardownRun=t,aa._=s,a.picturefillCFG={pf:s,push:function(a){var b=a.shift();"function"==typeof s[b]?s[b].apply(s,a):(A[b]=a[0],R&&s.fillImgs({reselect:!0}))}};for(;I&&I.length;)a.picturefillCFG.push(I.shift());a.picturefill=aa,"object"==typeof module&&"object"==typeof module.exports?module.exports=aa:"function"==typeof define&&define.amd&&define("picturefill",function(){return aa}),s.supPicture||(z["image/webp"]=e("image/webp","data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA=="))}(window,document);;
(function ($, Drupal, drupalSettings) {
  Drupal.viewsSlideshow = Drupal.viewsSlideshow || {};

  /**
   * Views Slideshow Controls
   */
  Drupal.viewsSlideshowControls = Drupal.viewsSlideshowControls || {};

  /**
   * Implement the play hook for controls.
   */
  Drupal.viewsSlideshowControls.play = function (options) {
    // Route the control call to the correct control type.
    // Need to use try catch so we don't have to check to make sure every part
    // of the object is defined.
    try {
      if (typeof drupalSettings.viewsSlideshowControls[options.slideshowID].top.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].top.type].play == 'function') {
        Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].top.type].play(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }

    try {
      if (typeof drupalSettings.viewsSlideshowControls[options.slideshowID].bottom.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].bottom.type].play == 'function') {
        Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].bottom.type].play(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }
  };

  /**
   * Implement the pause hook for controls.
   */
  Drupal.viewsSlideshowControls.pause = function (options) {
    // Route the control call to the correct control type.
    // Need to use try catch so we don't have to check to make sure every part
    // of the object is defined.
    try {
      if (typeof drupalSettings.viewsSlideshowControls[options.slideshowID].top.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].top.type].pause == 'function') {
        Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].top.type].pause(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }

    try {
      if (typeof drupalSettings.viewsSlideshowControls[options.slideshowID].bottom.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].bottom.type].pause == 'function') {
        Drupal[drupalSettings.viewsSlideshowControls[options.slideshowID].bottom.type].pause(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }
  };


  /**
   * Views Slideshow Text Controls
   */

  // Add views slieshow api calls for views slideshow text controls.
  Drupal.behaviors.viewsSlideshowControlsText = {
    attach: function (context) {

      // Process previous link
      $('.views_slideshow_controls_text_previous:not(.views-slideshow-controls-text-previous-processed)', context).addClass('views-slideshow-controls-text-previous-processed').each(function() {
        var uniqueID = $(this).attr('id').replace('views_slideshow_controls_text_previous_', '');
        $(this).click(function() {
          Drupal.viewsSlideshow.action({ "action": 'previousSlide', "slideshowID": uniqueID });
          return false;
        });
      });

      // Process next link
      $('.views_slideshow_controls_text_next:not(.views-slideshow-controls-text-next-processed)', context).addClass('views-slideshow-controls-text-next-processed').each(function() {
        var uniqueID = $(this).attr('id').replace('views_slideshow_controls_text_next_', '');
        $(this).click(function() {
          Drupal.viewsSlideshow.action({ "action": 'nextSlide', "slideshowID": uniqueID });
          return false;
        });
      });

      // Process pause link
      $('.views_slideshow_controls_text_pause:not(.views-slideshow-controls-text-pause-processed)', context).addClass('views-slideshow-controls-text-pause-processed').each(function() {
        var uniqueID = $(this).attr('id').replace('views_slideshow_controls_text_pause_', '');
        $(this).click(function() {
          if (drupalSettings.viewsSlideshow[uniqueID].paused) {
            Drupal.viewsSlideshow.action({ "action": 'play', "slideshowID": uniqueID, "force": true });
          }
          else {
            Drupal.viewsSlideshow.action({ "action": 'pause', "slideshowID": uniqueID, "force": true });
          }
          return false;
        });
      });
    }
  };

  Drupal.viewsSlideshowControlsText = Drupal.viewsSlideshowControlsText || {};

  /**
   * Implement the pause hook for text controls.
   */
  Drupal.viewsSlideshowControlsText.pause = function (options) {
    var pauseText = Drupal.theme.prototype['viewsSlideshowControlsPause'] ? Drupal.theme('viewsSlideshowControlsPause') : '';
    $('#views_slideshow_controls_text_pause_' + options.slideshowID + ' a').text(pauseText);
    $('#views_slideshow_controls_text_pause_' + options.slideshowID).removeClass('views-slideshow-controls-text-status-play');
    $('#views_slideshow_controls_text_pause_' + options.slideshowID).addClass('views-slideshow-controls-text-status-pause');
  };

  /**
   * Implement the play hook for text controls.
   */
  Drupal.viewsSlideshowControlsText.play = function (options) {
    var playText = Drupal.theme.prototype['viewsSlideshowControlsPlay'] ? Drupal.theme('viewsSlideshowControlsPlay') : '';
    $('#views_slideshow_controls_text_pause_' + options.slideshowID + ' a').text(playText);
    $('#views_slideshow_controls_text_pause_' + options.slideshowID).removeClass('views-slideshow-controls-text-status-pause');
    $('#views_slideshow_controls_text_pause_' + options.slideshowID).addClass('views-slideshow-controls-text-status-play');
  };

  // Theme the resume control.
  Drupal.theme.prototype.viewsSlideshowControlsPause = function () {
    return Drupal.t('Resume');
  };

  // Theme the pause control.
  Drupal.theme.prototype.viewsSlideshowControlsPlay = function () {
    return Drupal.t('Pause');
  };

  /**
   * Views Slideshow Pager
   */
  Drupal.viewsSlideshowPager = Drupal.viewsSlideshowPager || {};

  /**
   * Implement the transitionBegin hook for pagers.
   */
  Drupal.viewsSlideshowPager.transitionBegin = function (options) {
    // Route the pager call to the correct pager type.
    // Need to use try catch so we don't have to check to make sure every part
    // of the object is defined.
    try {
      if (typeof drupalSettings.viewsSlideshowPager != "undefined" && typeof drupalSettings.viewsSlideshowPager[options.slideshowID].top.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].transitionBegin == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].transitionBegin(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }

    try {
      if (typeof drupalSettings.viewsSlideshowPager != "undefined" && typeof drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].transitionBegin == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].transitionBegin(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }
  };

  /**
   * Implement the goToSlide hook for pagers.
   */
  Drupal.viewsSlideshowPager.goToSlide = function (options) {
    // Route the pager call to the correct pager type.
    // Need to use try catch so we don't have to check to make sure every part
    // of the object is defined.
    try {
      if (typeof drupalSettings.viewsSlideshowPager[options.slideshowID].top.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].goToSlide == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].goToSlide(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }

    try {
      if (typeof drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].goToSlide == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].goToSlide(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }
  };

  /**
   * Implement the previousSlide hook for pagers.
   */
  Drupal.viewsSlideshowPager.previousSlide = function (options) {
    // Route the pager call to the correct pager type.
    // Need to use try catch so we don't have to check to make sure every part
    // of the object is defined.
    try {
      if (typeof drupalSettings.viewsSlideshowPager[options.slideshowID].top.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].previousSlide == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].previousSlide(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }

    try {
      if (typeof drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].previousSlide == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].previousSlide(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }
  };

  /**
   * Implement the nextSlide hook for pagers.
   */
  Drupal.viewsSlideshowPager.nextSlide = function (options) {
    // Route the pager call to the correct pager type.
    // Need to use try catch so we don't have to check to make sure every part
    // of the object is defined.
    try {
      if (typeof drupalSettings.viewsSlideshowPager[options.slideshowID].top.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].nextSlide == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].top.type].nextSlide(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }

    try {
      if (typeof drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type != "undefined" && typeof Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].nextSlide == 'function') {
        Drupal[drupalSettings.viewsSlideshowPager[options.slideshowID].bottom.type].nextSlide(options);
      }
    }
    catch(err) {
      // Don't need to do anything on error.
    }
  };


  /**
   * Views Slideshow Pager Fields
   */

  // Add views slieshow api calls for views slideshow pager fields.
  Drupal.behaviors.viewsSlideshowPagerFields = {
    attach: function (context) {
      // Process pause on hover.
      $('.views_slideshow_pager_field:not(.views-slideshow-pager-field-processed)', context).addClass('views-slideshow-pager-field-processed').each(function() {
        // Parse out the location and unique id from the full id.
        var pagerInfo = $(this).attr('id').split('_');
        var location = pagerInfo[2];
        pagerInfo.splice(0, 3);
        var uniqueID = pagerInfo.join('_');

        // Add the activate and pause on pager hover event to each pager item.
        if (drupalSettings.viewsSlideshowPagerFields[uniqueID][location].activatePauseOnHover) {
          $(this).children().each(function(index, pagerItem) {
            var mouseIn = function() {
              Drupal.viewsSlideshow.action({ "action": 'goToSlide', "slideshowID": uniqueID, "slideNum": index });
              Drupal.viewsSlideshow.action({ "action": 'pause', "slideshowID": uniqueID });
            };

            var mouseOut = function() {
              Drupal.viewsSlideshow.action({ "action": 'play', "slideshowID": uniqueID });
            };

            if (jQuery.fn.hoverIntent) {
              $(pagerItem).hoverIntent(mouseIn, mouseOut);
            }
            else {
              $(pagerItem).hover(mouseIn, mouseOut);
            }
          });
        }
        else {
          $(this).children().each(function(index, pagerItem) {
            $(pagerItem).click(function() {
              Drupal.viewsSlideshow.action({ "action": 'goToSlide', "slideshowID": uniqueID, "slideNum": index });
            });
          });
        }
      });
    }
  };

  Drupal.viewsSlideshowPagerFields = Drupal.viewsSlideshowPagerFields || {};

  /**
   * Implement the transitionBegin hook for pager fields pager.
   */
  Drupal.viewsSlideshowPagerFields.transitionBegin = function (options) {
    for (pagerLocation in drupalSettings.viewsSlideshowPager[options.slideshowID]) {
      // Remove active class from pagers
      $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"]').removeClass('active');

      // Add active class to active pager.
      $('#views_slideshow_pager_field_item_'+ pagerLocation + '_' + options.slideshowID + '_' + options.slideNum).addClass('active');
    }
  };

  /**
   * Implement the goToSlide hook for pager fields pager.
   */
  Drupal.viewsSlideshowPagerFields.goToSlide = function (options) {
    for (pagerLocation in drupalSettings.viewsSlideshowPager[options.slideshowID]) {
      // Remove active class from pagers
      $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"]').removeClass('active');

      // Add active class to active pager.
      $('#views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '_' + options.slideNum).addClass('active');
    }
  };

  /**
   * Implement the previousSlide hook for pager fields pager.
   */
  Drupal.viewsSlideshowPagerFields.previousSlide = function (options) {
    for (pagerLocation in drupalSettings.viewsSlideshowPager[options.slideshowID]) {
      // Get the current active pager.
      var pagerNum = $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"].active').attr('id').replace('views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '_', '');

      // If we are on the first pager then activate the last pager.
      // Otherwise activate the previous pager.
      if (pagerNum == 0) {
        pagerNum = $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"]').length() - 1;
      }
      else {
        pagerNum--;
      }

      // Remove active class from pagers
      $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"]').removeClass('active');

      // Add active class to active pager.
      $('#views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '_' + pagerNum).addClass('active');
    }
  };

  /**
   * Implement the nextSlide hook for pager fields pager.
   */
  Drupal.viewsSlideshowPagerFields.nextSlide = function (options) {
    for (pagerLocation in drupalSettings.viewsSlideshowPager[options.slideshowID]) {
      // Get the current active pager.
      var pagerNum = $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"].active').attr('id').replace('views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '_', '');
      var totalPagers = $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"]').length();

      // If we are on the last pager then activate the first pager.
      // Otherwise activate the next pager.
      pagerNum++;
      if (pagerNum == totalPagers) {
        pagerNum = 0;
      }

      // Remove active class from pagers
      $('[id^="views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '"]').removeClass('active');

      // Add active class to active pager.
      $('#views_slideshow_pager_field_item_' + pagerLocation + '_' + options.slideshowID + '_' + slideNum).addClass('active');
    }
  };


  /**
   * Views Slideshow Slide Counter
   */

  Drupal.viewsSlideshowSlideCounter = Drupal.viewsSlideshowSlideCounter || {};

  /**
   * Implement the transitionBegin for the slide counter.
   */
  Drupal.viewsSlideshowSlideCounter.transitionBegin = function (options) {
    $('#views_slideshow_slide_counter_' + options.slideshowID + ' .num').text(options.slideNum + 1);
  };

  /**
   * This is used as a router to process actions for the slideshow.
   */
  Drupal.viewsSlideshow.action = function (options) {
    // Set default values for our return status.
    var status = {
      'value': true,
      'text': ''
    };

    // If an action isn't specified return false.
    if (typeof options.action == 'undefined' || options.action == '') {
      status.value = false;
      status.text =  Drupal.t('There was no action specified.');
      return error;
    }

    // If we are using pause or play switch paused state accordingly.
    if (options.action == 'pause') {
      drupalSettings.viewsSlideshow[options.slideshowID].paused = 1;
      // If the calling method is forcing a pause then mark it as such.
      if (options.force) {
        drupalSettings.viewsSlideshow[options.slideshowID].pausedForce = 1;
      }
    }
    else if (options.action == 'play') {
      // If the slideshow isn't forced pause or we are forcing a play then play
      // the slideshow.
      // Otherwise return telling the calling method that it was forced paused.
      if (!drupalSettings.viewsSlideshow[options.slideshowID].pausedForce || options.force) {
        drupalSettings.viewsSlideshow[options.slideshowID].paused = 0;
        drupalSettings.viewsSlideshow[options.slideshowID].pausedForce = 0;
      }
      else {
        status.value = false;
        status.text += ' ' + Drupal.t('This slideshow is forced paused.');
        return status;
      }
    }

    // We use a switch statement here mainly just to limit the type of actions
    // that are available.
    switch (options.action) {
      case "goToSlide":
      case "transitionBegin":
      case "transitionEnd":
        // The three methods above require a slide number. Checking if it is
        // defined and it is a number that is an integer.
        if (typeof options.slideNum == 'undefined' || typeof options.slideNum !== 'number' || parseInt(options.slideNum) != (options.slideNum - 0)) {
          status.value = false;
          status.text = Drupal.t('An invalid integer was specified for slideNum.');
        }
      case "pause":
      case "play":
      case "nextSlide":
      case "previousSlide":
        // Grab our list of methods.
        var methods = drupalSettings.viewsSlideshow[options.slideshowID]['methods'];

        // if the calling method specified methods that shouldn't be called then
        // exclude calling them.
        var excludeMethodsObj = {};
        if (typeof options.excludeMethods !== 'undefined') {
          // We need to turn the excludeMethods array into an object so we can use the in
          // function.
          for (var i=0; i < excludeMethods.length; i++) {
            excludeMethodsObj[excludeMethods[i]] = '';
          }
        }

        // Call every registered method and don't call excluded ones.
        for (i = 0; i < methods[options.action].length; i++) {
          if (Drupal[methods[options.action][i]] != undefined && typeof Drupal[methods[options.action][i]][options.action] == 'function' && !(methods[options.action][i] in excludeMethodsObj)) {
            Drupal[methods[options.action][i]][options.action](options);
          }
        }
        break;

      // If it gets here it's because it's an invalid action.
      default:
        status.value = false;
        status.text = Drupal.t('An invalid action "!action" was specified.', { "!action": options.action });
    }
    return status;
  };
})(jQuery, Drupal, drupalSettings);
;
;
;

/**
 *  @file
 *  A simple jQuery Cycle Div Slideshow Rotator.
 */

/**
 * This will set our initial behavior, by starting up each individual slideshow.
 */
(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.viewsSlideshowCycle = {
        attach: function (context) {
            $('.views_slideshow_cycle_main:not(.viewsSlideshowCycle-processed)', context).addClass('viewsSlideshowCycle-processed').each(function() {
                var fullId = '#' + $(this).attr('id');
                var settings = drupalSettings.viewsSlideshowCycle[fullId];
                settings.targetId = '#' + $(fullId + " :first").attr('id');

                settings.slideshowId = settings.targetId.replace('#views_slideshow_cycle_teaser_section_', '');
                // Pager after function.
                var pager_after_fn = function(curr, next, opts) {
                    // Need to do some special handling on first load.
                    var slideNum = opts.currSlide;
                    if (typeof settings.processedAfter == 'undefined' || !settings.processedAfter) {
                        settings.processedAfter = 1;
                        slideNum = (typeof settings.opts.startingSlide == 'undefined') ? 0 : settings.opts.startingSlide;
                    }
                    Drupal.viewsSlideshow.action({ "action": 'transitionEnd', "slideshowID": settings.slideshowId, "slideNum": slideNum });
                }
                // Pager before function.
                var pager_before_fn = function(curr, next, opts) {
                    var slideNum = opts.nextSlide;

                    // Remember last slide.
                    if (settings.remember_slide) {
                        createCookie(settings.vss_id, slideNum, settings.remember_slide_days);
                    }

                    // Make variable height.
                    if (!settings.fixed_height) {
                        //get the height of the current slide
                        var $ht = $(next).height();
                        //set the container's height to that of the current slide
                        $(next).parent().animate({height: $ht});
                    }

                    // Need to do some special handling on first load.
                    if (typeof settings.processedBefore == 'undefined' || !settings.processedBefore) {
                        settings.processedBefore = 1;
                        slideNum = (typeof opts.startingSlide == 'undefined') ? 0 : opts.startingSlide;
                    }

                    Drupal.viewsSlideshow.action({ "action": 'transitionBegin', "slideshowID": settings.slideshowId, "slideNum": slideNum });
                }
                settings.loaded = false;

                settings.opts = {
                    speed:settings.speed,
                    timeout:settings.timeout,
                    delay:settings.delay,
                    sync:settings.sync,
                    random:settings.random,
                    nowrap:settings.nowrap,
                    after:pager_after_fn,
                    before:pager_before_fn,
                    cleartype:(settings.cleartype)? true : false,
                    cleartypeNoBg:(settings.cleartypenobg)? true : false
                }

                // Set the starting slide if we are supposed to remember the slide
                if (settings.remember_slide) {
                    var startSlide = readCookie(settings.vss_id);
                    if (startSlide == null) {
                        startSlide = 0;
                    }
                    settings.opts.startingSlide = parseInt(startSlide);
                }

                if (settings.effect == 'none') {
                    settings.opts.speed = 1;
                }
                else {
                    settings.opts.fx = settings.effect;
                }

                // Take starting item from fragment.
                var hash = location.hash;
                if (hash) {
                    var hash = hash.replace('#', '');
                    var aHash = hash.split(';');
                    var aHashLen = aHash.length;

                    // Loop through all the possible starting points.
                    for (var i = 0; i < aHashLen; i++) {
                        // Split the hash into two parts. One part is the slideshow id the
                        // other is the slide number.
                        var initialInfo = aHash[i].split(':');
                        // The id in the hash should match our slideshow.
                        // The slide number chosen shouldn't be larger than the number of
                        // slides we have.
                        if (settings.slideshowId == initialInfo[0] && settings.num_divs > initialInfo[1]) {
                            settings.opts.startingSlide = parseInt(initialInfo[1]);
                        }
                    }
                }

                // Pause on hover.
                if (settings.pause) {
                    var mouseIn = function() {
                        Drupal.viewsSlideshow.action({ "action": 'pause', "slideshowID": settings.slideshowId });
                    }

                    var mouseOut = function() {
                        Drupal.viewsSlideshow.action({ "action": 'play', "slideshowID": settings.slideshowId });
                    }

                    if (jQuery.fn.hoverIntent) {
                        $('#views_slideshow_cycle_teaser_section_' + settings.vss_id).hoverIntent(mouseIn, mouseOut);
                    }
                    else {
                        $('#views_slideshow_cycle_teaser_section_' + settings.vss_id).hover(mouseIn, mouseOut);
                    }
                }

                // Pause on clicking of the slide.
                if (settings.pause_on_click) {
                    $('#views_slideshow_cycle_teaser_section_' + settings.vss_id).click(function() {
                        Drupal.viewsSlideshow.action({ "action": 'pause', "slideshowID": settings.slideshowId, "force": true });
                    });
                }

                if (typeof JSON != 'undefined' && typeof settings.advanced_options != 'undefined') {
                    var advancedOptions = JSON.parse(settings.advanced_options);
                    for (var option in advancedOptions) {
                        switch(option) {

                            // Standard Options
                            case "activePagerClass":
                            case "allowPagerClickBubble":
                            case "autostop":
                            case "autostopCount":
                            case "backwards":
                            case "bounce":
                            case "cleartype":
                            case "cleartypeNoBg":
                            case "containerResize":
                            case "continuous":
                            case "delay":
                            case "easeIn":
                            case "easeOut":
                            case "easing":
                            case "fastOnEvent":
                            case "fit":
                            case "fx":
                            case "height":
                            case "manualTrump":
                            case "metaAttr":
                            case "next":
                            case "nowrap":
                            case "pager":
                            case "pagerEvent":
                            case "pause":
                            case "pauseOnPagerHover":
                            case "prev":
                            case "prevNextEvent":
                            case "random":
                            case "randomizeEffects":
                            case "requeueOnImageNotLoaded":
                            case "requeueTimeout":
                            case "rev":
                            case "slideExpr":
                            case "slideResize":
                            case "speed":
                            case "speedIn":
                            case "speedOut":
                            case "startingSlide":
                            case "sync":
                            case "timeout":
                            case "width":
                                var optionValue = advancedOptions[option];
                                optionValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(optionValue);
                                settings.opts[option] = optionValue;
                                break;

                            // These process options that look like {top:50, bottom:20}
                            case "animIn":
                            case "animOut":
                            case "cssBefore":
                            case "cssAfter":
                            case "shuffle":
                                var cssValue = advancedOptions[option];
                                cssValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(cssValue);
                                settings.opts[option] = eval('(' + cssValue + ')');
                                break;

                            // These options have their own functions.
                            case "after":
                                var afterValue = advancedOptions[option];
                                afterValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(afterValue);
                                // transition callback (scope set to element that was shown): function(currSlideElement, nextSlideElement, options, forwardFlag)
                                settings.opts[option] = function(currSlideElement, nextSlideElement, options, forwardFlag) {
                                    pager_after_fn(currSlideElement, nextSlideElement, options);
                                    eval(afterValue);
                                }
                                break;

                            case "before":
                                var beforeValue = advancedOptions[option];
                                beforeValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(beforeValue);
                                // transition callback (scope set to element to be shown):     function(currSlideElement, nextSlideElement, options, forwardFlag)
                                settings.opts[option] = function(currSlideElement, nextSlideElement, options, forwardFlag) {
                                    pager_before_fn(currSlideElement, nextSlideElement, options);
                                    eval(beforeValue);
                                }
                                break;

                            case "end":
                                var endValue = advancedOptions[option];
                                endValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(endValue);
                                // callback invoked when the slideshow terminates (use with autostop or nowrap options): function(options)
                                settings.opts[option] = function(options) {
                                    eval(endValue);
                                }
                                break;

                            case "fxFn":
                                var fxFnValue = advancedOptions[option];
                                fxFnValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(fxFnValue);
                                // function used to control the transition: function(currSlideElement, nextSlideElement, options, afterCalback, forwardFlag)
                                settings.opts[option] = function(currSlideElement, nextSlideElement, options, afterCalback, forwardFlag) {
                                    eval(fxFnValue);
                                }
                                break;

                            case "onPagerEvent":
                                var onPagerEventValue = advancedOptions[option];
                                onPagerEventValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(onPagerEventValue);
                                settings.opts[option] = function(zeroBasedSlideIndex, slideElement) {
                                    eval(onPagerEventValue);
                                }
                                break;

                            case "onPrevNextEvent":
                                var onPrevNextEventValue = advancedOptions[option];
                                onPrevNextEventValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(onPrevNextEventValue);
                                settings.opts[option] = function(isNext, zeroBasedSlideIndex, slideElement) {
                                    eval(onPrevNextEventValue);
                                }
                                break;

                            case "pagerAnchorBuilder":
                                var pagerAnchorBuilderValue = advancedOptions[option];
                                pagerAnchorBuilderValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(pagerAnchorBuilderValue);
                                // callback fn for building anchor links:  function(index, DOMelement)
                                settings.opts[option] = function(index, DOMelement) {
                                    var returnVal = '';
                                    eval(pagerAnchorBuilderValue);
                                    return returnVal;
                                }
                                break;

                            case "pagerClick":
                                var pagerClickValue = advancedOptions[option];
                                pagerClickValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(pagerClickValue);
                                // callback fn for pager clicks:    function(zeroBasedSlideIndex, slideElement)
                                settings.opts[option] = function(zeroBasedSlideIndex, slideElement) {
                                    eval(pagerClickValue);
                                }
                                break;

                            case "paused":
                                var pausedValue = advancedOptions[option];
                                pausedValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(pausedValue);
                                // undocumented callback when slideshow is paused:    function(cont, opts, byHover)
                                settings.opts[option] = function(cont, opts, byHover) {
                                    eval(pausedValue);
                                }
                                break;

                            case "resumed":
                                var resumedValue = advancedOptions[option];
                                resumedValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(resumedValue);
                                // undocumented callback when slideshow is resumed:    function(cont, opts, byHover)
                                settings.opts[option] = function(cont, opts, byHover) {
                                    eval(resumedValue);
                                }
                                break;

                            case "timeoutFn":
                                var timeoutFnValue = advancedOptions[option];
                                timeoutFnValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(timeoutFnValue);
                                settings.opts[option] = function(currSlideElement, nextSlideElement, options, forwardFlag) {
                                    eval(timeoutFnValue);
                                }
                                break;

                            case "updateActivePagerLink":
                                var updateActivePagerLinkValue = advancedOptions[option];
                                updateActivePagerLinkValue = Drupal.viewsSlideshowCycle.advancedOptionCleanup(updateActivePagerLinkValue);
                                // callback fn invoked to update the active pager link (adds/removes activePagerClass style)
                                settings.opts[option] = function(pager, currSlideIndex) {
                                    eval(updateActivePagerLinkValue);
                                }
                                break;
                        }
                    }
                }

                // If selected wait for the images to be loaded.
                // otherwise just load the slideshow.
                if (settings.wait_for_image_load) {
                    // For IE/Chrome/Opera we if there are images then we need to make
                    // sure the images are loaded before starting the slideshow.
                    settings.totalImages = $(settings.targetId + ' img').length;
                    if (settings.totalImages) {
                        settings.loadedImages = 0;

                        // Add a load event for each image.
                        $(settings.targetId + ' img').each(function() {
                            var $imageElement = $(this);
                            $imageElement.bind('load', function () {
                                Drupal.viewsSlideshowCycle.imageWait(fullId);
                            });

                            // Removing the source and adding it again will fire the load event.
                            var imgSrc = $imageElement.attr('src');
                            $imageElement.attr('src', '');
                            $imageElement.attr('src', imgSrc);
                        });

                        // We need to set a timeout so that the slideshow doesn't wait
                        // indefinitely for all images to load.
                        setTimeout("Drupal.viewsSlideshowCycle.load('" + fullId + "')", settings.wait_for_image_load_timeout);
                    }
                    else {
                        Drupal.viewsSlideshowCycle.load(fullId);
                    }
                }
                else {
                    Drupal.viewsSlideshowCycle.load(fullId);
                }
            });
        }
    };

    Drupal.viewsSlideshowCycle = Drupal.viewsSlideshowCycle || {};

    // Cleanup the values of advanced options.
    Drupal.viewsSlideshowCycle.advancedOptionCleanup = function(value) {
        value = $.trim(value);
        value = value.replace(/\n/g, '');
        if (!isNaN(parseInt(value))) {
            value = parseInt(value);
        }
        else if (value.toLowerCase() == 'true') {
            value = true;
        }
        else if (value.toLowerCase() == 'false') {
            value = false;
        }

        return value;
    }

    // This checks to see if all the images have been loaded.
    // If they have then it starts the slideshow.
    Drupal.viewsSlideshowCycle.imageWait = function(fullId) {
        if (++drupalSettings.viewsSlideshowCycle[fullId].loadedImages == drupalSettings.viewsSlideshowCycle[fullId].totalImages) {
            Drupal.viewsSlideshowCycle.load(fullId);
        }
    };

    // Start the slideshow.
    Drupal.viewsSlideshowCycle.load = function (fullId) {
        var settings = drupalSettings.viewsSlideshowCycle[fullId];

        // Make sure the slideshow isn't already loaded.
        if (!settings.loaded) {
            $(settings.targetId).cycle(settings.opts);
            settings.loaded = true;

            // Start Paused
            if (settings.start_paused) {
                Drupal.viewsSlideshow.action({ "action": 'pause', "slideshowID": settings.slideshowId, "force": true });
            }

            // Pause if hidden.
            if (settings.pause_when_hidden) {
                var checkPause = function(settings) {
                    // If the slideshow is visible and it is paused then resume.
                    // otherwise if the slideshow is not visible and it is not paused then
                    // pause it.
                    var visible = viewsSlideshowCycleIsVisible(settings.targetId, settings.pause_when_hidden_type, settings.amount_allowed_visible);
                    if (visible) {
                        Drupal.viewsSlideshow.action({ "action": 'play', "slideshowID": settings.slideshowId });
                    }
                    else {
                        Drupal.viewsSlideshow.action({ "action": 'pause', "slideshowID": settings.slideshowId });
                    }
                }

                // Check when scrolled.
                $(window).scroll(function() {
                    checkPause(settings);
                });

                // Check when the window is resized.
                $(window).resize(function() {
                    checkPause(settings);
                });
            }
        }
    };

    Drupal.viewsSlideshowCycle.pause = function (options) {
        //Eat TypeError, cycle doesn't handle pause well if options isn't defined.
        try{
            if (options.pause_in_middle && $.fn.pause) {
                $('#views_slideshow_cycle_teaser_section_' + options.slideshowID).pause();
            }
            else {
                $('#views_slideshow_cycle_teaser_section_' + options.slideshowID).cycle('pause');
            }
        }
        catch(e){
            if(!e instanceof TypeError){
                throw e;
            }
        }
    };

    Drupal.viewsSlideshowCycle.play = function (options) {
        drupalSettings.viewsSlideshowCycle['#views_slideshow_cycle_main_' + options.slideshowID].paused = false;
        if (options.pause_in_middle && $.fn.resume) {
            $('#views_slideshow_cycle_teaser_section_' + options.slideshowID).resume();
        }
        else {
            $('#views_slideshow_cycle_teaser_section_' + options.slideshowID).cycle('resume');
        }
    };

    Drupal.viewsSlideshowCycle.previousSlide = function (options) {
        $('#views_slideshow_cycle_teaser_section_' + options.slideshowID).cycle('prev');
    };

    Drupal.viewsSlideshowCycle.nextSlide = function (options) {
        $('#views_slideshow_cycle_teaser_section_' + options.slideshowID).cycle('next');
    };

    Drupal.viewsSlideshowCycle.goToSlide = function (options) {
        $('#views_slideshow_cycle_teaser_section_' + options.slideshowID).cycle(options.slideNum);
    };

    // Verify that the value is a number.
    function IsNumeric(sText) {
        var ValidChars = "0123456789";
        var IsNumber=true;
        var Char;

        for (var i=0; i < sText.length && IsNumber == true; i++) {
            Char = sText.charAt(i);
            if (ValidChars.indexOf(Char) == -1) {
                IsNumber = false;
            }
        }
        return IsNumber;
    }

    /**
     * Cookie Handling Functions
     */
    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else {
            var expires = "";
        }
        document.cookie = name+"="+value+expires+"; path=/";
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) {
                return c.substring(nameEQ.length,c.length);
            }
        }
        return null;
    }

    function eraseCookie(name) {
        createCookie(name,"",-1);
    }

    /**
     * Checks to see if the slide is visible enough.
     * elem = element to check.
     * type = The way to calculate how much is visible.
     * amountVisible = amount that should be visible. Either in percent or px. If
     *                it's not defined then all of the slide must be visible.
     *
     * Returns true or false
     */
    function viewsSlideshowCycleIsVisible(elem, type, amountVisible) {
        // Get the top and bottom of the window;
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();
        var docViewLeft = $(window).scrollLeft();
        var docViewRight = docViewLeft + $(window).width();

        // Get the top, bottom, and height of the slide;
        var elemTop = $(elem).offset().top;
        var elemHeight = $(elem).height();
        var elemBottom = elemTop + elemHeight;
        var elemLeft = $(elem).offset().left;
        var elemWidth = $(elem).width();
        var elemRight = elemLeft + elemWidth;
        var elemArea = elemHeight * elemWidth;

        // Calculate what's hiding in the slide.
        var missingLeft = 0;
        var missingRight = 0;
        var missingTop = 0;
        var missingBottom = 0;

        // Find out how much of the slide is missing from the left.
        if (elemLeft < docViewLeft) {
            missingLeft = docViewLeft - elemLeft;
        }

        // Find out how much of the slide is missing from the right.
        if (elemRight > docViewRight) {
            missingRight = elemRight - docViewRight;
        }

        // Find out how much of the slide is missing from the top.
        if (elemTop < docViewTop) {
            missingTop = docViewTop - elemTop;
        }

        // Find out how much of the slide is missing from the bottom.
        if (elemBottom > docViewBottom) {
            missingBottom = elemBottom - docViewBottom;
        }

        // If there is no amountVisible defined then check to see if the whole slide
        // is visible.
        if (type == 'full') {
            return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
            && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop)
            && (elemLeft >= docViewLeft) && (elemRight <= docViewRight)
            && (elemLeft <= docViewRight) && (elemRight >= docViewLeft));
        }
        else if(type == 'vertical') {
            var verticalShowing = elemHeight - missingTop - missingBottom;

            // If user specified a percentage then find out if the current shown percent
            // is larger than the allowed percent.
            // Otherwise check to see if the amount of px shown is larger than the
            // allotted amount.
            if (amountVisible.indexOf('%')) {
                return (((verticalShowing/elemHeight)*100) >= parseInt(amountVisible));
            }
            else {
                return (verticalShowing >= parseInt(amountVisible));
            }
        }
        else if(type == 'horizontal') {
            var horizontalShowing = elemWidth - missingLeft - missingRight;

            // If user specified a percentage then find out if the current shown percent
            // is larger than the allowed percent.
            // Otherwise check to see if the amount of px shown is larger than the
            // allotted amount.
            if (amountVisible.indexOf('%')) {
                return (((horizontalShowing/elemWidth)*100) >= parseInt(amountVisible));
            }
            else {
                return (horizontalShowing >= parseInt(amountVisible));
            }
        }
        else if(type == 'area') {
            var areaShowing = (elemWidth - missingLeft - missingRight) * (elemHeight - missingTop - missingBottom);

            // If user specified a percentage then find out if the current shown percent
            // is larger than the allowed percent.
            // Otherwise check to see if the amount of px shown is larger than the
            // allotted amount.
            if (amountVisible.indexOf('%')) {
                return (((areaShowing/elemArea)*100) >= parseInt(amountVisible));
            }
            else {
                return (areaShowing >= parseInt(amountVisible));
            }
        }
    }
})(jQuery, Drupal, drupalSettings);
;
;
