<!doctype html>
<html lang="en">
    <?php 
        require_once 'config_db.php';
        require 'master.php'; 
        $MasterPage = 'master.php';

    ?>   
        
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Front-end system</title>
    <script src="https://api.longdo.com/map/?key=08e654d1841e852fe16405f23380768f"></script>
  </head>
  <body style="background-color:GhostWhite">

        <div class="row d-fex justify-content-center align-items-center p-5">
            <div class="col card">
                  <div class="pt-5">
                    <h2 class="col-12 mb-4">Richtig Module</h2>
                        <div class="col-12">
                                    <div class="mb-3">
                                        <h5 class="form-label">Title</h5>
                                        <input class="form-control" placeholder="Title" type="text" name="title" />
                                    </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <h5 class="form-label">Description</h5>
                                <textarea class="form-control" rows="4" style="resize: none"
                                 placeholder="Description" type="text"></textarea>
                            </div>
                        </div>
                                <div class="col-12 mb-3">
                                    <h5 class="form-label">Date</h5>
                                    <div class="d-flex ">
                                        <div class="col-6 d-flex align-items-baseline ">
                                            <p class="m-0  col-2"> Start date : </p>
                                            <input class="form-control flatpickr-input me-2 col" type="date" >
                                        </div>
                                        <div class="col-6 d-flex align-items-baseline">
                                            <p class="col-2"> End Date : </p>
                                            <input class="form-control flatpickr-input col" type="date" >
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-4" id="divmap" >
                                    <div class="d-flex flex-column ">
                                        <div class="col-12 d-flex flex-column ">
                                            <h5 class="form-label">Location</h5>
                                                <select  id="select-type-locat" class="form-control  mb-4" >
                                                    <option value="" selected disabled hidden> choose Location
                                                    </option>
                                                    <option value="1"> เลือกสถานที่จากที่มีข้อมูล </option>
                                                    <option value="2"> กรอกข้อมูลเอง </option>
                                                </select>

                                                <div class="d-flex col-12 flex-column align-items-center">
                                    <div id="type_Locat1"  class="col-12"  style="display:none;">
                                        <div class="col-11 d-flex align-items-baseline" >
                                           <div class="col-6 d-flex align-items-baseline ms-4">
                                            <p class="col-4">Start Location :</p>
                                            <select class="form-control col-8"
                                                                    style="width:50%" id="startLocation">
                                             <option value="" selected disabled hidden> choose Start Location </option>
                                              <option 
                                              value='
                                              {"lat":7.210400436196002,"lon":100.59164131777196}'> Amarit Bangkok Head office </option>
                                            </select>
                                        </div>
                                        <div class="col-6 d-flex align-items-baseline">
                                            <p class="col-4">End Location :</p>
                                               <select class="form-control col-8"  style="width:50%" id="endLocation">
                                                <option value="" selected disabled hidden>  choose End Location </option>
                                                 <option  value='
                                                 {"lat":13.73653391960603,"lon":100.59403613453787}'>
                                                    Amarit and Associates Company Limited
                                                 </option>
                                                </select>
                                               </div>
                                            </div>
                                       </div>
                                                       

                                                    <div id="type_Locat2" class="col-12" style="display:none;">
                                                         <div class="col-12 d-flex flex-column justify-content-evenly"   >
                                                            <div class="d-flex align-item-center col-12">
                                                                <div class="col-6 d-flex d-flex align-items-baseline ">
                                                                <p class=" col-2"> Start Location name </p>
                                                                <input class="form-control"
                                                                    placeholder="startLocationName" type="text" />
                                                                </div>
                                                                <div class="col-6 d-flex d-flex align-items-baseline">
                                                                <p class="col-2"> end Location name </p>
                                                                <input class="form-control" 
                                                                    placeholder="endLocationName" type="text"/>
                                                                </div>
                                                            </div>
                                                <div class="col-12 d-flex align-items-baseline justify-content-evenly">
                                                                <div class="col-6 d-flex align-items-baseline ">
                                                                    <p class="col-2">Start Location</p>
                                                                    <input class="form-control col mr-3" placeholder="lat" type="number" name="startLat" 
                                                                    id="startLat"/>
                                                                    <input class="form-control col" placeholder="lon" type="number" name="startLon"
                                                                    id="startLon" />
                                                                </div>
                                                                <div class="col-6 d-flex align-items-baseline ">
                                                                    <p class="col-2">End Location</p>
                                                                    <input class="form-control col mr-3"  placeholder="lat" type="number" name="endLat" 
                                                                    id="endLat"/>
                                                                    <input class="form-control col"  placeholder="lon" type="number" name="endLon" 
                                                                    id="endLon" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                       

                                            <div class="d-flex col-12 justify-content-around"
                                                        style="text-align: center;">
                                              <p class="col-3">ระยะเวลา : <span id="duration"> </span> </p>
                                              <p class="col-3">ระยะทาง : <span id="distance"> </span></p>
                                                    </div>
                                                </div>
                                        </div>
                                        <div style="height:60vh">
                                          <div class="col-12" style="height:100%" id="map"><div>  
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success col-2 me-2"
                                        id="btn-save-event">Save</button>
                                    <button type="button" class="btn btn-danger me-1 col-2" data-bs-dismiss="modal"
                                        (click)="closeEventModal('editmodalShow')">Close
                                    </button>
                                </div> -->
                        </div>  
                </div>
        </div>


    <script> 
        let data = [  {
                        start: { lat: '', lon: '' },
                        end: { lat: '', lon: '' }
                    }
                ];

        $(document).ready(function(){


            //change type location
            $('#select-type-locat').on('change',function(){
                // console.log($(this).val())
                var type = $(this).val();
                if(type == 1){
                   const div1 = document.getElementById('type_Locat1');
                   const div2 = document.getElementById('type_Locat2');
                   div1.style.display = 'block';
                   div2.style.display = 'none';
                   const startLocation = document.getElementById('startLocation');
                   const endLocation = document.getElementById('endLocation');
                   startLocation.value = '';
                   endLocation.value = '';
                }else{
                    const div1 = document.getElementById('type_Locat1');
                    const div2 = document.getElementById('type_Locat2');
                    div2.style.display = 'block';
                    div1.style.display = 'none';

                    const startLon = document.getElementById('startLon');
                    const startLat = document.getElementById('startLat');
                    const endLon = document.getElementById('endLon');
                    const endLat = document.getElementById('endLat');
                    startLon.value = '';
                    startLat.value = '';
                    endLon.value = '';
                    endLat.value = '';
                }
                data = [  {
                        start: { lat: '', lon: '' },
                        end: { lat: '', lon: '' }
                    }
                ];
                initMap(data)
                const duration = document.getElementById('duration');
                const distance = document.getElementById('distance');
                duration.innerHTML = ''; 
                distance.innerHTML = ''; 
            });

            $('#startLon,#startLat,#endLon,#endLat').on('change',async function(){
                const startLon = document.getElementById('startLon');
                const startLat = document.getElementById('startLat');
                const endLon = document.getElementById('endLon');
                const endLat = document.getElementById('endLat');

                if(startLon.value && startLat.value && endLon.value && endLat.value){
                    data = [  {
                        start: { lat: startLat.value, lon: startLon.value },
                        end: { lat: endLat.value, lon: endLon.value }
                    }
                    ];
                    try {
                        const dt = await initMap(data);
                        const duration = document.getElementById('duration');
                        const distance = document.getElementById('distance');
                        duration.innerHTML = dt.timeWithFormat; 
                        distance.innerHTML = dt.distanceWithFormat; 

                    } catch (error) {
                        console.error('Error initializing map:', error);
                    }
                }
            });

            $('#startLocation,#endLocation').on('change',async function(){
                const startLocation = document.getElementById('startLocation');
                const endLocation = document.getElementById('endLocation');

                if(startLocation.value && endLocation.value){
                    data = [  {
                        start: JSON.parse(startLocation.value),
                        end: JSON.parse(endLocation.value)
                    }
                    ];
                    try {
                        const dt = await initMap(data);
                        const duration = document.getElementById('duration');
                        const distance = document.getElementById('distance');
                        duration.innerHTML = dt.timeWithFormat;
                        distance.innerHTML =  dt.distanceWithFormat; 

                    } catch (error) {
                        console.error('Error initializing map:', error);
                    }
                }
            });
        });
      

        function initMap(data) {
        return new Promise((resolve, reject) => {
        var map = new longdo.Map({
            placeholder: document.getElementById('map')

        });

        document.getElementById('map').addEventListener('touchstart', function (event) {
            event.preventDefault();
        }, { passive: false });

        map.Ui.Mouse.enableClick(false);
        map.Ui.LayerSelector.visible(false);
        map.Ui.Geolocation.visible(false);
        map.Ui.Toolbar.visible(false);
        map.Ui.Fullscreen.visible(false);
        map.Ui.Crosshair.visible(false);
        map.Ui.Keyboard.enable(false);
        map.Ui.Keyboard.enableInertia(false);
        map.Ui.Mouse.enableClick(false);
        map.Layers.setBase(longdo.Layers.POI);
        let dataDistance;
        if (Object.keys(data).length > 0) {

            let mapdata = {
                // "id": 1,
                "flat": '',
                "flon": '',
                "tlat": '',
                "tlon": '',
            }

            data.forEach(element => {
                mapdata.flat = element.start.lat
                mapdata.flon = element.start.lon
                mapdata.tlat = element.end.lat
                mapdata.tlon = element.end.lon
            });



            var Marker = new longdo.Marker(
                { lon: mapdata.flon, lat: mapdata.flat },
            );

            var Marker2 = new longdo.Marker(
                { lon: mapdata.tlon, lat: mapdata.tlat },
            );

            map.Event.bind("ready", function () {
                map.Route.add(Marker);
                map.Route.add(Marker2);
                map.Route.label(longdo.RouteLabel.Hide);
                map.Route.mode(longdo.RouteMode.Cost);
                map.Route.search();
            })


            map.Event.bind('pathComplete', (data) => {
                try {
                    // console.log('flon:' + map.Route.guide()[0].from.lon)
                    // console.log('flat:' + map.Route.guide()[0].from.lat)
                    // console.log('tlon:' + map.Route.guide()[0].to.lon)
                    // console.log('tlat:' + map.Route.guide()[0].to.lat)
                    // console.log('distance: ' + map.Route.distance('kilometer'))
                    // console.log('time: ' + map.Route.interval('hour'))

                    map.bound({
                        minLon: Math.min(map.Route.guide()[0].from.lon, map.Route.guide()[0].to.lon), minLat: Math.min(map.Route.guide()[0].from.lat, map.Route.guide()[0].to.lat),
                        maxLon: Math.max(map.Route.guide()[0].from.lon, map.Route.guide()[0].to.lon), maxLat: Math.max(map.Route.guide()[0].from.lat, map.Route.guide()[0].to.lat),

                    }, {
                        lon: map.Route.guide()[0].from.lon, lat: map.Route.guide()[0].from.lat
                    })

                    dataDistance = {
                        distance: map.Route.distance(),
                        time:map.Route.interval(),
                        distanceWithFormat: map.Route.distance('kilometer'),
                        timeWithFormat: map.Route.interval('hour'),
                    }
                    resolve(dataDistance);

                }catch (error) {
                    // Handle error
                    console.error('Error processing path:', error);
                    reject(error);
                }
            })

        }

    });
    }

    </script>
    
  </body>
</html>
<?php sqlsrv_close($conn); ?>