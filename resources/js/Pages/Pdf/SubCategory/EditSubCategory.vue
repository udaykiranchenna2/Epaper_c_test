<template>
    <AppLayout title="Dashboard">
        <div>
            <div class="header bg-gray-300 rounded-md my-3">
                <div class="flex ">
                    <Link :href="'/admin/sub-categories'" class="btn btn-primary m-2">List</Link>
                </div>
            </div>
            <div class="min-h-screen flex flex-col mt-10 items-center pt-6 sm:pt-0 bg-gray-100">
                <div class="w-full sm:max-w-2xl  px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="grid  grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="Title" value="Title" />
                                <TextInput id="Title" v-model="form.title" type="text" class="mt-1 block w-full"
                                    required autofocus />
                                <InputError class="mt-2" v-if="form.errors.has('title')"  :message="form.errors.get('title')" />
                            </div>
                            <div>
                                <InputLabel for="category" value="Category" />
                                <!-- <multiselect v-model="form.category" :options="categories"></multiselect> -->
                                <Multiselect v-model="form.category" :options="Categories" :searchable="true" :close-on-select="true" :show-labels="false" placeholder="Pick a value"></Multiselect>
                                <InputError class="mt-2" v-if="form.errors.has('category')"
                                    :message="form.errors.get('category')" />
                            </div>
                        </div>

                       <div class="my-2">
                        <button class="m-auto btn btn-primary" :class="{ 'opacity-25': form.busy }" :disabled="form.busy">
                            Update
                        </button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
    import AppLayout from '@/Layouts/AdminLayout.vue';
    import {
        Head,
        Link,
    } from '@inertiajs/inertia-vue3';
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import Form from 'vform';
    import {
        useToast
    } from "vue-toastification";
    import Multiselect from '@vueform/multiselect'
    export default {

        components: {
            AppLayout,
            Head,
            Link,
            TextInput,
            Checkbox,
            InputError,
            InputLabel,
            PrimaryButton,Multiselect
        },
        props:{
            Categories:Object,
            Subcategory:Object,
        },
        data() {
            return {
                form: new Form({
                    title: this.Subcategory.title,
                    id: this.Subcategory.id,
                    category: this.Subcategory.category_id,
                }),
                toast: useToast(),
            }
        },
        methods:{
           async submit()
            {
                await this.form.post('/admin/update-sub-category').then(res=>{
                    if(res.data.status)
                    {
                    this.toast.success("Sub-category has been updated!", {});
                    }else{
                        this.toast.error("Something went wrong!", {});
                    }
                })
            }
        }

    }

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
