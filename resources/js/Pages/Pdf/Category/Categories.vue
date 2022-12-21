<template>
    <AppLayout title="Dashboard">
        <div>
            <div class=" bg-gray-100">
                <div class="header bg-gray-300 rounded-md my-3">
                    <div class="flex ">
                        <Link :href="'/admin/create-categories'" class="btn btn-primary m-2">Add</Link>
                    </div>
                </div>
                <Table  :data="Categories.data" :meta="Categories">
                    <template #cell(actions)="{ item: category }">
                        <Link :href="'/admin/edit-category/'+category.id" class="btn btn-success text-white btn-sm mx-1">
                          Edit 
                       
                        </Link>
                        <burron @click="deleteCategory(category.id)" class="btn btn-danger text-white btn-sm mx-1">
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
        Categories:Object,
    },
    data() {
        return {
            toast: useToast(),
        }
    },
    methods:{
        deleteCategory(id)
        {
            axios.post('/admin/delete-category',{id:id})
            .then(res=>{
                if(res.data.status == true)
                {
                    let index = this.Categories.data.findIndex((element) => {
                        return element.id === id
                    })
                    this.Categories.data.splice(index, 1);
                    this.toast.success('Category has been deleted')
                }
            })
        }
    }
}
</script>
