$ftpServer = 'ftp://145.223.77.119'
$user = 'u998578075.dynapulsar.com'
$pass = '**pp7J7xpzz'
$remotePath = '/domains/dynapulsar.com/public_html'
$localPath = 'd:\ats-resume-portal\frontend\web'

function Upload-File {
    param($localFile, $remoteFile)
    $ftpRequest = [System.Net.FtpWebRequest]::Create("$ftpServer$remoteFile")
    $ftpRequest.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
    $ftpRequest.Credentials = New-Object System.Net.NetworkCredential($user, $pass)
    $ftpRequest.UseBinary = $true
    $ftpRequest.UsePassive = $true
    $fileContents = [System.IO.File]::ReadAllBytes($localFile)
    $ftpRequest.ContentLength = $fileContents.Length
    $requestStream = $ftpRequest.GetRequestStream()
    $requestStream.Write($fileContents, 0, $fileContents.Length)
    $requestStream.Close()
    $response = $ftpRequest.GetResponse()
    $response.Close()
}

Get-ChildItem -Path $localPath -Recurse | ForEach-Object {
    if ($_.PSIsContainer) {
        $remoteDir = $remotePath + '/' + $_.FullName.Replace($localPath, '').Replace('\', '/')
        $ftpRequest = [System.Net.FtpWebRequest]::Create("$ftpServer$remoteDir")
        $ftpRequest.Method = [System.Net.WebRequestMethods+Ftp]::MakeDirectory
        $ftpRequest.Credentials = New-Object System.Net.NetworkCredential($user, $pass)
        try { $response = $ftpRequest.GetResponse(); $response.Close() } catch { }
    } else {
        $remoteFile = $remotePath + '/' + $_.FullName.Replace($localPath, '').Replace('\', '/')
        Upload-File $_.FullName $remoteFile
    }
}