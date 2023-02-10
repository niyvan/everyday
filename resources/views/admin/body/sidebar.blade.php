 <div class="vertical-menu">

     <div data-simplebar class="h-100">

         <!-- User details -->


         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title">Menu</li>

                 <li>
                     <a href="{{ url('/dashboard') }}" class="waves-effect">
                         <i class="ri-home-fill"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-compass-2-fill"></i>
                         <span>Sales</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('invoice.create') }}">New Sales</a></li>
                         <li><a href="{{ route('invoice.index') }}">Sales List</a></li>
                         <li><a href="{{ route('invoice.pending.list') }}">Sales Pending</a></li>
                     </ul>
                 </li>

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-reddit-fill"></i>
                         <span>Items</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li>
                             <a href="{{ route('item.create') }}">New Item</a>
                         </li>
                         <li>
                             <a href="{{ route('item.index') }}">Items List</a>
                         </li>
                     </ul>

                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-apps-2-fill"></i>
                         <span>Categories</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('category.add') }}">New Category</a></li>

                     </ul>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('category.all') }}">Categories List</a></li>

                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-oil-fill"></i>
                         <span>Purchases</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('purchase.add') }}">New Purchase</a></li>
                         <li><a href="{{ route('purchase.all') }}">Purchases List</a></li>
                         <li><a href="{{ route('purchase.pending') }}">Purchases Pending</a></li>
                     </ul>
                 </li>

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-shield-user-fill"></i>
                         <span>Customers</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('customer.add') }}">New Customer</a></li>
                         <li><a href="{{ route('customer.all') }}">Customers List</a></li>
                         <li><a href="{{ route('credit.customer') }}">Credit Customers</a></li>
                         <li><a href="{{ route('paid.customer') }}">Paid Customers</a></li>
                     </ul>
                 </li>

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-gift-fill"></i>
                         <span>Reports</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('stock.report') }}">Stock Report</a></li>
                         <li><a href="{{ route('daily.purchase.report') }}">Purchase Report</a></li>
                         <li><a href="{{ route('daily.invoice.report') }}">Sales Report</a></li>
                         <li><a href="{{ route('stock.product.wise') }}">Item Sales Report </a></li>
                         <li><a href="{{ route('customer.wise.report') }}">Customers Report</a></li>

                     </ul>
                 </li>

             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>
