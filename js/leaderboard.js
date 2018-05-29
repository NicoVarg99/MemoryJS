function initializeLeaderboard() {
  var table = $('#leaderboard').DataTable({
    "processing": true,
    "ajax": {
      "url": window.location.pathname + "iface.php?q=getLeaderboard&level=" + difficulty,
      dataSrc: ''
    }, searching: false,
    paging: false,
    "bInfo" : false,
    "columns": [{
      "data": "rank"
    }, {
      "data": "name"
    }, {
      "data": "moves"
    }, {
      "data": "timestamp"
    }]
  });

  // //Auto refresh
  // setInterval( function () {
  //   table.ajax.reload(null, false);
  // }, 5000 );
}

function reInitializeLeaderboard() {
  $('#leaderboard').DataTable().destroy();
  initializeLeaderboard();
}

function pushRecord() {
  console.log("Name" + name);
  console.log("Level" + difficulty);
  console.log("Moves" + moves);
}
