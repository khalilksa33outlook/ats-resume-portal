$ftpServer = "ftp://145.223.77.119"
$username = "u998578075.dynapulsar.com"
$password = "**pp7J7xpzz**"
$localPath = "D:\ats-resume-portal"
$remotePath = "/"

$webClient = New-Object System.Net.WebClient
$webClient.Credentials = New-Object System.Net.NetworkCredential($username, $password)

function Upload-Directory {
    param($localDir, $remoteDir)
    $files = Get-ChildItem $localDir
    foreach ($file in $files) {
        if ($file.PSIsContainer) {
            Upload-Directory $file.FullName ($remoteDir + $file.Name + "/")
        } else {
            $remoteFile = $remoteDir + $file.Name
            $webClient.UploadFile($ftpServer + $remoteFile, $file.FullName)
        }
    }
}

Upload-Directory $localPath $remotePath