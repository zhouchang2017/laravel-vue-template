webpackJsonp([0],{"65HA":function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"",""])},"9en6":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=a("Xxa5"),n=a.n(r);function s(t){return function(){var e=t.apply(this,arguments);return new Promise(function(t,a){return function r(n,s){try{var i=e[n](s),o=i.value}catch(t){return void a(t)}if(!i.done)return Promise.resolve(o).then(function(t){r("next",t)},function(t){r("throw",t)});t(o)}("next")})}}e.default={props:{value:{type:String},accept:{type:String,default:"*"},selectLabel:{type:String,default:"Select an image"},removeLabel:{type:String,default:"Remove"}},data:function(){return{imageUrl:"",progress:0,loading:!1,dialog:!1}},watch:{},mounted:function(){this.imageUrl=""},computed:{dialogHeight:function(){return this.$vuetify.breakpoint.height-100},color:function(){return["error","warning","success"][Math.floor(this.progress/40)]}},methods:{onPickFile:function(){this.$refs.image.click()},onFilePicked:function(t){var e=this;return s(n.a.mark(function a(){var r,s,i,o;return n.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:if(!(r=t.target.files||t.dataTransfer.files)||!r[0]){a.next=12;break}if(!((s=r[0].name)&&s.lastIndexOf(".")<=0)){a.next=5;break}return a.abrupt("return");case 5:return(i=new FileReader).addEventListener("load",function(){e.imageUrl=i.result}),i.readAsDataURL(r[0]),a.next=10,e.upload(r[0]);case 10:o=a.sent,e.$emit("getPath",o);case 12:case"end":return a.stop()}},a,e)}))()},removeFile:function(){this.imageUrl="",this.progress=0,this.dialog=!1,this.$store.dispatch("message/responseMessage",{text:this.$t("remove_img_success")})},upload:function(t){var e=this;return s(n.a.mark(function a(){var r,s,i,o;return n.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return r=new FormData,s={headers:{"Content-Type":"multipart/form-data"},onUploadProgress:function(t){e.progress=Math.round(100*t.loaded/t.total),e.progress>=100&&(e.loading=!1)}},r.append("avatar",t),e.loading=!0,a.next=6,e.$store.dispatch("file/uploadImage",{formData:r,config:s});case 6:return i=a.sent,o=i.data,e.loading=!1,a.abrupt("return",o);case 10:case"end":return a.stop()}},a,e)}))()}}}},FvFi:function(t,e,a){var r=a("65HA");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("194f8275",r,!0,{})},GuIv:function(t,e,a){(t.exports=a("FZ+f")(!1)).push([t.i,"input[type=file][data-v-b5d096be]{position:absolute;left:-99999px}.loading[data-v-b5d096be]{opacity:.4}",""])},Vcw5:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-card",[a("v-card-title",{staticClass:"grey lighten-4",attrs:{"primary-title":""}},[a("h3",{staticClass:"headline mb-0"},[t._v(t._s(t.name))])]),t._v(" "),a("v-divider"),t._v(" "),a("v-toolbar",{attrs:{tabs:"",card:""}},[a("v-text-field",{staticClass:"mx-3",attrs:{"prepend-icon":"search",label:"Search","solo-inverted":"",flat:""},on:{input:t.inputEvent},model:{value:t.query,callback:function(e){t.query=e},expression:"query"}}),t._v(" "),a("v-tabs",{attrs:{slot:"extension",centered:"","show-arrows":""},slot:"extension",model:{value:t.tabs,callback:function(e){t.tabs=e},expression:"tabs"}},[a("v-tabs-slider",{attrs:{color:"primary"}}),t._v(" "),t._l(t.tempNuxts,function(e){return a("v-tab",{key:e.id},[t._v("\n                "+t._s(e.name)+"\n            ")])})],2)],1),t._v(" "),t.loaded?a("v-tabs-items",{model:{value:t.tabs,callback:function(e){t.tabs=e},expression:"tabs"}},t._l(t.nuxts,function(e){return a("v-tab-item",{key:e.id},[a("v-form",{ref:"tab-"+e.id+"form",refInFor:!0,attrs:{"lazy-validation":""},model:{value:t.valid,callback:function(e){t.valid=e},expression:"valid"}},[a("v-card",[a("v-card-title",{attrs:{"primary-title":""}},[a("div",[a("div",{staticClass:"headline"},[t._v("Index Navigation Link")]),t._v(" "),a("span",{staticClass:"grey--text"},[t._v("设置在客户端首页导航栏链接")])])]),t._v(" "),a("v-divider",{staticClass:"mt-5"}),t._v(" "),a("v-card-title",{attrs:{"primary-title":""}},[a("div",[a("div",{staticClass:"headline"},[t._v("Banner")]),t._v(" "),a("span",{staticClass:"grey--text"},[t._v("设置在客户端显示的海报大图")])])]),t._v(" "),a("v-card-text",[a("v-text-field",{attrs:{label:"文章标题",rules:t.titleRules,counter:32,required:""},model:{value:e.formData.title,callback:function(a){t.$set(e.formData,"title",a)},expression:"nuxt.formData.title"}}),t._v(" "),a("v-radio-group",{attrs:{row:"",label:"banner图片",mandatory:!1},model:{value:e.formData.bannerAvatarIsUrl,callback:function(a){t.$set(e.formData,"bannerAvatarIsUrl",a)},expression:"nuxt.formData.bannerAvatarIsUrl"}},[a("v-radio",{attrs:{label:"url地址",value:!0}}),t._v(" "),a("v-radio",{attrs:{label:"上传图片",value:!1}})],1),t._v(" "),a("v-text-field",{directives:[{name:"show",rawName:"v-show",value:e.formData.bannerAvatarIsUrl,expression:"nuxt.formData.bannerAvatarIsUrl"}],attrs:{label:"图片地址",required:""},model:{value:e.formData.avatar,callback:function(a){t.$set(e.formData,"avatar",a)},expression:"nuxt.formData.avatar"}}),t._v(" "),a("upload-button",{directives:[{name:"show",rawName:"v-show",value:!e.formData.bannerAvatarIsUrl,expression:"!nuxt.formData.bannerAvatarIsUrl"}],ref:"fileInput",refInFor:!0,staticClass:"mx-0",attrs:{accept:"image/*"},on:{getPath:function(a){t.getPath(t.src,e)}}})],1),t._v(" "),a("v-divider",{staticClass:"mt-5"}),t._v(" "),a("v-card-title",{attrs:{"primary-title":""}},[a("div",[a("div",{staticClass:"headline"},[t._v("Recommend Catalog")]),t._v(" "),a("span",{staticClass:"grey--text"},[t._v("设置在客户端首页推荐的类目")])])]),t._v(" "),a("v-divider",{staticClass:"mt-5"}),t._v(" "),a("v-card-actions",[a("v-btn",{attrs:{flat:""},on:{click:function(e){t.resetForm()}}},[t._v("Clear")]),t._v(" "),a("v-spacer"),t._v(" "),a("v-btn",{attrs:{color:"primary",disabled:!t.valid,flat:""},on:{click:t.submit}},[t._v("Submit")])],1)],1)],1)],1)})):t._e()],1)},staticRenderFns:[]}},aoQU:function(t,e,a){var r=a("VU/8")(a("9en6"),a("j863"),!1,function(t){a("xt5C")},"data-v-b5d096be",null);t.exports=r.exports},j863:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("v-card",[a("v-card-media",{directives:[{name:"show",rawName:"v-show",value:t.imageUrl,expression:"imageUrl"}],ref:"imageUrl",class:{loading:t.loading},staticStyle:{cursor:"pointer"},attrs:{contain:"",src:t.imageUrl,height:"200px"},on:{click:function(e){e.stopPropagation(),t.dialog=!0}}}),t._v(" "),a("v-btn",{directives:[{name:"show",rawName:"v-show",value:0===t.progress,expression:"progress === 0"}],attrs:{large:"",block:"",raised:"",color:"info"},on:{click:t.onPickFile}},[t._v("\n            "+t._s(t.selectLabel)+"\n        ")]),t._v(" "),a("v-progress-linear",{directives:[{name:"show",rawName:"v-show",value:t.loading,expression:"loading"}],staticClass:"my-0",attrs:{height:"40",color:t.color},model:{value:t.progress,callback:function(e){t.progress=e},expression:"progress"}}),t._v(" "),a("v-btn",{directives:[{name:"show",rawName:"v-show",value:100===t.progress,expression:"progress === 100"}],staticClass:"error",attrs:{large:"",block:"",raised:""},on:{click:t.removeFile}},[t._v("\n            "+t._s(t.removeLabel)+"\n        ")]),t._v(" "),a("input",{ref:"image",attrs:{type:"file",name:"image",accept:t.accept},on:{change:t.onFilePicked}})],1),t._v(" "),a("v-dialog",{attrs:{fullscreen:"","max-width":"100%",lazy:""},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[a("v-card",{attrs:{"full-height":""}},[a("v-card-title",[a("span",[t._v("图片预览")]),t._v(" "),a("v-spacer"),t._v(" "),a("v-btn",{attrs:{icon:""},on:{click:function(e){e.stopPropagation(),t.dialog=!1}}},[a("v-icon",[t._v("clear")])],1)],1),t._v(" "),a("v-card-media",{class:{loading:t.loading},attrs:{contain:"",src:t.imageUrl,height:t.dialogHeight}}),t._v(" "),a("v-card-actions",[a("v-spacer"),t._v(" "),a("v-btn",{attrs:{flat:""},on:{click:function(e){return e.stopPropagation(),t.removeFile(e)}}},[t._v("Delete")]),t._v(" "),a("v-btn",{attrs:{color:"primary",flat:""},on:{click:function(e){e.stopPropagation(),t.dialog=!1}}},[t._v("Close")])],1)],1)],1)],1)},staticRenderFns:[]}},uJLv:function(t,e,a){var r=a("VU/8")(a("xxTv"),a("Vcw5"),!1,function(t){a("FvFi")},"data-v-f4a2a340",null);t.exports=r.exports},xt5C:function(t,e,a){var r=a("GuIv");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);a("rjj0")("11da7c18",r,!0,{})},xxTv:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=a("Xxa5"),n=a.n(r),s=a("aoQU"),i=a.n(s);function o(t){return function(){var e=t.apply(this,arguments);return new Promise(function(t,a){return function r(n,s){try{var i=e[n](s),o=i.value}catch(t){return void a(t)}if(!i.done)return Promise.resolve(o).then(function(t){r("next",t)},function(t){r("throw",t)});t(o)}("next")})}}e.default={name:"nuxt_setting",data:function(){return{query:"",bannerAvatarIsUrl:!0,tabs:0,loaded:!1,name:this.$t("nuxt_settings"),nuxts:[],loading:!1,valid:!0,titleRules:[function(t){return!!t||"Title is required"},function(t){return t&&t.length<=64||"Title must be less than 64 characters"}],tempNuxts:[]}},watch:{},components:{UploadButton:i.a},methods:{inputEvent:function(t){this.tempNuxts=this.nuxts.filter(function(e){return e.name.includes(t)||e.prefix.includes(t)})},fetch:function(){var t=this;return o(n.a.mark(function e(){var a,r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return t.loading=!0,(a={limit:"all"}).sortedBy="desc",a.orderBy="created_at",e.next=6,t.$store.dispatch("nuxt/index",a);case 6:r=e.sent,t.$set(t,"nuxts",r),t.loading=!1;case 9:case"end":return e.stop()}},e,t)}))()},submit:function(){var t=this;return o(n.a.mark(function e(){return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:if(!t.$refs.form.validate()){e.next=5;break}return e.next=3,t.$store.dispatch("post/store",{formDate:t.formDate});case 3:t.$store.dispatch("message/responseMessage",{text:t.$t("post_create_success")}),t.$router.replace({name:"post.index"});case 5:case"end":return e.stop()}},e,t)}))()},resetForm:function(){this.errorMessages=[],this.formHasErrors=!1,this.$refs.form.reset()},getPath:function(t,e){e.formData.avatar=t}},created:function(){var t=this;return o(n.a.mark(function e(){return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.fetch();case 2:t.nuxts.forEach(function(e,a){t.$set(t.nuxts[a],"formData",{avatar:"",title:"",bannerAvatarIsUrl:!0})}),t.tempNuxts=t.nuxts,t.loaded=!0;case 5:case"end":return e.stop()}},e,t)}))()}}}});
//# sourceMappingURL=0.js.map