// Define variables
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var width = window.innerWidth;
var height = window.innerHeight;
var meteors = [];

// Create the Meteor class
function Meteor(x, y, radius, color, speed) {
  this.x = x;
  this.y = y;
  this.radius = radius;
  this.color = color;
  this.speed = speed;
}

// Define the draw function for the Meteor class
Meteor.prototype.draw = function() {
  ctx.beginPath();
  ctx.arc(this.x, this.y, this.radius, 0, Math.PI*2);
  ctx.fillStyle = this.color;
  ctx.fill();
}

// Define the update function for the Meteor class
Meteor.prototype.update = function() {
  this.x -= this.speed;
  this.y += this.speed;
  this.draw();
}

// Initialize the meteors array
for (var i = 0; i < 50; i++) {
  var x = Math.random() * width;
  var y = Math.random() * height;
  var radius = Math.random() * 3 + 1;
  var color = "#ffffff";
  var speed = Math.random() * 5 + 1;
  meteors.push(new Meteor(x, y, radius, color, speed));
}

// Define the animate function
function animate() {
  requestAnimationFrame(animate);
  ctx.clearRect(0, 0, width, height);

  for (var i = 0; i < meteors.length; i++) {
    if (meteors[i].x < -50 || meteors[i].y > height + 50) {
      meteors.splice(i, 1);
      var x = Math.random() * width;
      var y = -50;
      var radius = Math.random() * 3 + 1;
      var color = "#ffffff";
      var speed = Math.random() * 5 + 1;
      meteors.push(new Meteor(x, y, radius, color, speed));
    } else {
      meteors[i].update();
    }
  }
}

// Start the animation
animate();
