import{o as i,c as L,w as e,a as t,r as y,u as x,d as b,e as c,b as o,f as v,g as n,h as a,F as $,i as w,t as k,n as C}from"./app.150167c1.js";import{_ as M}from"./ActionMessage.c9ab4a64.js";import{_ as U}from"./ActionSection.14c524dd.js";import{_ as T}from"./Checkbox.6e1fc067.js";import{_ as z,a as S}from"./DialogModal.7e5689ff.js";import{_ as W}from"./DangerButton.d6a1b2f7.js";import{_ as E}from"./FormSection.4b446a39.js";import{_ as Y,a as q}from"./TextInput.d686f9ba.js";import{_ as B}from"./InputLabel.0a5821c1.js";import{_ as F}from"./PrimaryButton.be32a831.js";import{_ as A}from"./SecondaryButton.df8bccde.js";import{S as G}from"./SectionBorder.50ea6de9.js";import"./SectionTitle.e746243c.js";import"./_plugin-vue_export-helper.cdc0426e.js";const H={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},J={class:"sm:flex sm:items-start"},K=t("div",{class:"mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"},[t("svg",{class:"h-6 w-6 text-red-600",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"})])],-1),O={class:"mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"},Q={class:"text-lg"},R={class:"mt-2"},X={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-right"},Z={__name:"ConfirmationModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(d,{emit:P}){const r=()=>{P("close")};return(m,h)=>(i(),L(z,{show:d.show,"max-width":d.maxWidth,closeable:d.closeable,onClose:r},{default:e(()=>[t("div",H,[t("div",J,[K,t("div",O,[t("h3",Q,[y(m.$slots,"title")]),t("div",R,[y(m.$slots,"content")])])])]),t("div",X,[y(m.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}},ee={class:"col-span-6 sm:col-span-4"},se={key:0,class:"col-span-6"},te={class:"mt-2 grid grid-cols-1 md:grid-cols-2 gap-4"},oe={class:"flex items-center"},le={class:"ml-2 text-sm text-gray-600"},ne={key:0},ae={class:"mt-10 sm:mt-0"},ie={class:"space-y-6"},re={class:"flex items-center"},ce={key:0,class:"text-sm text-gray-400"},de=["onClick"],me=["onClick"],ue=t("div",null," Please copy your new API token. For your security, it won't be shown again. ",-1),pe={key:0,class:"mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500"},fe={class:"grid grid-cols-1 md:grid-cols-2 gap-4"},_e={class:"flex items-center"},ve={class:"ml-2 text-sm text-gray-600"},Fe={__name:"ApiTokenManager",props:{tokens:Array,availablePermissions:Array,defaultPermissions:Array},setup(d){const r=x({name:"",permissions:d.defaultPermissions}),m=x({permissions:[]}),h=x(),g=b(!1),p=b(null),f=b(null),I=()=>{r.post(route("api-tokens.store"),{preserveScroll:!0,onSuccess:()=>{g.value=!0,r.reset()}})},V=u=>{m.permissions=u.abilities,p.value=u},j=()=>{m.put(route("api-tokens.update",p.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>p.value=null})},D=u=>{f.value=u},N=()=>{h.delete(route("api-tokens.destroy",f.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>f.value=null})};return(u,l)=>(i(),c("div",null,[o(E,{onSubmitted:I},{title:e(()=>[n(" Create API Token ")]),description:e(()=>[n(" API tokens allow third-party services to authenticate with our application on your behalf. ")]),form:e(()=>[t("div",ee,[o(B,{for:"name",value:"Name"}),o(Y,{id:"name",modelValue:a(r).name,"onUpdate:modelValue":l[0]||(l[0]=s=>a(r).name=s),type:"text",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"]),o(q,{message:a(r).errors.name,class:"mt-2"},null,8,["message"])]),d.availablePermissions.length>0?(i(),c("div",se,[o(B,{for:"permissions",value:"Permissions"}),t("div",te,[(i(!0),c($,null,w(d.availablePermissions,s=>(i(),c("div",{key:s},[t("label",oe,[o(T,{checked:a(r).permissions,"onUpdate:checked":l[1]||(l[1]=_=>a(r).permissions=_),value:s},null,8,["checked","value"]),t("span",le,k(s),1)])]))),128))])])):v("",!0)]),actions:e(()=>[o(M,{on:a(r).recentlySuccessful,class:"mr-3"},{default:e(()=>[n(" Created. ")]),_:1},8,["on"]),o(F,{class:C({"opacity-25":a(r).processing}),disabled:a(r).processing},{default:e(()=>[n(" Create ")]),_:1},8,["class","disabled"])]),_:1}),d.tokens.length>0?(i(),c("div",ne,[o(G),t("div",ae,[o(U,null,{title:e(()=>[n(" Manage API Tokens ")]),description:e(()=>[n(" You may delete any of your existing tokens if they are no longer needed. ")]),content:e(()=>[t("div",ie,[(i(!0),c($,null,w(d.tokens,s=>(i(),c("div",{key:s.id,class:"flex items-center justify-between"},[t("div",null,k(s.name),1),t("div",re,[s.last_used_ago?(i(),c("div",ce," Last used "+k(s.last_used_ago),1)):v("",!0),d.availablePermissions.length>0?(i(),c("button",{key:1,class:"cursor-pointer ml-6 text-sm text-gray-400 underline",onClick:_=>V(s)}," Permissions ",8,de)):v("",!0),t("button",{class:"cursor-pointer ml-6 text-sm text-red-500",onClick:_=>D(s)}," Delete ",8,me)])]))),128))])]),_:1})])])):v("",!0),o(S,{show:g.value,onClose:l[3]||(l[3]=s=>g.value=!1)},{title:e(()=>[n(" API Token ")]),content:e(()=>[ue,u.$page.props.jetstream.flash.token?(i(),c("div",pe,k(u.$page.props.jetstream.flash.token),1)):v("",!0)]),footer:e(()=>[o(A,{onClick:l[2]||(l[2]=s=>g.value=!1)},{default:e(()=>[n(" Close ")]),_:1})]),_:1},8,["show"]),o(S,{show:p.value!=null,onClose:l[6]||(l[6]=s=>p.value=null)},{title:e(()=>[n(" API Token Permissions ")]),content:e(()=>[t("div",fe,[(i(!0),c($,null,w(d.availablePermissions,s=>(i(),c("div",{key:s},[t("label",_e,[o(T,{checked:a(m).permissions,"onUpdate:checked":l[4]||(l[4]=_=>a(m).permissions=_),value:s},null,8,["checked","value"]),t("span",ve,k(s),1)])]))),128))])]),footer:e(()=>[o(A,{onClick:l[5]||(l[5]=s=>p.value=null)},{default:e(()=>[n(" Cancel ")]),_:1}),o(F,{class:C(["ml-3",{"opacity-25":a(m).processing}]),disabled:a(m).processing,onClick:j},{default:e(()=>[n(" Save ")]),_:1},8,["class","disabled"])]),_:1},8,["show"]),o(Z,{show:f.value!=null,onClose:l[8]||(l[8]=s=>f.value=null)},{title:e(()=>[n(" Delete API Token ")]),content:e(()=>[n(" Are you sure you would like to delete this API token? ")]),footer:e(()=>[o(A,{onClick:l[7]||(l[7]=s=>f.value=null)},{default:e(()=>[n(" Cancel ")]),_:1}),o(W,{class:C(["ml-3",{"opacity-25":a(h).processing}]),disabled:a(h).processing,onClick:N},{default:e(()=>[n(" Delete ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{Fe as default};
