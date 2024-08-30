<template>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Test Chart</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/admin/employees">Home</router-link>
              </li>
              <li class="breadcrumb-item active">Test Chart</li>
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
                <h5 class="m-0 card-title">Test Chart</h5>
                
              </div>
              <div class="card-body">
               <div class="row">
                <div class="col-md-6">
                    <Bar :data="chartData" />
                </div>
                <div class="col-md-6">
                    <Doughnut :data="chartDataDoughnut" />
                </div>
               </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
 <script setup>
 import { ref } from 'vue'
 import { Bar, Doughnut } from 'vue-chartjs'
 import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'
 
 ChartJS.register(ArcElement,Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
 
 // Define the chart data using ref
 const chartData = ref({
   labels: ['January', 'February', 'March'],
   datasets: [
     {
       label: 'Data One',
       backgroundColor: '#f87979',
       data: [40, 20, 12]
     }
   ]
 })
 // Define the chart data using ref
 const chartDataDoughnut = ref({
    labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
  datasets: [
    {
      backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
      data: [40, 20, 80, 10]
    }
  ]
 })

 </script>