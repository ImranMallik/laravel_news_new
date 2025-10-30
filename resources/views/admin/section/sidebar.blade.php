 <div class="navbar-bg"></div>


 <div class="main-sidebar sidebar-style-2">
     <aside id="sidebar-wrapper">
         <div class="sidebar-brand">
             <a href="index.html">Stisla</a>
         </div>
         <div class="sidebar-brand sidebar-brand-sm">
             <a href="index.html">St</a>
         </div>
         <ul class="sidebar-menu">
             <li class="{{ setActive(['admin.dashboard']) }}">
                 <a class="nav-link" href="{{ route('admin.dashboard') }}">
                     <i class="fas fa-fire"></i><span>Dashboard</span>
                 </a>
             </li>

             <li class="{{ setActive(['admin.language.index', 'admin.language.create', 'admin.language.edit']) }}">
                 <a class="nav-link"
                     href="{{ route('admin.language.index', 'admin.language.create', 'admin.language.edit') }}">
                     <i class="fas fa-language"></i>
                     <span>Languages</span>
                 </a>
             </li>


             <li class="{{ setActive(['admin.category.index', 'admin.category.create', 'admin.category.edit']) }}">
                 <a class="nav-link"
                     href="{{ route('admin.category.index', 'admin.category.create', 'admin.category.edit') }}">
                     <i class="fas fa-folder"></i>
                     <span>Category</span>
                 </a>
             </li>
             <li class="{{ setActive(['admin.home-section-setting.index']) }}">
                 <a class="nav-link" href="{{ route('admin.home-section-setting.index') }}">
                     <i class="fas fa-home"></i>
                     <span>Home Section Setting</span>
                 </a>
             </li>
             <li class="{{ setActive(['admin.ads.*']) }}">
                 <a class="nav-link" href="{{ route('admin.ads.index') }}">
                     <i class="fas fa-bullhorn"></i>
                     <span>Advertisement</span>
                 </a>
             </li>

             <li class="{{ setActive(['admin.subscriber.*']) }}">
                 <a class="nav-link" href="{{ route('admin.subscriber.index') }}">
                     <i class="fas fa-envelope-open-text"></i>
                     <span>Subscribers</span>
                 </a>
             </li>

             <li class="{{ setActive(['admin.social-count.*']) }}">
                 <a class="nav-link" href="{{ route('admin.social-count.index') }}">
                     <i class="fas fa-chart-bar"></i>
                     <span>Social Count</span>
                 </a>
             </li>




             <li class="dropdown {{ setActive(['admin.news.index', 'admin.news.create', 'admin.news.edit']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                     <span>News</span></a>
                 <ul class="dropdown-menu">
                     <li class="{{ setActive(['admin.news.index', 'admin.news.create', 'admin.news.edit']) }}">
                         <a class="nav-link" href="{{ route('admin.news.index') }}">All News</a>
                     </li>
                 </ul>
             </li>

             <li class="{{ setActive(['admin.user-contract-message']) }}">
                 <a class="nav-link" href="{{ route('admin.user-contract-message') }}">
                     <i class="fas fa-envelope"></i>
                     <span>Contact Message</span>
                     @if ($unreadMessage > 0)
                         <i class="badge bg-danger" style="color:#fff">{{ $unreadMessage }}</i>
                     @endif

                 </a>
             </li>



             <li
                 class="dropdown {{ setActive(['admin.social-link.*', 'admin.footer-info.*', 'admin.footer-grid-one.*', 'admin.footer-grid-two.*', 'admin.footer-grid-three.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                     <i class="fas fa-share-alt"></i>
                     <span>Footer Setting</span>
                 </a>
                 <ul class="dropdown-menu">
                     <li
                         class="{{ setActive(['admin.social-link.index', 'admin.social-link.create', 'admin.social-link.edit']) }}">
                         <a class="nav-link" href="{{ route('admin.social-link.index') }}">Social Links</a>
                     </li>
                     <li
                         class="{{ setActive(['admin.footer-info.index', 'admin.footer-info.create', 'admin.footer-info.edit']) }}">
                         <a class="nav-link" href="{{ route('admin.footer-info.index') }}">Footer Info</a>
                     </li>
                     <li
                         class="{{ setActive(['admin.footer-grid-one.index', 'admin.footer-grid-one.create', 'admin.footer-grid-one.edit']) }}">
                         <a class="nav-link" href="{{ route('admin.footer-grid-one.index') }}">Footer Grid One</a>
                     </li>
                     <li
                         class="{{ setActive(['admin.footer-grid-two.index', 'admin.footer-grid-two.create', 'admin.footer-grid-two.edit']) }}">
                         <a class="nav-link" href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a>
                     </li>
                     <li
                         class="{{ setActive(['admin.footer-grid-three.index', 'admin.footer-grid-three.create', 'admin.footer-grid-three.edit']) }}">
                         <a class="nav-link" href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a>
                     </li>
                 </ul>
             </li>

             <li class="dropdown {{ setActive(['admin.about-us.*', 'admin.contract-us.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-alt"></i>
                     <span>Pages</span></a>
                 <ul class="dropdown-menu">
                     <li class="{{ setActive(['admin.about-us.*']) }}">
                         <a class="nav-link" href="{{ route('admin.about-us.index') }}">About Us</a>
                     </li>
                 </ul>
                 <ul class="dropdown-menu">
                     <li class="{{ setActive(['admin.contract-us.*']) }}">
                         <a class="nav-link" href="{{ route('admin.contract-us.index') }}">Contract Us</a>
                     </li>
                 </ul>
             </li>

             <li class="dropdown {{ setActive(['admin.role.*']) }}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                     <i class="fas fa-users-cog"></i>
                     <span>{{ __('Access Management') }}</span>
                 </a>
                 <ul class="dropdown-menu">
                     <li class="{{ setActive(['admin.role.index', 'admin.role.create']) }}">
                         <a class="nav-link"
                             href="{{ route('admin.role.index') }}">{{ __('Roles and Permissions') }}</a>
                     </li>
                 </ul>
             </li>



             <li class="{{ setActive(['admin.setting.index']) }}">
                 <a class="nav-link" href="{{ route('admin.setting.index') }}">
                     <i class="fas fa-cog"></i>
                     <span>Settings</span>
                 </a>
             </li>



             {{-- <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                     <span>Layout</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                     <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                     <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                 </ul>
             </li>
             <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}
         </ul>


     </aside>
 </div>
