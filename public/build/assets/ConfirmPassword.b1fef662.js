import{u as m,d,e as c,b as a,h as e,w as r,F as u,o as p,H as f,a as o,n as _,g as w,m as b}from"./app.a072a467.js";import{A as g}from"./AuthenticationCard.e5630cc5.js";import{_ as h}from"./AuthenticationCardLogo.63561d44.js";import{_ as x,a as v}from"./TextInput.a7652268.js";import{_ as y}from"./InputLabel.4c12adfa.js";import{_ as V}from"./PrimaryButton.5d4b0423.js";import"./_plugin-vue_export-helper.cdc0426e.js";const C=o("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),$=["onSubmit"],k={class:"flex justify-end mt-4"},j={__name:"ConfirmPassword",setup(F){const s=m({password:""}),t=d(null),n=()=>{s.post(route("password.confirm"),{onFinish:()=>{s.reset(),t.value.focus()}})};return(A,i)=>(p(),c(u,null,[a(e(f),{title:"Secure Area"}),a(g,null,{logo:r(()=>[a(h)]),default:r(()=>[C,o("form",{onSubmit:b(n,["prevent"])},[o("div",null,[a(y,{for:"password",value:"Password"}),a(x,{id:"password",ref_key:"passwordInput",ref:t,modelValue:e(s).password,"onUpdate:modelValue":i[0]||(i[0]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(v,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),o("div",k,[a(V,{class:_(["ml-4",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:r(()=>[w(" Confirm ")]),_:1},8,["class","disabled"])])],40,$)]),_:1})],64))}};export{j as default};
