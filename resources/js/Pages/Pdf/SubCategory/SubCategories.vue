<template>
    <AppLayout title="Dashboard">
        <div>
            <div class=" bg-gray-100">
                <div class="header bg-gray-300 rounded-md my-3">
                    <div class="flex ">
                        <Link :href="'/admin/create-sub-categories'" class="btn btn-primary m-2">Add</Link>
                    </div>
                </div>
                <Table  :data="SubCategories.data" :meta="SubCategories">
                    <template #cell(category)="{ item: subcategory }">
                        <span>{{subcategory.category.title}}</span>
                      </template>

                    <template #cell(actions)="{ item: subcategory }">
                        <Link :href="'/admin/edit-sub-category/'+subcategory.id" class="btn btn-success text-white btn-sm mx-1">
                          Edit
                        </Link>
                        <burron @click="deleteSubCategory(subcategory.id)" class="btn btn-danger text-white btn-sm mx-1">
                            Delete
                          </burron>
                      </template>
                  </Table>
            </div>


        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import {
        useToast
    } from "vue-toastification";
export default {

    components: {
        AppLayout,
        Head, Link, useForm,
         PrimaryButton,Table
    },
    props:{
        SubCategories:Object,
    },
    data() {
        return {
            toast: useToast(),
        }
    },
    methods:{
        deleteSubCategory(id)
        {
            axios.post('/admin/delete-sub-category',{id:id})
            .then(res=>{
                if(res.data.status == true)
                {
                    let index = this.SubCategories.data.findIndex((element) => {
                        return element.id === id
                    })
                    this.SubCategories.data.splice(index, 1);
                    this.toast.success('Category has been deleted')
                }
            })
        }
    }
}
</script>
