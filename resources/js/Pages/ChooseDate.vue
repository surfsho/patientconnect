<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
var items = reactive([])
var item = reactive({
    date: null,
    time: null,
})
var temp = {};
function settime(time){
    item.time = time;
}
function create() {
    const urlParams = new URLSearchParams(window.location.search);
    router.post('/bookappointment',{patient:urlParams.get('patient'),provider:urlParams.get("provider"),slots:items});
}
function addpreference() {
    if(items.length == 3) {
        return;
    }
    console.log(item);
    
    temp.date = item.date.getDate()+"-"+item.date.getMonth()+"-"+item.date.getFullYear()
    temp.time = item.time;
    temp.fdate = item.date.toISOString().slice(0, 19).replace('T', ' ');
    items.push(Object.assign({},temp));
}
const configuration = {
    dateStart:new Date()
}
</script>
<style>
.datepicker-input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;

  cursor: pointer;
  box-sizing: border-box;
}

</style>

<template>
<div style="padding:20px; margin: 20px; font-size: 25px; border-bottom: 1px solid black;">
    <p>Choose a Date and Time</p>
</div>
<v-row>
<v-col cols="20" md="4">
<div class="mx-3">
<v-col cols="20" >

<p>Choose a Date</p>
</v-col>
 <VueDatePicker v-model="item.date" inline auto-apply :min-date="new Date()" />
 </div>
</v-col>
<v-col cols="20" md="4">
<v-col cols="20">
<p>Choose a Time</p>
</v-col>
<div>


<v-btn-toggle style="display:block;height:250px;" density="comfortable">
<div style="display:inline-flex;height:60px;">
<v-btn @click="settime('11:00 am')">11:00 am</v-btn>
<v-btn @click="settime('11:30 am')">11:30 am</v-btn>
<v-btn @click="settime('12:00 pm')">12:00 pm</v-btn>
<v-btn @click="settime('12:30 pm')">12:30 pm</v-btn>
</div>
<div style="display:inline-flex;height:60px;">
<v-btn @click="settime('1:00 pm')">1:00 pm</v-btn>
<v-btn @click="settime('1:30 pm')">1:30 pm</v-btn>
<v-btn @click="settime('2:00 pm')">2:00 pm</v-btn>
<v-btn @click="settime('2:30 pm')">2:30 pm</v-btn>
</div>
<div style="display:inline-flex;height:60px;">
<v-btn @click="settime('3:00 pm')">3:00 pm</v-btn>
<v-btn @click="settime('3:30 pm')">3:30 pm</v-btn>
<v-btn @click="settime('4:00 pm')">4:00 pm</v-btn>
<v-btn @click="settime('4:30 pm')">4:30 pm</v-btn>

</div>
<br>
<div style="display:inline-flex;height:60px;">
<v-btn @click="settime('5:00 pm')">5:00 pm</v-btn>
</div>
</v-btn-toggle>



<v-btn class="mt-10" @click="addpreference()">Add Preference</v-btn>
<div class="mt-10">
Preference

<v-list lines="one">
  <v-list-item
    v-for="i in items"
    
    :title="i.date"
    :subtitle="i.time"
  ></v-list-item>
</v-list>
</div>
</div>
<v-btn @click="create">Book Appointment</v-btn>
</v-col>
</v-row>

</template>