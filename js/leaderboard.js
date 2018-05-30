var table;

function initializeLeaderboard() {
  table = $('#leaderboard').DataTable({
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
  if (moves == 0) return;
  console.log("Name" + name);
  console.log("Level" + difficulty);
  console.log("Moves" + moves);

  $.getJSON("iface.php?q=postResult&name=" + name + "&level=" + difficulty + "&moves=" + moves, function(data) {
    console.log("AJAX");
    console.log(data);
    if (data.status) {
      //Record beaten
      $(".alert.alert-success").slideDown();
    } else {
      //Record not beaten
      $(".alert.alert-warning").slideDown();
    }
    table.ajax.reload(null, false);
  });
}
