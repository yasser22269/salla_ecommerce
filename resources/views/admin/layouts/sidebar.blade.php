

  <div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" navigation-header">
            <span data-i18n="nav.Users.pages">Users</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Users*') ? 'active' : '' }}"><a href="{{ route('Users.index') }}"><i class="la la-user"></i><span class="menu-title" >Users</span><span class="badge badge badge-info float-right"> {{ App\Models\User::count() }} </span></a>
        </li>

          <li class=" navigation-header">
              <span data-i18n="nav.Order.pages">Orders</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Order*') ? 'active' : '' }}"><a href="{{ route('OrderAdmin.index') }}"><i class="la la-check-square"></i><span class="menu-title" >Orders</span><span class="badge badge badge-info float-right"> {{ App\Models\Order::count() }} </span></a>
          </li>

          <li class=" navigation-header">
              <span data-i18n="nav.category.pages">categories</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Category*') ? 'active' : '' }}"><a href="{{ route('Category.index') }}"><i class="la la-check-square"></i><span class="menu-title" >categories</span><span class="badge badge badge-info float-right"> {{ App\Models\category::count() }} </span></a>
          </li>

          <li class=" navigation-header">
              <span data-i18n="nav.category.pages">Products</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Products*') ? 'active' : '' }}"><a href="{{ route('Products.index') }}"><i class="la la-edit"></i><span class="menu-title" >Products</span><span class="badge badge badge-info float-right"> {{ App\Models\Product::count() }} </span></a>
          </li>


          <li class=" navigation-header">
              <span data-i18n="nav.category.pages">Attributes</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Attributes*') ? 'active' : '' }}"><a href="{{ route('Attributes.index') }}"><i class="la la-edit"></i><span class="menu-title" >Attributes</span><span class="badge badge badge-info float-right"> {{ App\Models\Attribute::count() }} </span></a>
          </li>


          <li class=" navigation-header">
              <span data-i18n="nav.category.pages">Option</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Options*') ? 'active' : '' }}"><a href="{{ route('Options.index') }}"><i class="la la-edit"></i><span class="menu-title" >Options</span><span class="badge badge badge-info float-right"> {{ App\Models\Option::count() }} </span></a>
          </li>

          <li class=" navigation-header">
              <span data-i18n="nav.contactus.pages">CONTACT</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/Contact*') ? 'active' : '' }}"><a href="{{ route('Contact.index') }}"><i class="la la-edit"></i><span class="menu-title" >Contacts</span><span class="badge badge badge-info float-right"> {{ App\Models\ContactUS::count() }} </span></a>
          </li>




          <li class=" navigation-header">
              <span data-i18n="nav.coupons.pages">coupons</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item  {{ Request::is('Admin/coupon*') ? 'active' : '' }}"><a href="{{ route('coupon.index') }}"><i class="la la-edit"></i><span class="menu-title" >coupons</span><span class="badge badge badge-info float-right"> {{ App\Models\coupon::count() }} </span></a>
          </li>

          <li class=" navigation-header">
              <span data-i18n="nav.category.pages">Settings</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Pages"></i>
          </li>
          <li class="nav-item {{ Request::is('Admin/Settings*') ? 'active' : '' }}"><a href="{{ route('Settings.index') }}"><i class="la la-edit"></i><span class="menu-title" data-i18n="nav.navbars.main">Settings</span></a>

          </li>

        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
        <li class=" navigation-header"> </li>
      </ul>
    </div>
  </div>
