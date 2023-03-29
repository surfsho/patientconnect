<script setup>
let props = defineProps({ patients: Array })

console.log(props.patients.length);
var headers=[{title:"Time",key:"giventime"},
{title:"Patient Name", key:"firstname"},

{title:"Patient ID", key:"patient_id"},
{title:"Provider", key:"fullname"},
{title:"Location", key:"state"},
{title:"Email", key:"email_address"},
{title:"Phone", key:"phone_number"}];
</script>
<template>
<v-row class="ma-4">
<v-col cols="2">
<v-list-subheader>Start Time</v-list-subheader>

<v-text-field variant="outlined" type="date">
</v-text-field>
</v-col>
<v-col cols="2">
<v-list-subheader>End Time</v-list-subheader>

<v-text-field variant="outlined" type="date">
</v-text-field>
</v-col>
<v-col cols="2">
<v-list-subheader>Patient Id</v-list-subheader>

<v-text-field variant="outlined" placeholder="Enter patient ID">
</v-text-field>
</v-col>
<v-col cols="2">
<v-list-subheader>Patient Name</v-list-subheader>

<v-text-field variant="outlined" ></v-text-field>

</v-col>
<v-col cols="2">
<v-list-subheader>Provider</v-list-subheader>

<v-select variant="outlined" :items="patients.map(function(i){return i.fullname})" label="All providers"></v-select>

</v-col>
<v-col cols="2">
<v-list-subheader>Location</v-list-subheader>

<v-select variant="outlined" label="All locations" :items="patients.map(function(i){return i.state})"></v-select>

</v-col>
</v-row>

<v-data-table
    style="margin:20px;"
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="patients"
    must-sort
    item-value="name"
    class="elevation-1"
     show-select
  >
   <template v-slot:item="{ item, index }">
      <tr>
        <td>
        <v-checkbox></v-checkbox>
        </td>
        <td>
        <div>
            {{ patients[index].giventime }}
            {{ patients[index].givendate }}
        </div>
        </td>
        <td>{{ item.columns.firstname }} {{ patients[index].lastname}}</td>
        <td>{{ item.columns.patient_id }}</td>
        <td>{{ item.columns.fullname }}</td>
        <td>{{ item.columns.state }}</td>
        <td>{{ item.columns.email_address }}</td>
        <td>{{ item.columns.phone_number }}</td>
      </tr>
    </template>
  </v-data-table>
</template>