<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>{{ $title }}</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin-dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="/vendors/images/dglogo.png" alt="">
                        </span>
                        <span class="user-name">{{ session('admin')['name'] }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="/admin/{{  session('admin')['id'] }}/edit"><i
                                class="dw dw-user1"></i> Profile</a>
                        <a class="dropdown-item" href="/logout"><i class="dw dw-logout"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
