<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">{{ config('app.name', 'Laravel') }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">RU</a>
      </div>
        <ul class="sidebar-menu">
          <li {!! (request()->is('home') || request()->is('home/*') ? 'class="active"' : '') !!} ><a class="nav-link" href="{{ route('home')}}"><i class="fas fa-home"></i><span>Home</span></a></li>
          
          @permission('master-data-manage')
          <li class="menu-header">Sistem</li>
          <li class="nav-item dropdown {{ (request()->is('master-data/*') ? "active" : '') }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i> <span>Master Data</span></a>
            <ul class="dropdown-menu">
              @permission('category-product-manage')
              <li {!! (request()->is('master-data/category-product') || request()->is('master-data/category-product/*') ? 'class="active"' : '') !!} ><a class="nav-link" href="{{ route('masterdata.categoryProduct.index')}}">Kategori Produk</a></li>
              @endpermission
              @permission('product-manage')
                <li {!! (request()->is('master-data/product') || request()->is('master-data/product/*') ? 'class="active"' : '') !!} ><a class="nav-link" href="{{ route('masterdata.product.index')}}">Data Produk</a></li>
              @endpermission
              @permission('master-pengiriman-manage')
                <li {!! (request()->is('master-data/shipping') || request()->is('master-data/shipping/*') ? 'class="active"' : '') !!} ><a class="nav-link" href="{{ route('masterdata.shipping.index')}}">Master Pengiriman</a></li>
              @endpermission
            </ul>
          </li>
          @endpermission
        </ul>
    </aside>
</div>