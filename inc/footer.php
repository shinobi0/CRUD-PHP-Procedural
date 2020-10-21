<footer class="text-light text-center py-4">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div id="mapid" style="height: 180px"></div>
        </div>
        <div class="col-md-6">
            <i class="fab icon-footer fa-github"></i>
            <i class="fab icon-footer fa-linkedin"></i>
            <i class="fab icon-footer fa-instagram"></i>
            <div><i class="fas fa-phone-alt"></i>06.20.00.99.00</div>
            <div><i class="far fa-envelope"></i>contact@voiture.com</div>
        </div>
    </div>
</div>

</footer>
<script>



    var ctx = document.getElementById('myChart').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data : {
    datasets: [{
        data: [10, 20, 30]
    }],
    labels: [
        'HTML',
        'CSS',
        'PHP'
    ]
},
    options: {}
});



// var chart = new Chart(ctx, {
//     // The type of chart we want to create
//     type: 'line',
//     // The data for our dataset
//     data: {
//         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//         datasets: [{
//             label: 'My First dataset',
//             backgroundColor: 'rgb(255, 99, 132)',
//             borderColor: 'rgb(255, 99, 132)',
//             data: [0, 10, 5, 2, 20, 30, 45]
//         }]
//     },
//     // Configuration options go here
//     options: {}
// });


</script>


<script>
var mymap = L.map('mapid').setView([48.8534, 2.3488], 13);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoic2hpbm9iaTE5ODAiLCJhIjoiY2sxMXo4b2h4MDA1MDNucWw4b2l2aWo0cCJ9.X8_QyT3AlA_zVnkdb7j31g'
}).addTo(mymap);

</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="assets/js/script.js"></script>
</body>
</html>