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
              <div class="card-header ">
                <h5 class="card-title">Emergency Contact</h5>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <button @click="clearFormDepartments" 
                      class="btn btn-block btn-genashtim"
                      > <i class="fa fa-plus" aria-hidden="true"></i> Add New Contact</button
                    >
                  </li>
                </ul>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-info">
                                
                                <p class="mb-1"><b>Employee:</b> {{getFullName(employeeInfo)}}</p>
                                <p><b>Email:</b> {{ employeeInfo.email }}</p>
                  </div>
                <dl class="dl-contact">
                  <dt>Full Name</dt>
                  <dd>
                    <p class="pl-4">
                    <b>Relationship: </b> relationship <br> <b>Contact: </b> phone number - email <br><b>Address: </b>
                    </p>
                    <div class="contact-last-item text-right">
                        <div class="btn-group">
                        <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                      </div>
                       
                    </div>
                    </dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
                </div>
                <div class="col-12  col-sm-6">
                    <div class="card card-hrms card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Emergency contact Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-warning">
                                <p>Required fields are marked with a red asterisk <span class="text-danger">(*)</span>
                                </p>
                            </div>

                            <form @submit.prevent="handleSubmit">
                               
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fullName">Full Name <span class="text-danger">*</span></label>
                                            <input v-model="emergencyContact.full_name" type="text" class="form-control"
                                                id="fullName" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phoneNumber">Phone Number <span class="text-danger">*</span></label>
                                            <input v-model="emergencyContact.phone_number" type="text"
                                                class="form-control" id="phoneNumber" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="relationship">Relationship <span class="text-danger">*</span></label>
                                            <input v-model="emergencyContact.relationship" type="text"
                                                class="form-control" id="relationship" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input v-model="emergencyContact.email" type="email" class="form-control"
                                                id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea v-model="emergencyContact.address" class="form-control"
                                                id="address"></textarea>
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
import {getFullName } from "../../functions";

const pageName = ref({});
const buttonText = ref({});
const loading = ref(false);
const router = useRouter();
const route = useRoute();
const employeeId = parseInt(route.params.id, 10);
const emergencyContact = reactive({
    full_name: '',
    relationship: '',
    phone_number: '',
    email: '',
    address: '',
});
const employeeInfo = ref([]);
pageName.value = 'Add Contact Information';
buttonText.value = 'Add Contact';

const saveEmergencyContact = async (contactData) => {
  try {
    const response = await axios.post(`/api/employees/${employeeId}/emergency-contacts`, contactData);
    return response.data;
  } catch (error) {
    console.error('Failed to save emergency contact:', error);
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
onMounted(() => {
    fetchEmployee();
})
</script>