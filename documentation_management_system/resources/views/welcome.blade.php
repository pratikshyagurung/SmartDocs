<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Docs</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-light: #6366f1;
            --primary-dark: #4338ca;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --gray-color: #64748b;
            --border-color: #e2e8f0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: var(--dark-color);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }
        
        .auth-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }
        
        .btn-outline:hover {
            background-color: rgba(79, 70, 229, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .search-container {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            font-size: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .section-title h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .section-title p {
            color: var(--gray-color);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }
        
        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
            position: relative;
            padding-left: 2.5rem;
        }
        
        .feature-card h3::before {
            content: "—";
            position: absolute;
            left: 0;
            color: var(--primary-color);
        }
        
        .feature-card p {
            color: var(--gray-color);
            margin-bottom: 0;
        }
        
        hr {
            border: 0;
            height: 1px;
            background-color: var(--border-color);
            margin: 2rem 0;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .section-title h2 {
                font-size: 1.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .auth-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Smart Docs</h1>
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="What are you looking for?">
            </div>
            
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn btn-outline">
                    <i class="fas fa-sign-in-alt mr-2"></i> Log In
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
                

            </div>
        </header>
        
        <div class="section-title">
            <h2>Powerful Features for Your Documentation</h2>
            <p>Everything you need to create, organize, and share knowledge effectively.</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <h3>Article Management</h3>
                <p>Create, edit, and organize articles with rich text editing and version control.</p>
            </div>
            
            <div class="feature-card">
                <h3>Category System</h3>
                <p>Organize content with a flexible category hierarchy and tagging system.</p>
            </div>
            
            <div class="feature-card">
                <h3>Advanced Search</h3>
                <p>Powerful full-text search with filters to find exactly what you need.</p>
            </div>
            
            <div class="feature-card">
                <h3>Role-Based Access</h3>
                <p>Control access with admin, editor, and viewer roles for your team.</p>
            </div>
        </div>
    </div>


</body>
</html>