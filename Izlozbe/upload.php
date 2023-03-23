<?php



if(isset($_GET['broj'])){
        $broj = $_GET['broj'];

 
}


$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "wav");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "audio/wav")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg"))
        

&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    mkdir("slike$broj", 0777, true);

    if (file_exists("slike$broj/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
        
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "slike$broj/" . $_FILES["file"]["name"]);

      header('Location: vlak.php?vlak='.$broj.'');
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>