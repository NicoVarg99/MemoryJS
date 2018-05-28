var flipped = 0;
var c1 = "";
var c2 = "";
var moves = 0;
var difficulty = "medium"
var interval;

function shuffle(a) {
  var j, x, i;
  for (i = a.length - 1; i > 0; i--) {
    j = Math.floor(Math.random() * (i + 1));
    x = a[i];
    a[i] = a[j];
    a[j] = x;
  }
  return a;
}

function checkMatch() { //To be called when 2 cards are uncovered
  if (c1 == c2) { //Check if equal
    //Hide matching cards
    $('.card').filter(function() {
        return $($(this).children()[1]).css('background-color') == c1;
    }).fadeTo("slow", 0, function() {
    	$(".card").filter(function() {
          return $($(this).children()[1]).css('background-color') == c1;
      }).hide();
      $(".card").filter(function() {
          return $($(this).children()[1]).css('background-color') == c1;
      }).remove();
    });
  } else { //Not equal, unflip them
    $(".card").flip(false);
  }
  flipped = 0;
}





function initializeWithSize(r, c) {
  console.log("r = " + r + " - c = " + c);
  clearInterval(interval);
  moves = 0;
  $("#moves").html("Moves: " + moves);

  var i, j;
  var colors8 = ["#FF0000", "#FF0000", "#FF7F00", "#FF7F00",
    "#FFFF00", "#FFFF00", "#00FF00", "#00FF00"
  ];

  var colors16 = ["#FF0000", "#FF0000", "#FF7F00", "#FF7F00",
    "#FFFF00", "#FFFF00", "#00FF00", "#00FF00",
    "#0000FF", "#0000FF", "#8B00FF", "#8B00FF",
    "#000000", "#000000", "#FFFFFF", "#FFFFFF"
  ];

  var colors24 = ["#FF0000", "#FF0000", "#FF7F00", "#FF7F00",
    "#FFFF00", "#FFFF00", "#00FF00", "#00FF00",
    "#0000FF", "#0000FF", "#8B00FF", "#8B00FF",
    "#000000", "#000000", "#FFFFFF", "#FFFFFF",
    "#b82245", "#b82245", "#ada870", "#ada870",
    "#f00dfc", "#f00dfc", "#ba92f7", "#ba92f7"
  ];

  if (r == 2 && c == 4) colors = shuffle(colors8);
  if (r == 4 && c == 4) colors = shuffle(colors16);
  if (r == 4 && c == 6) colors = shuffle(colors24);

  var content = "<table id='memTab'>"
  for (i = 0; i < r; i++) {
    content += '<tr>';
    for (j = 0; j < c; j++) {
      content += '<td><div class="card">\
                    <div class="front"></div>\
                    <div class="back" style="background-color: ' + colors[c * i + j] + ';"></div>\
                  </div></td>';
    }
    content += '</tr>';
  }
  content += "</table>"

  $('#memTab').replaceWith(content);
  $(".card").flip({
    trigger: "manual"
  });

  //Click on a card
  $(".card").click(function() {
    var card = $(this).data("flip-model");
    $("#moves").html("Moves: " + ++moves);
    if (card.isFlipped) { //If already flipped unflip
      $(this).flip(false);
      flipped--;
    } else if (flipped < 2) { //If 0 or 1 cards already flipped flip
      $(this).flip(true);
      flipped++;
      c1 = c2;
      c2 = $($(this).children()[1]).css("background-color");
    }

    if (flipped == 2)
      setTimeout(checkMatch, 800);
  });

  interval = setInterval(checkWinner, 100);
}

$("button").click(function () {
	$("button").removeClass('btn-primary').addClass('btn-default');
	$(this).removeClass('btn-default').addClass('btn-primary');
  difficulty = $(this).data("level");
  if (difficulty == "easy") initializeWithSize(2, 4);
  if (difficulty == "medium") initializeWithSize(4, 4);
  if (difficulty == "hard") initializeWithSize(4, 6);
})

function checkWinner() {
  if ($(".card").length == 0) {
    console.log("Pazzesco");
    $('#memTab').replaceWith("<p>You win!</p>");
    clearInterval(interval);
  }
}

//initializeWithSize(4, 4);
