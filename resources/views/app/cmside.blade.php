<aside class="main-sidebar sidebar-dark-success elevation-4">
    <div class="">
        <a href="#" class="brand-link">
            <img src="{{ asset('img/logo_cmh.png') }}" alt="CMPHO LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">CMPHO - PLAN</span>
        </a>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-header"><small class="text-muted">สิทธิผู้ดูแลระบบ</small></li>
                <li class="nav-item">
                    <a href="{{ route('cmpho.index') }}"
                        class="nav-link {{ request()->is('cmpho/dashboard') || request()->is('cmpho/view*') ? 'active':'' }}">
                        <i class="nav-icon fa-solid fa-folder-open"></i>
                        แผนงานโครงการ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cmpho.user.index') }}"
                        class="nav-link {{ request()->is('cmpho/users*') ? 'active':'' }}">
                        <i class="nav-icon fa-solid fa-user-cog"></i>
                        ข้อมูลผู้ใช้งาน
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cmpho.hospital.index') }}"
                        class="nav-link {{ request()->is('cmpho/hospital*') ? 'active':'' }}">
                        <i class="nav-icon fa-solid fa-hospital"></i>
                        ข้อมูลหน่วยบริการ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cmpho.department.index') }}"
                        class="nav-link {{ request()->is('cmpho/department*') ? 'active':'' }}">
                        <i class="nav-icon fa-solid fa-sitemap"></i>
                        ข้อมูลกลุ่มงาน สสจ.
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cmpho.budget.index') }}"
                        class="nav-link {{ request()->is('cmpho/budget*') ? 'active':'' }}">
                        <i class="nav-icon fa-solid fa-comments-dollar"></i>
                        ข้อมูลแหล่งงบประมาณ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-book"></i>
                        คู่มือการใช้งาน
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>