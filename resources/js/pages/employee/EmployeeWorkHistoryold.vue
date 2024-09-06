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
                        <li class="breadcrumb-item"><router-link to="/admin/employees">List of Employees </router-link>
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
                <div class="col-12  col-sm-6">
                    <div class="card card-hrms card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Work History</h3> : <router-link :to="{ name: 'admin-employee-view', params: { id: employeeInfo.id } }">{{ getFullName(employeeInfo) }}</router-link><a href="view"> </a>  
                            <div class="card-tools">

                                

                            </div>
                        </div>
                        <div class="card-body ">
                            
                            <div class="timeline timeline-inverse">
                                <div>
                                    <i class="fas fa-user bg-info"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header border-0"> 
                                        </h3>
                                    </div>
                                </div>                       
                                <div v-for="(work, index) in workList" :key="work.id">
                               
                                    <i class="fas  fa-check bg-primary"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> <strong>  {{work.start_date}} - {{work.end_date}} ( {{work.employee_type}})</strong> </span>
                                        <div class="timeline-header">
                                            <strong>  {{work.job_title}}</strong  > - {{work.company_name}}
                                                <br> <spam class="text-right"> {{work.name}} </spam>
                                                <br> <spam class="text-right"> {{work.employment_status}} </spam>
                                        </div>
                                      
                                        <div class="timeline-body">
                                            {{work.description}}   
                                          </div>
                                        <div class="timeline-footer">
                                            <div class="contact-last-item text-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-info btn-xs"  @click.prevent="selectToUpdate(index)"><i
                                                        class="fas fa-edit"></i> Edit</button>
                                                <button type="button" class="btn btn-outline-danger btn-xs" @click.prevent="deleteWorkHistory(index)"><i
                                                        class="fa fa-trash"></i> Delete</button>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>


                               
 
                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                </div>
                <div  id="add_emergency" class="col-12  col-sm-6">
                    <div class="card card-hrms card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{editCardName}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-warning">
                                <p>Required fields are marked with a red asterisk <span class="text-danger">(*)</span>
                                </p>
                            </div>

                            <form @submit.prevent="handleSubmit">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="job_title">Job title  <span class="text-danger">*</span></label>
                                            <input v-model="workhisory.job_title" type="text" class="form-control"
                                                id="job_title" required>
                                        </div>
                                         
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company_name">Company Name<span
                                                    class="text-danger">*</span></label>
                                            <input v-model="workhisory.company_name" type="text"
                                                class="form-control" id="company_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="department_id">Department <span class="text-danger">*</span></label>
                                            <select class="form-control" id="department_id" v-model="workhisory.department_id">
                                                <option v-for="department in departmentData" :key="department.value"
                                                    :value="department.id"> {{ department.name }} </option>
                                            </select>
                                           <!-- <input v-model="workhisory.department_id" type="text" class="form-control"
                                               id="department_id" required>-->
                                        </div>
                                    
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="employment_status">Employment Status <span
                                                    class="text-danger">*</span></label>
                                            <input v-model="workhisory.employment_status" type="text"
                                                class="form-control" id="employment_status" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="employee_type">Employee Type</label>
                                            <input v-model="workhisory.employee_type" type="text" class="form-control"
                                                id="employee_type">
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="start_date">Start Date <span
                                                    class="text-danger">*</span></label>
                                            <input v-model="workhisory.start_date" type="date"
                                                class="form-control" id="start_date" required>
                                        </div>
                                         
                                    </div><div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="end_date ">End Date <span
                                                    class="text-danger">*</span></label>
                                            <input v-model="workhisory.end_date" type="date"
                                                class="form-control" id="end_date " required>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea v-model="workhisory.description " class="form-control"
                                                id="description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ buttonText }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Preloader :loading="loading" />
</template>
<script setup>
import { onMounted, reactive, ref } from 'vue';
import Preloader from "../../components/Preloader.vue";
import Swal from 'sweetalert2';
import { useRouter, useRoute } from 'vue-router';
import {getFullName, validateWorkHistoryForm } from "../../functions";

const pageName = ref({});
const editCardName = ref({});
const buttonText = ref({});
const loading = ref(false);
const workList = ref([]);
const router = useRouter();
const route = useRoute();
const employeeId = parseInt(route.params.id, 10);
const departmentData = ref([]);
const workhisory = reactive({
        employment_status: '',
        employee_type: '',
        company_name: '',
        job_title: '',
        start_date: '',
        end_date: '',
        description: '',
        created_at: '',
        updated_at: '',
        employee_id: 0,
        id:0
});
const employeeInfo = ref([]);
const errors = ref({});
pageName.value = 'Add Work History';
buttonText.value = 'Add New Work History';
editCardName.value = 'Add Work History Information';


