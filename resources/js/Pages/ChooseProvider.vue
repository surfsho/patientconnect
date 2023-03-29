<script setup>
let props = defineProps({ providers: Array })
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
var selected = reactive({active: false}); 
var searchproviders = ref(props.providers);
var id = "";
function select(e){
    console.log(e);
    let active =  document.querySelector(".v-card.active");
    if(active != null) {
        active.classList.remove("active");
    }
    e.target.classList.add("active");
    id = e.target.id;
    id = id.replace("click","");
}

function click(id){
    return "click-"+id;
}



function book() {
    console.log(id);
    const urlParams = new URLSearchParams(window.location.search);
    router.get('/choosedate',{patient:urlParams.get('patient'),provider:id});
}

function search(e) {
   if(e.target.value.length == 0) {
    
    searchproviders.value = props.providers;
    return;
   }
   let h = [];
   
   for(let i of searchproviders.value) {
    if(i.fullname.toLowerCase().includes(e.target.value))
        h.push(Object.assign({},i));
   }
   searchproviders.value =h;
}

</script>
<style>
.main {
    width: 1500px;
    margin: 20px;
}
.v-card.active {
    background: darkorange;
}
</style>
<template>
<div class="main">
<v-list-subheader>Search by first and last name</v-list-subheader>
<v-text-field
label="Search"
append-inner-icon="mdi mdi-magnify" variant="outlined" @change="search"></v-text-field>
<v-container
      
    >
<v-row>
<v-col md="4" v-for="(provider,index) in searchproviders">

<v-card width="400" style="text-align:center;"  :id="'click'+provider.id" @click="select">
<v-avatar
    :image="provider.gender == 'male'?'/storage/uploads/doctor.png':'/storage/uploads/woman.png'"
    style="height:150px;width:150px;"
    >
    </v-avatar>
      <v-card-item>
        <v-card-title>{{ provider.fullname}}</v-card-title>

        <v-card-subtitle>Next Available: Thu, July 2</v-card-subtitle>
      </v-card-item>
    </v-card>
    </v-col>
    
</v-row>
<v-btn style="float:right;" @click="book">Next</v-btn>
</v-container>
</div>
</template>