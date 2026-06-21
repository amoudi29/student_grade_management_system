<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading System Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #1e1b4b 0%, #312e81 100%);
            padding: 24px 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .logo {
            padding: 0 24px 32px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-size: 20px;
            font-weight: 700;
        }

        .logo i {
            font-size: 28px;
            color: #818cf8;
        }

        .nav-item {
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
            color: #c7c7e0;
            cursor: pointer;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.08);
            color: white;
            border-left-color: #818cf8;
        }

        .nav-item i {
            width: 22px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 32px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #1e1b4b, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
        }

        .btn-outline {
            background: white;
            border: 1.5px solid var(--border);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            cursor: pointer;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .stat-card.students { --card-color: #6366f1; --card-color-light: #a5b4fc; }
        .stat-card.avg-grade { --card-color: #10b981; --card-color-light: #6ee7b7; }
        .stat-card.pass-rate { --card-color: #f59e0b; --card-color-light: #fcd34d; }
        .stat-card.assignments { --card-color: #ec4899; --card-color-light: #f9a8d4; }
        .stat-card.pending { --card-color: #3b82f6; --card-color-light: #93c5fd; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .stat-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-badge.up {
            background: #dcfce7;
            color: #15803d;
        }

        .stat-badge.down {
            background: #fee2e2;
            color: #b91c1c;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 42px;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 8px;
            font-variant-numeric: tabular-nums;
        }

        .stat-subtext {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .stat-progress {
            margin-top: 16px;
            height: 6px;
            background: #f1f5f9;
            border-radius: 3px;
            overflow: hidden;
        }

        .stat-progress-bar {
            height: 100%;
            border-radius: 3px;
            background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
            transition: width 1.5s ease;
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--border);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        /* Grade Distribution */
        .grade-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .grade-label {
            width: 36px;
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            padding: 4px 8px;
            border-radius: 8px;
            color: white;
        }

        .grade-label.a { background: #10b981; }
        .grade-label.b { background: #3b82f6; }
        .grade-label.c { background: #f59e0b; }
        .grade-label.d { background: #f97316; }
        .grade-label.f { background: #ef4444; }

        .grade-track {
            flex: 1;
            height: 28px;
            background: #f1f5f9;
            border-radius: 14px;
            overflow: hidden;
            position: relative;
        }

        .grade-fill {
            height: 100%;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 12px;
            color: white;
            font-weight: 700;
            font-size: 12px;
            transition: width 1.5s ease;
        }

        .grade-fill.a { background: linear-gradient(90deg, #10b981, #34d399); }
        .grade-fill.b { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .grade-fill.c { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .grade-fill.d { background: linear-gradient(90deg, #f97316, #fb923c); }
        .grade-fill.f { background: linear-gradient(90deg, #ef4444, #f87171); }

        .grade-count {
            width: 40px;
            text-align: right;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* Activity List */
        .activity-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            font-weight: 700;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .activity-time {
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* Student Table */
        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .student-table th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border);
        }

        .student-table td {
            padding: 14px 16px;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
        }

        .student-table tr:last-child td {
            border-bottom: none;
        }

        .student-table tr:hover td {
            background: #f8fafc;
        }

        .grade-pill {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 13px;
        }

        .grade-pill.a { background: #dcfce7; color: #15803d; }
        .grade-pill.b { background: #dbeafe; color: #1d4ed8; }
        .grade-pill.c { background: #fef3c7; color: #b45309; }
        .grade-pill.d { background: #ffedd5; color: #c2410c; }
        .grade-pill.f { background: #fee2e2; color: #b91c1c; }

        .student-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: white;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-name {
            font-weight: 600;
        }

        .student-id {
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .charts-grid { grid-template-columns: 1fr; }
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        .stat-card:nth-child(5) { animation-delay: 0.5s; }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 200;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 20px;
            padding: 32px;
            width: 500px;
            max-width: 90vw;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            animation: fadeInUp 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: var(--text-secondary);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }
    </style>
<base target="_blank">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <span>GradeHub</span>
        </div>
        <nav>
            <div class="nav-item active">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </div>
            <div class="nav-item">
                <i class="fas fa-users"></i>
                <span>Students</span>
            </div>
            <div class="nav-item">
                <i class="fas fa-book"></i>
                <span>Courses</span>
            </div>
            <div class="nav-item">
                <i class="fas fa-clipboard-list"></i>
                <span>Assignments</span>
            </div>
            <div class="nav-item">
                <i class="fas fa-chart-bar"></i>
                <span>Gradebook</span>
            </div>
            <div class="nav-item">
                <i class="fas fa-file-export"></i>
                <span>Reports</span>
            </div>
            <div class="nav-item">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <div>
                <h1>Grading Dashboard</h1>
                <p style="color: var(--text-secondary); margin-top: 4px;">Monitor student performance and manage grades efficiently.</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline" onclick="exportGrades()">
                    <i class="fas fa-download"></i>
                    Export
                </button>
                <button class="btn btn-primary" onclick="openModal()">
                    <i class="fas fa-plus"></i>
                    Add Grade
                </button>
                <button class="btn btn-primary" onclick="refreshData()">
                    <i class="fas fa-sync-alt" id="refresh-icon"></i>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card students" onclick="pulseCard(this)">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-badge up">
                        <i class="fas fa-arrow-up"></i> 5%
                    </div>
                </div>
                <div class="stat-label">Total Students</div>
                <div class="stat-number" data-target="342">0</div>
                <div class="stat-subtext">Enrolled this semester</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: 0%" data-width="78%"></div>
                </div>
            </div>

            <div class="stat-card avg-grade" onclick="pulseCard(this)">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-badge up">
                        <i class="fas fa-arrow-up"></i> 2.3%
                    </div>
                </div>
                <div class="stat-label">Class Average</div>
                <div class="stat-number" data-target="84" data-suffix="%">0</div>
                <div class="stat-subtext">Overall grade average</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: 0%" data-width="84%"></div>
                </div>
            </div>

            <div class="stat-card pass-rate" onclick="pulseCard(this)">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-badge up">
                        <i class="fas fa-arrow-up"></i> 4%
                    </div>
                </div>
                <div class="stat-label">Pass Rate</div>
                <div class="stat-number" data-target="92" data-suffix="%">0</div>
                <div class="stat-subtext">Students passing all courses</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: 0%" data-width="92%"></div>
                </div>
            </div>

            <div class="stat-card assignments" onclick="pulseCard(this)">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-badge down">
                        <i class="fas fa-arrow-down"></i> 1%
                    </div>
                </div>
                <div class="stat-label">Assignments</div>
                <div class="stat-number" data-target="56">0</div>
                <div class="stat-subtext">Graded this week</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: 0%" data-width="65%"></div>
                </div>
            </div>

            <div class="stat-card pending" onclick="pulseCard(this)">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-badge up">
                        <i class="fas fa-arrow-up"></i> 8%
                    </div>
                </div>
                <div class="stat-label">Pending Review</div>
                <div class="stat-number" data-target="24">0</div>
                <div class="stat-subtext">Submissions awaiting grading</div>
                <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 0%" data-width="45%"></div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Grade Distribution</div>
                        <p style="font-size: 13px; color: var(--text-secondary); margin-top: 4px;">Student performance breakdown by letter grade</p>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <span style="font-size: 12px; padding: 4px 12px; background: #ede9fe; color: #6366f1; border-radius: 20px; font-weight: 600;">All Courses</span>
                    </div>
                </div>
                <div id="gradeDistribution">
                    <div class="grade-bar">
                        <div class="grade-label a">A</div>
                        <div class="grade-track">
                            <div class="grade-fill a" style="width: 0%" data-width="32%">32%</div>
                        </div>
                        <div class="grade-count">109</div>
                    </div>
                    <div class="grade-bar">
                        <div class="grade-label b">B</div>
                        <div class="grade-track">
                            <div class="grade-fill b" style="width: 0%" data-width="28%">28%</div>
                        </div>
                        <div class="grade-count">96</div>
                    </div>
                    <div class="grade-bar">
                        <div class="grade-label c">C</div>
                        <div class="grade-track">
                            <div class="grade-fill c" style="width: 0%" data-width="22%">22%</div>
                        </div>
                        <div class="grade-count">75</div>
                    </div>
                    <div class="grade-bar">
                        <div class="grade-label d">D</div>
                        <div class="grade-track">
                            <div class="grade-fill d" style="width: 0%" data-width="12%">12%</div>
                        </div>
                        <div class="grade-count">41</div>
                    </div>
                    <div class="grade-bar">
                        <div class="grade-label f">F</div>
                        <div class="grade-track">
                            <div class="grade-fill f" style="width: 0%" data-width="6%">6%</div>
                        </div>
                        <div class="grade-count">21</div>
                    </div>
                </div>
            </div>
                   </div>

    

        <!-- Student Grades Table -->
        <div class="card" style="margin-top: 24px;">
            <div class="card-header">
                <div>
                    <div class="card-title">Recent Grades</div>
                    <p style="font-size: 13px; color: var(--text-secondary); margin-top: 4px;">Latest student submissions and grades</p>
                </div>
                <div class="header-actions">
                    <input type="text" placeholder="Search students..." style="padding: 10px 16px; border: 1.5px solid var(--border); border-radius: 10px; font-family: inherit; font-size: 14px; width: 220px;">
                    <select style="padding: 10px 16px; border: 1.5px solid var(--border); border-radius: 10px; font-family: inherit; font-size: 14px;">
                        <option>All Courses</option>
                        <option>CS101</option>
                        <option>Math 201</option>
                        <option>Physics 301</option>
                    </select>
                </div>
            </div>
            <table class="student-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Assignment</th>
                        <th>Score</th>
                        <th>Grade</th>
                        <th>Status</th>
                        <th>Submitted</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <tr>
                        <td>
                            <div class="student-info">
                                <div class="student-avatar" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">JD</div>
                                <div>
                                    <div class="student-name">John Doe</div>
                                    <div class="student-id">#STU-2024-001</div>
                                </div>
                            </div>
                        </td>
                        <td>CS101</td>
                        <td>Midterm Exam</td>
                        <td><strong>92/100</strong></td>
                        <td><span class="grade-pill a">A</span></td>
                        <td><span style="color: #10b981; font-weight: 600;"><i class="fas fa-check-circle"></i> Graded</span></td>
                        <td>Jun 20, 2026</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-info">
                                <div class="student-avatar" style="background: linear-gradient(135deg, #10b981, #34d399);">AS</div>
                                <div>
                                    <div class="student-name">Alice Smith</div>
                                    <div class="student-id">#STU-2024-042</div>
                                </div>
                            </div>
                        </td>
                        <td>Math 201</td>
                        <td>Problem Set 5</td>
                        <td><strong>88/100</strong></td>
                        <td><span class="grade-pill b">B+</span></td>
                        <td><span style="color: #10b981; font-weight: 600;"><i class="fas fa-check-circle"></i> Graded</span></td>
                        <td>Jun 19, 2026</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-info">
                                <div class="student-avatar" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">MJ</div>
                                <div>
                                    <div class="student-name">Michael Johnson</div>
                                    <div class="student-id">#STU-2024-103</div>
                                </div>
                            </div>
                        </td>
                        <td>Physics 301</td>
                        <td>Lab Report 3</td>
                        <td><strong>76/100</strong></td>
                        <td><span class="grade-pill c">C</span></td>
                        <td><span style="color: #10b981; font-weight: 600;"><i class="fas fa-check-circle"></i> Graded</span></td>
                        <td>Jun 19, 2026</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-info">
                                <div class="student-avatar" style="background: linear-gradient(135deg, #ec4899, #f472b6);">EW</div>
                                <div>
                                    <div class="student-name">Emma Wilson</div>
                                    <div class="student-id">#STU-2024-067</div>
                                </div>
                            </div>
                        </td>
                        <td>CS101</td>
                        <td>Project Phase 2</td>
                        <td><strong>--</strong></td>
                        <td><span class="grade-pill" style="background: #f1f5f9; color: #64748b;">--</span></td>
                        <td><span style="color: #f59e0b; font-weight: 600;"><i class="fas fa-clock"></i> Pending</span></td>
                        <td>Jun 21, 2026</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-info">
                                <div class="student-avatar" style="background: linear-gradient(135deg, #3b82f6, #60a5fa);">RB</div>
                                <div>
                                    <div class="student-name">Robert Brown</div>
                                    <div class="student-id">#STU-2024-089</div>
                                </div>
                            </div>
                        </td>
                        <td>Math 201</td>
                        <td>Quiz 4</td>
                        <td><strong>95/100</strong></td>
                        <td><span class="grade-pill a">A</span></td>
                        <td><span style="color: #10b981; font-weight: 600;"><i class="fas fa-check-circle"></i> Graded</span></td>
                        <td>Jun 18, 2026</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-info">
                                <div class="student-avatar" style="background: linear-gradient(135deg, #6366f1, #a5b4fc);">SD</div>
                                <div>
                                    <div class="student-name">Sarah Davis</div>
                                    <div class="student-id">#STU-2024-055</div>
                                </div>
                            </div>
                        </td>
                        <td>Physics 301</td>
                        <td>Midterm Exam</td>
                        <td><strong>82/100</strong></td>
                        <td><span class="grade-pill b">B</span></td>
                        <td><span style="color: #10b981; font-weight: 600;"><i class="fas fa-check-circle"></i> Graded</span></td>
                        <td>Jun 17, 2026</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Add Grade Modal -->
    <div class="modal-overlay" id="addGradeModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Add New Grade</div>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <form id="gradeForm" onsubmit="submitGrade(event)">
                <div class="form-group">
                    <label>Student</label>
                    <select required>
                        <option value="">Select student...</option>
                        <option>John Doe (#STU-2024-001)</option>
                        <option>Alice Smith (#STU-2024-042)</option>
                        <option>Michael Johnson (#STU-2024-103)</option>
                        <option>Emma Wilson (#STU-2024-067)</option>
                        <option>Robert Brown (#STU-2024-089)</option>
                        <option>Sarah Davis (#STU-2024-055)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <select required>
                        <option value="">Select course...</option>
                        <option>CS101 - Intro to Computer Science</option>
                        <option>Math 201 - Calculus II</option>
                        <option>Physics 301 - Quantum Mechanics</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Assignment</label>
                    <input type="text" placeholder="e.g., Midterm Exam" required>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label>Score</label>
                        <input type="number" min="0" max="100" placeholder="0-100" required>
                    </div>
                    <div class="form-group">
                        <label>Max Points</label>
                        <input type="number" value="100" min="1" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-outline" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Grade</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Animated Counter
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            const suffix = element.dataset.suffix || '';

            function update() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start).toLocaleString() + suffix;
                    requestAnimationFrame(update);
                } else {
                    element.textContent = target.toLocaleString() + suffix;
                }
            }
            update();
        }

        // Initialize counters
        document.querySelectorAll('.stat-number').forEach(el => {
            const target = parseInt(el.dataset.target);
            setTimeout(() => animateCounter(el, target), 300);
        });

        // Animate progress bars
        setTimeout(() => {
            document.querySelectorAll('.stat-progress-bar').forEach(bar => {
                bar.style.width = bar.dataset.width;
            });
        }, 500);

        // Animate grade distribution bars
        setTimeout(() => {
            document.querySelectorAll('.grade-fill').forEach(bar => {
                bar.style.width = bar.dataset.width;
            });
        }, 800);

        // Pulse animation on click
        function pulseCard(card) {
            card.style.transform = 'scale(0.97)';
            setTimeout(() => {
                card.style.transform = '';
            }, 150);
        }

        // Refresh data simulation
        function refreshData() {
            const icon = document.getElementById('refresh-icon');
            icon.style.animation = 'spin 1s linear';

            document.querySelectorAll('.stat-number').forEach(el => {
                const current = parseInt(el.textContent.replace(/[^0-9]/g, ''));
                const variation = Math.floor(Math.random() * 20) - 10;
                const newTarget = Math.max(0, current + variation);
                const suffix = el.dataset.suffix || '';
                el.textContent = '0';
                animateCounter(el, newTarget, 1000);
            });

            setTimeout(() => {
                icon.style.animation = '';
            }, 1000);
        }

        // Add spin keyframe dynamically
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);

        // Modal functions
        function openModal() {
            document.getElementById('addGradeModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('addGradeModal').classList.remove('active');
        }

        function submitGrade(e) {
            e.preventDefault();
            closeModal();

            // Show success feedback
            const btn = document.querySelector('.btn-primary[onclick="openModal()"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Saved!';
            btn.style.background = 'linear-gradient(135deg, #10b981, #34d399)';

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
            }, 2000);
        }

        // Export grades
        function exportGrades() {
            const btn = document.querySelector('.btn-outline[onclick="exportGrades()"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';

            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Exported!';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                }, 2000);
            }, 1500);
        }

        // Close modal on overlay click
        document.getElementById('addGradeModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Handle resize
        window.addEventListener('resize', () => {
            // Debounced resize handling
        });
    </script>
</body>
</html>