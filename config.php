<?php
session_start();

// Hardcoded admin credentials (in real project, use database)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'demo123');

// File paths - FIXED for Windows/XAMPP
define('DATA_FILE', __DIR__ . '/data/images.json');
define('UPLOAD_DIR', __DIR__ . '/uploads/');

// Create uploads directory if it doesn't exist
if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}

// Create data directory if it doesn't exist
if (!file_exists(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0777, true);
}

// Initialize images.json if it doesn't exist
if (!file_exists(DATA_FILE)) {
    $initialData = [
        'images' => [
            // Sample images - you need to add actual images to uploads folder
            [
                'id' => 'img_001',
                'filename' => 'wedding-1.jpg',
                'path' => 'uploads/wedding-1.jpg',
                'caption' => 'Elegant beach wedding ceremony',
                'category' => 'wedding',
                'page' => 'gallery',
                'order' => 1,
                'date_added' => date('Y-m-d')
            ],
            [
                'id' => 'img_002',
                'filename' => 'wedding-2.jpg',
                'path' => 'uploads/wedding-2.jpg',
                'caption' => 'First dance moment',
                'category' => 'wedding',
                'page' => 'gallery',
                'order' => 2,
                'date_added' => date('Y-m-d')
            ],
            [
                'id' => 'img_003',
                'filename' => 'portrait-1.jpg',
                'path' => 'uploads/portrait-1.jpg',
                'caption' => 'Professional headshot',
                'category' => 'portrait',
                'page' => 'gallery',
                'order' => 3,
                'date_added' => date('Y-m-d')
            ],
            [
                'id' => 'img_004',
                'filename' => 'event-1.jpg',
                'path' => 'uploads/event-1.jpg',
                'caption' => 'Corporate event coverage',
                'category' => 'event',
                'page' => 'gallery',
                'order' => 4,
                'date_added' => date('Y-m-d')
            ],
            [
                'id' => 'img_005',
                'filename' => 'nature-1.jpg',
                'path' => 'uploads/nature-1.jpg',
                'caption' => 'Sunset landscape',
                'category' => 'nature',
                'page' => 'gallery',
                'order' => 5,
                'date_added' => date('Y-m-d')
            ]
        ]
    ];
    file_put_contents(DATA_FILE, json_encode($initialData, JSON_PRETTY_PRINT));
}

// Function to get all images
function getAllImages() {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $data = json_decode(file_get_contents(DATA_FILE), true);
    return isset($data['images']) ? $data['images'] : [];
}

// Function to save images
function saveImages($images) {
    $data = ['images' => $images];
    return file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

// Function to add image
function addImage($filename, $caption, $category, $page) {
    $images = getAllImages();
    $newId = 'img_' . str_pad(count($images) + 1, 3, '0', STR_PAD_LEFT);
    
    $newImage = [
        'id' => $newId,
        'filename' => $filename,
        'path' => 'uploads/' . $filename,
        'caption' => $caption,
        'category' => $category,
        'page' => $page,
        'order' => count($images) + 1,
        'date_added' => date('Y-m-d')
    ];
    
    $images[] = $newImage;
    return saveImages($images);
}

// Function to update image
function updateImage($id, $caption, $category, $page) {
    $images = getAllImages();
    foreach ($images as &$image) {
        if ($image['id'] === $id) {
            $image['caption'] = $caption;
            $image['category'] = $category;
            $image['page'] = $page;
            break;
        }
    }
    return saveImages($images);
}

// Function to delete image
function deleteImage($id) {
    $images = getAllImages();
    foreach ($images as $key => $image) {
        if ($image['id'] === $id) {
            // Delete the actual file
            $filePath = __DIR__ . '/' . $image['path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            unset($images[$key]);
            break;
        }
    }
    // Reindex array
    $images = array_values($images);
    return saveImages($images);
}
?>