<template>
    <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Dashboard</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Home</a></li>
             <li class="breadcrumb-item active">Dashboard</li>
           </ol>
         </div>
       </div>
     </div>
   </div>

   <div class="content">
     <div class="container-fluid">
       <div class="row">
         <!-- Info boxes -->
         <div class="col-lg-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Employees</span>
                <span class="info-box-number">0</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-tie"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">ManCom</span>
                <span class="info-box-number">0</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-building"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Departments</span>
                <span class="info-box-number">0</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-pie"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Employee Performances</span>
                <span class="info-box-number">0</span>
              </div>
            </div>
          </div>
       </div>
       <div class = "row">
        <div class="col-lg-8">
            <div class="card card-dark card-outline">
                <div class="card-header">
                  <h3 class="card-title"><i class = "fa fa-user"></i> Employee Overview in 12 Months (Hired vs. Resigned)</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    
                   </div>
                  </div>
                  <div class="card-body">
                    <div class=" pl-0 pr-0 pt-0 mt-0 text-center" style = "height: 300px;">
                      <h3 class = " mt-5 pt-5">CHART HERE</h3>
                      <small class = "pt-0 mt-0">Under Construction!</small>
                    </div>
                  </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-dark card-outline">
                <div class="card-header">
                  <h3 class="card-title"><i class = "fa fa-building"></i> Top 10 Department</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    
                   </div>
                  </div>
                  <div class="card-body table-responsive pl-0 pr-0 pt-0 mt-0"  >
                  <div class ="" style = "height: 300px;"> 
                      <table class=" table table-striped table-valign-middle">
                        <thead>
                        <tr>
                          <th>Department</th>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Department 1 <span class = "badge badge-warning float-right"> 5 </span></td>
                            <td>
                              <a href="#" class="text-muted">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>
                  
                    </div>
                  </div>
                  <div class = "card-footer p-3 text-center">
                    <a href = "javascript:void(0);" class = "text-center"><i class = "fa fa-eye"></i> View All Departments</a>
                  </div>
            </div>
          </div> 
       </div>
       <div class = "row">
            <div class="col-lg-12">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                      <h3 class="card-title"><i class = "fa fa-user-tie"></i> List of ManCom</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                      </div>
                      </div>
                      <div class="card-body">
                        <div class=" pl-0 pr-0 pt-0 mt-0 text-center" style = "height: 300px;">
                          
                        </div>
                      </div>
                </div>
              </div>
        </div>
       <div class = "row">
          <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title"><i class = "fa fa-users"></i> Top 15 Latest Employees</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    
                   </div>
                  </div>
                  <div class="card-body">
                    <div class=" pl-0 pr-0 pt-0 mt-0 text-center" style = "height: 300px;">
                      
                    </div>
                  </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title"><i class = "fa fa-users"></i> Top 15 Old Employees</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    
                   </div>
                  </div>
                  <div class="card-body">
                    <div class=" pl-0 pr-0 pt-0 mt-0 text-center" style = "height: 300px;">
                      
                    </div>
                  </div>
            </div>
          </div>
          
        </div>
        <div class = "row">
            <div class="col-lg-12">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                      <h3 class="card-title"><i class = "fas fa-birthday-cake"></i> Birthday Celebrant Today</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                      </div>
                      </div>
                      <div class="card-body">
                        <div class=" pl-0 pr-0 pt-0 mt-0 text-center" style = "height: 300px;">
                          
                        </div>
                      </div>
                </div>
              </div>
        </div>
     </div>
   </div>
</template>
