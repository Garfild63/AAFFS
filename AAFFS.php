<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">

  <title>Open horizons</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="style.css"/>

  <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

       <div class="header">
            <div class="zagolovok"> <h1> Open Horison </h1> </div>
	<div class= “podzagolovok”><h4>В прошлое могут смотреть не только лишь все</h4> </div>
       </div>



<div id="map" style="width: 100%; height: 600px;"></div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Сведения и отзывы</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalContent">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Больше информации</button>
      </div>
    </div>
  </div>
</div>

<footer>
<p>
        Создано командой EmeraldCode<br> Состав: 
         <a class="add_place" href="http://garf63.hostronavt.ru/index.php">Добавьте свою точку!</a><br>
                <a href="https://vk.com/alexander4upin"> Александр Чупин,   </a>
        <a href="https://vk.com/garfild63"> Антон Колесников,   </a>
        <a href="https://vk.com/lihonenko"> Тимофей Лихоненко,   </a> <br>
        <a href="https://vk.com/s.blinnikova"> Софья Блинникова,   </a>
        <a href="https://vk.com/daria1503"> Дарья Подковыркина </a>
       </p>

</footer>


<script type="text/javascript">
  function moveMapToEurope(map){
    map.setCenter({lat:44, lng:12});
    map.setZoom(14);
  }

//Step 1: initialize communication with the platform
  var platform = new H.service.Platform({
    apikey: 'NPHmEQWNZZU5jr573k9L'
  });
  var defaultLayers = platform.createDefaultLayers();

  //Step 2: initialize a map - this map is centered over Europe
  var map = new H.Map(document.getElementById('map'),
    defaultLayers.vector.normal.map,{
      center: {lat:44, lng:12},
      zoom: 3,
      pixelRatio: window.devicePixelRatio || 1
    });
  // add a resize listener to make sure that the map occupies the whole container
  window.addEventListener('resize', () => map.getViewPort().resize());

  //Step 3: make the map interactive
  // MapEvents enables the event system
  // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
  var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

  // Create the default UI components
  var ui = H.ui.UI.createDefault(map, defaultLayers);

  const createMarker = (text, coords) => {
    var svgMarkup = `
      <div>
<img src="Marker.png">
        <span style="color: black; padding: 2px; line-height: 26px;">${text}</span>
      </div>
    `;
    var icon = new H.map.DomIcon(svgMarkup);
    return new H.map.DomMarker(coords, {icon: icon});
  };

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
        echo "}, comment: '\\n ";
		echo $arr[4];
		echo "', photo: '";
		echo $arr[5];
		echo "', description: '";
        echo $arr[6];
        echo "'}, ";
    }
    echo "];";
}
?>

  markers.forEach(el => {
    const marker = createMarker(el.text, el.coords);
    marker.data = el;
    map.addObject(marker);
  });
  var parentEl = document.getElementById('modalContent'),
      img = document.createElement("IMG");
  img.width = 450; //Настройка ширины изображения
  img.height = 300; //Настройка высоты изображения
  map.addEventListener('tap', (e) => {
    img.src = e.target.data.photo;
    document.getElementById('modalContent').innerText = e.target.data.description + '\n' + e.target.data.comment;
    parentEl.appendChild(img);
    $('#exampleModal').modal('show');
  });
</script>
</body>
</html>

