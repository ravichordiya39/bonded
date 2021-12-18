<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <span class="admin-brand-content font-secondary"><a href="{{url('admin/dashboard')}}"><img class="admin-brand-logo" src="{{url('/')}}/public/front/images/logo.png" width="135" alt="kalila Logo"></a></span>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">
            <li class="menu-item active ">
                <a href="{{url('admin/dashboard')}}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Dashboard</span>
                    </span>
                    <span class="menu-icon">

                       <i class="icon-placeholder mdi mdi-shape-outline "></i>
                   </span>
               </a>
               <!--submenu-->

            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Orders
                            <span class="menu-arrow"></span>
                        </span>

                    </span>
                    <span class="menu-icon">
                       <i class="icon-placeholder mdi mdi-lead-pencil "></i>
                   </span>
               </a>
                <!--submenu-->
                <ul class="sub-menu">

                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/new-orders" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">New Orders
                                </span>
                            </span>
                            <span class="menu-icon">

                                <i class="icon-placeholder mdi mdi-checkbook "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/all-orders" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">All Orders
                                </span>
                            </span>
                            <span class="menu-icon">

                                <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                            </span>
                        </a>
                    </li>


                </ul>
            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Categories
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                       <i class="icon-placeholder mdi mdi-lead-pencil "></i>
                   </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{url('admin/category')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Categories
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-checkbook "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/map-attribute')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Map Attributes
                                </span>
                            </span>
                            <span class="menu-icon">

                                <i class="icon-placeholder mdi mdi-calendar-edit "></i>
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Product Configuration
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                       <i class="icon-placeholder mdi mdi-lead-pencil "></i>
                   </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{url('admin/product/config/brand')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Brands
                                </span>
                            </span>
                            <span class="menu-icon">

                                <i class="icon-placeholder mdi mdi-step-forward  "></i>
                            </span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{url('admin/product/config/size')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Size</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-step-forward"></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/config/color')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Colors</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-step-forward  "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/config/occasion')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Occasions</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-step-forward  "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/config/fabric')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Fabric</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-step-forward  "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/config/design')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Design</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-step-forward  "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/config/material')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Material</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-step-forward  "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/config/pattern')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Pattern</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-step-forward  "></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Product
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-cursor-default-outline "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{url('admin/product/list')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Product List</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/add')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Add Product </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    A
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/product/upload')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Product Bulk Upload</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>

                </ul>
            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Blog
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                       <i class="icon-placeholder mdi mdi-lead-pencil "></i>
                   </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{url('admin/blog/list')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Blog List
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-checkbook "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/blog/add')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Add Blog
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Website Content
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-cursor-default-outline "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/add-testimonial" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Add Testimonials</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/config/front/list')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Footer & Content List </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/config/front/edit')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Footer & Content Edit </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="{{url('admin/config/banner/list')}}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Banners</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="#" class="open-dropdown menu-link">
                            <span class="menu-label">
                                <span class="menu-name">CMS
                                    <span class="menu-arrow"></span>
                                </span>
                            </span>
                            <span class="menu-icon">

                                <i class="icon-placeholder mdi mdi-format-list-bulleted "></i>
                            </span>
                        </a>
                        <!--submenu-->
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{url('admin/config/cms/list')}}" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">CMS List </span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                            b
                                        </i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('admin/config/cms/add')}}" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Add CMS Page </span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="icon-placeholder  ">
                                            b
                                        </i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">User Utility
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-cursor-default-outline "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/adduser" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Add Users </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    A
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/viewuser" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">View Users </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>

                </ul>
            </li>


            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Offers
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-cursor-default-outline "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/add-offers" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Add Offer </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    A
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/view-offers" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">View Offers </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>

                </ul>
            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Reports
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-cursor-default-outline "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/reports/sale-report" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Sales Reports</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    S
                                </i>
                            </span>
                        </a>

                    </li>
                    
                    <li class="menu-item">
                        <a href="#" class=" menu-link">
                        
                            <span class="menu-label">
                                <span class="menu-name">GST Reports</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    G
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/reports/customer-report" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Customer Reports</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    C
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/reports/inventory-report" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Inventory Reports</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    I
                                </i>
                            </span>
                        </a>

                    </li>

                </ul>
            </li>

            <li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Settings
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-cursor-default-outline "></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/payment-setting" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Payment Setting</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    A
                                </i>
                            </span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/view-offers" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">View Users </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>

                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/referral-settings" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Referral Setting</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>

                    </li>

                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/shipping-settings" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Shipping Charges Setting</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder   ">
                                    V
                                </i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="https://abeerjaipur.com/admin/newsletter-listing" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name"> Newsletter Listing</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder"> V</i>
                            </span>
                        </a>

                    </li>

                </ul>
            </li>

        </ul>

    </div>
</aside>