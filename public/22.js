webpackJsonp([22],{"+rpV":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=a("Xxa5"),n=a.n(r),s=a("aoQU"),o=a.n(s);function i(e,t){var a={};for(var r in e)t.indexOf(r)>=0||Object.prototype.hasOwnProperty.call(e,r)&&(a[r]=e[r]);return a}function l(e){return function(){var t=e.apply(this,arguments);return new Promise(function(e,a){return function r(n,s){try{var o=t[n](s),i=o.value}catch(e){return void a(e)}if(!o.done)return Promise.resolve(i).then(function(e){r("next",e)},function(e){r("throw",e)});e(i)}("next")})}}t.default={name:"banner-create-form",components:{UploadButton:o.a},props:{editData:{type:Object,default:null}},data:function(){return{bannerAvatarIsUrl:!0,search:null,loading:!1,posts:[],banner:{title:"",avatar:"",type:"main",link:"",post_id:null,start_at:null,end_at:null,sort:0},valid:!0,date:null,showDialogStart:!1,showDialogEnd:!1}},watch:{search:function(e){e&&this.querySelections(e)}},methods:{querySelections:function(e){var t=this;this.loading=!0,setTimeout(l(n.a.mark(function a(){var r;return n.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return r={search:"title:"+e,searchFields:"title:like"},a.next=3,t.fetchPosts(r);case 3:t.posts=a.sent,t.loading=!1;case 5:case"end":return a.stop()}},a,t)})),500)},fetchPosts:function(e){var t=this;return l(n.a.mark(function a(){var r,s;return n.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.next=2,t.$store.dispatch("post/index",e);case 2:return r=a.sent,s=r.data,a.abrupt("return",s);case 5:case"end":return a.stop()}},a,t)}))()},getPath:function(e){console.log(e),this.banner.avatar=e},resetForm:function(){this.errorMessages=[],this.formHasErrors=!1,this.$refs.form.reset()},submit:function(){var e=this;return l(n.a.mark(function t(){var a,r,s;return n.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(!e.$refs.form.validate()){t.next=15;break}if(!e.editData){t.next=10;break}return a=e.banner,r=a.id,s=i(a,["id"]),t.next=5,e.$store.dispatch("banner/update",{id:r,props:s});case 5:t.sent,e.$store.dispatch("message/responseMessage",{text:e.$t("banner_update_success")}),e.$router.replace({name:"banner.index"}),t.next=15;break;case 10:return t.next=12,e.$store.dispatch("banner/store",e.banner);case 12:t.sent,e.$store.dispatch("message/responseMessage",{text:e.$t("banner_create_success")}),e.$router.replace({name:"banner.index"});case 15:case"end":return t.stop()}},t,e)}))()}},created:function(){var e=this;return l(n.a.mark(function t(){return n.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.fetchPosts({});case 2:e.posts=t.sent,e.editData&&e.$set(e,"banner",e.editData);case 4:case"end":return t.stop()}},t,e)}))()}}},"/ybE":function(e,t,a){var r=a("VU/8")(a("+rpV"),a("LQld"),!1,function(e){a("QGef")},"data-v-8424ffc4",null);e.exports=r.exports},"9en6":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=a("Xxa5"),n=a.n(r);function s(e){return function(){var t=e.apply(this,arguments);return new Promise(function(e,a){return function r(n,s){try{var o=t[n](s),i=o.value}catch(e){return void a(e)}if(!o.done)return Promise.resolve(i).then(function(e){r("next",e)},function(e){r("throw",e)});e(i)}("next")})}}t.default={props:{value:{type:String},accept:{type:String,default:"*"},selectLabel:{type:String,default:"Select an image"},removeLabel:{type:String,default:"Remove"}},data:function(){return{imageUrl:"",progress:0,loading:!1,dialog:!1}},watch:{},mounted:function(){this.imageUrl=""},computed:{dialogHeight:function(){return this.$vuetify.breakpoint.height-100},color:function(){return["error","warning","success"][Math.floor(this.progress/40)]}},methods:{onPickFile:function(){this.$refs.image.click()},onFilePicked:function(e){var t=this;return s(n.a.mark(function a(){var r,s,o,i;return n.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:if(!(r=e.target.files||e.dataTransfer.files)||!r[0]){a.next=12;break}if(!((s=r[0].name)&&s.lastIndexOf(".")<=0)){a.next=5;break}return a.abrupt("return");case 5:return(o=new FileReader).addEventListener("load",function(){t.imageUrl=o.result}),o.readAsDataURL(r[0]),a.next=10,t.upload(r[0]);case 10:i=a.sent,t.$emit("getPath",i);case 12:case"end":return a.stop()}},a,t)}))()},removeFile:function(){this.imageUrl="",this.progress=0,this.dialog=!1,this.$store.dispatch("message/responseMessage",{text:this.$t("remove_img_success")})},upload:function(e){var t=this;return s(n.a.mark(function a(){var r,s,o,i;return n.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return r=new FormData,s={headers:{"Content-Type":"multipart/form-data"},onUploadProgress:function(e){t.progress=Math.round(100*e.loaded/e.total),t.progress>=100&&(t.loading=!1)}},r.append("avatar",e),t.loading=!0,a.next=6,t.$store.dispatch("file/uploadImage",{formData:r,config:s});case 6:return o=a.sent,i=o.data,t.loading=!1,a.abrupt("return",i);case 10:case"end":return a.stop()}},a,t)}))()}}}},GuIv:function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,"input[type=file][data-v-b5d096be]{position:absolute;left:-99999px}.loading[data-v-b5d096be]{opacity:.4}",""])},J5nq:function(e,t,a){(e.exports=a("FZ+f")(!1)).push([e.i,"",""])},LQld:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-form",{ref:"form",attrs:{"lazy-validation":""},model:{value:e.valid,callback:function(t){e.valid=t},expression:"valid"}},[a("v-card",[a("v-card-title",{attrs:{"primary-title":""}},[a("div",[a("div",{staticClass:"headline"},[e._v("Banner")]),e._v(" "),a("span",{staticClass:"grey--text"},[e._v("设置在客户端显示的海报大图")])])]),e._v(" "),a("v-card-text",[a("v-radio-group",{attrs:{row:"",label:"banner位置",mandatory:!1},model:{value:e.banner.type,callback:function(t){e.$set(e.banner,"type",t)},expression:"banner.type"}},[a("v-radio",{attrs:{label:"首页头部巨幕海报",value:"main"}}),e._v(" "),a("v-radio",{attrs:{label:"首页中部海报",value:"mid"}})],1),e._v(" "),a("v-text-field",{attrs:{label:"Banner标题",rules:[function(){return!!e.banner.title||"title is required!!"}],counter:32,required:""},model:{value:e.banner.title,callback:function(t){e.$set(e.banner,"title",t)},expression:"banner.title"}}),e._v(" "),a("v-radio-group",{attrs:{row:"",label:"banner图片",mandatory:!1},model:{value:e.bannerAvatarIsUrl,callback:function(t){e.bannerAvatarIsUrl=t},expression:"bannerAvatarIsUrl"}},[a("v-radio",{attrs:{label:"url地址",value:!0}}),e._v(" "),a("v-radio",{attrs:{label:"上传图片",value:!1}})],1),e._v(" "),a("v-text-field",{directives:[{name:"show",rawName:"v-show",value:e.bannerAvatarIsUrl,expression:"bannerAvatarIsUrl"}],attrs:{label:"图片地址",required:""},model:{value:e.banner.avatar,callback:function(t){e.$set(e.banner,"avatar",t)},expression:"banner.avatar"}}),e._v(" "),a("upload-button",{directives:[{name:"show",rawName:"v-show",value:!e.bannerAvatarIsUrl,expression:"!bannerAvatarIsUrl"}],ref:"fileInput",staticClass:"mx-0",attrs:{accept:"image/*"},on:{getPath:e.getPath}}),e._v(" "),a("v-select",{attrs:{clearable:"",label:"关联文章","item-text":"title","item-value":"id",autocomplete:"",loading:e.loading,"cache-items":"",chips:"",items:e.posts,"search-input":e.search},on:{"update:searchInput":function(t){e.search=t}},model:{value:e.banner.post_id,callback:function(t){e.$set(e.banner,"post_id",t)},expression:"banner.post_id"}}),e._v(" "),a("v-text-field",{attrs:{disabled:!!e.banner.post_id,label:"链接地址"},model:{value:e.banner.link,callback:function(t){e.$set(e.banner,"link",t)},expression:"banner.link"}}),e._v(" "),a("v-text-field",{attrs:{label:"排序权重",required:"",rules:[function(){return/^-?\d+$/.test(e.banner.sort)||"必须为数字"}]},model:{value:e.banner.sort,callback:function(t){e.$set(e.banner,"sort",t)},expression:"banner.sort"}}),e._v(" "),a("v-layout",{attrs:{row:"",wrap:""}},[a("v-flex",{attrs:{xs12:"",sm6:""}},[a("v-dialog",{ref:"dialogStart",attrs:{persistent:"",lazy:"","full-width":"",width:"290px","return-value":e.banner.start_at},on:{"update:returnValue":function(t){e.$set(e.banner,"start_at",t)}},model:{value:e.showDialogStart,callback:function(t){e.showDialogStart=t},expression:"showDialogStart"}},[a("v-text-field",{attrs:{slot:"activator",label:"开始时间","prepend-icon":"event",readonly:""},slot:"activator",model:{value:e.banner.start_at,callback:function(t){e.$set(e.banner,"start_at",t)},expression:"banner.start_at"}}),e._v(" "),a("v-date-picker",{attrs:{scrollable:""},model:{value:e.banner.start_at,callback:function(t){e.$set(e.banner,"start_at",t)},expression:"banner.start_at"}},[a("v-spacer"),e._v(" "),a("v-btn",{attrs:{flat:"",color:"primary"},on:{click:function(t){e.showDialogStart=!1}}},[e._v("Cancel")]),e._v(" "),a("v-btn",{attrs:{flat:"",color:"primary"},on:{click:function(t){e.$refs.dialogStart.save(e.banner.start_at)}}},[e._v("OK")])],1)],1)],1),e._v(" "),a("v-flex",{attrs:{xs12:"",sm6:""}},[a("v-spacer"),e._v(" "),a("v-dialog",{ref:"dialogEnd",attrs:{persistent:"",lazy:"","full-width":"",width:"290px","return-value":e.banner.end_at},on:{"update:returnValue":function(t){e.$set(e.banner,"end_at",t)}},model:{value:e.showDialogEnd,callback:function(t){e.showDialogEnd=t},expression:"showDialogEnd"}},[a("v-text-field",{attrs:{slot:"activator",label:"结束时间","prepend-icon":"event",readonly:""},slot:"activator",model:{value:e.banner.end_at,callback:function(t){e.$set(e.banner,"end_at",t)},expression:"banner.end_at"}}),e._v(" "),a("v-date-picker",{attrs:{scrollable:""},model:{value:e.banner.end_at,callback:function(t){e.$set(e.banner,"end_at",t)},expression:"banner.end_at"}},[a("v-spacer"),e._v(" "),a("v-btn",{attrs:{flat:"",color:"primary"},on:{click:function(t){e.showDialogEnd=!1}}},[e._v("Cancel")]),e._v(" "),a("v-btn",{attrs:{flat:"",color:"primary"},on:{click:function(t){e.$refs.dialogEnd.save(e.banner.end_at)}}},[e._v("OK")])],1)],1)],1)],1)],1),e._v(" "),a("v-divider",{staticClass:"mt-2"}),e._v(" "),a("v-card-actions",[a("v-btn",{attrs:{flat:""},on:{click:e.resetForm}},[e._v("Clear")]),e._v(" "),a("v-spacer"),e._v(" "),a("v-btn",{attrs:{color:"primary",disabled:!e.valid,flat:""},on:{click:e.submit}},[e._v("Submit")])],1)],1)],1)},staticRenderFns:[]}},QGef:function(e,t,a){var r=a("J5nq");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("cefacd9c",r,!0,{})},aoQU:function(e,t,a){var r=a("VU/8")(a("9en6"),a("j863"),!1,function(e){a("xt5C")},"data-v-b5d096be",null);e.exports=r.exports},j863:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("v-card",[a("v-card-media",{directives:[{name:"show",rawName:"v-show",value:e.imageUrl,expression:"imageUrl"}],ref:"imageUrl",class:{loading:e.loading},staticStyle:{cursor:"pointer"},attrs:{contain:"",src:e.imageUrl,height:"200px"},on:{click:function(t){t.stopPropagation(),e.dialog=!0}}}),e._v(" "),a("v-btn",{directives:[{name:"show",rawName:"v-show",value:0===e.progress,expression:"progress === 0"}],attrs:{large:"",block:"",raised:"",color:"info"},on:{click:e.onPickFile}},[e._v("\n            "+e._s(e.selectLabel)+"\n        ")]),e._v(" "),a("v-progress-linear",{directives:[{name:"show",rawName:"v-show",value:e.loading,expression:"loading"}],staticClass:"my-0",attrs:{height:"40",color:e.color},model:{value:e.progress,callback:function(t){e.progress=t},expression:"progress"}}),e._v(" "),a("v-btn",{directives:[{name:"show",rawName:"v-show",value:100===e.progress,expression:"progress === 100"}],staticClass:"error",attrs:{large:"",block:"",raised:""},on:{click:e.removeFile}},[e._v("\n            "+e._s(e.removeLabel)+"\n        ")]),e._v(" "),a("input",{ref:"image",attrs:{type:"file",name:"image",accept:e.accept},on:{change:e.onFilePicked}})],1),e._v(" "),a("v-dialog",{attrs:{fullscreen:"","max-width":"100%",lazy:""},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[a("v-card",{attrs:{"full-height":""}},[a("v-card-title",[a("span",[e._v("图片预览")]),e._v(" "),a("v-spacer"),e._v(" "),a("v-btn",{attrs:{icon:""},on:{click:function(t){t.stopPropagation(),e.dialog=!1}}},[a("v-icon",[e._v("clear")])],1)],1),e._v(" "),a("v-card-media",{class:{loading:e.loading},attrs:{contain:"",src:e.imageUrl,height:e.dialogHeight}}),e._v(" "),a("v-card-actions",[a("v-spacer"),e._v(" "),a("v-btn",{attrs:{flat:""},on:{click:function(t){return t.stopPropagation(),e.removeFile(t)}}},[e._v("Delete")]),e._v(" "),a("v-btn",{attrs:{color:"primary",flat:""},on:{click:function(t){t.stopPropagation(),e.dialog=!1}}},[e._v("Close")])],1)],1)],1)],1)},staticRenderFns:[]}},xt5C:function(e,t,a){var r=a("GuIv");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);a("rjj0")("11da7c18",r,!0,{})}});
//# sourceMappingURL=22.js.map