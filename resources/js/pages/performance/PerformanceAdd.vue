<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ pageName }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/admin/dashboard">Home</router-link></li>
                        <li class="breadcrumb-item"><router-link to="/admin/performances">Performance List</router-link>
                        </li>
                        <li class="breadcrumb-item active">{{ pageName }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class = "col-sm-3">
                    <div class="card card-hrms card-outline">
                        <div class="card-header">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle profile-employee-img"
                                        src="https://adminlte.io/themes/v3//dist/img/user4-128x128.jpg"
                                        alt="Employee profile picture">
                                </div>
                                <h3 id = "profile-fullname" class="profile-username text-center">--- --- ---- ----</h3>
                                <p id = "profile-nickname" class="text-muted text-center">(--- -- ---)</p>
                                <p id = "profile-jobtitle" class="text-muted text-center">---- -----</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Status</b> <a class="float-right">Activated</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9">
                    <div class="card card-hrms card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Employee Performance</h5>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-warning">
                                <p>Required fields are marked with a red asterisk <span class="text-danger">(*)</span>
                                </p>
                            </div>
                            <form @submit.prevent="handleSubmit">

                            <div class="row mt-3">
                                <div class="col-12 col-lg-12">
                                    <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="first-name">Select Employee <span
                                                            class="text-danger">*</span></label>
                                                            <a-select id="employee_id"  class="form-control " 
                                                                show-search 
                                                                style="width: 100%;" 
                                                                :options="employeeOptions"
                                                                v-model:value="form.employee_id"
                                                                placeholder="Input Employee Name to search"
                                                                :filter-option="employeesFilterOption"
                                                                :class="{ 'is-invalid': errors.employee_id }"
                                                                @change="getSpecificEmployee(form.employee_id)"
                                                                >
                                                            
                                                                </a-select>
                                                        <div v-if="errors.employee_id" class="invalid-feedback">{{ errors.employee_id }}
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="first-name">Performance Scores <span
                                                            class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="performance-scores"
                                                            placeholder = "Enter Performance Scores" 
                                                            step="0.1"
                                                             v-model="form.performance_scores"
                                                             :class="{ 'is-invalid': errors.performance_scores }"
                                                            />
                                                            <div v-if="errors.performance_scores" class="invalid-feedback">{{ errors.performance_scores }}
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="first-name">Performance Date <span
                                                            class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" id="performance-dates"
                                                            placeholder = "Enter Performance Date" 
                                                            v-model="form.performance_dates"
                                                            :class="{ 'is-invalid': errors.performance_dates }"
                                                            :max="new Date()"
                                                            />
                                                            <div v-if="errors.performance_dates" class="invalid-feedback">{{ errors.performance_dates }}
                                                            </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="first-name">Note</label>
                                                            <textarea class = "form-control" rows = "4" placeholder="Enter Employee Performance Notes" v-model="form.description">

                                                            </textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" class="btn btn-primary">Save Employee Performance</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Preloader :loading="loading" /-->
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue';
import Preloader from "../../components/Preloader.vue";
import Swal from 'sweetalert2';
import { useRouter, useRoute } from 'vue-router';
import { validateEmployeePerformanceForm } from "../../functions";

import { DEFAULT_AVATAR } from "../../config/siteSettingsConsts.js";

const pageName = ref({});
const buttonText = ref({});
const avatarUrl = ref({});
const loading = ref(false);
pageName.value = 'Add New Performance';
buttonText.value = 'Add Performance';

const errors = ref({});

const router = useRouter();
const route = useRoute();
const employeeId = parseInt(route.params.id, 10);
avatarUrl.value = DEFAULT_AVATAR;
const employeeOptions = ref([]);
//Get Form IDs
const form = reactive({
    employee_id: null,
    performance_dates: null,
    performance_scores: 0,
    description: '',
});

const validateForm = () => {
  errors.value = {}; // Reset errors
  if (!form.employee_id) {
    errors.value.employee_id = 'Employee is required';
    return false;
  }
  if (!form.performance_scores) {
    errors.value.performance_scores = 'Score is required';
    return false;
  }
  if ( form.performance_scores <= 0 ) {
    errors.value.performance_scores = 'Please specific valid scores';
    return false;
  }
  if (!form.performance_dates) {
    errors.value.performance_dates = 'Date is required';
    return false;
  }
  return true;
};


const employeesFilterOption = (input, option) => {
  return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const convertEmployeeOptions = (employees) => {
    const defaultOption = {
    value: null,
    label: ' -- Select if Applicable --' 
  };
  return [ defaultOption, ...employees.map(employee => ({
    value: employee.id,
    label: `${employee.first_name} ${employee.last_name} (${employee.email})`
  }))];
};

const getEmployees = () => {
  loading.value = true;
  axios.get('/api/employee').then((response)=>{
    console.log('response.data');
    // console.log(response.data);
    employeeOptions.value = convertEmployeeOptions(response.data);
  }).catch((error) => {
        
        console.error(error);
        loading.value = false;
    });
 
};

const getSpecificEmployee = ( id ) => {
  loading.value = true;
 if( !id ){
    $('#profile-fullname').html('--- --- ---- ----');
    $('#profile-nickname').html('(--- -- ---)');
    $('#profile-jobtitle').html('---- -----');

 }else{
    axios.get('/api/employee/'+id).then((response)=>{
        //console.log('response.data');
        //console.log(response.data);
    //alert(response.data['id']);
    //alert(response.data['first_name'] + ' ' + response.data['last_name']);
    $('#profile-fullname').html(response.data['first_name']+' '+response.data['middle_name']+' '+response.data['last_name']);
    $('#profile-nickname').html('('+response.data['nick_name']+')');
    $('#profile-jobtitle').html(response.data['job_title']);

    }).catch((error) => {
            
            console.error(error);
            loading.value = false;
    });
}
 
};



//Used for Onload 
onMounted(() => {
    $(".profile-user-img").attr("src","/"+avatarUrl.value);
    getEmployees();
    //getSpecificEmployee(2008);
});

const handleSubmit = async () => {
    console.log(form);
    if (!validateForm()) {
        Swal.fire(
        'Validation Error!',
        'Please fill in all required fields.',
        'error'
        );
        return;
    }
     Swal.fire({
            title: 'Are you sure you want to save this?',
            text: "Data will be saved in the system",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, go ahead and save'
        }).then(async (result) => {
            if (result.isConfirmed) {
                axios.post('/api/performances',form).then((response)=>{
                  
                    Swal.fire({
                        title: 'Employee performance saved successfully.',
                        text: "Would you like to add new again?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, proceed',
                        cancelButtonText: 'No, I want employee performance list.'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }else{
                            router.push("/admin/performances/")
                        }
                    });
                    
                }).catch((error) => {
                        if (error.response && error.response.status === 422) {
                            errors.value = error.response.data.errors;
                            console.log(errors.value);
                        }
                });
                
            }else{

            }
        });
    
}


</script>
