<div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-1">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" target="_blank" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Visit website
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('backend.admin.dashboard') }}"
                    class="nav-link {{ menuActive('backend.admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            @if(auth()->user()->type== 'Admin')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fab fa-blogger-b nav-icon"></i>
                    <p>
                        Blogs
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>
                                <span class="text-lightblue">Blog</span>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.blogs.create') }}"
                                    class="nav-link {{ menuActive('backend.admin.blogs.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.blogs') }}"
                                    class="nav-link {{ menuActive(['backend.admin.blogs','backend.admin.blogs.edit']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blog List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}"
                            class="nav-link {{ menuActive('categories.*') ? 'active' : '' }}">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>Blog Category</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa fa-id-card nav-icon"></i>
                    <p>
                        Portfolio
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>
                                <span class="text-lightblue">Project</span>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('portfolio.projects.create') }}"
                                    class="nav-link {{ menuActive('portfolio.projects.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('portfolio.projects.index') }}"
                                    class="nav-link {{ menuActive(['portfolio.projects.index','portfolio.projects.edit']) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('portfolio.categories.index') }}"
                            class="nav-link {{ menuActive('portfolio.categories.*') ? 'active' : '' }}">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>Category</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa fa-graduation-cap nav-icon"></i>
                    <p>
                        Resume
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('education.index') }}"
                            class="nav-link {{ menuActive('education.*') ? 'active' : '' }}">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>Education</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('experiences.index') }}"
                            class="nav-link {{ menuActive('experiences.*') ? 'active' : '' }}">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>Experience</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('technology.index') }}"
                    class="nav-link {{ menuActive('technology.*') ? 'active' : '' }}">
                    <i class="fa fa-plug nav-icon"></i>
                    <p>Technology</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('testimonials.index') }}"
                    class="nav-link {{ menuActive('testimonials.*') ? 'active' : '' }}">
                    <i class="fas fa-comments nav-icon"></i>
                    <p>Testimonials</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('services.index') }}"
                    class="nav-link {{ menuActive('services.*') ? 'active' : '' }}">
                    <i class="fa fa-th-large nav-icon"></i>
                    <p>Services</p>
                </a>
            </li>
           
            <li class="nav-item">
                <a href="{{ route('page-builder.index') }}"
                    class="nav-link {{ menuActive('page-builder.*') ? 'active' : '' }}">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Page Builder</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('backend.admin.users') }}"
                    class="nav-link {{ menuActive('backend.admin.users') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User Management
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>
                        Website Settings
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('text-slider.index') }}"
                            class="nav-link {{ menuActive('text-slider.*') ? 'active' : '' }}">
                            <i class="fas fa-folder nav-icon"></i>
                            <p>Text Slider</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('menus.index') }}"
                            class="nav-link {{ menuActive('menus.*') ? 'active' : '' }}">
                            <i class="fas fa-folder nav-icon"></i>
                            <p>Menu Settings</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('backend.admin.settings.website.general') }}?active-tab=website-info"
                            class="nav-link {{ menuActive('backend.admin.settings.website.general') ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>General Settings</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>
                                <span class="text-lightblue">Access Control</span>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.roles') }}"
                                    class="nav-link {{ menuActive('backend.admin.roles') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.permissions') }}"
                                                            class="nav-link {{ menuActive('backend.admin.permissions') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                </ul>
            </li>
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>

<script>
    // Get all elements with the nav-treeview class
    const treeviewElements = document.querySelectorAll('.nav-treeview');

    // Iterate over each treeview element
    treeviewElements.forEach(treeviewElement => {
        // Check if it has the nav-link and active classes
        const navLinkElements = treeviewElement.querySelectorAll('.nav-link.active');

        // If there are nav-link elements with the active class, log the treeview element
        if (navLinkElements.length > 0) {
            // Add the menu-open class to the parent nav-item
            const parentNavItem = treeviewElement.closest('.nav-item');
            if (parentNavItem) {
                parentNavItem.classList.add('menu-open');
            }

            // Add the active class to the immediate child nav-link
            const childNavLink = parentNavItem.querySelector('.nav-link');
            if (childNavLink) {
                childNavLink.classList.add('active');
            }
        }
    });
</script>
