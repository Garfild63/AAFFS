<?php
$link = mysqli_connect('sql305.hostronavt.ru', 'onavt_25293093', 'pidorasy83', 'onavt_25293093_database');
$result = mysqli_query($link, 'SELECT * FROM Sights WHERE TRUE');
if ($row = mysqli_fetch_all($result)) {
    echo "const markers = [ ";
    foreach ($row as $arr) {
        echo "{ text: '";
        echo $arr[1];
        echo "', coords: {lat:";
        echo $arr[2];
        echo ", lng:";
        echo $arr[3];
        echo "}, old_photo1: '";
		echo $arr[4];
		echo "', old_photo2: '";
		echo $arr[5];
		echo "', old_photo3: '";
		echo $arr[6];
		echo "', photo: '";
		echo $arr[7];
		echo "', description: '";
        echo $arr[8];
        echo "'}, ";
    }
    echo "];";
}
?>
