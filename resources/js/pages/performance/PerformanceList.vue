<template>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Performance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/admin/employees">Home</router-link>
              </li>
              <li class="breadcrumb-item active">Performance List</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-hrms card-outline">
              <div class="card-header">
                <h5 class="m-0 card-title">Performance List</h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <button
                       @click = "redirect_to('add')"
                        class="btn btn-block btn-outline-primary"
                      >
                        Add New Performance
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <!--a-table :columns="columns" :data-source="performancelist" @change="onChange" /-->
                
                <a-table class="antTable" :data-source="performancelist"  @change="onChange" >
                  <a-table-column class = "ant-table-cell" key="id" title="Index" data-index="id" 
                  :sorter="{ compare: (a, b) => a.id - b.id, multiple: 6 }"
                  />
                  <a-table-column key="full_name" title="Employee Name" data-index="full_name" 
                  :sorter="{ compare: (a, b) => a.full_name - b.full_name, multiple: 5 }"
                  >
                    <template #default="{ record }">
                      <router-link :to="{ name: 'admin-employee-view', params: { id: record.id } }">
                        {{ record.full_name }}
                      </router-link>
                    </template>
                  </a-table-column>
                  <a-table-column key="performance_scores" title="Scores" data-index="performance_scores"
                  :sorter="{ compare: (a, b) => a.performance_scores - b.performance_scores, multiple: 4 }"
                  />
                  <a-table-column key="performance_dates" title="Performance Date" data-index="performance_dates" 
                  :sorter="{ compare: (a, b) => new Date(a.performance_dates) - new Date(b.performance_dates), multiple: 3 }"              
                  />
                  <a-table-column key="description" title="Notes" data-index="description" 
                  :sorter="(a, b) => {
                      if (a.description < b.description) return -1;
                      if (a.description > b.description) return 1;
                      return 0;
                    }"
                  />
                  <a-table-column key="created_at" title="Created Date" data-index="created_at" 
                  :sorter="{
                              compare: (a, b) => new Date(a.created_at) - new Date(b.created_at),
                              multiple: 1
                            }"

                  />
                  
                  <a-table-column key="action" title="Action">
                    <template #default="{ record }">
                      <span>
                        
                        <a class = "btn btn-flat btn-primary btn-sm bg-white text-primary text-sm border border-1 border-primary" href = "javascript:void(0)" @click="editPerformance(record.id)">
                          <i class = "fa fa-edit"></i> Edit

                        </a>
                        <a-divider class = "text-black" type="vertical" />
                        <a class = "btn btn-flat btn-danger btn-sm bg-white text-danger text-sm border border-1 border-danger" href = "javascript:void(0)" style = "color: red;" @click = "() => deletePerformance( record.id, record.full_name )" >
                          <i class = "fa fa-trash"></i>  Delete</a>
                      </span>
                      
                    </template>
                    
                  </a-table-column>
                </a-table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </template>
<script lang="ts" setup>
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { useRouter, useRoute } from 'vue-router';
import { checkAvatarImage } from "../../functions";
const router = useRouter();
const route = useRoute();
const performancelist = ref([]);
const columns = [
  {
    title: 'Employee Name',
    dataIndex: 'full_name',
  },
  {
    title: 'Performance Scores',
    dataIndex: 'performance_scores',
    sorter: {
      compare: (a, b) => a.performance_scores - b.performance_scores,
      multiple: 4,
    },
  },
  {
    title: 'Performance Date',
    dataIndex: 'performance_dates',
    sorter: {
      compare: (a, b) => a.performance_dates - b.performance_dates,
      multiple: 3,
    },
  },
  {
    title: 'Note',
    dataIndex: 'description',
    sorter: {
      compare: (a, b) => a.description - b.description,
      multiple: 2,
    },
  },
  {
    title: 'Created Date',
    dataIndex: 'created_at',
    sorter: {
      compare: (a, b) => a.created_at- b.created_at,
      multiple: 1,
    },
  },
  {
    title: 'Action',
    key: 'operation',
    fixed: 'right',
    width: 100,
  },
];


function onChange(pagination, filters, sorter, extra) {
  console.log('params', pagination, filters, sorter, extra);
}

const getEmployees = () => {
  axios.get('/api/performances').then((response)=>{
    performancelist.value = response.data;
    console.log(response.data);
  }).catch((error) => {      
        console.log(error);
  });
 
};

const test = () => {
    alert('test');
};

const redirect_to = ( page ) =>{
  router.push('/admin/performances/' + page);
};

//On Load
onMounted(() => {
  getEmployees();
  //console.log(employeetest);
});

//Delete 
const deletePerformance = ( id, name ) =>{
  //alert(id+' '+name);
  Swal.fire({
        title: 'Are you sure? ',
        html: 'Do you want to delete '+name+' performace index by '+id ,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
      if (result.isConfirmed) {
        //alert('test');
        axios.delete(`/api/performances/employee-performance/${id}`).then((response) => {
                Swal.fire(
                         'Success!',
                         'Employee Performance of '+name+' has been deleted.',
                         'success'
                );
            getEmployees();
        }).catch((error) => {
          console.log(error);
        });
        
      }

    });
};

const editPerformance = ( id ) =>{
  
    router.push({name: "admin-performances-edit" , params: {id: id} });
}
</script>
