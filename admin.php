<?php
include 'config.php';

// Handle login
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit();
    } else {
        $login_error = 'Invalid username or password';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit();
}

// Handle image upload
if (isset($_SESSION['admin_logged_in']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_image'])) {
    $caption = $_POST['caption'] ?? '';
    $category = $_POST['category'] ?? 'wedding';
    $page = $_POST['page'] ?? 'gallery';
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $_FILES['image']['name']);
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($extension, $allowed)) {
            $destination = UPLOAD_DIR . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                if (addImage($filename, $caption, $category, $page)) {
                    $success = 'Image added successfully!';
                } else {
                    $error = 'Failed to save image data';
                }
            } else {
                $error = 'Failed to upload file';
            }
        } else {
            $error = 'Invalid file type. Allowed: ' . implode(', ', $allowed);
        }
    } else {
        $error = 'Please select an image file';
    }
}

// Handle edit
if (isset($_SESSION['admin_logged_in']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_image'])) {
    $id = $_POST['image_id'];
    $caption = $_POST['caption'];
    $category = $_POST['category'];
    $page = $_POST['page'];
    
    if (updateImage($id, $caption, $category, $page)) {
        $success = 'Image updated successfully!';
    } else {
        $error = 'Failed to update image';
    }
}

// Handle delete
if (isset($_SESSION['admin_logged_in']) && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (deleteImage($id)) {
        $success = 'Image deleted successfully!';
    } else {
        $error = 'Failed to delete image';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Admin Panel - Monovue</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true): ?>
            <!-- Login Form -->
            <div class="login-box">
                <div class="login-header">
                    <i class="fas fa-camera"></i>
                    <h2>Admin Login</h2>
                    <p>Enter your credentials to access dashboard</p>
                </div>
                
                <?php if ($login_error): ?>
                    <div class="alert alert-error"><?php echo $login_error; ?></div>
                <?php endif; ?>
                
                <form method="POST" class="login-form">
                    <div class="form-group username-form-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group password-form-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="login-actions">
                        <a href="index.php" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <button type="submit" name="login" class="btn-login">
        <i class="fas fa-sign-in-alt"></i> Login
    </button>

    
</div>
                </form>
                
                <!-- <div class="login-demo">
                    <p><strong>Demo Credentials:</strong></p>
                    <p>Username: admin<br>Password: demo123</p>
                </div> -->
            </div>
        <?php else: ?>
            <!-- Admin Dashboard with Loader -->
            <div id="dashboard-loader" class="dashboard-loader">
                <div class="loader-spinner"></div>
                <p>Loading dashboard...</p>
            </div>
            
            <div id="dashboard-content" class="admin-dashboard" style="display: none;">
                <div class="admin-header">
                    <h1><i class="fas fa-cog"></i> Admin Dashboard</h1>
                    <div class="admin-actions">
                        <a href="index.php" target="_blank"><i class="fas fa-eye"></i> View Site</a>
                        <a href="admin.php?logout=1" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
                
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <!-- Add Image Form -->
                <div class="admin-card">
                    <h2><i class="fas fa-plus-circle"></i> Add New Image</h2>
                    <form method="POST" enctype="multipart/form-data" class="add-image-form" id="addImageForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Image File *</label>
                                <input type="file" name="image" accept="image/*" required id="imageInput">
                                <div id="imagePreviewContainer" class="image-preview-container" style="display: none;">
                                    <img id="imagePreview" class="image-preview" alt="Image preview">
                                    <button type="button" id="clearPreview" class="clear-preview">&times;</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Caption *</label>
                                <input type="text" name="caption" placeholder="Beautiful sunset wedding" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category">
                                    <option value="wedding">Wedding</option>
                                    <option value="portrait">Portrait</option>
                                    <option value="event">Event</option>
                                    <option value="nature">Nature</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Display Page</label>
                                <select name="page">
                                    <option value="gallery">Gallery</option>
                                    <option value="portfolio">Portfolio</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="add_image" class="btn-submit" id="uploadBtn">
                            <i class="fas fa-upload"></i> Upload Image
                        </button>
                        <div id="uploadLoader" class="upload-loader" style="display: none;">
                            <div class="loader-spinner-small"></div>
                            <span>Uploading image...</span>
                        </div>
                    </form>
                </div>
                
                <!-- Manage Images -->
                <div class="admin-card">
                    <h2><i class="fas fa-images"></i> Manage Images</h2>
                    <?php
                    $images = getAllImages();
                    $groupedImages = [];
                    foreach ($images as $img) {
                        $groupedImages[$img['page']][] = $img;
                    }
                    ?>
                    
                    <?php foreach ($groupedImages as $pageName => $pageImages): ?>
                        <div class="image-group">
                            <h3><i class="fas fa-folder"></i> <?php echo ucfirst($pageName); ?> Page (<?php echo count($pageImages); ?> images)</h3>
                            <div class="images-grid">
                                <?php foreach ($pageImages as $image): ?>
                                    <div class="image-card" id="image-<?php echo $image['id']; ?>">
                                        <img src="<?php echo $image['path']; ?>" alt="<?php echo $image['caption']; ?>" loading="lazy">
                                        <div class="image-details">
                                            <form method="POST" class="edit-form">
                                                <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                                                <input type="text" name="caption" value="<?php echo htmlspecialchars($image['caption']); ?>" required>
                                                <select name="category">
                                                    <option value="wedding" <?php echo $image['category'] === 'wedding' ? 'selected' : ''; ?>>Wedding</option>
                                                    <option value="portrait" <?php echo $image['category'] === 'portrait' ? 'selected' : ''; ?>>Portrait</option>
                                                    <option value="event" <?php echo $image['category'] === 'event' ? 'selected' : ''; ?>>Event</option>
                                                    <option value="nature" <?php echo $image['category'] === 'nature' ? 'selected' : ''; ?>>Nature</option>
                                                </select>
                                                <select name="page">
                                                    <option value="gallery" <?php echo $image['page'] === 'gallery' ? 'selected' : ''; ?>>Gallery</option>
                                                    <option value="portfolio" <?php echo $image['page'] === 'portfolio' ? 'selected' : ''; ?>>Portfolio</option>
                                                </select>
                                                <div class="edit-actions">
                                                    <button type="submit" name="edit_image" class="btn-edit">
                                                        <i class="fas fa-save"></i> Update
                                                    </button>
                                                    <a href="admin.php?delete=<?php echo $image['id']; ?>" 
   class="btn-delete">
    <i class="fas fa-trash"></i> Delete
</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="js/admin.js"></script>
</body>
</html>