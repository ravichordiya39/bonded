@extends('layouts.admin')
@section('content')
<section class="admin-content">
        <div class="container-fluid bg-dark m-b-30">
            <div class="row">

                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4 class="  "><span class="btn btn-white-translucent"><i
                                    class="mdi mdi-shape-circle-plus "></i></span> <span class="js-greeting"></span>,
                        Admin!</h4>
                    <p class="opacity-75 ">
                        Dear Admin!<br> Welcome to Abeer Jaipur Admin .This login panel provides facility to manage whole website from admin end.
                    </p>
					<p class="opacity-75 ">
                        In this admin panel, you can manage Categories, Sub Categories, Child Categories , Product as well as whole website's content.
                    </p>


                </div>
            </div>
        </div>
        <div class="container-fluid pull-up">
            <div class="row">
                <div class="col m-b-30">
                    <div class="card ">
                         <a  href="https://abeerjaipur.com/admin/all-orders">
                        <div class="text-center card-body">
                            <div class="text-success   ">
                                <div class="avatar avatar-sm ">
                                  
                                     <span class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-arrow-up-bold mdi-18px"></i> </span>
                                            
                                </div>
                               <h6 class="m-t-5 m-b-0"> </h6>
                            </div>


                            <div class=" text-center">
                                <h3>12</h3>
                            </div>
                            <div class="text-overline ">
                                Total Orders
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col m-b-30">
                    <div class="card ">
                         <a  href="https://abeerjaipur.com/productlist">
                        <div class="   text-center card-body">
                            <div class="text-danger   ">
                                <div class="avatar avatar-sm ">
                                    <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-account-convert mdi-18px"></i> </span>

                                </div>
                                <h6 class="m-t-5 m-b-0"></h6>
                            </div>


                            <div class=" text-center">
                                <h3>234</h3>
                            </div>
                            <div class="text-overline ">
                                Total Productss
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col m-b-30">
                    <div class="card ">
                         <a  href="https://abeerjaipur.com/viewuser">
                        <div class="   text-center card-body">
                            <div class="text-warning   ">
                                <div class="avatar avatar-sm ">
                                    <span class="avatar-title rounded-circle badge-soft-warning"><i
                                                class="mdi mdi-account-convert mdi-18px"></i> </span>

                                </div>
                                <h6 class="m-t-5 m-b-0"></h6>
                            </div>


                            <div class=" text-center">
                                <h3> 23 </h3>
                            </div>
                            <div class="text-overline ">
                                Customer Registrations
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-info   ">
                                <div class="avatar avatar-sm ">
                                    <span class="avatar-title rounded-circle badge-soft-info"><i
                                                class="mdi mdi-account-convert mdi-18px"></i> </span>

                                </div>
                                <h6 class="m-t-5 m-b-0"></h6>
                            </div>


                            <div class=" text-center">
                                <h3> <a  href="https://abeerjaipur.com/category"> 8 </a> /  <a  href="https://abeerjaipur.com/subcategory">34 </a></h3>
                            </div>
                            <div class="text-overline ">
                               Category / Sub Category
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-lg-block d-none m-b-30">
                    <div class="card ">
                        <div class="   text-center card-body">
                            <div class="text-danger   ">
                                <div class="avatar avatar-sm ">
                                    <span class="avatar-title rounded-circle badge-soft-danger"><i
                                                class="mdi mdi-account-convert mdi-18px"></i> </span>

                                </div>
                                <h6 class="m-t-5 m-b-0"> </h6>
                            </div>


                            <div class=" text-center">
                                <h3>-- </h3>
                            </div>
                            <div class="text-overline ">
                                Total Product Ratings
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row d-none">
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Quarterly User Growth</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div id="chart-01"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Country Wise Distribution</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">


                            <div id="chart-02"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Top grossing Products</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">


                            <div id="chart-03"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Gender Based</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">


                            <div id="chart-04"></div>
                        </div>
                        <div class="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i> Restart your Re-targeting Campaigns</span>
                                </h6>
                                <a href="#!" class="btn btn-white shadow-none">See Campaigns</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-8 m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Latest Orders</div>
                        </div>

                        <div class="table-responsive">

                            <table class="table table-hover table-sm ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Order Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                                                                                               <tr>
                                         <td class="align-middle">1
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">277
                                    </td>
                                    <td class="align-middle">Arbaaz</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">2
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">73,73
                                    </td>
                                    <td class="align-middle">we</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">3
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">72,71
                                    </td>
                                    <td class="align-middle">brijesh</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">4
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">75
                                    </td>
                                    <td class="align-middle">brijesh</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">5
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">71
                                    </td>
                                    <td class="align-middle">brijesh</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                                 
                                                                                        
                                                                                     <span class="badge badge-soft-dark badge-light">Refunded</span>       
                                            
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">6
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">30
                                    </td>
                                    <td class="align-middle">Shamsul Aarifeen</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">7
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">30
                                    </td>
                                    <td class="align-middle">Shamsul Aarifeen</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">8
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">30,25,28
                                    </td>
                                    <td class="align-middle">mazid</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">9
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">30
                                    </td>
                                    <td class="align-middle">mazid</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                                                       <tr>
                                         <td class="align-middle">10
                                     
                                       <!-- <div class="avatar avatar-sm avatar-online"><img
                                                    src="assets/img/users/user-1.jpg"
                                                    class="avatar-img avatar-sm rounded-circle" alt="user-image"></div>
                                        <span class="ml-2">Tiger Nixon</span> -->
                                        </td>

                                        <td class="align-middle">30
                                    </td>
                                    <td class="align-middle">mazid</td>
                                    

                                    <td class="align-middle">
                                                                                                                                                                           
                                             <span class="badge badge-soft-success badge-light">Processing</span>
                                                                                        
                                                                                        
                                                                                     </td>
                                    <td class="text-center align-middle"><a class="btn btn-primary btn-sm" href="#">
                                            Details</a></td>
                                </tr>
                                
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i>  List based on your order history.</span>
                                </h6>
                                <a href="https://abeerjaipur.com/admin/all-orders" class="btn btn-dark">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 m-b-30">
                    <div class="card ">
                        <div class="card-header">
                            <div class="card-title">Recent Products Added</div>

                            <div class="card-controls">

                                <a href="#" class="js-card-refresh icon"> </a>
                                <div class="dropdown">
                                    <a href="https://abeerjaipur.com/productlist" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Show All Products</button></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622888545.IMG_20210511_160055~2.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Red Anemoe</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Red-Anemoe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Red-Anemoe" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622887934.IMG_20210512_141440~2.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Peony</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Peony" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Peony" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622885992.IMG_20210512_145423~2.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Meconopsis</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Meconopsis" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Meconopsis" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622724446.IMG_20210511_162152~2.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Matthiola</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Matthiola" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Matthiola" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622723951.IMG_20210513_174544.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Marguerite</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Marguerite" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Marguerite" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622723153.IMG_20210513_170727.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Lilies</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Lilies" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Lilies" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622721828.IMG_20210513_165245~2.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Florian</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Florian" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Florian" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622709765.IMG_20210511_152232~3.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Cherry Blossom</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Cherry-Blossom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Cherry-Blossom" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1622705984.IMG_20210511_150803~3.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Blueweed</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Blueweed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Blueweed" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="https://abeerjaipur.com/thumbnail/1620206631.IMG_20210301_164157.jpg"
                                                                        class="avatar-img avatar-sm rounded" alt="user-image">
                                    </div>
                                </div>
                                <div class="">
                                    <div>Vraksh</div>
                                    <div class="text-muted">Bath Linen</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://abeerjaipur.com/editproduct/Vraksh" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> 

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://abeerjaipur.com/editproduct/Vraksh" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@section('js-script')
@endsection