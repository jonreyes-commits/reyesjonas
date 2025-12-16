<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Vaccination Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-purple: #7c3aed;
            --light-purple: #a78bfa;
            --dark-purple: #5b21b6;
            --accent-pink: #ec4899;
            --accent-blue: #3b82f6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 25%, #ede9fe 75%, #ddd6fe 100%);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 15% 40%, rgba(124, 58, 237, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 85% 70%, rgba(236, 72, 153, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 50% 10%, rgba(59, 130, 246, 0.06) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }
        
        .navbar {
            background: linear-gradient(135deg, #5b21b6 0%, #7c3aed 50%, #a855f7 100%);
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 1.2rem 0;
            backdrop-filter: blur(20px);
            border-bottom: 3px solid rgba(255,255,255,0.15);
            position: relative;
            overflow: hidden;
        }
        
        .navbar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: navShine 8s linear infinite;
        }
        
        @keyframes navShine {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .navbar-content {
            position: relative;
            z-index: 1;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.75rem;
            color: white !important;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: flex;
            align-items: center;
            gap: 15px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .navbar-brand i {
            font-size: 2.2rem;
            background: linear-gradient(135deg, #fff 0%, #e9d5ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: iconPulse 3s ease-in-out infinite;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }
        
        @keyframes iconPulse {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.15) rotate(5deg); }
        }
        
        .navbar-brand:hover {
            transform: translateY(-3px) scale(1.02);
            text-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }
        
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .navbar-user {
            background: rgba(255,255,255,0.2);
            padding: 12px 24px;
            border-radius: 50px;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .navbar-user:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            border-color: rgba(255,255,255,0.5);
        }
        
        .navbar-user i {
            font-size: 1.4rem;
            background: linear-gradient(135deg, #e9d5ff 0%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar-user-name {
            font-weight: 700;
            font-size: 1.05rem;
            color: white;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            cursor: pointer;
            letter-spacing: 0.3px;
        }
        
        .btn-logout:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5);
        }
        
        .main-container {
            margin-top: 30px;
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .admin-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background: rgba(255, 255, 255, 0.95);
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.8);
        }
        
        .admin-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(124, 58, 237, 0.15);
            border-color: rgba(124, 58, 237, 0.2);
        }
        
        .admin-card-header {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            padding: 1.5rem;
            font-weight: 700;
            font-size: 1.15rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        .admin-card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .quick-action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .quick-action-card {
            padding: 35px;
            border-radius: 20px;
            border: none;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
            text-align: center;
        }
        
        .quick-action-card::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .quick-action-card:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .quick-action-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 15px 45px rgba(124, 58, 237, 0.5);
        }
        
        .quick-action-card i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            display: block;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }
        
        .quick-action-card span {
            position: relative;
            z-index: 1;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
            letter-spacing: 0.3px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #6d28d9 0%, #7c3aed 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            font-weight: 600;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
            font-weight: 600;
            color: white;
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.5);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            font-weight: 600;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5);
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #f3e8ff;
            padding: 12px 18px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
        }
        
        .modal-content {
            border-radius: 20px;
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            color: white;
            border-radius: 20px 20px 0 0;
        }
        
        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            color: white;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background-color: #faf5ff;
            transform: scale(1.01);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
            padding: 25px;
            border-radius: 20px;
            color: white;
            text-align: center;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
            transition: all 0.4s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(124, 58, 237, 0.4);
        }
        
        .stat-card i {
            font-size: 3rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }
        
        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 10px 0;
        }
        
        .stat-card p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 600;
        }
        
        .timestamp-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .worker-badge {
            background: #dbeafe;
            color: #1e40af;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4 navbar-content">
            <a class="navbar-brand" href="#">
                <i class="fas fa-user-shield"></i>
                <span>Admin Portal</span>
            </a>
            <div class="navbar-actions ms-auto">
                <div class="navbar-user">
                    <i class="fas fa-crown"></i>
                    <span class="navbar-user-name">System Administrator</span>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container main-container">
        <!-- Statistics Dashboard -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="fas fa-syringe"></i>
                    <h3 id="totalVaccines">0</h3>
                    <p>Vaccine Types</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);">
                    <i class="fas fa-users"></i>
                    <h3 id="totalUsers">0</h3>
                    <p>System Users</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);">
                    <i class="fas fa-calendar-check"></i>
                    <h3 id="totalRecords">0</h3>
                    <p>Vaccination Records</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%);">
                    <i class="fas fa-building"></i>
                    <h3 id="totalManufacturers">0</h3>
                    <p>Manufacturers</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-action-grid">
            <div class="quick-action-card" onclick="showAddVaccine()">
                <i class="fas fa-plus-circle"></i>
                <span>Add Vaccine Type</span>
            </div>
            <div class="quick-action-card" style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);" onclick="showManageUsers()">
                <i class="fas fa-users-cog"></i>
                <span>Manage Users</span>
            </div>
            <div class="quick-action-card" style="background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);" onclick="showVaccinationLogs()">
                <i class="fas fa-clipboard-list"></i>
                <span>Vaccination Logs</span>
            </div>
            <div class="quick-action-card" style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%);" onclick="showManufacturers()">
                <i class="fas fa-industry"></i>
                <span>Manufacturers</span>
            </div>
        </div>

        <!-- Vaccine Types Management -->
        <div class="admin-card">
            <div class="admin-card-header">
                <i class="fas fa-syringe me-2"></i>Vaccine Types Management
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vaccine Name</th>
                                <th>Manufacturer</th>
                                <th>Doses Required</th>
                                <th>Interval (Days)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="vaccineTableBody">
                            <tr>
                                <td colspan="7" class="text-center text-muted">No vaccine types added yet</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- User Management -->
        <div class="admin-card">
            <div class="admin-card-header">
                <i class="fas fa-users me-2"></i>User Management
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <tr>
                                <td colspan="7" class="text-center text-muted">No users added yet</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Vaccination Records Log -->
        <div class="admin-card">
            <div class="admin-card-header">
                <i class="fas fa-history me-2"></i>Vaccination Records Log
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Record ID</th>
                                <th>Patient Name</th>
                                <th>Vaccine</th>
                                <th>Dose</th>
                                <th>Health Worker</th>
                                <th>Timestamp</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody id="logTableBody">
                            <tr>
                                <td colspan="7" class="text-center text-muted">No vaccination records yet</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Vaccine Modal -->
    <div class="modal fade" id="addVaccineModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Add Vaccine Type</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addVaccineForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Storage Temperature</label>
                                <input type="text" class="form-control" id="updateStorageTemp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Efficacy Rate (%)</label>
                                <input type="number" class="form-control" id="updateEfficacyRate" min="0" max="100" step="0.1">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="updateVaccineDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-select" id="updateVaccineStatus" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Under Review">Under Review</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updateVaccine()">
                        <i class="fas fa-save me-2"></i>Update Vaccine
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalTitle"><i class="fas fa-user-plus me-2"></i>Add New User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <input type="hidden" id="userId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="userName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" id="userEmail" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role *</label>
                                <select class="form-select" id="userRole" required onchange="updatePermissions()">
                                    <option value="">Select Role</option>
                                    <option value="Admin">Administrator</option>
                                    <option value="Health Worker">Health Worker</option>
                                    <option value="Viewer">Viewer (Read Only)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" class="form-control" id="userDepartment">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="permViewRecords" checked disabled>
                                        <label class="form-check-label" for="permViewRecords">View Patient Records</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="permAddRecords">
                                        <label class="form-check-label" for="permAddRecords">Add Vaccination Records</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="permEditRecords">
                                        <label class="form-check-label" for="permEditRecords">Edit Records</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="permManageUsers">
                                        <label class="form-check-label" for="permManageUsers">Manage Users</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="permManageVaccines">
                                        <label class="form-check-label" for="permManageVaccines">Manage Vaccines</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="permViewReports">
                                        <label class="form-check-label" for="permViewReports">View Reports</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-select" id="userStatus" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveUser()">
                        <i class="fas fa-save me-2"></i>Save User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Manufacturer Modal -->
    <div class="modal fade" id="manufacturerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-industry me-2"></i>Manage Manufacturers</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Contact Email</th>
                                    <th>Website</th>
                                </tr>
                            </thead>
                            <tbody id="manufacturerTableBody">
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h5 class="mb-3"><i class="fas fa-plus me-2"></i>Add New Manufacturer</h5>
                    <form id="addManufacturerForm">
                        <div class="mb-3">
                            <label class="form-label">Manufacturer Name *</label>
                            <input type="text" class="form-control" id="manufacturerName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country *</label>
                            <input type="text" class="form-control" id="manufacturerCountry" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" id="manufacturerEmail">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Website</label>
                            <input type="url" class="form-control" id="manufacturerWebsite">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addManufacturer()">
                        <i class="fas fa-save me-2"></i>Add Manufacturer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data Storage
        let vaccines = [];
        let users = [];
        let manufacturers = [];
        let vaccinationRecords = [];
        let vaccineIdCounter = 1;
        let userIdCounter = 1;
        let manufacturerIdCounter = 1;
        let recordIdCounter = 1;

        // Initialize with sample data
        function initializeSampleData() {
            // Sample Manufacturers
            manufacturers = [
                { id: manufacturerIdCounter++, name: 'Pfizer-BioNTech', country: 'USA/Germany', email: 'contact@pfizer.com', website: 'https://www.pfizer.com' },
                { id: manufacturerIdCounter++, name: 'Moderna', country: 'USA', email: 'info@modernatx.com', website: 'https://www.modernatx.com' },
                { id: manufacturerIdCounter++, name: 'Johnson & Johnson', country: 'USA', email: 'contact@jnj.com', website: 'https://www.jnj.com' },
                { id: manufacturerIdCounter++, name: 'AstraZeneca', country: 'UK/Sweden', email: 'info@astrazeneca.com', website: 'https://www.astrazeneca.com' },
                { id: manufacturerIdCounter++, name: 'Sinovac', country: 'China', email: 'contact@sinovac.com', website: 'https://www.sinovac.com' }
            ];

            // Sample Vaccines
            vaccines = [
                {
                    id: vaccineIdCounter++,
                    name: 'Pfizer-BioNTech COVID-19',
                    manufacturer: 'Pfizer-BioNTech',
                    dosesRequired: 2,
                    doseInterval: 21,
                    boosterInterval: 180,
                    storageTemp: '-70°C to -80°C',
                    efficacyRate: 95,
                    description: 'mRNA-based vaccine for COVID-19',
                    status: 'Active'
                },
                {
                    id: vaccineIdCounter++,
                    name: 'Moderna COVID-19',
                    manufacturer: 'Moderna',
                    dosesRequired: 2,
                    doseInterval: 28,
                    boosterInterval: 180,
                    storageTemp: '-20°C',
                    efficacyRate: 94.1,
                    description: 'mRNA vaccine for COVID-19',
                    status: 'Active'
                },
                {
                    id: vaccineIdCounter++,
                    name: 'Johnson & Johnson COVID-19',
                    manufacturer: 'Johnson & Johnson',
                    dosesRequired: 1,
                    doseInterval: 0,
                    boosterInterval: 60,
                    storageTemp: '2°C to 8°C',
                    efficacyRate: 66.3,
                    description: 'Single-dose viral vector vaccine',
                    status: 'Active'
                }
            ];

            // Sample Users
            users = [
                {
                    id: userIdCounter++,
                    name: 'Dr. Sarah Johnson',
                    email: 'sarah.johnson@hospital.com',
                    role: 'Health Worker',
                    department: 'Immunization Department',
                    permissions: {
                        viewRecords: true,
                        addRecords: true,
                        editRecords: true,
                        manageUsers: false,
                        manageVaccines: false,
                        viewReports: true
                    },
                    status: 'Active'
                },
                {
                    id: userIdCounter++,
                    name: 'Admin User',
                    email: 'admin@hospital.com',
                    role: 'Admin',
                    department: 'Administration',
                    permissions: {
                        viewRecords: true,
                        addRecords: true,
                        editRecords: true,
                        manageUsers: true,
                        manageVaccines: true,
                        viewReports: true
                    },
                    status: 'Active'
                },
                {
                    id: userIdCounter++,
                    name: 'Dr. Michael Chen',
                    email: 'michael.chen@hospital.com',
                    role: 'Health Worker',
                    department: 'Emergency Department',
                    permissions: {
                        viewRecords: true,
                        addRecords: true,
                        editRecords: false,
                        manageUsers: false,
                        manageVaccines: false,
                        viewReports: true
                    },
                    status: 'Active'
                }
            ];

            // Sample Vaccination Records
            vaccinationRecords = [
                {
                    id: recordIdCounter++,
                    patientName: 'John Doe',
                    patientId: 1001,
                    vaccine: 'Pfizer-BioNTech COVID-19',
                    dose: 1,
                    batchNumber: 'PF2024-001',
                    healthWorker: 'Dr. Sarah Johnson',
                    healthWorkerId: 1,
                    timestamp: '2024-12-01 10:30:45',
                    location: 'Main Clinic - Room 3'
                },
                {
                    id: recordIdCounter++,
                    patientName: 'John Doe',
                    patientId: 1001,
                    vaccine: 'Pfizer-BioNTech COVID-19',
                    dose: 2,
                    batchNumber: 'PF2024-015',
                    healthWorker: 'Dr. Sarah Johnson',
                    healthWorkerId: 1,
                    timestamp: '2024-12-16 14:15:20',
                    location: 'Main Clinic - Room 3'
                },
                {
                    id: recordIdCounter++,
                    patientName: 'Maria Santos',
                    patientId: 1002,
                    vaccine: 'Moderna COVID-19',
                    dose: 1,
                    batchNumber: 'MD2024-088',
                    healthWorker: 'Dr. Michael Chen',
                    healthWorkerId: 3,
                    timestamp: '2024-12-10 09:45:12',
                    location: 'Emergency Department'
                }
            ];

            updateAllTables();
            updateStatistics();
            populateManufacturerDropdowns();
        }

        // Update all tables
        function updateAllTables() {
            updateVaccineTable();
            updateUserTable();
            updateLogTable();
            updateManufacturerTable();
        }

        // Update Statistics
        function updateStatistics() {
            document.getElementById('totalVaccines').textContent = vaccines.length;
            document.getElementById('totalUsers').textContent = users.length;
            document.getElementById('totalRecords').textContent = vaccinationRecords.length;
            document.getElementById('totalManufacturers').textContent = manufacturers.length;
        }

        // Populate manufacturer dropdowns
        function populateManufacturerDropdowns() {
            const options = manufacturers.map(m => `<option value="${m.name}">${m.name}</option>`).join('');
            document.getElementById('vaccineManufacturer').innerHTML = '<option value="">Select Manufacturer</option>' + options;
            document.getElementById('updateVaccineManufacturer').innerHTML = '<option value="">Select Manufacturer</option>' + options;
        }

        // Show modals
        function showAddVaccine() {
            document.getElementById('addVaccineForm').reset();
            new bootstrap.Modal(document.getElementById('addVaccineModal')).show();
        }

        function showManageUsers() {
            document.getElementById('userModalTitle').innerHTML = '<i class="fas fa-user-plus me-2"></i>Add New User';
            document.getElementById('userForm').reset();
            document.getElementById('userId').value = '';
            new bootstrap.Modal(document.getElementById('userModal')).show();
        }

        function showVaccinationLogs() {
            document.querySelector('.admin-card:last-child').scrollIntoView({ behavior: 'smooth' });
        }

        function showManufacturers() {
            updateManufacturerTable();
            new bootstrap.Modal(document.getElementById('manufacturerModal')).show();
        }

        // Add Vaccine
        function addVaccine() {
            const name = document.getElementById('vaccineName').value;
            const manufacturer = document.getElementById('vaccineManufacturer').value;
            const dosesRequired = document.getElementById('dosesRequired').value;
            const doseInterval = document.getElementById('doseInterval').value;
            const boosterInterval = document.getElementById('boosterInterval').value;
            const storageTemp = document.getElementById('storageTemp').value;
            const efficacyRate = document.getElementById('efficacyRate').value;
            const description = document.getElementById('vaccineDescription').value;
            const status = document.getElementById('vaccineStatus').value;

            if (!name || !manufacturer || !dosesRequired || !status) {
                alert('Please fill in all required fields!');
                return;
            }

            const vaccine = {
                id: vaccineIdCounter++,
                name,
                manufacturer,
                dosesRequired: parseInt(dosesRequired),
                doseInterval: parseInt(doseInterval) || 0,
                boosterInterval: parseInt(boosterInterval) || 0,
                storageTemp: storageTemp || 'N/A',
                efficacyRate: parseFloat(efficacyRate) || 0,
                description: description || 'No description provided',
                status
            };

            vaccines.push(vaccine);
            updateVaccineTable();
            updateStatistics();
            bootstrap.Modal.getInstance(document.getElementById('addVaccineModal')).hide();
            alert('Vaccine type added successfully!');
        }

        // Update Vaccine Table
        function updateVaccineTable() {
            const tbody = document.getElementById('vaccineTableBody');
            if (vaccines.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">No vaccine types added yet</td></tr>';
                return;
            }

            tbody.innerHTML = vaccines.map(v => `
                <tr>
                    <td><strong>${v.id}</strong></td>
                    <td><strong>${v.name}</strong></td>
                    <td>${v.manufacturer}</td>
                    <td>${v.dosesRequired}</td>
                    <td>${v.doseInterval || 'N/A'}</td>
                    <td><span class="badge ${getStatusBadge(v.status)}">${v.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="viewVaccineDetails(${v.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="openUpdateVaccine(${v.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteVaccine(${v.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // Open Update Vaccine Modal
        function openUpdateVaccine(vaccineId) {
            const vaccine = vaccines.find(v => v.id === vaccineId);
            if (!vaccine) return;

            document.getElementById('updateVaccineId').value = vaccine.id;
            document.getElementById('updateVaccineName').value = vaccine.name;
            document.getElementById('updateVaccineManufacturer').value = vaccine.manufacturer;
            document.getElementById('updateDosesRequired').value = vaccine.dosesRequired;
            document.getElementById('updateDoseInterval').value = vaccine.doseInterval;
            document.getElementById('updateBoosterInterval').value = vaccine.boosterInterval;
            document.getElementById('updateStorageTemp').value = vaccine.storageTemp;
            document.getElementById('updateEfficacyRate').value = vaccine.efficacyRate;
            document.getElementById('updateVaccineDescription').value = vaccine.description;
            document.getElementById('updateVaccineStatus').value = vaccine.status;

            new bootstrap.Modal(document.getElementById('updateVaccineModal')).show();
        }

        // Update Vaccine
        function updateVaccine() {
            const vaccineId = parseInt(document.getElementById('updateVaccineId').value);
            const vaccine = vaccines.find(v => v.id === vaccineId);
            
            if (!vaccine) return;

            vaccine.name = document.getElementById('updateVaccineName').value;
            vaccine.manufacturer = document.getElementById('updateVaccineManufacturer').value;
            vaccine.dosesRequired = parseInt(document.getElementById('updateDosesRequired').value);
            vaccine.doseInterval = parseInt(document.getElementById('updateDoseInterval').value) || 0;
            vaccine.boosterInterval = parseInt(document.getElementById('updateBoosterInterval').value) || 0;
            vaccine.storageTemp = document.getElementById('updateStorageTemp').value;
            vaccine.efficacyRate = parseFloat(document.getElementById('updateEfficacyRate').value) || 0;
            vaccine.description = document.getElementById('updateVaccineDescription').value;
            vaccine.status = document.getElementById('updateVaccineStatus').value;

            updateVaccineTable();
            bootstrap.Modal.getInstance(document.getElementById('updateVaccineModal')).hide();
            alert('Vaccine information updated successfully!');
        }

        // Delete Vaccine
        function deleteVaccine(vaccineId) {
            if (confirm('Are you sure you want to delete this vaccine type?')) {
                vaccines = vaccines.filter(v => v.id !== vaccineId);
                updateVaccineTable();
                updateStatistics();
                alert('Vaccine type deleted successfully!');
            }
        }

        // View Vaccine Details
        function viewVaccineDetails(vaccineId) {
            const vaccine = vaccines.find(v => v.id === vaccineId);
            if (!vaccine) return;

            alert(`🔬 VACCINE DETAILS\n━━━━━━━━━━━━━━━━━━━━━━━\nVaccine Name: ${vaccine.name}\nManufacturer: ${vaccine.manufacturer}\nDoses Required: ${vaccine.dosesRequired}\nDose Interval: ${vaccine.doseInterval} days\nBooster Interval: ${vaccine.boosterInterval} days\nStorage Temperature: ${vaccine.storageTemp}\nEfficacy Rate: ${vaccine.efficacyRate}%\nDescription: ${vaccine.description}\nStatus: ${vaccine.status}`);
        }

        // Update User Table
        function updateUserTable() {
            const tbody = document.getElementById('userTableBody');
            if (users.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">No users added yet</td></tr>';
                return;
            }

            tbody.innerHTML = users.map(u => {
                const permCount = Object.values(u.permissions).filter(p => p).length;
                return `
                <tr>
                    <td><strong>${u.id}</strong></td>
                    <td>${u.name}</td>
                    <td>${u.email}</td>
                    <td><span class="badge bg-info">${u.role}</span></td>
                    <td><span class="badge bg-secondary">${permCount} permissions</span></td>
                    <td><span class="badge ${getStatusBadge(u.status)}">${u.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="viewUserDetails(${u.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="editUser(${u.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser(${u.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `}).join('');
        }

        // Save User
        function saveUser() {
            const userId = document.getElementById('userId').value;
            const name = document.getElementById('userName').value;
            const email = document.getElementById('userEmail').value;
            const role = document.getElementById('userRole').value;
            const department = document.getElementById('userDepartment').value;
            const status = document.getElementById('userStatus').value;

            if (!name || !email || !role || !status) {
                alert('Please fill in all required fields!');
                return;
            }

            const permissions = {
                viewRecords: document.getElementById('permViewRecords').checked,
                addRecords: document.getElementById('permAddRecords').checked,
                editRecords: document.getElementById('permEditRecords').checked,
                manageUsers: document.getElementById('permManageUsers').checked,
                manageVaccines: document.getElementById('permManageVaccines').checked,
                viewReports: document.getElementById('permViewReports').checked
            };

            if (userId) {
                // Update existing user
                const user = users.find(u => u.id === parseInt(userId));
                if (user) {
                    user.name = name;
                    user.email = email;
                    user.role = role;
                    user.department = department;
                    user.permissions = permissions;
                    user.status = status;
                }
            } else {
                // Add new user
                users.push({
                    id: userIdCounter++,
                    name,
                    email,
                    role,
                    department: department || 'N/A',
                    permissions,
                    status
                });
            }

            updateUserTable();
            updateStatistics();
            bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
            alert('User saved successfully!');
        }

        // Edit User
        function editUser(userId) {
            const user = users.find(u => u.id === userId);
            if (!user) return;

            document.getElementById('userModalTitle').innerHTML = '<i class="fas fa-user-edit me-2"></i>Edit User';
            document.getElementById('userId').value = user.id;
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userRole').value = user.role;
            document.getElementById('userDepartment').value = user.department;
            document.getElementById('userStatus').value = user.status;
            
            document.getElementById('permViewRecords').checked = user.permissions.viewRecords;
            document.getElementById('permAddRecords').checked = user.permissions.addRecords;
            document.getElementById('permEditRecords').checked = user.permissions.editRecords;
            document.getElementById('permManageUsers').checked = user.permissions.manageUsers;
            document.getElementById('permManageVaccines').checked = user.permissions.manageVaccines;
            document.getElementById('permViewReports').checked = user.permissions.viewReports;

            new bootstrap.Modal(document.getElementById('userModal')).show();
        }

        // Delete User
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                users = users.filter(u => u.id !== userId);
                updateUserTable();
                updateStatistics();
                alert('User deleted successfully!');
            }
        }

        // View User Details
        function viewUserDetails(userId) {
            const user = users.find(u => u.id === userId);
            if (!user) return;

            const permList = Object.entries(user.permissions)
                .filter(([key, value]) => value)
                .map(([key]) => key.replace(/([A-Z])/g, ' $1').trim())
                .join(', ');

            alert(`👤 USER DETAILS\n━━━━━━━━━━━━━━━━━━━━━━━\nName: ${user.name}\nEmail: ${user.email}\nRole: ${user.role}\nDepartment: ${user.department}\nStatus: ${user.status}\nPermissions: ${permList || 'None'}`);
        }

        // Update Permissions based on Role
        function updatePermissions() {
            const role = document.getElementById('userRole').value;
            
            if (role === 'Admin') {
                document.getElementById('permAddRecords').checked = true;
                document.getElementById('permEditRecords').checked = true;
                document.getElementById('permManageUsers').checked = true;
                document.getElementById('permManageVaccines').checked = true;
                document.getElementById('permViewReports').checked = true;
            } else if (role === 'Health Worker') {
                document.getElementById('permAddRecords').checked = true;
                document.getElementById('permEditRecords').checked = true;
                document.getElementById('permManageUsers').checked = false;
                document.getElementById('permManageVaccines').checked = false;
                document.getElementById('permViewReports').checked = true;
            } else if (role === 'Viewer') {
                document.getElementById('permAddRecords').checked = false;
                document.getElementById('permEditRecords').checked = false;
                document.getElementById('permManageUsers').checked = false;
                document.getElementById('permManageVaccines').checked = false;
                document.getElementById('permViewReports').checked = true;
            }
        }

        // Update Vaccination Log Table
        function updateLogTable() {
            const tbody = document.getElementById('logTableBody');
            if (vaccinationRecords.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">No vaccination records yet</td></tr>';
                return;
            }

            tbody.innerHTML = vaccinationRecords.map(r => `
                <tr>
                    <td><strong>${r.id}</strong></td>
                    <td>${r.patientName} (ID: ${r.patientId})</td>
                    <td>${r.vaccine}</td>
                    <td><span class="badge bg-info">Dose ${r.dose}</span></td>
                    <td><span class="worker-badge">${r.healthWorker}</span></td>
                    <td><span class="timestamp-badge">${r.timestamp}</span></td>
                    <td>${r.location || 'N/A'}</td>
                </tr>
            `).join('');
        }

        // Update Manufacturer Table
        function updateManufacturerTable() {
            const tbody = document.getElementById('manufacturerTableBody');
            if (manufacturers.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No manufacturers added yet</td></tr>';
                return;
            }

            tbody.innerHTML = manufacturers.map(m => `
                <tr>
                    <td><strong>${m.id}</strong></td>
                    <td>${m.name}</td>
                    <td>${m.country}</td>
                    <td>${m.email}</td>
                    <td>${m.website}</td>
                </tr>
            `).join('');
        }

        // Add Manufacturer
        function addManufacturer() {
            const name = document.getElementById('manufacturerName').value;
            const country = document.getElementById('manufacturerCountry').value;
            const email = document.getElementById('manufacturerEmail').value;
            const website = document.getElementById('manufacturerWebsite').value;

            if (!name || !country) {
                alert('Please fill in all required fields!');
                return;
            }

            const manufacturer = {
                id: manufacturerIdCounter++,
                name,
                country,
                email: email || 'N/A',
                website: website || 'N/A'
            };

            manufacturers.push(manufacturer);
            updateManufacturerTable();
            populateManufacturerDropdowns();
            updateStatistics();
            document.getElementById('addManufacturerForm').reset();
            alert('Manufacturer added successfully!');
        }

        // Get status badge class
        function getStatusBadge(status) {
            switch (status) {
                case 'Active':
                    return 'bg-success';
                case 'Inactive':
                    return 'bg-secondary';
                case 'Under Review':
                    return 'bg-warning text-dark';
                case 'Suspended':
                    return 'bg-danger';
                default:
                    return 'bg-light text-dark';
            }
        }

        // Handle Logout
        function handleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logged out successfully!');
                window.location.reload();
            }
        }

        // Initialize on page load
        window.addEventListener('DOMContentLoaded', initializeSampleData);
    </script>
</body>
</html>