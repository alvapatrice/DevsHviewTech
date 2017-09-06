<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)" data-slug="dashboard">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.home'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.home') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Home</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub @if(if_route(['admin.posts.list', 'admin.posts.create'])) active open @endif">
                        <a href="javascript:void(0)" data-slug="layout">
                            <i class="site-menu-icon fa fa-file-text" aria-hidden="true"></i>
                            <span class="site-menu-title">Posts</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.posts.list'])) active  @endif">
                                <a class="animsition-link" href="{{ route('admin.posts.list') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">All Posts</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.posts.create'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.posts.create') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Create New Post</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub @if(if_route([ 'admin.categories.list', 'admin.categories.create' ])) active open @endif">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa fa-list-alt" aria-hidden="true"></i>
                            <span class="site-menu-title">Categories</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.categories.list'])) active @endif">
                                <a href="{{ route('admin.categories.list') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">All categories</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.categories.create'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.categories.create') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Create New Category</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub @if(if_route(['admin.tags.list', 'admin.tags.create'])) active open  @endif">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa fa-tags" aria-hidden="true"></i>
                            <span class="site-menu-title">Tags</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.tags.list'])) active @endif">
                                <a href="{{ route('admin.tags.list') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">All Tags</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.tags.create'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.tags.create') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Create New Tag</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub @if(if_route(['admin.media.list', 'admin.media.create'])) active open @endif">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa fa-picture-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Media</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.media.list'])) active @endif">
                                <a href="{{ route('admin.media.list') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">All Media</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.media.create'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.media.create') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Upload Media</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-category">Users</li>
                    <li class="site-menu-item has-sub @if(if_route(['admin.user.list', 'admin.user.create'])) active open @endif">
                        <a href="javascript:void(0)" data-slug="uikit">
                            <i class="site-menu-icon fa fa-users" aria-hidden="true"></i>
                            <span class="site-menu-title">Users</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.user.list'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.user.list') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">All users</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.user.create'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.user.create') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Create New User</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-category">Forums</li>
                    <li class="site-menu-item has-sub @if(if_route(['admin.threads.category.list', 'admin.threads.category.create', 'admin.threads.list'])) active open @endif">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa fa-comments-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Threads</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.threads.list'])) active @endif">
                                <a href="{{ route('admin.threads.list') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Threads List</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.threads.category.list'])) active @endif">
                                <a href="{{ route('admin.threads.category.list') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Thread Categories</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.threads.category.create'])) active @endif">
                                <a class="animsition-link" href="{{ route('admin.threads.category.create') }}">
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Create New Thread Category</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-category">Books</li>
                    <li class="site-menu-item has-sub @if(if_route(['admin.books.list', 'admin.books.create'])) active open @endif">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa fa-book" aria-hidden="true"></i>
                            <span class="site-menu-title">Books</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.books.list'])) active @endif">
                                <a href="{{ route('admin.books.list') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">All Books</span>
                                </a>
                            </li>
                            <li class="site-menu-item @if(if_route(['admin.books.create'])) active @endif">
                                <a href="{{ route('admin.books.create') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Upload Book</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-category">Others</li>
                    <li class="site-menu-item has-sub @if(if_route(['admin.sitemap.generate'])) active open @endif">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa fa-sitemap" aria-hidden="true"></i>
                            <span class="site-menu-title">Sitemap</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item @if(if_route(['admin.sitemap.generate'])) active @endif">
                                <a href="{{ route('admin.sitemap.generate') }}" >
                                    <i class="site-menu-icon " aria-hidden="true"></i>
                                    <span class="site-menu-title">Generate Siteamp</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="site-menubar-footer">
        <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
           data-original-title="Settings">
            <span class="icon wb-settings" aria-hidden="true"></span>
        </a>
        <a href="{{ route('user.logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon wb-eye-close" aria-hidden="true"></span>
        </a>
        <a href="{{ route('user.logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
    </div>
</div>