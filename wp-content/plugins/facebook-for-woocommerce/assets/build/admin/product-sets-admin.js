!function(e){var t={};function o(r){if(t[r])return t[r].exports;var n=t[r]={i:r,l:!1,exports:{}};return e[r].call(n.exports,n,n.exports,o),n.l=!0,n.exports}o.m=e,o.c=t,o.d=function(e,t,r){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(o.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)o.d(r,n,function(t){return e[t]}.bind(null,n));return r},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=9)}({9:function(e,t){jQuery(document).ready((function(e){jQuery(".select2.wc-facebook").length&&(jQuery(".select2.wc-facebook").select2().addClass("visible").attr("disabled",!1),jQuery(".select2.updating-message").addClass("hidden"),jQuery(document).ajaxSuccess((function(e,t,o){var r=new URLSearchParams(o.data);r.has("action")&&"add-tag"===r.get("action")&&r.has("taxonomy")&&"fb_product_set"===r.get("taxonomy")&&jQuery(".select2.wc-facebook").select2().val(null).trigger("change")}))),e('form[id="addtag"] input[name="submit"]').on("click",(function(t){var o=e("#_wc_facebook_product_cats").val(),r=[];window.facebook_for_woocommerce_product_sets&&window.facebook_for_woocommerce_product_sets.excluded_category_ids&&(r=window.facebook_for_woocommerce_product_sets.excluded_category_ids),o.length>0&&r.length>0&&function(e,t){for(var o=0,r=0;r<t.length;r++)t.includes(t[r])&&o++;return o>0}(0,r)&&alert(facebook_for_woocommerce_product_sets.excluded_category_warning_message)}))}))}});