<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $world = $_POST['world'];
    
    // Handle file upload
    if (isset($_FILES['world_image']) && $_FILES['world_image']['error'] == 0) {
        $file = $_FILES['world_image'];
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $max_file_size = 5 * 1024 * 1024; // 5MB

        if (in_array($file_ext, $allowed_ext) && $file_size <= $max_file_size) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $new_file_name = $world . '_' . $username . '.' . $file_ext;
            move_uploaded_file($file_tmp, $upload_dir . $new_file_name);
            
            // Save world submission (this example just outputs success message)
            echo "World submitted successfully!";
        } else {
            echo "Invalid file type or size exceeded!";
        }
    } else {
        echo "Failed to upload world image.";
    }
}
?>