const clearForm = () =>{
  workhisory.id = 0;
  workhisory.employment_status = '';
  workhisory.employee_type = '';
  workhisory.company_name = '';
  workhisory.phone_number = '';
  workhisory.job_title = '';
  workhisory.start_date = '';
  workhisory.end_date = '';
  workhisory.description = '';
  buttonText.value = "Add New Contact";
  editCardName.value = 'Add Emergency Contact Information';
  document.getElementById('add_emergency').scrollIntoView({behavior : 'smooth'});
};

const selectToUpdate = (index)=>{

if(index >= 0 && index < workList.value.length){
    console.log(workList.value[index]); 
    const data = workList.value[index];
    workhisory.employment_status = data.employment_status;
    workhisory.employee_type = data.employee_type;
    workhisory.company_name = data.company_name;
    workhisory.phone_number = data.phone_number;
    workhisory.job_title = data.job_title;
    workhisory.start_date = data.start_date;
    workhisory.end_date = data.end_date;
    workhisory.department_id = data.department_id;
    workhisory.description = data.description;
    workhisory.employee_id = data.employee_id;
    workhisory.id = data.id;
    buttonText.value = "Update Work History Information";
    editCardName.value = 'Update Work History Information';
    document.getElementById('add_emergency').scrollIntoView({behavior : 'smooth'});
    console.log(workhisory); 

}
}
const deleteWorkHistory = (index)=>{
    if(index >= 0 && index < workList.value.length){
    console.log(workList.value[index]); 
    const data = workList.value[index];
    const htmlData = '<p>Delete Work History <b>'+data.job_title+'</b> from <b>'+getFullName(employeeInfo.value)+'</b></p>'
    Swal.fire({
        title: 'Are you sure?',
        html: htmlData,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
      if (result.isConfirmed) {
        loading.value = true;
        axios.delete(`/api/employee/work-history/${data.id}`).then((response) => {
            console.log(response.data);
            getWorkHistory();
            clearForm ();
            Swal.fire(
                        'Success!',
                        'Work History data has been updated. please check.',
                        'success'
           );
        }).catch((error) => {
            console.error(error);
        }).finally(() => {
            loading.value = false;
        });
      }
    });
} 
}

const handleSubmit =() =>{
    errors.value = validateWorkHistoryForm(workhisory);
   
    
    
    if (Object.keys(errors.value).length === 0) {
 
        loading.value = true;
        workhisory.employee_id = employeeId;
            axios.post(`/api/employee/${employeeId}/work-history`, workhisory).then((response) =>{
                Swal.fire(
                        'Success!',
                        'Work History data has been updated. please check.',
                        'success'
                    )
            }).catch((error) =>{
                Swal.fire(
                        'Error!',
                        'Something is wrong. please contact the administrator.',
                        'error'
                    )
                console.error(error);
            }).finally(() =>{
                getWorkHistory();
                clearForm();
                loading.value = false;
            });
 

    } else {
                Swal.fire(
                    'Validation Error!',
                    'Please fill in all required fields.',
                    'error'
                );
            }
    
}
   
const fetchEmployee = () => {
    if (!isNaN(employeeId) && employeeId > 0) {
        loading.value = true;
        axios.get(`/api/employee/${employeeId}`).then((response) => {
            employeeInfo.value = response.data;
            console.log(employeeInfo);
        }).catch((error) => {
            console.error(error);
            Swal.fire(
                'No Employee Found!',
                'No Employee information available. Please try again.',
                'error'
            );
            router.push('/admin/dashboard');
        }).finally(() => {
            loading.value = false;
        });

    } else {
        Swal.fire(
            'No Employee Found!',
            'No Employee information available. Please try again.',
            'error'
        );
        router.push('/admin/dashboard');
    }
};
const getWorkHistory = ()=>{
  loading.value = true;
  axios.get(`/api/employee/${employeeId}/work-history`).then((response)=>{
    console.log(response.data);
    workList.value = response.data;
    console.log(workList);

  }).catch((error) => {
        console.error(error);
    }).finally(()=>{
      loading.value = false;
    });
};

const getDepartments = ()=>{
  loading.value = true;
  axios.get('/api/departments').then((response)=>{
    //console.log(response.data);
    // departmentList.value = response.data;
    departmentData.value = response.data;
    loading.value = false;
  }).catch((error) => {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
        loading.value = false;
    });
};

onMounted(() => {
    fetchEmployee();
    getWorkHistory();
    getDepartments();

})
</script>