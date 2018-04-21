var flipped = 0;
var c1 = "";
var c2 = "";
var moves = 0;

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
    });
  } else { //Not equal, unflip them
    $(".card").flip(false);
  }
  flipped = 0;
}

var i, j;
var colors = ["#FF0000", "#FF0000", "#FF7F00", "#FF7F00",
  "#FFFF00", "#FFFF00", "#00FF00", "#00FF00",
  "#0000FF", "#0000FF", "#8B00FF", "#8B00FF",
  "#000000", "#000000", "#FFFFFF", "#FFFFFF"
];
colors = shuffle(colors);

var content = "<table id='memTab'>"
for (i = 0; i < 4; i++) {
  content += '<tr>';
  for (j = 0; j < 4; j++) {
    content += '<td><div class="card">\
                  <div class="front"></div>\
                  <div class="back" style="background-color: ' + colors[4 * i + j] + ';"></div>\
                </div></td>';
  }
  content += '</tr>';
}
content += "</table>"

$('#memTab').append(content);
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
