<script setup>
import {reactive} from 'vue';
import {router} from '@inertiajs/vue3';
let form = reactive({
    name:"",
    template:"",
    type:""
})

function create() {
    router.post('/newtemplate',form);
}

</script>
<template>
<v-form v-model="valid" style="width:400px;padding:10px;">
<h1>Create Template</h1>
<v-list-subheader>Template name</v-list-subheader>
<v-text-field
    v-model="form.name"
        :rules="firstNameRules"
      ></v-text-field>
<v-list-subheader>Template</v-list-subheader>
      <v-textarea
        v-model="form.template"
        :rules="lastNameRules"
      ></v-textarea>
    <v-list-subheader>Template Type</v-list-subheader>
      <v-select v-model="form.type" :items='["Appointment confirmation","General Notifications","Payment Reminders","Patient Forms","Review Notifications","Chats"]'></v-select>
      <v-btn  @click="create">Submit</v-btn>
</v-form>
</template>