function initializeLeaderboard() {
  $('#leaderboard').DataTable({
    "processing": true,
    "ajax": {
      "url": window.location.pathname + "iface.php?q=getLeaderboard&level=" + difficulty,
      dataSrc: ''
    },
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
}

function reInitializeLeaderboard() {
  $('#leaderboard').DataTable().destroy();
  initializeLeaderboard();
}
