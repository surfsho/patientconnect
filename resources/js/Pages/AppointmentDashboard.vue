<script setup>
import { ref, reactive, watch } from 'vue'
import { router } from '@inertiajs/vue3'
let props = defineProps({ patients: Array, providers: Array, messages: Array })
//reactive v-model
let dialog = reactive([]);
for(let i in props.patients) {
  dialog[i] =  false;
}

let pageno = ref(0);

function cpage(page) {
  pageno.value = page-1;
  console.log(pageno);
}


let mindex = ref("");
let tindex = ref(0);
let mtemplate = ref("");
console.log(props.messages);

function sel(data) {
  console.log(data);
  tindex.value = data-1;
  mtemplate.value = props.messages[tindex.value].template;
}

console.log(dialog);
let form = reactive({
  starttime: "",
  endtime: "",
  patient_id: "",
  patient_name: "",
  provider: "",
  location: "",
})
let selectedTasks=[];
function selectAll(p) {
  console.log(p)
}

let rp = ref(props.patients);
console.log(rp.value);
//filter by starttime endtime provider location patient id patient_name 
function filter() {
  console.log(form.provider);
  let correct = false;
  let p = [];
  console.log(form);
  for(let i of props.patients){
    let name = i.first_name+" "+i.last_name;
    console.log(name);
    if(i.appt_time.substring(0,5) >= form.starttime && i.appt_time.substring(0,5) <= form.endtime)
      correct =  true;
    else if(i.patient_id == form.patient_id)
      correct = true;
    else if(name.localeCompare(form.patient_name) == 0)
      correct = true;
    else if(i.full_name.localeCompare(form.provider) == 0)
      correct = true;
    else if(i.state.localeCompare(form.location) == 0)
      correct = true;
    
    if(correct) {
      console.log(i);
      console.log(i.appt_time.substring(0,5)==form.starttime);
      console.log(i.patient_id,form.patient_id);
      p.push(Object.assign({},i));
    }
    correct = false;
  }
  console.log(p);
  if(form.starttime.length == 0 && form.endtime.length == 0 && form.patient_id.length == 0 && form.patient_name.length == 0 && form.provider.length == 0 && form.location.length == 0)
    rp.value = props.patients;
  else
    rp.value = p;
}
//watch for v-select because events not working
watch(form,filter);
console.log(props.patients.length);
//table header
var headers=[{title:"Time",key:"giventime"},
{title:"Patient Name", key:"first_name"},

{title:"Patient ID", key:"patient_id"},
{title:"Provider", key:"full_name"},
{title:"Location", key:"state"},
{title:"Email", key:"email_address"},
{title:"Phone", key:"phone_number"}];

function submit(email2) {
  router.post('/sendemail',{email:email2});
}

function sendEmail(index) {
  const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

  console.log(tindex.value);
  console.log(props.messages[tindex.value]);
  console.log(index);
  console.log(rp.value);
  let lindex = pageno.value*10+index;

  let current = rp.value[lindex];
  console.log(current);
  
  let r = props.messages[tindex.value].template.replace(/{{\s*name\s*}}/,current.first_name+" "+current.last_name);
  r = r.replace(/{{\s*date\s*}}/,current.appt_date);
  r = r.replace(/{{\s*provider\s*}}/,current.full_name);
  r = r.replace(/{{\s*day\s*}}/,weekday[new Date(current.appt_date).getDay()]);
  r = r.replace(/{{\s*time\s*}}/,(new Date(current.appt_time+" "+current.appt_date).getHours() )+" Hours")
  console.log(r);
  router.post('/sendemail',{email:current.email_address,message:r});
  dialog[index] = false;
}

function activate(index) {
  console.log(index);
  dialog[index] = true;
}

function deactivate(index) {
  dialog[index] = false;
}
</script>
<template>
<div style="padding:20px; margin: 20px; font-size: 25px; border-bottom: 1px solid black;">
    <p>Appointment Dashboard</p>
</div>
<v-row class="ma-4">
<v-col cols="2">
<v-list-subheader>Start Time</v-list-subheader>

<v-text-field variant="outlined" type="time" @change="filter" v-model="form.starttime">
</v-text-field>
</v-col>
<v-col cols="2">
<v-list-subheader>End Time</v-list-subheader>

<v-text-field variant="outlined" type="time" @change="filter" v-model="form.endtime">
</v-text-field>
</v-col>
<v-col cols="2">
<v-list-subheader>Patient Id</v-list-subheader>

<v-text-field variant="outlined" placeholder="Enter patient ID" @change="filter" v-model="form.patient_id">
</v-text-field>
</v-col>
<v-col cols="2">
<v-list-subheader>Patient Name</v-list-subheader>

<v-text-field variant="outlined" placeholder="Enter patient Name" @change="filter" v-model="form.patient_name"></v-text-field>

</v-col>
<v-col cols="2">
<v-list-subheader>Provider</v-list-subheader>

<v-select variant="outlined" :items="providers" @input="filter"  v-model="form.provider"></v-select>

</v-col>
<v-col cols="2">
<v-list-subheader>Location</v-list-subheader>

<v-select variant="outlined" :items="patients.map(function(i){return i.state})" @input="filter"  v-model="form.location"></v-select>

</v-col>
</v-row>

<v-data-table
    style="margin:20px;"
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="rp" 
    item-value="name"
    class="elevation-1"
     show-select
    @update:page="cpage"
  >
  
  
   <template v-slot:item="{ item, index}">
      <tr>
      
        <td>
        <v-checkbox></v-checkbox>
        </td>
        <td>
        <div>
          Preference  {{ rp[pageno*10+index].preference}}
            {{ rp[index].appt_time }}
            {{ rp[index].appt_date }}
        </div>
        </td>
        <td>{{ item.columns.first_name }} {{ rp[pageno*10+index].last_name}}</td>
        <td>{{ item.columns.patient_id }}</td>
        <td>{{ item.columns.full_name }}</td>
        <td>{{ item.columns.state }}</td>
        <td>{{ item.columns.email_address }} <v-btn @click="activate(index)">Send
        
        

        </v-btn>
        <v-dialog
        v-model="dialog[index]"
        width="500"
      >
        <v-card>
          <v-card-text>
            <v-list-subheader>Notification Type</v-list-subheader>
            <v-select
  label="Select"
  v-model="mindex"
  item-value="id"
  item-title="name"
  :items="messages"
  @update:modelValue="sel"
></v-select>
<v-list-subheader>Template</v-list-subheader>
<v-textarea label="Label" v-model="mtemplate"></v-textarea>
          </v-card-text>
          <v-card-actions>
            <v-btn color="orange" style="float:right;" @click="sendEmail(index)">Send Email</v-btn>
            <v-btn color="primary" @click="deactivate(index)">Close Dialog</v-btn>
            
          </v-card-actions>
        </v-card>
      </v-dialog></td>
        <td>{{ item.columns.phone_number }}</td>
      </tr>
    </template>
  </v-data-table>
</template>