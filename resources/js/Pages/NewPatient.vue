<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

var emailRules = [ 
  v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
]

var phoneNumber = [
  v => /^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/.test(v) || 'Phone number must be valid'
]
const form = reactive({
  firstname: null,
  lastname: null,
  dateofbirth: null,
  sex: null,
  phone_number: null,
  state: null,
  zipcode: null,
  email_address: null,
})

function submit() {
  router.post('/newpatient', form)
}

</script>
<template>
  <div style="padding:20px; margin: 20px; font-size: 25px; border-bottom: 1px solid black;">
    <p>Patient information</p>
  </div>
  <v-form @submit.prevent="submit">
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
        <v-row>
         <v-col
          cols="30"
          md="4"
        >
            <v-list-subheader>Patient First Name</v-list-subheader>
        </v-col>
        <v-spacer></v-spacer>
        <v-col
          cols="12"
          md="4"
        >
            <v-list-subheader>Required</v-list-subheader>
            </v-col>
            </v-row>
          <v-text-field
            v-model="form.firstname"
            :rules="nameRules"
            :counter="10"
            
            variant="outlined"
            required
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
        <v-row>
         <v-col
          cols="30"
          md="4"
        >
            <v-list-subheader>Patient Last Name</v-list-subheader>
            </v-col>
            <v-spacer></v-spacer>
        <v-col
          cols="12"
          md="4"
        >
            <v-list-subheader>Required</v-list-subheader>
            </v-col>
            </v-row>
          <v-text-field
            v-model="form.lastname"
            :rules="nameRules"
            :counter="10"
            
            variant="outlined"
            required
          ></v-text-field>
        </v-col>

        
      </v-row>
      <v-row>
      <v-col
          cols="12"
          md="4"
        >
         <v-row>
         <v-col
          cols="30"
          md="4"
        >
            <v-list-subheader>Date of Birth</v-list-subheader>
            </v-col>
            <v-spacer></v-spacer>
        <v-col
          cols="12"
          md="4"
        >
            <v-list-subheader>Required</v-list-subheader>
            </v-col>
            </v-row>
          <v-text-field
           type="date"
            v-model="form.dateofbirth"
            
        
            variant="outlined"
            required
          ></v-text-field>
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
         <v-row>
         <v-col
          cols="30"
          md="4"
        >
            <v-list-subheader>Gender</v-list-subheader>
            </v-col>
            <v-spacer></v-spacer>
        <v-col
          cols="12"
          md="4"
        >
            <v-list-subheader>Required</v-list-subheader>
            </v-col>
            </v-row>
           <v-select
            v-model="form.sex"
            variant="outlined"
            :items="['Male', 'Female']"
        ></v-select>
        </v-col>
    </v-row>
     <v-row>
      <v-col
          cols="12"
          md="4"
        >
        <v-row>
         <v-col
          cols="30"
          md="4"
        >
            <v-list-subheader>Email address</v-list-subheader>
             </v-col>
            <v-spacer></v-spacer>
        <v-col
          cols="12"
          md="4"
        >

            <v-list-subheader>Required</v-list-subheader>
            </v-col>
            </v-row>
          <v-text-field
            v-model="form.email_address"
            :rules="emailRules"
            
            variant="outlined"
            required
          ></v-text-field>
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
        <v-row>
         <v-col
          cols="30"
          md="4"
        >
        
            <v-list-subheader>Preferred Phone Number</v-list-subheader>
        </v-col>
            <v-spacer></v-spacer>
        <v-col
          cols="12"
          md="4"
        >

            <v-list-subheader>Required</v-list-subheader>
            </v-col>
            </v-row>
        
        
          <v-text-field
            v-model="form.phone_number"
            :rules="phoneNumber"
            
            variant="outlined"
            required
          ></v-text-field>
        </v-col>
    </v-row>
     <v-row>
      <v-col
          cols="12"
          md="4"
        >
            <v-list-subheader>State</v-list-subheader>
             <v-select
            v-model="form.state"
            variant="outlined"
            :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
        ></v-select>
         
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
         <v-row>
         <v-col
          cols="30"
          md="4"
        >
            <v-list-subheader>Zip Code</v-list-subheader>
            </v-col>
            <v-spacer></v-spacer>
        <v-col
          cols="12"
          md="4"
          align-self="end"
        >
            <v-list-subheader >Required</v-list-subheader>
            </v-col>
            </v-row>
          <v-text-field
            v-model="form.zipcode"
            
            
            variant="outlined"
            required
          ></v-text-field>
        </v-col>
    </v-row>
    <div style="float:right;margin-right:650px;">
    <v-btn type="submit"> Next</v-btn>
    </div>
    </v-container>
    
  </v-form>
        

</template> 