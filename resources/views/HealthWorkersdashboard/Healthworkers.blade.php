<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Worker Portal - Vaccination Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2563eb;
            --light-blue: #60a5fa;
            --dark-blue: #1e40af;
            --accent-purple: #8b5cf6;
            --accent-cyan: #06b6d4;
            --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 25%, #e0e7ff 75%, #ede9fe 100%);
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
                radial-gradient(circle at 20% 50%, rgba(37, 99, 235, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(6, 182, 212, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }
        
        .navbar {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #6366f1 100%);
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
            background: linear-gradient(135deg, #fff 0%, #bfdbfe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: iconPulse 3s ease-in-out infinite;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }
        
        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
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
            background: linear-gradient(135deg, #bfdbfe 0%, #ffffff 100%);
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
        
        .btn-logout i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }
        
        .btn-logout:hover i {
            transform: translateX(-3px);
        }
        
        .main-container {
            margin-top: 30px;
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background: rgba(255, 255, 255, 0.95);
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.8);
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.15);
            border-color: rgba(37, 99, 235, 0.2);
        }
        
        .card-header {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
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
        
        .card-header::before {
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
        
        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
            letter-spacing: 0.3px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
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
            color: white;
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
            border-radius: 10px;
            border: 2px solid #e3f2fd;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(0,102,204,0.25);
        }
        
        .modal-content {
            border-radius: 20px;
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(90deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            color: white;
            border-radius: 20px 20px 0 0;
        }
        
        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(90deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            color: white;
        }
        
        .quick-action-btn {
            width: 100%;
            padding: 35px;
            margin-bottom: 25px;
            border-radius: 20px;
            border: none;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }
        
        .quick-action-btn::before {
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
        
        .quick-action-btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .quick-action-btn:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 15px 45px rgba(37, 99, 235, 0.5);
        }
        
        .quick-action-btn i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            display: block;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }
        
        .quick-action-btn span {
            position: relative;
            z-index: 1;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .vaccination-record {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            border-left: 4px solid var(--primary-blue);
        }
        
        .edit-log-entry {
            background: #fff3cd;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            border-left: 3px solid #ffc107;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4 navbar-content">
            <a class="navbar-brand" href="#">
                <i class="fas fa-hospital-user"></i>
                <span>Health Worker Portal</span>
            </a>
            <div class="navbar-actions ms-auto">
                <div class="navbar-user">
                    <i class="fas fa-user-md"></i>
                    <span class="navbar-user-name">Dr. Health Worker</span>
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
        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-md-4">
                <button class="quick-action-btn" onclick="showRegisterPatient()">
                    <i class="fas fa-user-plus"></i>
                    Register New Patient
                </button>
            </div>
            <div class="col-md-4">
                <button class="quick-action-btn" onclick="showSearchPatient()">
                    <i class="fas fa-search"></i>
                    Search Patient
                </button>
            </div>
            <div class="col-md-4">
                <button class="quick-action-btn" onclick="showRecordVaccination()">
                    <i class="fas fa-syringe"></i>
                    Record Vaccination
                </button>
            </div>
        </div>

        <!-- Patient List -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-users me-2"></i>Registered Patients
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="patientTable">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Contact</th>
                                <th>Eligibility</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="patientTableBody">
                            <tr>
                                <td colspan="6" class="text-center text-muted">No patients registered yet</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Patient Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Register New Patient</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" class="form-control" id="dob" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender *</label>
                                <select class="form-select" id="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Number *</label>
                                <input type="tel" class="form-control" id="contact" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address *</label>
                            <textarea class="form-control" id="address" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Medical Notes</label>
                            <textarea class="form-control" id="medicalNotes" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vaccination Eligibility Status *</label>
                            <select class="form-select" id="eligibility" required>
                                <option value="">Select Status</option>
                                <option value="Eligible">Eligible</option>
                                <option value="Not Eligible">Not Eligible</option>
                                <option value="Pending Review">Pending Review</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="registerPatient()">
                        <i class="fas fa-save me-2"></i>Register Patient
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Details Modal -->
    <div class="modal fade" id="patientDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user me-2"></i>Patient Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="patientDetailsContent"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Patient Modal -->
    <div class="modal fade" id="updatePatientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Patient Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" id="updatePatientId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="updateContact">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="updateEmail">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="updateAddress" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Medical Notes</label>
                            <textarea class="form-control" id="updateMedicalNotes" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Eligibility Status</label>
                            <select class="form-select" id="updateEligibility">
                                <option value="Eligible">Eligible</option>
                                <option value="Not Eligible">Not Eligible</option>
                                <option value="Pending Review">Pending Review</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="updatePatient()">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Record Vaccination Modal -->
    <div class="modal fade" id="recordVaccinationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-syringe me-2"></i>Record Vaccination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Step 1: Verify Patient Identity -->
                    <div id="verifyStep">
                        <h6 class="mb-3">Step 1: Verify Patient Identity</h6>
                        <div class="mb-3">
                            <label class="form-label">Enter Patient ID or Name</label>
                            <input type="text" class="form-control" id="verifyPatientInput" placeholder="Search by ID or name">
                        </div>
                        <button class="btn btn-primary" onclick="verifyPatient()">
                            <i class="fas fa-check-circle me-2"></i>Verify Patient
                        </button>
                        <div id="verifyResult" class="mt-3"></div>
                    </div>

                    <!-- Step 2: Record Vaccination Details -->
                    <div id="vaccinationStep" style="display: none;">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>Patient verified: <strong id="verifiedPatientName"></strong>
                        </div>
                        <form id="vaccinationForm">
                            <input type="hidden" id="vaccinationPatientId">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vaccine Name *</label>
                                    <select class="form-select" id="vaccineName" required>
                                        <option value="">Select Vaccine</option>
                                        <option value="Pfizer-BioNTech">Pfizer-BioNTech</option>
                                        <option value="Moderna">Moderna</option>
                                        <option value="Johnson & Johnson">Johnson & Johnson</option>
                                        <option value="AstraZeneca">AstraZeneca</option>
                                        <option value="Sinovac">Sinovac</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Dose Number *</label>
                                    <select class="form-select" id="doseNumber" required>
                                        <option value="">Select Dose</option>
                                        <option value="1">First Dose</option>
                                        <option value="2">Second Dose</option>
                                        <option value="3">Booster 1</option>
                                        <option value="4">Booster 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Batch Number *</label>
                                    <input type="text" class="form-control" id="batchNumber" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date Administered *</label>
                                    <input type="date" class="form-control" id="dateAdministered" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" id="vaccinationNotes" rows="2"></textarea>
                            </div>
                        </form>
                        <button class="btn btn-success" onclick="recordVaccination()">
                            <i class="fas fa-save me-2"></i>Record Vaccination
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Dose Modal -->
    <div class="modal fade" id="scheduleDoseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-calendar-plus me-2"></i>Schedule Future Dose</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="scheduleForm">
                        <input type="hidden" id="schedulePatientId">
                        <input type="hidden" id="scheduleVaccineName">
                        <div class="mb-3">
                            <label class="form-label">Next Dose Number</label>
                            <input type="text" class="form-control" id="scheduleNextDose" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Recommended Interval</label>
                            <select class="form-select" id="scheduleInterval" onchange="calculateScheduleDate()">
                                <option value="21">3 weeks (21 days)</option>
                                <option value="28">4 weeks (28 days)</option>
                                <option value="90">3 months (90 days)</option>
                                <option value="180">6 months (180 days)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Scheduled Date *</label>
                            <input type="date" class="form-control" id="scheduledDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" id="scheduleNotes" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="scheduleDose()">
                        <i class="fas fa-calendar-check me-2"></i>Schedule Dose
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mark Missed/Rescheduled Modal -->
    <div class="modal fade" id="markMissedModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Mark Vaccination Status</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="missedForm">
                        <input type="hidden" id="missedScheduleId">
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-select" id="missedStatus" required>
                                <option value="">Select Status</option>
                                <option value="Missed">Missed</option>
                                <option value="Rescheduled">Rescheduled</option>
                            </select>
                        </div>
                        <div class="mb-3" id="rescheduleSection" style="display: none;">
                            <label class="form-label">New Scheduled Date</label>
                            <input type="date" class="form-control" id="newScheduledDate">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Explanation *</label>
                            <textarea class="form-control" id="missedExplanation" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" onclick="markMissed()">
                        <i class="fas fa-save me-2"></i>Save Status
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Vaccination Modal -->
    <div class="modal fade" id="editVaccinationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Vaccination Record</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle me-2"></i>Note: Original record will be preserved. Changes will be logged.
                    </div>
                    <form id="editVaccinationForm">
                        <input type="hidden" id="editVaccinationId">
                        <div class="mb-3">
                            <label class="form-label">Reason for Edit *</label>
                            <select class="form-select" id="editReason" required>
                                <option value="">Select Reason</option>
                                <option value="Incorrect Batch Number">Incorrect Batch Number</option>
                                <option value="Wrong Date">Wrong Date</option>
                                <option value="Data Entry Error">Data Entry Error</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Detailed Explanation *</label>
                            <textarea class="form-control" id="editExplanation" rows="2" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Batch Number</label>
                                <input type="text" class="form-control" id="editBatchNumber">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date Administered</label>
                                <input type="date" class="form-control" id="editDateAdministered">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Updated Notes</label>
                            <textarea class="form-control" id="editVaccinationNotes" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveVaccinationEdit()">
                        <i class="fas fa-save me-2"></i>Save Edit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data storage
        let patients = [];
        let vaccinations = [];
        let schedules = [];
        let editLogs = [];
        let patientIdCounter = 1001;

        // Show modals
        function showRegisterPatient() {
            new bootstrap.Modal(document.getElementById('registerModal')).show();
        }

        function showSearchPatient() {
            const search = prompt('Enter Patient ID or Name to search:');
            if (search) {
                const patient = patients.find(p => 
                    p.id.toString().includes(search) || 
                    p.name.toLowerCase().includes(search.toLowerCase())
                );
                if (patient) {
                    viewPatientDetails(patient.id);
                } else {
                    alert('Patient not found!');
                }
            }
        }

        function showRecordVaccination() {
            document.getElementById('verifyStep').style.display = 'block';
            document.getElementById('vaccinationStep').style.display = 'none';
            document.getElementById('verifyPatientInput').value = '';
            document.getElementById('verifyResult').innerHTML = '';
            new bootstrap.Modal(document.getElementById('recordVaccinationModal')).show();
        }

        // Register Patient
        function registerPatient() {
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const dob = document.getElementById('dob').value;
            const gender = document.getElementById('gender').value;
            const contact = document.getElementById('contact').value;
            const email = document.getElementById('email').value;
            const address = document.getElementById('address').value;
            const medicalNotes = document.getElementById('medicalNotes').value;
            const eligibility = document.getElementById('eligibility').value;

            if (!firstName || !lastName || !dob || !gender || !contact || !address || !eligibility) {
                alert('Please fill in all required fields!');
                return;
            }

            const age = calculateAge(dob);
            const patient = {
                id: patientIdCounter++,
                name: `${firstName} ${lastName}`,
                firstName,
                lastName,
                dob,
                age,
                gender,
                contact,
                email,
                address,
                medicalNotes,
                eligibility,
                registeredDate: new Date().toISOString()
            };

            patients.push(patient);
            updatePatientTable();
            bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
            document.getElementById('registerForm').reset();
            
            alert(`Patient registered successfully!\nPatient ID: ${patient.id}`);
        }

        function calculateAge(dob) {
            const today = new Date();
            const birthDate = new Date(dob);
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        // Update patient table
        function updatePatientTable() {
            const tbody = document.getElementById('patientTableBody');
            if (patients.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No patients registered yet</td></tr>';
                return;
            }

            tbody.innerHTML = patients.map(p => `
                <tr>
                    <td><strong>${p.id}</strong></td>
                    <td>${p.name}</td>
                    <td>${p.age}</td>
                    <td>${p.contact}</td>
                    <td><span class="badge ${getEligibilityBadgeClass(p.eligibility)}">${p.eligibility}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="viewPatientDetails(${p.id})">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-sm btn-success" onclick="openUpdatePatient(${p.id})">
                            <i class="fas fa-edit"></i> Update
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function getEligibilityBadgeClass(status) {
            switch(status) {
                case 'Eligible': return 'bg-success';
                case 'Not Eligible': return 'bg-danger';
                case 'Pending Review': return 'bg-warning';
                default: return 'bg-secondary';
            }
        }

        // View Patient Details
        function viewPatientDetails(patientId) {
            const patient = patients.find(p => p.id === patientId);
            if (!patient) return;

            const patientVaccinations = vaccinations.filter(v => v.patientId === patientId);
            const patientSchedules = schedules.filter(s => s.patientId === patientId);

            let content = `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Personal Information</h6>
                        <p><strong>Patient ID:</strong> ${patient.id}</p>
                        <p><strong>Name:</strong> ${patient.name}</p>
                        <p><strong>Date of Birth:</strong> ${patient.dob} (Age: ${patient.age})</p>
                        <p><strong>Gender:</strong> ${patient.gender}</p>
                        <p><strong>Contact:</strong> ${patient.contact}</p>
                        <p><strong>Email:</strong> ${patient.email || 'N/A'}</p>
                        <p><strong>Address:</strong> ${patient.address}</p>
                        <p><strong>Eligibility:</strong> <span class="badge ${getEligibilityBadgeClass(patient.eligibility)}">${patient.eligibility}</span></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary mb-3"><i class="fas fa-notes-medical me-2"></i>Medical Notes</h6>
                        <p>${patient.medicalNotes || 'No medical notes recorded.'}</p>
                    </div>
                </div>
                <hr>
                <h6 class="text-primary mb-3"><i class="fas fa-syringe me-2"></i>Vaccination History</h6>
            `;

            if (patientVaccinations.length === 0) {
                content += '<p class="text-muted">No vaccinations recorded yet.</p>';
            } else {
                patientVaccinations.forEach(v => {
                    const logs = editLogs.filter(log => log.vaccinationId === v.id);
                    content += `
                        <div class="vaccination-record">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>${v.vaccineName} - Dose ${v.doseNumber}</strong><br>
                                    <small><i class="fas fa-calendar me-1"></i>${v.dateAdministered}</small><br>
                                    <small><i class="fas fa-flask me-1"></i>Batch: ${v.batchNumber}</small><br>
                                    ${v.notes ? `<small><i class="fas fa-comment me-1"></i>${v.notes}</small>` : ''}
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-warning" onclick="openEditVaccination(${v.id})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-primary" onclick="openScheduleDose(${patient.id}, '${v.vaccineName}', ${v.doseNumber})">
                                        <i class="fas fa-calendar-plus"></i> Schedule Next
                                    </button>
                                </div>
                            </div>
                            ${logs.length > 0 ? `
                                <div class="mt-2">
                                    <small><strong>Edit History:</strong></small>
                                    ${logs.map(log => `
                                        <div class="edit-log-entry">
                                            <small><i class="fas fa-history me-1"></i><strong>${log.reason}</strong> - ${log.timestamp}</small><br>
                                            <small>${log.explanation}</small>
                                        </div>
                                    `).join('')}
                                </div>
                            ` : ''}
                        </div>
                    `;
                });
            }

            content += '<hr><h6 class="text-primary mb-3"><i class="fas fa-calendar-check me-2"></i>Scheduled Doses</h6>';

            if (patientSchedules.length === 0) {
                content += '<p class="text-muted">No scheduled doses.</p>';
            } else {
                patientSchedules.forEach(s => {
                    content += `
                        <div class="vaccination-record">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>${s.vaccineName} - Dose ${s.nextDose}</strong>
                                    <span class="badge ${s.status === 'Scheduled' ? 'bg-info' : s.status === 'Missed' ? 'bg-danger' : 'bg-warning'}">${s.status}</span><br>
                                    <small><i class="fas fa-calendar me-1"></i>Scheduled: ${s.scheduledDate}</small><br>
                                    ${s.notes ? `<small><i class="fas fa-comment me-1"></i>${s.notes}</small>` : ''}
                                    ${s.explanation ? `<br><small class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>${s.explanation}</small>` : ''}
                                </div>
                                <div>
                                    ${s.status === 'Scheduled' ? `
                                        <button class="btn btn-sm btn-warning" onclick="openMarkMissed(${s.id})">
                                            <i class="fas fa-exclamation-triangle"></i> Mark Status
                                        </button>
                                    ` : ''}
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            document.getElementById('patientDetailsContent').innerHTML = content;
            new bootstrap.Modal(document.getElementById('patientDetailsModal')).show();
        }

        // Open Update Patient Modal
        function openUpdatePatient(patientId) {
            const patient = patients.find(p => p.id === patientId);
            if (!patient) return;

            document.getElementById('updatePatientId').value = patient.id;
            document.getElementById('updateContact').value = patient.contact;
            document.getElementById('updateEmail').value = patient.email || '';
            document.getElementById('updateAddress').value = patient.address;
            document.getElementById('updateMedicalNotes').value = patient.medicalNotes || '';
            document.getElementById('updateEligibility').value = patient.eligibility;

            new bootstrap.Modal(document.getElementById('updatePatientModal')).show();
        }

        // Update Patient
        function updatePatient() {
            const patientId = parseInt(document.getElementById('updatePatientId').value);
            const patient = patients.find(p => p.id === patientId);
            
            if (!patient) return;

            patient.contact = document.getElementById('updateContact').value;
            patient.email = document.getElementById('updateEmail').value;
            patient.address = document.getElementById('updateAddress').value;
            patient.medicalNotes = document.getElementById('updateMedicalNotes').value;
            patient.eligibility = document.getElementById('updateEligibility').value;

            updatePatientTable();
            bootstrap.Modal.getInstance(document.getElementById('updatePatientModal')).hide();
            alert('Patient information updated successfully!');
        }

        // Verify Patient for Vaccination
        function verifyPatient() {
            const input = document.getElementById('verifyPatientInput').value.trim();
            const resultDiv = document.getElementById('verifyResult');

            if (!input) {
                resultDiv.innerHTML = '<div class="alert alert-danger">Please enter a Patient ID or Name</div>';
                return;
            }

            const patient = patients.find(p => 
                p.id.toString() === input || 
                p.name.toLowerCase().includes(input.toLowerCase())
            );

            if (!patient) {
                resultDiv.innerHTML = '<div class="alert alert-danger"><i class="fas fa-times-circle me-2"></i>Patient not found!</div>';
                return;
            }

            if (patient.eligibility !== 'Eligible') {
                resultDiv.innerHTML = `<div class="alert alert-warning"><i class="fas fa-exclamation-triangle me-2"></i>Patient found but eligibility status is: <strong>${patient.eligibility}</strong></div>`;
                return;
            }

            document.getElementById('verifiedPatientName').textContent = patient.name;
            document.getElementById('vaccinationPatientId').value = patient.id;
            document.getElementById('verifyStep').style.display = 'none';
            document.getElementById('vaccinationStep').style.display = 'block';
        }

        // Record Vaccination
        function recordVaccination() {
            const patientId = parseInt(document.getElementById('vaccinationPatientId').value);
            const vaccineName = document.getElementById('vaccineName').value;
            const doseNumber = document.getElementById('doseNumber').value;
            const batchNumber = document.getElementById('batchNumber').value;
            const dateAdministered = document.getElementById('dateAdministered').value;
            const notes = document.getElementById('vaccinationNotes').value;

            if (!vaccineName || !doseNumber || !batchNumber || !dateAdministered) {
                alert('Please fill in all required fields!');
                return;
            }

            const vaccination = {
                id: vaccinations.length + 1,
                patientId,
                vaccineName,
                doseNumber,
                batchNumber,
                dateAdministered,
                notes,
                recordedDate: new Date().toISOString()
            };

            vaccinations.push(vaccination);
            bootstrap.Modal.getInstance(document.getElementById('recordVaccinationModal')).hide();
            document.getElementById('vaccinationForm').reset();
            
            alert(`Vaccination recorded successfully!\nPatient ID: ${patientId}\nVaccine: ${vaccineName}\nDose: ${doseNumber}`);
        }

        // Open Schedule Dose Modal
        function openScheduleDose(patientId, vaccineName, lastDose) {
            document.getElementById('schedulePatientId').value = patientId;
            document.getElementById('scheduleVaccineName').value = vaccineName;
            document.getElementById('scheduleNextDose').value = `Dose ${parseInt(lastDose) + 1}`;
            
            calculateScheduleDate();
            new bootstrap.Modal(document.getElementById('scheduleDoseModal')).show();
        }

        // Calculate Scheduled Date
        function calculateScheduleDate() {
            const interval = parseInt(document.getElementById('scheduleInterval').value);
            const today = new Date();
            today.setDate(today.getDate() + interval);
            document.getElementById('scheduledDate').value = today.toISOString().split('T')[0];
        }

        // Schedule Dose
        function scheduleDose() {
            const patientId = parseInt(document.getElementById('schedulePatientId').value);
            const vaccineName = document.getElementById('scheduleVaccineName').value;
            const nextDose = document.getElementById('scheduleNextDose').value.replace('Dose ', '');
            const scheduledDate = document.getElementById('scheduledDate').value;
            const notes = document.getElementById('scheduleNotes').value;

            if (!scheduledDate) {
                alert('Please select a scheduled date!');
                return;
            }

            const schedule = {
                id: schedules.length + 1,
                patientId,
                vaccineName,
                nextDose,
                scheduledDate,
                notes,
                status: 'Scheduled',
                createdDate: new Date().toISOString()
            };

            schedules.push(schedule);
            bootstrap.Modal.getInstance(document.getElementById('scheduleDoseModal')).hide();
            document.getElementById('scheduleForm').reset();
            
            alert('Dose scheduled successfully!');
        }

        // Open Mark Missed Modal
        function openMarkMissed(scheduleId) {
            document.getElementById('missedScheduleId').value = scheduleId;
            document.getElementById('missedStatus').value = '';
            document.getElementById('missedExplanation').value = '';
            document.getElementById('rescheduleSection').style.display = 'none';
            new bootstrap.Modal(document.getElementById('markMissedModal')).show();
        }

        // Toggle reschedule section
        document.getElementById('missedStatus').addEventListener('change', function() {
            const rescheduleSection = document.getElementById('rescheduleSection');
            if (this.value === 'Rescheduled') {
                rescheduleSection.style.display = 'block';
            } else {
                rescheduleSection.style.display = 'none';
            }
        });

        // Mark Missed or Rescheduled
        function markMissed() {
            const scheduleId = parseInt(document.getElementById('missedScheduleId').value);
            const status = document.getElementById('missedStatus').value;
            const explanation = document.getElementById('missedExplanation').value;
            const newDate = document.getElementById('newScheduledDate').value;

            if (!status || !explanation) {
                alert('Please fill in all required fields!');
                return;
            }

            if (status === 'Rescheduled' && !newDate) {
                alert('Please select a new scheduled date!');
                return;
            }

            const schedule = schedules.find(s => s.id === scheduleId);
            if (schedule) {
                schedule.status = status;
                schedule.explanation = explanation;
                if (status === 'Rescheduled') {
                    schedule.scheduledDate = newDate;
                }
            }

            bootstrap.Modal.getInstance(document.getElementById('markMissedModal')).hide();
            alert(`Schedule marked as ${status} successfully!`);
        }

        // Open Edit Vaccination Modal
        function openEditVaccination(vaccinationId) {
            const vaccination = vaccinations.find(v => v.id === vaccinationId);
            if (!vaccination) return;

            document.getElementById('editVaccinationId').value = vaccination.id;
            document.getElementById('editBatchNumber').value = vaccination.batchNumber;
            document.getElementById('editDateAdministered').value = vaccination.dateAdministered;
            document.getElementById('editVaccinationNotes').value = vaccination.notes || '';
            document.getElementById('editReason').value = '';
            document.getElementById('editExplanation').value = '';

            new bootstrap.Modal(document.getElementById('editVaccinationModal')).show();
        }

        // Save Vaccination Edit
        function saveVaccinationEdit() {
            const vaccinationId = parseInt(document.getElementById('editVaccinationId').value);
            const reason = document.getElementById('editReason').value;
            const explanation = document.getElementById('editExplanation').value;
            const batchNumber = document.getElementById('editBatchNumber').value;
            const dateAdministered = document.getElementById('editDateAdministered').value;
            const notes = document.getElementById('editVaccinationNotes').value;

            if (!reason || !explanation) {
                alert('Please provide a reason and explanation for the edit!');
                return;
            }

            const vaccination = vaccinations.find(v => v.id === vaccinationId);
            if (!vaccination) return;

            // Create edit log
            const editLog = {
                id: editLogs.length + 1,
                vaccinationId,
                reason,
                explanation,
                oldBatchNumber: vaccination.batchNumber,
                newBatchNumber: batchNumber,
                oldDate: vaccination.dateAdministered,
                newDate: dateAdministered,
                timestamp: new Date().toLocaleString()
            };

            editLogs.push(editLog);

            // Update vaccination record
            vaccination.batchNumber = batchNumber;
            vaccination.dateAdministered = dateAdministered;
            vaccination.notes = notes;

            bootstrap.Modal.getInstance(document.getElementById('editVaccinationModal')).hide();
            alert('Vaccination record updated successfully! Edit has been logged.');
        }

        // Set today's date as max for date inputs
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dateAdministered').setAttribute('max', today);
            document.getElementById('editDateAdministered').setAttribute('max', today);
        });

        // Initialize with sample data (optional - for demonstration)
        function loadSampleData() {
            // Sample Patient 1
            patients.push({
                id: patientIdCounter++,
                name: 'John Doe',
                firstName: 'John',
                lastName: 'Doe',
                dob: '1985-05-15',
                age: 39,
                gender: 'Male',
                contact: '+63 912 345 6789',
                email: 'john.doe@email.com',
                address: '123 Main Street, Quezon City, Metro Manila',
                medicalNotes: 'No known allergies. History of hypertension.',
                eligibility: 'Eligible',
                registeredDate: new Date().toISOString()
            });

            // Sample Patient 2
            patients.push({
                id: patientIdCounter++,
                name: 'Maria Santos',
                firstName: 'Maria',
                lastName: 'Santos',
                dob: '1990-08-20',
                age: 34,
                gender: 'Female',
                contact: '+63 917 456 7890',
                email: 'maria.santos@email.com',
                address: '456 Rizal Avenue, Manila',
                medicalNotes: 'Pregnant - 2nd trimester. Consult before vaccination.',
                eligibility: 'Pending Review',
                registeredDate: new Date().toISOString()
            });

            // Sample Patient 3
            patients.push({
                id: patientIdCounter++,
                name: 'Carlos Reyes',
                firstName: 'Carlos',
                lastName: 'Reyes',
                dob: '1978-12-10',
                age: 46,
                gender: 'Male',
                contact: '+63 918 567 8901',
                email: 'carlos.reyes@email.com',
                address: '789 Commonwealth Avenue, Quezon City',
                medicalNotes: 'Diabetic. Takes insulin daily.',
                eligibility: 'Eligible',
                registeredDate: new Date().toISOString()
            });

            // Sample Vaccination Record
            vaccinations.push({
                id: 1,
                patientId: 1001,
                vaccineName: 'Pfizer-BioNTech',
                doseNumber: '1',
                batchNumber: 'PF20241215A',
                dateAdministered: '2024-11-15',
                notes: 'No adverse reactions observed.',
                recordedDate: new Date().toISOString()
            });

            vaccinations.push({
                id: 2,
                patientId: 1001,
                vaccineName: 'Pfizer-BioNTech',
                doseNumber: '2',
                batchNumber: 'PF20241220B',
                dateAdministered: '2024-12-06',
                notes: 'Mild soreness at injection site. Patient monitored for 30 minutes.',
                recordedDate: new Date().toISOString()
            });

            vaccinations.push({
                id: 3,
                patientId: 1003,
                vaccineName: 'Moderna',
                doseNumber: '1',
                batchNumber: 'MD20241210C',
                dateAdministered: '2024-11-25',
                notes: 'Patient tolerated well.',
                recordedDate: new Date().toISOString()
            });

            // Sample Scheduled Dose
            schedules.push({
                id: 1,
                patientId: 1001,
                vaccineName: 'Pfizer-BioNTech',
                nextDose: '3',
                scheduledDate: '2025-06-06',
                notes: 'Booster dose - 6 months after second dose',
                status: 'Scheduled',
                createdDate: new Date().toISOString()
            });

            schedules.push({
                id: 2,
                patientId: 1003,
                vaccineName: 'Moderna',
                nextDose: '2',
                scheduledDate: '2024-12-23',
                notes: 'Second dose scheduled 28 days after first',
                status: 'Scheduled',
                createdDate: new Date().toISOString()
            });

            updatePatientTable();
        }

        // Load sample data on page load (comment this out if you don't want sample data)
        loadSampleData();

        // Search functionality in patient table
        function searchPatients(searchTerm) {
            const tbody = document.getElementById('patientTableBody');
            const filtered = patients.filter(p => 
                p.id.toString().includes(searchTerm) ||
                p.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                p.contact.includes(searchTerm) ||
                p.email.toLowerCase().includes(searchTerm.toLowerCase())
            );

            if (filtered.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No patients found</td></tr>';
                return;
            }

            tbody.innerHTML = filtered.map(p => `
                <tr>
                    <td><strong>${p.id}</strong></td>
                    <td>${p.name}</td>
                    <td>${p.age}</td>
                    <td>${p.contact}</td>
                    <td><span class="badge ${getEligibilityBadgeClass(p.eligibility)}">${p.eligibility}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="viewPatientDetails(${p.id})">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-sm btn-success" onclick="openUpdatePatient(${p.id})">
                            <i class="fas fa-edit"></i> Update
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // Export patient data as JSON (for backup purposes)
        function exportPatientData() {
            const data = {
                patients: patients,
                vaccinations: vaccinations,
                schedules: schedules,
                editLogs: editLogs,
                exportDate: new Date().toISOString()
            };

            const dataStr = JSON.stringify(data, null, 2);
            const dataBlob = new Blob([dataStr], { type: 'application/json' });
            const url = URL.createObjectURL(dataBlob);
            const link = document.createElement('a');
            link.href = url;
            link.download = `vaccination-data-${new Date().toISOString().split('T')[0]}.json`;
            link.click();
            URL.revokeObjectURL(url);
        }

        // Generate vaccination report for a patient
        function generatePatientReport(patientId) {
            const patient = patients.find(p => p.id === patientId);
            if (!patient) return;

            const patientVaccinations = vaccinations.filter(v => v.patientId === patientId);
            const patientSchedules = schedules.filter(s => s.patientId === patientId);

            let report = `
==============================================
VACCINATION REPORT
==============================================

PATIENT INFORMATION:
Patient ID: ${patient.id}
Name: ${patient.name}
Date of Birth: ${patient.dob} (Age: ${patient.age})
Gender: ${patient.gender}
Contact: ${patient.contact}
Email: ${patient.email || 'N/A'}
Eligibility: ${patient.eligibility}

----------------------------------------------
VACCINATION HISTORY:
----------------------------------------------
`;

            if (patientVaccinations.length === 0) {
                report += 'No vaccinations recorded.\n';
            } else {
                patientVaccinations.forEach((v, index) => {
                    report += `
${index + 1}. ${v.vaccineName} - Dose ${v.doseNumber}
   Date: ${v.dateAdministered}
   Batch: ${v.batchNumber}
   Notes: ${v.notes || 'None'}
`;
                });
            }

            report += `
----------------------------------------------
SCHEDULED DOSES:
----------------------------------------------
`;

            if (patientSchedules.length === 0) {
                report += 'No scheduled doses.\n';
            } else {
                patientSchedules.forEach((s, index) => {
                    report += `
${index + 1}. ${s.vaccineName} - Dose ${s.nextDose}
   Scheduled Date: ${s.scheduledDate}
   Status: ${s.status}
   Notes: ${s.notes || 'None'}
`;
                });
            }

            report += `
==============================================
Report Generated: ${new Date().toLocaleString()}
==============================================
`;

            // Download as text file
            const blob = new Blob([report], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = `patient-report-${patient.id}-${new Date().toISOString().split('T')[0]}.txt`;
            link.click();
            URL.revokeObjectURL(url);
        }

        // Statistics Dashboard
        function showStatistics() {
            const totalPatients = patients.length;
            const eligiblePatients = patients.filter(p => p.eligibility === 'Eligible').length;
            const totalVaccinations = vaccinations.length;
            const scheduledDoses = schedules.filter(s => s.status === 'Scheduled').length;
            const missedDoses = schedules.filter(s => s.status === 'Missed').length;

            alert(`
📊 VACCINATION STATISTICS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Total Registered Patients: ${totalPatients}
Eligible for Vaccination: ${eligiblePatients}
Total Vaccinations Given: ${totalVaccinations}
Scheduled Upcoming Doses: ${scheduledDoses}
Missed Appointments: ${missedDoses}
            `);
        }

        // Logout function
        function handleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // Add fade out animation
                document.body.style.opacity = '0';
                document.body.style.transition = 'opacity 0.5s ease';
                
                setTimeout(() => {
                    alert('You have been logged out successfully!\n\nThank you for using Health Worker Portal.');
                    // In a real application, this would redirect to login page
                    // window.location.href = '/login';
                    location.reload();
                }, 500);
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + N = Register new patient
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                showRegisterPatient();
            }
            // Ctrl/Cmd + F = Search patient
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                showSearchPatient();
            }
            // Ctrl/Cmd + R = Record vaccination
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                showRecordVaccination();
            }
        });

        console.log('%c🏥 Health Worker Portal Loaded Successfully! ', 'background: #0066cc; color: white; padding: 10px; font-size: 14px; font-weight: bold;');
        console.log('%cKeyboard Shortcuts:', 'color: #0066cc; font-weight: bold;');
        console.log('Ctrl/Cmd + N: Register New Patient');
        console.log('Ctrl/Cmd + F: Search Patient');
        console.log('Ctrl/Cmd + R: Record Vaccination');
    </script>
</body>
</html>