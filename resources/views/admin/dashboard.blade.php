@extends('layouts.admin')
@section('content')
<section class="admin-content">
        <div class="container-fluid bg-dark m-b-30">
            <div class="row">

                <div class=" col-12 text-white p-t-40 p-b-90">

                    <h4 class="  "><span class="btn btn-white-translucent"><i
                                    class="mdi mdi-shape-circle-plus "></i></span> <span class="js-greeting"></span>,
                        Admin!</h4>
                    <p class="opacity-75 ">
                        Dear Admin!<br> Welcome to Bonded Coir Jaipur Admin .This login panel provides facility to manage whole website from admin end.
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
                         <a  href="https://bonded-coir.com/admin/all-orders">
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
                         <a  href="https://bonded-coir.com/productlist">
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
                         <a  href="https://bonded-coir.com/viewuser">
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
                                <h3> <a  href="https://bonded-coir.com/category"> 8 </a> /  <a  href="https://bonded-coir.com/subcategory">34 </a></h3>
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
                            <div class="card-title">User list</div>
                        </div>

                        <div class="table-responsive">

                            <table class="table table-hover table-sm ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Phone</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($user as $key => $userList){ ?>
                                        <tr>
                                            <td>{{$userList->id}}</td>                                  
                                            <td>{{$userList->name}}</td>                                  
                                            <td>{{$userList->email}}</td>                                  
                                            <td>{{$userList->phone}}</td>

                                            <td class="align-middle">
                                                <a href="{{url('admin/product/edit')}}/{{$userList->id}}" class="btn  btn-primary"> View</a> 
                                                <a href="{{url('admin/product/edit')}}/{{$userList->id}}" class="btn  btn-primary"> Edit</a>
                                                <a href="javascript:;" data-id="{{$userList->id}}" class="btn btn-danger delete-data-btn"> Delete</a>
                                            </td>
                                       <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <a href="https://bonded-coir.com/admin/all-users" class="btn btn-dark">View All</a>
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
                                    <a href="https://bonded-coir.com/productlist" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                class="icon mdi  mdi-dots-vertical"></i> </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">Show All Products</button></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-hover table-sm ">

                                    <?php foreach($product as $productKey => $productList){ ?>
                                        <tr>

                                                <div class="list-group list-group-flush ">

                            <div class="list-group-item d-flex  align-items-center">
                                <div class="m-r-20">
                                    <div class="avatar avatar-sm "><img src="{{$productList->thumbnail_url}}"
                                                                        class="avatar-img avatar-sm rounded" alt="{{$productList->thumbnail_url}}">
                                    </div>
                                </div>
                                <div class="">
                                    <div>{{$productList->name}}</div>
                                    <div class="text-muted">{{$productList->cat_name}}</div>
                                </div>

                                <div class="ml-auto">
                                    <div class="dropdown">
                                        <a href="https://bonded-coir.com/editproduct/Red-Anemoe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi  mdi-dots-vertical mdi-18px"></i> </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="https://bonded-coir.com/editproduct/Red-Anemoe" >
                                            <button class="dropdown-item" type="button">Edit</button>
                                             </a> 
                                        </div>

                                                                                 
                                    </div>
                                </div>

                            </div>
                        </div>
                    </tr>
                    <?php } ?>
                        </div>
                    </table>
                </div>
                        <div class="card-footer" style="border-top: 0px;">
                            <div class="d-flex  justify-content-between">
                                <a href="https://bonded-coir.com/product/list" class="btn btn-dark">View All</a>
                            </div>
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
                                    
                                    <?php foreach($order as $key => $orderList){ ?>
                                        <tr>
                                            <td>{{$orderList->id}}</td>                                  
                                            <td>{{$orderList->order_id}}</td>                                  
                                            <td>{{$orderList->user_id}}</td>                                  
                                            <td>{{$orderList->order_status}}</td>

                                            <td class="align-middle">
                                                <a href="{{url('admin/product/edit')}}/{{$orderList->id}}" class="btn  btn-primary"> View</a> 
                                                <a href="{{url('admin/product/edit')}}/{{$orderList->id}}" class="btn  btn-primary"> Edit</a>
                                                <a href="javascript:;" data-id="{{$orderList->id}}" class="btn btn-danger delete-data-btn"> Delete</a>
                                            </td>
                                       <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between">
                                <h6 class="m-b-0 my-auto"><span class="opacity-75"> <i class="mdi mdi-information"></i>  List based on your order history.</span>
                                </h6>
                                <a href="https://bonded-coir.com/admin/all-orders" class="btn btn-dark">View All</a>
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