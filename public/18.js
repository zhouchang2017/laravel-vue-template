webpackJsonp([18],{ce1J:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=r("Xxa5"),a=r.n(n),s=r("2gGM"),o=r.n(s);t.default={name:"email-view",metaInfo:function(){return{title:this.$t("reset_password")}},data:function(){return{form:new o.a({email:""})}},methods:{send:function(){var e,t=this;return(e=a.a.mark(function e(){var r,n;return a.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.formHasErrors();case 2:if(!e.sent){e.next=4;break}return e.abrupt("return");case 4:return e.next=6,t.form.post("/api/password/email");case 6:r=e.sent,n=r.data,t.$store.dispatch("message/responseMessage",{type:"success",text:n.status}),t.$router.push({name:"welcome"});case 10:case"end":return e.stop()}},e,t)}),function(){var t=e.apply(this,arguments);return new Promise(function(e,r){return function n(a,s){try{var o=t[a](s),i=o.value}catch(e){return void r(e)}if(!o.done)return Promise.resolve(i).then(function(e){n("next",e)},function(e){n("throw",e)});e(i)}("next")})})()}}}},h0Uh:function(e,t,r){var n=r("VU/8")(r("ce1J"),r("kvwA"),!1,null,null,null);e.exports=n.exports},kvwA:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("v-layout",{attrs:{row:""}},[r("v-flex",{attrs:{xs12:"",sm8:"","offset-sm2":"",lg4:"","offset-lg4":""}},[r("v-card",[r("progress-bar",{attrs:{show:e.form.busy}}),e._v(" "),r("form",{on:{submit:function(t){return t.preventDefault(),e.send(t)},keydown:function(t){e.form.onKeydown(t)}}},[r("v-card-title",{attrs:{"primary-title":""}},[r("h3",{staticClass:"headline mb-0"},[e._v(e._s(e.$t("reset_password")))])]),e._v(" "),r("v-card-text",[r("email-input",{directives:[{name:"validate",rawName:"v-validate",value:"required|email",expression:"'required|email'"}],attrs:{form:e.form,label:e.$t("email"),"v-errors":e.errors,value:e.form.email,name:"email"},on:{"update:value":function(t){e.$set(e.form,"email",t)}}})],1),e._v(" "),r("v-card-actions",[r("submit-button",{attrs:{flat:!0,form:e.form,label:e.$t("send_password_reset_link")}})],1)],1)],1)],1)],1)},staticRenderFns:[]}}});
//# sourceMappingURL=18.js.map