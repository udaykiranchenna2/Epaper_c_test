import{_ as h}from"./AdminLayout.8e81396a.js";import{H as x,L as v,M as w,c as i,w as d,D as s,o as n,a as e,b as a,g as L,m as k,f as p,n as V}from"./app.a072a467.js";import{_ as C}from"./Checkbox.5fa227e1.js";import{_ as I,a as S}from"./TextInput.a7652268.js";import{_ as T}from"./InputLabel.4c12adfa.js";import{_ as M}from"./PrimaryButton.5d4b0423.js";import{g as B}from"./vform.es.70f98f00.js";import{s as E}from"./default.css_vue_type_style_index_0_src_true_lang.165296d4.js";import{_ as N}from"./_plugin-vue_export-helper.cdc0426e.js";import"./DropdownLink.8d601aa9.js";const A={components:{AppLayout:h,Head:x,Link:v,TextInput:I,Checkbox:C,InputError:S,InputLabel:T,PrimaryButton:M,Multiselect:E},props:{Categories:Object,Subcategory:Object},data(){return{form:new B({title:this.Subcategory.title,id:this.Subcategory.id,category:this.Subcategory.category_id}),toast:w()}},methods:{async submit(){await this.form.post("/admin/update-sub-category").then(l=>{l.data.status?this.toast.success("Sub-category has been updated!",{}):this.toast.error("Something went wrong!",{})})}}},U={class:"header bg-gray-300 rounded-md my-3"},j={class:"flex"},D={class:"min-h-screen flex flex-col mt-10 items-center pt-6 sm:pt-0 bg-gray-100"},H={class:"w-full sm:max-w-2xl px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"},O={class:"grid grid-cols-2 gap-4"},P={class:"my-2"},q=["disabled"];function z(l,o,f,F,t,m){const _=s("Link"),c=s("InputLabel"),g=s("TextInput"),u=s("InputError"),b=s("Multiselect"),y=s("AppLayout");return n(),i(y,{title:"Dashboard"},{default:d(()=>[e("div",null,[e("div",U,[e("div",j,[a(_,{href:"/admin/sub-categories",class:"btn btn-primary m-2"},{default:d(()=>[L("List")]),_:1})])]),e("div",D,[e("div",H,[e("form",{onSubmit:o[2]||(o[2]=k((...r)=>m.submit&&m.submit(...r),["prevent"]))},[e("div",O,[e("div",null,[a(c,{for:"Title",value:"Title"}),a(g,{id:"Title",modelValue:t.form.title,"onUpdate:modelValue":o[0]||(o[0]=r=>t.form.title=r),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"]),t.form.errors.has("title")?(n(),i(u,{key:0,class:"mt-2",message:t.form.errors.get("title")},null,8,["message"])):p("",!0)]),e("div",null,[a(c,{for:"category",value:"Category"}),a(b,{modelValue:t.form.category,"onUpdate:modelValue":o[1]||(o[1]=r=>t.form.category=r),options:f.Categories,searchable:!0,"close-on-select":!0,"show-labels":!1,placeholder:"Pick a value"},null,8,["modelValue","options"]),t.form.errors.has("category")?(n(),i(u,{key:0,class:"mt-2",message:t.form.errors.get("category")},null,8,["message"])):p("",!0)])]),e("div",P,[e("button",{class:V(["m-auto btn btn-primary",{"opacity-25":t.form.busy}]),disabled:t.form.busy}," Update ",10,q)])],32)])])])]),_:1})}const ee=N(A,[["render",z]]);export{ee as default};
