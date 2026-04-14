-- Create database
CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- About section
CREATE TABLE about (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bio TEXT NOT NULL,
    profile_image VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Skills table
CREATE TABLE skills (
    id INT PRIMARY KEY AUTO_INCREMENT,
    skill_name VARCHAR(100) NOT NULL,
    proficiency INT DEFAULT 50,
    category VARCHAR(50) DEFAULT 'Technical',
    display_order INT DEFAULT 0
);

-- Projects table
CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    technologies VARCHAR(255),
    image VARCHAR(255),
    project_url VARCHAR(255),
    github_url VARCHAR(255),
    display_order INT DEFAULT 0,
    status ENUM('active', 'archived') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Messages table
CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insert sample data
INSERT INTO about (bio, profile_image) VALUES ('Hello! I am a passionate full-stack developer with over 5 years of experience in building web applications. I love creating elegant solutions to complex problems and continuously learning new technologies.', 'default-avatar.jpg');

INSERT INTO skills (skill_name, proficiency, category, display_order) VALUES
('PHP', 90, 'Backend', 1),
('JavaScript', 85, 'Frontend', 2),
('HTML/CSS', 95, 'Frontend', 3),
('MySQL', 85, 'Database', 4),
('React', 75, 'Frontend', 5),
('Python', 70, 'Backend', 6),
('Git', 80, 'Tools', 7),
('Laravel', 75, 'Framework', 8);

INSERT INTO projects (title, description, technologies, image, project_url, github_url, display_order, status) VALUES
('E-Commerce Platform', 'A full-featured online store with cart, payment integration, and admin dashboard.', 'PHP, MySQL, JavaScript, Stripe API', 'project1.jpg', 'https://example.com/shop', 'https://github.com/username/ecommerce', 1, 'active'),
('Task Management App', 'Collaborative task management tool with real-time updates and team features.', 'React, Node.js, MongoDB, Socket.io', 'project2.jpg', 'https://example.com/tasks', 'https://github.com/username/taskapp', 2, 'active'),
('Portfolio Website', 'Dynamic portfolio system with admin panel for content management.', 'PHP, MySQL, HTML/CSS, JavaScript', 'project3.jpg', 'https://example.com/portfolio', 'https://github.com/username/portfolio', 3, 'active'),
('Weather Dashboard', 'Real-time weather app with interactive maps and forecasts.', 'JavaScript, API, Chart.js, Bootstrap', 'project4.jpg', 'https://example.com/weather', 'https://github.com/username/weather', 4, 'active');