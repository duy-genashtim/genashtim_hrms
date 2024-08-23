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
                       @click = "addNewPerformance"
                        class="btn btn-block btn-outline-primary"
                      >
                        Add New Performance
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
              <div >
              <table class="table table-bordered hrms-table">
                <thead>
                  <tr>
                    <th width="50"></th>
                    <th>Full Name</th>
                    <th>Date Scores</th>
                    <th>Performance Scores</th>
                    <th>Description</th>
                    <th>Added By</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
              </div>
              <div class="text-center">
                <p class="text-muted">No data found</p>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Preloader :loading="loading" />
  </template>
  <script setup>

  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from "vue-router";
  import {getFullName, checkAvatarImage } from "../../functions";
  import Preloader from "../../components/Preloader.vue";
  const loading = ref(false);

  const employees = ref([]);
  const router = useRouter();

  const addNewPerformance = () => {
    router.push("/admin/performances/add");
  };
 
  </script>