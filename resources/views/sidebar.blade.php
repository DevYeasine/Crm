<aside class="admin-sidebar" id="admin-sidebar">
    <div class="sidebar-content">
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ asset('./index.html') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./analytics.html') }}">
                        <i class="bi bi-graph-up"></i>
                        <span>Analytics</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./users.html') }}">
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./products.html') }}">
                        <i class="bi bi-box"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./orders.html') }}">
                        <i class="bi bi-bag-check"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./forms.html') }}">
                        <i class="bi bi-ui-checks"></i>
                        <span>Forms</span>
                        <span class="badge bg-success rounded-pill ms-auto">New</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('#') }}" data-bs-toggle="collapse" data-bs-target="#elementsSubmenu" aria-expanded="false">
                        <i class="bi bi-puzzle"></i>
                        <span>Elements</span>
                        <span class="badge bg-primary rounded-pill me-2">New</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="elementsSubmenu">
                        <ul class="nav nav-submenu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements.html') }}">
                                    <i class="bi bi-grid"></i>
                                    <span>Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements-buttons.html') }}">
                                    <i class="bi bi-square"></i>
                                    <span>Buttons</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements-alerts.html') }}">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    <span>Alerts</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements-badges.html') }}">
                                    <i class="bi bi-award"></i>
                                    <span>Badges</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements-cards.html') }}">
                                    <i class="bi bi-card-text"></i>
                                    <span>Cards</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements-modals.html') }}">
                                    <i class="bi bi-window"></i>
                                    <span>Modals</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements-forms.html') }}">
                                    <i class="bi bi-ui-checks"></i>
                                    <span>Forms</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('./elements-tables.html') }}">
                                    <i class="bi bi-table"></i>
                                    <span>Tables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./reports.html') }}">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./messages.html') }}">
                        <i class="bi bi-chat-dots"></i>
                        <span>Messages</span>
                        <span class="badge bg-danger rounded-pill ms-auto">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./calendar.html') }}">
                        <i class="bi bi-calendar-event"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./files.html') }}">
                        <i class="bi bi-folder2-open"></i>
                        <span>Files</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./settings.html') }}">
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./security.html') }}">
                        <i class="bi bi-shield-check"></i>
                        <span>Security</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('./help.html') }}">
                        <i class="bi bi-question-circle"></i>
                        <span>Help & Support</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>