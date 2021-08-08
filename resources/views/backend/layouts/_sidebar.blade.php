  <div class="page-sidebar">

        <ul class="x-navigation">
            <li class="" style="background: #F85F6A; text-align: center;">
                <a style="font-size: 22px;" href="{{ url('admin/dashboard') }}"><b>Meal & Wheel</b></a>
                <a href="#" class="x-navigation-control"></a>
            </li>

            <li class="@if ( Request::segment(2) == 'dashboard') active @endif">
                <a href="{{ url('admin/dashboard') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
            </li>

            <li class="@if ( Request::segment(2) == 'user') active @endif">
                <a href="{{ url('admin/user') }}"><span class="fa fa-user"></span> <span class="xn-text">User List</span></a>
            </li>

            <li class="@if ( Request::segment(2) == 'food_menu') active @endif">
                <a href="{{ url('admin/food_menu') }}"><span class="fa fa-cutlery"></span> <span class="xn-text">Food Menu List</span></a>
            </li>
            
            <li class="@if (Request::segment(2) == 'hotel') active @endif">
                <a href="{{ url('admin/hotel') }}"><span class="fa fa-cutlery"></span><span class="xn-text">Hotel List</span></a>
            </li>

            

            <li class="@if ( Request::segment(2) == 'food_sub_menu' ) active @endif">
                <a href="{{ url('admin/food_sub_menu') }}"><span class="fa fa-cutlery"></span><span class="xn-text">Food Sub Menu List</span></a>
            </li>

            <li class="@if ( Request::segment(2) == 'order_food') active @endif">
                <a href="{{ url('admin/order_food') }}"><span class="fa fa-shopping-cart"></span><span class="xn-text">Order Food List</span></a>
            </li>

       {{--      <li class="@if ( Request::segment(2) == 'best_seller') active @endif">
                <a href="{{ url('admin/best_seller') }}"><span class="fa fa-frown-o"></span> <span class="xn-text">Best Seller List</span></a>
            </li> --}}

            <li class="@if (Request::segment(2) == 'version_setting') active @endif">
                <a href="{{ url('admin/version_setting') }}"><span class="fa fa-refresh"></span><span class="xn-text">Version Setting List</span></a>
            </li>

           
        </ul>
    </div>