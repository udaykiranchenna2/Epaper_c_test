<template>
    <AppLayout title="Dashboard">
        <div>
            <div class="min-h-screen flex flex-col mt-10 items-center pt-6 sm:pt-0 bg-gray-100">


                <div class="w-full sm:max-w-2xl  px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg h-screen">
                    <form @submit.prevent="submit">
                        <div class="grid  grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="Title" value="Title" />
                                <TextInput id="Title" v-model="form.title" type="text" class="mt-1 block w-full"
                                    required autofocus />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="">
                                <InputLabel for="date" value="Date" />
                                <TextInput id="Date" v-model="form.date" type="date" class="mt-1 block w-full" required
                                    autocomplete="current-password" />
                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>


                            <div>
                                <InputLabel for="category" value="Category" />
                                <!-- <multiselect v-model="form.category" :options="categories"></multiselect> -->
                                <Multiselect v-model="form.category" :options="Categories" :searchable="true"
                                    :close-on-select="true" :show-labels="false" placeholder="Pick a value">
                                </Multiselect>
                                <InputError class="mt-2" v-if="form.errors.has('category')"
                                    :message="form.errors.get('category')" />
                            </div>
                            <!-- <div>
                                <InputLabel for="sub-category" value="Sub category" />
                                <Multiselect v-model="form.sub_category" :options="Subcategories" :searchable="true"
                                    :close-on-select="true" :show-labels="false" placeholder="Pick a value">
                                </Multiselect>
                                <InputError class="mt-2" v-if="form.errors.has('sub_category')"
                                    :message="form.errors.get('sub_category')" />
                            </div> -->
                            <div class=" col-span-2">
                                <InputLabel for="pdf" value="PDF" />
                                <form action="/file-upload" class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple id="file" ref="filepdf"
                                            v-on:change="handleFileUpload()" /> </div>
                                    <!-- <div class="dz-message" data-dz-message>
                                    <div class="text-lg font-medium">Drop files here or click to upload.</div>
                                    <div class="text-slate-500"> This is just a demo dropzone. Selected files are <span class="font-medium">not</span> actually uploaded. </div>
                                </div> -->
                                </form>
                                <InputError class="mt-2" :message="form.errors.pdf" />
                            </div>

                            <button class="btn btn-ptimary" @click="uploadPdf">Upload</button>

                            <!-- <div class="col-span-2">
                                <InputLabel for="type" value="Type" />
                                <div class="form-check mt-2"> <input id="radio-switch-1" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-chris-evans"> <label class="form-check-label" for="radio-switch-1">Main Edition</label> </div>
                                <div class="form-check mt-2"> <input id="radio-switch-2" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-liam-neeson"> <label class="form-check-label" for="radio-switch-2">Liam Neeson</label> </div>
                                <div class="form-check mt-2"> <input id="radio-switch-3" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-daniel-craig"> <label class="form-check-label" for="radio-switch-3">Daniel Craig</label> </div>
                                        <br />

                            </div> -->

                        </div>

                        <div class="my-3" v-if="form.busy">
                            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="progresswidth(progress)"> {{progress}}%</div>
                              </div>
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
        useForm
    } from '@inertiajs/inertia-vue3';
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import Multiselect from '@vueform/multiselect';
    import Form from 'vform';
    import {
        useToast
    } from "vue-toastification";
    import {
        objectToFormData
    } from 'object-to-formdata'
    import axios from 'axios';
    export default {
        props: {
            Categories: Object,
        },
        components: {
            AppLayout,
            Head,
            Link,
            useForm,
            TextInput,
            Checkbox,
            InputError,
            InputLabel,
            PrimaryButton,
            Multiselect,

        },
        data() {
            return {
                form: new Form({
                    title: '',
                    date: new Date().toISOString().substr(0, 10)
                }),
                toast: useToast(),
                Subcategories: [],
                progress:0
            }
        },
        methods: {
            getFormData(object) {
                const formData = new FormData();
                Object.keys(object).forEach(key => formData.append(key, object[key]));
                return formData;
            },
            loadSubCategories(id) {
                axios.post('/admin/load-sub-categories-by-id', {
                    id: id
                }).then(res => {
                    this.Subcategories = res.data.Subcategories;
                })
            },
            handleFileUpload() {
                this.form.pdf = this.$refs.filepdf.files[0];
            },
            async uploadPdf() {
                const response = await this.form.post('/admin/storeepaper', {
                        transformRequest: [data => this.getFormData(data)],
                        onUploadProgress: e => {
                        let pp = parseInt(Math.round((e.loaded/e.total)*100));
                        if(pp<=75)
                        {
                         this.progress = pp;
                        }

                    }
                    })

                    .then(res => {
                        console.log(res.data);
                        if(res.data.status == true)
                        {
                            this.progress = 100;
                            this.toast.success("Today's news has been upload!", {});
                        }
                    });

            },
            progresswidth(percentage)
            {
                return 'width:'+percentage+'%;';
            }
        }
    }

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
